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

include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes
xoops_load('xoopsformloader');
$errors = array();
$output = '';

// Get user groups array
$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
// $admin is true if user is an admin
$admin = (is_object($xoopsUser) && $xoopsUser->isAdmin($GLOBALS['xoopsModule']->mid())) ? true : false;

// get/check parameters/post
if(isset($_POST['op'])) {
    $op = $_POST['op'];
} else {
    $op = 'default';
}


if(isset($_POST['extension'])) {
    $extension = $_POST['extension'];
}


switch( $op ) {
case 'dump_images_cache':
    if (delDir(XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/imagecache", true)) {
        if (makeDir(XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/imagecache")) {
            redirect_header($currentFile, 3, _AJAXFM_AM_DUMP_IMAGES_CACHE_OK);
        } else {
            redirect_header($currentFile, 3, _AJAXFM_AM_DUMP_IMAGES_CACHE_NOT_OK);
        }
    } else {
        redirect_header($currentFile, 3, _AJAXFM_AM_DUMP_IMAGES_CACHE_NOT_OK);
    }
    break;
case 'install_tinymce':
    installCustomTinymceSettings();
    redirect_header($currentFile, 3, _AJAXFM_AM_EDITORPLUGIN_INSTALLED_OK);
    break;
case 'uninstall_tinymce':
    uninstallCustomTinymceSettings();
    redirect_header($currentFile, 3, _AJAXFM_AM_EDITORPLUGIN_UNINSTALLED_OK);
    break;
case 'activate_extension':
    activateExtension($extension);
    redirect_header($currentFile, 3, _AJAXFM_AM_EXTENSION_ACTIVATED);
    break;
case 'desactivate_extension':
    desactivateExtension($extension);
    redirect_header($currentFile, 3, _AJAXFM_AM_EXTENSION_DISABLED);
    break;
case 'install_extension':
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/textsanitizer.extension' .  '/' . $extension;
    $destination = XOOPS_ROOT_PATH . '/class/textsanitizer/' . $extension;
    if(!file_exists($source)) {
        redirect_header($currentFile, 3, _AJAXFM_AM_EXT_FILE_DONT_EXIST_SHORT);
        break;
    }
    // Copy extension
    if (!copyDir($source, $destination)) {
        redirect_header($currentFile, 3, _AJAXFM_AM_EXT_FILE_NOT_INSTALLABLE);
    }
    // Activate extension
    activateExtension($extension);
    redirect_header($currentFile, 3, _AJAXFM_AM_EXTENSION_INSTALLED . "<br />" . $extension . ' ' . _AJAXFM_AM_EXTENSION_ACTIVATED);
    break;
default:
case 'default':
    // render start here
    xoops_cp_header();

    // main admin menu
    include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
    echo moduleAdminTabMenu($adminmenu, $currentFile);
    // check if estansions path is writable
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';
    if (!is_writable($extensionsPath) or !is_writable($extensionsPath . '/config.php')) {
        echo '<p>' . sprintf(_AJAXFM_AM_EXTENSION_WARNING1, $extensionsPath, $extensionsPath) . '</p>';
        echo '<p>' . sprintf(_AJAXFM_AM_EXTENSION_WARNING2, $extensionsPath, $extensionsPath) . '</p>';
    }

    // Ajax File Manager extensions
	echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_EXTRA_EXTENSION_INFO . "</legend>";
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/textsanitizer.extension';
    $extraExtensions = listExtensions($source);

    echo _AJAXFM_AM_EXTRA_EXTENSION_INFO_DESC;
    echo "<table class=''>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AJAXFM_AM_EXTENSION . "</th>";
    echo "<th>" . _AJAXFM_AM_EXTENSION_STATUS . "</th>";
    echo "<th>" . _AJAXFM_AM_EXTENSION_ACTION . "</th>";
    echo "</tr>";
    $class = 0;

    foreach ($extraExtensions as $extension) {
        $class++;
        echo "<tr class='" . (($class&1)?'odd':'even') . "'>";
        echo "<td><h3>" . $extension . "</h3></td>";
        if(!extensionInstalled($extension)) {
            echo "<td>";
            echo "  <span style='color:red;'>" . _AJAXFM_AM_EXTENSION_NOT_INSTALLED . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='install_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AJAXFM_AM_INSTALL_EXTENSION . "'' type='submit' />";
            echo "  </form>";
            echo "</td>";
        } else {
            if(!extensionActivated($extension)) {
                echo "<td>";
                echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_INSTALLED_OK . "</span>";
                echo "  <br />";
                echo "  <span style='color:red;'>" . _AJAXFM_AM_EXTENSION_NOT_ACTIVATED . "</span>";
                echo "</td>";
                echo "<td>";
                echo "  <form action='" . $currentFile . "' method='post'>";
                echo "  <input type='hidden' name='op' value='activate_extension' />";
                echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
                echo "  <input class='formButton' value='" . _AJAXFM_AM_ACTIVATE_EXTENSION . "'' type='submit' />";
                echo "  </form>";
                echo "</td>";
            } else {
                echo "<td>";
                echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_INSTALLED_OK . "</span>";
                echo "  <br />";
                echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_ACTIVATED_OK . "</span>";
                echo "</td>";
                echo "<td>";
                echo "  <form action='" . $currentFile . "' method='post'>";
                echo "  <input type='hidden' name='op' value='desactivate_extension' />";
                echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
                echo "  <input class='formButton' value='" . _AJAXFM_AM_DISABLE_EXTENSION . "' type='submit' />";
                echo "</form>";
                echo "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";

    echo "<br />";

    // Ajax File Manager editors plugins
	echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_EDITORPLUGIN_INFO . "</legend>";
    echo "<table class=''>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AJAXFM_AM_EDITOR . "</th>";
    echo "<th>" . _AJAXFM_AM_EDITOR_STATUS . "</th>";
    echo "<th>" . _AJAXFM_AM_EDITOR_ACTION . "</th>";
    echo "</tr>";
	echo "<tr class='odd'>";
	echo "<td>";
	echo "<h3>" . _AJAXFM_AM_EDITORTINYMCE . "</h3>";
	$source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/tinymce.plugin/tinymce.php';
	$destination = $GLOBALS['xoops']->path('var/configs/tinymce.php');
	echo sprintf(_AJAXFM_AM_EDITORTINYMCE_DESC, $source , $destination);
	echo "</td>";
	if(!installedCustomTinymceSettings()) {
		echo "<td>";
		echo "  <span style='color:red;'>" . _AJAXFM_AM_EDITORPLUGIN_NOT_INSTALLED . "</span>";
		echo "</td>";
		echo "<td>";
		echo "  <form action='" . $currentFile . "' method='post'>";
		echo "  <input type='hidden' name='op' value='install_tinymce' />";
		echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
		echo "  <input class='formButton' value='" . _AJAXFM_AM_INSTALL_EDITORPLUGIN . "'' type='submit' />";
		echo "  </form>";
		echo "</td>";
	} else {
		echo "<td>";
		echo "  <span style='color:green;'>" . _AJAXFM_AM_EDITORPLUGIN_INSTALLED . "</span>";
		echo "</td>";
		echo "<td>";
		echo "  <form action='" . $currentFile . "' method='post'>";
		echo "  <input type='hidden' name='op' value='uninstall_tinymce' />";
		echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
		echo "  <input class='formButton' value='" . _AJAXFM_AM_UNINSTALL_EDITORPLUGIN . "' type='submit' />";
		echo "</form>";
		echo "</td>";
	}
	echo "</tr>";
    echo "</tbody>";
    echo "</table>";

    echo "</fieldset>";

    echo "<br />";

	// Standard or extra Xoops extensions
    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_EXTENSION_INFO . "</legend>";
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';
    $extensions = listExtensions($extensionsPath);
    $extensions = array_diff($extensions, $extraExtensions);

    echo "<table class=''>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AJAXFM_AM_EXTENSION . "</th>";
    echo "<th>" . _AJAXFM_AM_EXTENSION_STATUS . "</th>";
    echo "<th>" . _AJAXFM_AM_EXTENSION_ACTION . "</th>";
    echo "</tr>";
    $class = 0;
    foreach ($extensions as $extension) {
        $class++;
        echo "<tr class='" . (($class&1)?'odd':'even') . "'>";
        echo "<td><h3>" . $extension . "</h3></td>";
        if(!extensionActivated($extension)) {
            echo "<td>";
            echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_INSTALLED_OK . "</span>";
            echo "  <br />";
            echo "  <span style='color:red;'>" . _AJAXFM_AM_EXTENSION_NOT_ACTIVATED . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='activate_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AJAXFM_AM_ACTIVATE_EXTENSION . "'' type='submit' />";
            echo "  </form>";
            echo "</td>";
        } else {
            echo "<td>";
            echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_INSTALLED_OK . "</span>";
            echo "  <br />";
            echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENSION_ACTIVATED_OK . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='desactivate_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AJAXFM_AM_DISABLE_EXTENSION . "' type='submit' />";
            echo "</form>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</fieldset>";

	// Standard or enhanced image.php in xoops root path?
    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_IMAGE_PHP_INFO . "</legend>";
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';

    $originalImagePhp = XOOPS_ROOT_PATH . '/image.php';
    $enhancedImagePhp = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/image.php';
    $crcOriginalImagePhp = strtoupper(dechex(crc32(file_get_contents($originalImagePhp))));
    $crcEnhancedImagePhp = strtoupper(dechex(crc32(file_get_contents($enhancedImagePhp))));

    if ($crcOriginalImagePhp != $crcEnhancedImagePhp) {
        // files not the same
        echo _AJAXFM_AM_IMAGE_PHP_NO_SMART;
        echo "<br />";
        echo _AJAXFM_AM_IMAGE_PHP_NO_SMART_DESC;
    } else {
        // files the same
        echo _AJAXFM_AM_IMAGE_PHP_SMART;
        echo "<br />";
        echo _AJAXFM_AM_IMAGE_PHP_SMART_DESC;
        echo "<br />";
        echo "<form action='" . $currentFile . "' method='post'>";
        echo "<input type='hidden' name='op' value='dump_images_cache' />";
        echo "<input class='formButton' value='" . _AJAXFM_AM_DUMP_IMAGES_CACHE . "'' type='submit' />";
        echo "</form>";
    }
    echo "</fieldset>";
	
    xoops_cp_footer();
    break;
} // switch ( $op )
?>