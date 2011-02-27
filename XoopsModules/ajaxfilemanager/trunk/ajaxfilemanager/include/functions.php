<?php
/**
* This function transforms a numerical size (like 2048) to a lettteral size (like 2MB)
* @param   integer    $ret     numerical size
* @return  string     $size    letteral size
**/
function numToLet($size) {
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
function letToNum($size) { 
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
 * Get variables passed by GET or POST method
 *
 */
function system_CleanVars( &$global, $key, $default = '', $type = 'int' ) {
    switch ( $type ) {
        case 'string':
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_MAGIC_QUOTES ) : $default;
            break;
        case 'int': default:
            $ret = ( isset( $global[$key] ) ) ? filter_var( $global[$key], FILTER_SANITIZE_NUMBER_INT ) : $default;
            break;
    }
    if ( $ret === false ) {
        return $default;
    }
    return $ret;
}






/**
 * This function will read the full structure of a directory.
 * It's recursive because it doesn't stop with the one directory,
 * it just keeps going through all of the directories in the folder you specify.
 *
 */
function getDir($path = '.', $level = 0) {
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
function makeDir($dir) {
    if (!is_dir($dir)){
        if (!mkdir($dir)){
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
function copyDir($source, $destination) {
    if (!$dirHandler = opendir($source))
        return false;
    @mkdir($destination);
    while(false !== ( $file = readdir($dirHandler)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($source . '/' . $file) ) {
                if (!copyDir($source . '/' . $file, $destination . '/' . $file))
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
function delDir($dir, $if_not_empty = true) {
    if (!file_exists($dir)) return true;

    if ($if_not_empty == true) {
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!delDir($dir . '/' . $item)) return false;
        }
    }
    else {
    }

    return rmdir($dir);
}



/**
 * Extention functions
 *
 */

function extentionInstalled($extention) {
    return file_exists(XOOPS_ROOT_PATH . '/class/textsanitizer/' . $extention . '/' . $extention . '.php');
}
function extentionActivated($extention) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    return $conf['extensions'][$extention];
}
function activateExtention($extention) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    $conf['extensions'][$extention] = 1;
    file_put_contents(XOOPS_ROOT_PATH . '/class/textsanitizer/config.php', "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
}
function desactivateExtention($extention) {
    $conf = include XOOPS_ROOT_PATH . '/class/textsanitizer/config.php';
    $conf['extensions'][$extention] = 0;
    file_put_contents(XOOPS_ROOT_PATH . '/class/textsanitizer/config.php', "<?php\rreturn \$config = " . var_export($conf, true) . "\r?>");
}
function listExtentions($source) {
    if (!$dir = opendir($source))
        return false;
    $extentions = array();
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($source . '/' . $file) ) {
                $extentions[] = $file;
            }
        }
    }
    closedir($dir);
    return $extentions;
}

?>
