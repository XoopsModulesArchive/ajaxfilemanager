<?php
/**
 * Ajax File Manager
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           0.1
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */

/**
* This function transforms a numerical size (like 2048) to a lettteral size (like 2MB)
* @param   integer    $ret     numerical size
* @return  string     $size    letteral size
**/
function ajaxfilemanager_numToLet($size) {
    if($size>0) {
        $unit=array('B','KB','MB','GB','TB','PB');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    } else {
        return '';
    }
}



/**
* This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
*
* @param   string     $size    letteral size
* @return  integer    $ret     numerical size
**/
function ajaxfilemanager_letToNum($size) { 
    $l = substr($size, -1);
    $ret = substr($size, 0, -1);
    switch(strtoupper($l)) {
        case 'P':
        case 'p':
            $ret *= 1024;
        case 'T':
        case 't':
            $ret *= 1024;
        case 'G':
        case 'g':
            $ret *= 1024;
        case 'M':
        case 'm':
            $ret *= 1024;
        case 'K':
        case 'k':
            $ret *= 1024;
            break;
        }
    return $ret;
}



/**
 * This function will read the full structure of a directory.
 * It's recursive because it doesn't stop with the one directory,
 * it just keeps going through all of the directories in the folder you specify.
 *
 */
function ajaxfilemanager_getDir($path = '.', $level = 0) {
    $ret = array();
    $ignore = array('cgi-bin', '.', '..');
    // Directories to ignore when listing output. Many hosts will deny PHP access to the cgi-bin.
    $dirHandler = @opendir($path);
    // Open the directory to the handle $dirHandler
    while( false !== ($file = readdir($dirHandler ))){
    // Loop through the directory
        if( !in_array($file, $ignore)){
        // Check that this file is not to be ignored
            $spaces = str_repeat('&nbsp;',( $level * 4 ));
            // Just to add spacing to the list, to better show the directory tree.
            if(is_dir("$path/$file")){
            // Its a directory, so we need to keep reading down...
                $ret[] = "<strong>$spaces $file</strong>";
                $ret = array_merge($ret, getDir($path . DIRECTORY_SEPARATOR . $file, ($level+1)));
                // Re-call this same function but on a new directory.
                // this is what makes function recursive.
            } else {
                $ret[] = "$spaces $file";
                // Just print out the filename
            }
        }
    }
    closedir( $dirHandler );
    // Close the directory handle
    return $ret;
}



/**
 * Create a new directory that contains the file index.html
 *
 */
function ajaxfilemanager_makeDir($dir, $perm = 0777) {
    if (!is_dir($dir)){
        if (!@mkdir($dir, $perm)){
            return false;
        } else {
            if ($fileHandler = @fopen($dir . '/index.html', 'w'))
                fwrite($fileHandler, '<script>history.go(-1);</script>');
            @fclose($fileHandler);
            return true;
        }
    }
}



/**
 * Create a new directory that contains the file index.html
 *
 * $source: is the original directory
 * $destination: is the destination directory
 * Returns TRUE on success or FALSE on failure
 *
 */
function ajaxfilemanager_copyDir($source, $destination) {
    if (!$dirHandler = opendir($source))
        return false;
    @mkdir($destination);
    while(false !== ( $file = readdir($dirHandler)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($source . '/' . $file) ) {
                if (!ajaxfilemanager_copyDir($source . '/' . $file, $destination . '/' . $file))
                    return false;
            }
            else {
                if (!copy($source . '/' . $file, $destination . '/' . $file))
                    return false;
            }
        }
    }
    closedir($dirHandler);
    return true;
}



/**
 * Delete a not empty directory
 *
 * $dir: is the directory to delete
 * $if_not_empty: if FALSE it delete directory only if false
 * Returns TRUE on success or FALSE on failure
 */
function ajaxfilemanager_delDir($dir, $if_not_empty = true) {
    if (!file_exists($dir)) return true;
    if ($if_not_empty == true) {
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!ajaxfilemanager_delDir($dir . '/' . $item)) return false;
        }
    } else {
        // NOP
    }
    return rmdir($dir);
}



/**
 * Extension functions
 *
 */

function ajaxfilemanager_extensionInstalled($extension) {
    return file_exists(XOOPS_ROOT_PATH . '/class/textsanitizer/' . $extension . '/' . $extension . '.php');
}
function extensionActivated($extension) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    if (!isset($conf['extensions'][$extension])) {
        return false;
    } else {
        return $conf['extensions'][$extension];
    }
}
function ajaxfilemanager_activateExtension($extension) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    $conf['extensions'][$extension] = 1;
    file_put_contents(XOOPS_ROOT_PATH . '/class/textsanitizer/config.php', "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
}
function ajaxfilemanager_desactivateExtension($extension) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    $conf['extensions'][$extension] = 0;
    file_put_contents(XOOPS_ROOT_PATH . '/class/textsanitizer/config.php', "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
}
function ajaxfilemanager_listExtensions($source) {
    if (!$dirHandler = opendir($source))
        return false;
    $extensions = array();
    while(false !== ( $file = readdir($dirHandler)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($source . '/' . $file) ) {
                $extensions[] = $file;
            }
        }
    }
    closedir($dirHandler);
    return $extensions;
}

function ajaxfilemanager_installCustomTinymceSettings() {
	// load Tinymce settings
	if (!($conf = @include( $GLOBALS['xoops']->path('var/configs/tinymce.php')))) {
		$conf = include XOOPS_ROOT_PATH . '/class/xoopseditor/tinymce/settings.php';
	}
	// backup old settings
	$backconf = array();
	//if (isset($conf['file_browser_callback'])) {$backconf['file_browser_callback'] = $conf['file_browser_callback'];}
	@$backconf['file_browser_callback'] = $conf['file_browser_callback'];
    //if (isset($conf['callback'])) {$backconf['callback'] = $conf['callback'];}
    @$backconf['callback'] = $conf['callback'];
	// set new settings
    $conf['file_browser_callback'] = "ajaxfilemanager";
	$conf['callback'] = "function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = '" . XOOPS_URL . "/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce&config=ajaxfilemanager&language=" . _LANGCODE . "';
			var view = 'detail';
			switch (type) {
				case 'image':
				view = 'thumbnail';
					break;
				case 'media':
					break;
				case 'flash': 
					break;
				case 'file':
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: '" . XOOPS_URL . "/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce&config=ajaxfilemanager&language=" . _LANGCODE . "',
                width: 782,
                height: 440,
                inline : 'yes',
                close_previous : 'no'
            },{
                window : win,
                input : field_name
            });
		}";
    file_put_contents( $GLOBALS['xoops']->path('var/configs/tinymce.php'), "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
    if (!empty($backconf))
		file_put_contents( $GLOBALS['xoops']->path('var/configs/tinymce.bak.php'), "<?php\rreturn \$config = " . var_export($backconf, true) . "\r?>");
	return true;
}
function ajaxfilemanager_uninstallCustomTinymceSettings() {
	$conf = @include( $GLOBALS['xoops']->path('var/configs/tinymce.php'));
    $backconf = @include( $GLOBALS['xoops']->path('var/configs/tinymce.bak.php'));
    $conf = @array_merge($conf, $backconf);
    file_put_contents( $GLOBALS['xoops']->path('var/configs/tinymce.php'), "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
    unlink( $GLOBALS['xoops']->path('var/configs/tinymce.bak.php'));
}
function ajaxfilemanager_installedCustomTinymceSettings() {
	if (!($conf = @include( $GLOBALS['xoops']->path('var/configs/tinymce.php'))))
		return false;
	if (!isset($conf['file_browser_callback']))
		return false;
	if (!($conf['file_browser_callback'] == "ajaxfilemanager"))
		return false;
	if (!isset($conf['callback']))
		return false;
	return true;
}
?>