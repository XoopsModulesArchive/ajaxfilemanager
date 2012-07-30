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
    if (ajaxfilemanager_delDir(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/imagecache', true)) {
        if (ajaxfilemanager_makeDir(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/imagecache')) {
            redirect_header($currentFile, 3, _AM_AJAXFM_DUMP_IMAGES_CACHE_OK);
        } else {
            redirect_header($currentFile, 3, _AM_AJAXFM_DUMP_IMAGES_CACHE_NOT_OK);
        }
    } else {
        redirect_header($currentFile, 3, _AM_AJAXFM_DUMP_IMAGES_CACHE_NOT_OK);
    }
    break;
case 'install_tinymce':
    ajaxfilemanager_installCustomTinymceSettings();
    redirect_header($currentFile, 3, _AM_AJAXFM_EDITORPLUGIN_INSTALLED_OK);
    break;
case 'uninstall_tinymce':
    ajaxfilemanager_uninstallCustomTinymceSettings();
    redirect_header($currentFile, 3, _AM_AJAXFM_EDITORPLUGIN_UNINSTALLED_OK);
    break;
case 'activate_extension':
    ajaxfilemanager_activateExtension($extension);
    redirect_header($currentFile, 3, _AM_AJAXFM_EXTENSION_ACTIVATED);
    break;
case 'desactivate_extension':
    ajaxfilemanager_desactivateExtension($extension);
    redirect_header($currentFile, 3, _AM_AJAXFM_EXTENSION_DISABLED);
    break;
case 'install_extension':
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/textsanitizer.extensions' .  '/' . $extension;
    $destination = XOOPS_ROOT_PATH . '/class/textsanitizer/' . $extension;
    if(!file_exists($source)) {
        redirect_header($currentFile, 3, _AM_AJAXFM_EXT_FILE_DONT_EXIST_SHORT);
        break;
    }
    // Copy extension
    if (!ajaxfilemanager_copyDir($source, $destination)) {
        redirect_header($currentFile, 3, _AM_AJAXFM_EXT_FILE_NOT_INSTALLABLE);
    }
    // Activate extension
    ajaxfilemanager_activateExtension($extension);
    redirect_header($currentFile, 3, _AM_AJAXFM_EXTENSION_INSTALLED . '<br />' . $extension . ' ' . _AM_AJAXFM_EXTENSION_ACTIVATED);
    break;
default:
case 'default':
    // render start here
    xoops_cp_header();

    // check if estansions path is writable
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';
    if (!is_writable($extensionsPath) or !is_writable($extensionsPath . '/config.php')) {
        echo '<p>' . sprintf(_AM_AJAXFM_EXTENSION_WARNING1, $extensionsPath, $extensionsPath) . '</p>';
        echo '<p>' . sprintf(_AM_AJAXFM_EXTENSION_WARNING2, $extensionsPath, $extensionsPath) . '</p>';
    }

    echo "<h3>" . _AM_AJAXFM_EXTENSIONS_MANAGER . "</h3>";

    // Ajax File Manager extensions
	echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AM_AJAXFM_EXTRA_EXTENSION_INFO . '</legend>';
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/textsanitizer.extensions';
    $extraExtensions = ajaxfilemanager_listExtensions($source);

    echo _AM_AJAXFM_EXTRA_EXTENSION_INFO_DESC;
    echo "<table class='' style='width:50%;float:left;'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AM_AJAXFM_EXTENSION . "</th>";
    echo "<th>" . _AM_AJAXFM_EXTENSION_STATUS . "</th>";
    echo "<th>" . _AM_AJAXFM_EXTENSION_ACTION . "</th>";
    echo "</tr>";
    $class = 0;

    foreach ($extraExtensions as $extension) {
        $class++;
        echo "<tr class='" . (($class&1)?'odd':'even') . "'>";
        echo "<td><h3>" . $extension . "</h3></td>";
        if(!ajaxfilemanager_extensionInstalled($extension)) {
            echo "<td>";
            echo "  <span style='color:red;'>" . _AM_AJAXFM_EXTENSION_NOT_INSTALLED . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='install_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AM_AJAXFM_INSTALL_EXTENSION . "'' type='submit' />";
            echo "  </form>";
            echo "</td>";
        } else {
            if(!extensionActivated($extension)) {
                echo "<td>";
                echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_INSTALLED_OK . "</span>";
                echo "  <br />";
                echo "  <span style='color:red;'>" . _AM_AJAXFM_EXTENSION_NOT_ACTIVATED . "</span>";
                echo "</td>";
                echo "<td>";
                echo "  <form action='" . $currentFile . "' method='post'>";
                echo "  <input type='hidden' name='op' value='activate_extension' />";
                echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
                echo "  <input class='formButton' value='" . _AM_AJAXFM_ACTIVATE_EXTENSION . "'' type='submit' />";
                echo "  </form>";
                echo "</td>";
            } else {
                echo "<td>";
                echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_INSTALLED_OK . "</span>";
                echo "  <br />";
                echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_ACTIVATED_OK . "</span>";
                echo "</td>";
                echo "<td>";
                echo "  <form action='" . $currentFile . "' method='post'>";
                echo "  <input type='hidden' name='op' value='desactivate_extension' />";
                echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
                echo "  <input class='formButton' value='" . _AM_AJAXFM_DISABLE_EXTENSION . "' type='submit' />";
                echo "</form>";
                echo "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div style='width:50%;float:left;'>";
    // Test dhtmltextarea
        $editor_configs = array();
        $editor_configs['name'] = 'test_dhtmltextarea_extra';
        $editor_configs['value'] = _AM_AJAXFM_EDITORPLUGIN_TEST_DHTMLTEXTAREA;
        $editor_configs['rows'] = 20;
        $editor_configs['cols'] = 160;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = 'dhtmltextarea';
    $dhtmltextarea =  new XoopsFormEditor(_AM_AJAXFM_EDITORPLUGIN_TEST_DHTMLTEXTAREA, 'test_dhtmltextarea_extra', $editor_configs);
    echo $dhtmltextarea->render();
    echo "</div>";
    echo "<div style='clear:both'></div>";
    echo "</fieldset>";

    echo "<br />";

	// Standard or extra Xoops extensions
    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AM_AJAXFM_EXTENSION_INFO . "</legend>";
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';
    $extensions = ajaxfilemanager_listExtensions($extensionsPath);
    $extensions = array_diff($extensions, $extraExtensions);

    echo "<table class='' style='width:50%;float:left;'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AM_AJAXFM_EXTENSION . "</th>";
    echo "<th>" . _AM_AJAXFM_EXTENSION_STATUS . "</th>";
    echo "<th>" . _AM_AJAXFM_EXTENSION_ACTION . "</th>";
    echo "</tr>";
    $class = 0;
    foreach ($extensions as $extension) {
        $class++;
        echo "<tr class='" . (($class&1)?'odd':'even') . "'>";
        echo "<td><h3>" . $extension . "</h3></td>";
        if(!extensionActivated($extension)) {
            echo "<td>";
            echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_INSTALLED_OK . "</span>";
            echo "  <br />";
            echo "  <span style='color:red;'>" . _AM_AJAXFM_EXTENSION_NOT_ACTIVATED . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='activate_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AM_AJAXFM_ACTIVATE_EXTENSION . "'' type='submit' />";
            echo "  </form>";
            echo "</td>";
        } else {
            echo "<td>";
            echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_INSTALLED_OK . "</span>";
            echo "  <br />";
            echo "  <span style='color:green;'>" . _AM_AJAXFM_EXTENSION_ACTIVATED_OK . "</span>";
            echo "</td>";
            echo "<td>";
            echo "  <form action='" . $currentFile . "' method='post'>";
            echo "  <input type='hidden' name='op' value='desactivate_extension' />";
            echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
            echo "  <input class='formButton' value='" . _AM_AJAXFM_DISABLE_EXTENSION . "' type='submit' />";
            echo "</form>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div style='width:50%;float:left;'>";
    // Test dhtmltextarea
        $editor_configs = array();
        $editor_configs['name'] = 'test_dhtmltextarea_standard';
        $editor_configs['value'] = _AM_AJAXFM_EDITORPLUGIN_TEST_DHTMLTEXTAREA;
        $editor_configs['rows'] = 20;
        $editor_configs['cols'] = 160;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = 'dhtmltextarea';
    $dhtmltextarea =  new XoopsFormEditor(_AM_AJAXFM_EDITORPLUGIN_TEST_DHTMLTEXTAREA, 'test_dhtmltextarea_standard', $editor_configs);
    echo $dhtmltextarea->render();
    echo "</div>";
    echo "<div style='clear:both'></div>";
    echo "</fieldset>";

    echo "<br />";

    echo "<h3>" . _AM_AJAXFM_PLUGINS_MANAGER . "</h3>";

    // Ajax File Manager editors plugins
	echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AM_AJAXFM_EDITORPLUGIN_INFO . "</legend>";
    echo "<table class=''>";
    echo "<tbody>";
    echo "<tr>";
    echo "<th>" . _AM_AJAXFM_EDITOR . "</th>";
    echo "<th>" . _AM_AJAXFM_EDITOR_STATUS . "</th>";
    echo "<th>" . _AM_AJAXFM_EDITOR_ACTION . "</th>";
    echo "</tr>";
	echo "<tr class='odd'>";
	echo "<td>";
	echo "<h3>" . _AM_AJAXFM_EDITORTINYMCE . "</h3>";
	$source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/install/tinymce.settings/tinymce.php';
	$destination = $GLOBALS['xoops']->path('var/configs/tinymce.php');
	echo sprintf(_AM_AJAXFM_EDITORTINYMCE_DESC, $source , $destination);
	echo "</td>";
	if(!ajaxfilemanager_installedCustomTinymceSettings()) {
		echo "<td>";
		echo "  <span style='color:red;'>" . _AM_AJAXFM_EDITORPLUGIN_NOT_INSTALLED . "</span>";
		echo "</td>";
		echo "<td>";
		echo "  <form action='" . $currentFile . "' method='post'>";
		echo "  <input type='hidden' name='op' value='install_tinymce' />";
		echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
		echo "  <input class='formButton' value='" . _AM_AJAXFM_INSTALL_EDITORPLUGIN . "'' type='submit' />";
		echo "  </form>";
		echo "</td>";
	} else {
		echo "<td>";
		echo "  <span style='color:green;'>" . _AM_AJAXFM_EDITORPLUGIN_INSTALLED . "</span>";
		echo "</td>";
		echo "<td>";
		echo "  <form action='" . $currentFile . "' method='post'>";
		echo "  <input type='hidden' name='op' value='uninstall_tinymce' />";
		echo "  <input type='hidden' name='extension' value='" . $extension . "' />";
		echo "  <input class='formButton' value='" . _AM_AJAXFM_UNINSTALL_EDITORPLUGIN . "' type='submit' />";
		echo "</form>";
		echo "</td>";
	}
	echo "</tr>";
    echo "</tbody>";
    echo "</table>";
    // Test tinymce
        $editor_configs = array();
        $editor_configs['name'] = 'test_tinymce';
        $editor_configs['value'] = _AM_AJAXFM_EDITORPLUGIN_TEST_TINYMCE;
        $editor_configs['rows'] = 20;
        $editor_configs['cols'] = 160;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = 'tinymce';
    $tinymce =  new XoopsFormEditor(_AM_AJAXFM_EDITORPLUGIN_TEST_TINYMCE, 'test_tinymce', $editor_configs);
    echo $tinymce->render();
    echo "</fieldset>";

    echo "<br />";

    echo "<h3>" . _AM_AJAXFM_EXTRA_MANAGER . "</h3>";

	// Standard or enhanced image.php in xoops root path?
    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AM_AJAXFM_IMAGE_PHP_INFO . "</legend>";
    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';

    $originalImagePhp = XOOPS_ROOT_PATH . '/image.php';
    $enhancedImagePhp = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/image.php';
    $crcOriginalImagePhp = strtoupper(dechex(crc32(file_get_contents($originalImagePhp))));
    $crcEnhancedImagePhp = strtoupper(dechex(crc32(file_get_contents($enhancedImagePhp))));

    if ($crcOriginalImagePhp != $crcEnhancedImagePhp) {
        // files not the same
        echo _AM_AJAXFM_IMAGE_PHP_NO_SMART;
        echo "<br />";
        echo _AM_AJAXFM_IMAGE_PHP_NO_SMART_DESC;
    } else {
        // files the same
        echo _AM_AJAXFM_IMAGE_PHP_SMART;
        echo "<br />";
        echo _AM_AJAXFM_IMAGE_PHP_SMART_DESC;
        echo "<br />";
        echo "<form action='" . $currentFile . "' method='post'>";
        echo "<input type='hidden' name='op' value='dump_images_cache' />";
        echo "<input class='formButton' value='" . _AM_AJAXFM_DUMP_IMAGES_CACHE . "'' type='submit' />";
        echo "</form>";
    }
    echo "</fieldset>";
    include "admin_footer.php";
    break;
} // switch ( $op )
?>