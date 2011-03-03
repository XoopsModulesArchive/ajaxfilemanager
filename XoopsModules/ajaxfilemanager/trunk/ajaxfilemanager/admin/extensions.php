<?php
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

// get post
if(isset($_POST['step'])) {
    $step = $_POST['step'];
} else {
    $step = 'default';
}

if(isset($_POST['extension'])) {
    $extension = $_POST['extension'];
} else {
    $step = 'default';
}




switch( $step ) {
case 'activate':
    activateExtension($extension);
    redirect_header($currentFile, 3, _AJAXFM_AM_EXTENSION_ACTIVATED);
    break;
case 'desactivate':
    desactivateExtension($extension);
    redirect_header($currentFile, 3, _AJAXFM_AM_EXTENSION_DISABLED);
    break;
case 'install':
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/extra/textsanitizer.extension' .  '/' . $extension;
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
    xoops_cp_header();
    // main admin menu
    if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
        moduleAdminMenu(4, _AJAXFM_MI_ADMENU_EXTENSIONS);
    } else {
        include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
        loadModuleAdminMenu (4, _AJAXFM_MI_ADMENU_EXTENSIONS);
    }

    $extensionsPath = XOOPS_ROOT_PATH . '/class/textsanitizer';
    if (!is_writable($extensionsPath) or !is_writable($extensionsPath . '/config.php')) {
        echo '<p>' . sprintf(_AJAXFM_AM_EXTENSION_WARNING1, $extensionsPath) . '</p>';
        echo '<p>' . sprintf(_AJAXFM_AM_EXTENSION_WARNING2, $extensionsPath) . '</p>';
    }

    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_EXTRA_EXTENSION_INFO . "</legend>";
    $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/extra/textsanitizer.extension';
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
            echo "  <input type='hidden' name='step' value='install' />";
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
                echo "  <input type='hidden' name='step' value='activate' />";
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
                echo "  <input type='hidden' name='step' value='desactivate' />";
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
            echo "  <input type='hidden' name='step' value='activate' />";
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
            echo "  <input type='hidden' name='step' value='desactivate' />";
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

    xoops_cp_footer();
    break;
} // switch ( $step )
?>