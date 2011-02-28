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

if(isset($_POST['extention'])) {
    $extention = $_POST['extention'];
} else {
    $step = 'default';
}




switch( $step ) {
    case 'activate':
        activateExtention($extention);
        redirect_header($currentFile, 3, _AJAXFM_AM_EXTENTION_ACTIVATED);
        break;
    case 'desactivate':
        desactivateExtention($extention);
        redirect_header($currentFile, 3, _AJAXFM_AM_EXTENTION_DESACTIVATED);
        break;
    case 'install':
        $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/extra/textsanitizer.extension' .  '/' . $extention;
        $destination = XOOPS_ROOT_PATH . '/class/textsanitizer/' . $extention;
        if(!file_exists($source)) {
            redirect_header($currentFile, 3, _AJAXFM_AM_EXT_FILE_DONT_EXIST_SHORT);
            break;
        }

        // Copy extention
        if (!copyDir($source, $destination)) {
            redirect_header($currentFile, 3, _AJAXFM_AM_EXT_FILE_NOT_INSTALLABLE);
        }

        // Activate extention
        activateExtention($extention);
        redirect_header($currentFile, 3, _AJAXFM_AM_EXTENTION_INSTALLED . "<br />" . $extention . _AJAXFM_AM_EXTENTION_ACTIVATED);
        break;
    default:
    case 'default':
        xoops_cp_header();
        // main admin menu
        if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
            moduleAdminMenu(3, _AJAXFM_MI_ADMENU_EXTENTION);
        } else {
            include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
            loadModuleAdminMenu (3, _AJAXFM_MI_ADMENU_EXTENTION);
        }
        echo "<fieldset>";
        echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_EXTENTION_INFO . "</legend>";
        $source = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/extra/textsanitizer.extension';
        $extentions = listExtentions($source);

        echo "<table class=''>";
        echo "<tbody>";
        echo "<tr>";
        echo "<th>" . _AJAXFM_AM_EXTENTION . "</th>";
        echo "<th>" . _AJAXFM_AM_EXTENTION_STATUS . "</th>";
        echo "<th>" . _AJAXFM_AM_EXTENTION_ACTION . "</th>";
        echo "</tr>";
        $class = 0;
        foreach ($extentions as $extention) {
            $class++;
            echo "<tr class='" . (($class&1)?'odd':'even') . "'>";
            echo "<td><h3>" . $extention . "</h3></td>";
            if(!extentionInstalled($extention)) {
                echo "<td>";
                echo "  <span style='color:red;'>" . _AJAXFM_AM_EXTENTION_NOT_INSTALLED . "</span>";
                echo "</td>";
                echo "<td>";
                echo "  <form action='" . $currentFile . "' method='post'>";
                echo "  <input type='hidden' name='step' value='install' />";
                echo "  <input type='hidden' name='extention' value='" . $extention . "' />";
                echo "  <input class='formButton' value='" . _AJAXFM_AM_INSTALL_EXTENTION . "'' type='submit' />";
                echo "  </form>";
                echo "</td>";
            } else {
                if(!extentionActivated($extention)) {
                    echo "<td>";
                    echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENTION_INSTALLED_OK . "</span>";
                    echo "  <br />";
                    echo "  <span style='color:red;'>" . _AJAXFM_AM_EXTENTION_NOT_ACTIVATED . "</span>";
                    echo "</td>";
                    echo "<td>";
                    echo "  <form action='" . $currentFile . "' method='post'>";
                    echo "  <input type='hidden' name='step' value='activate' />";
                    echo "  <input type='hidden' name='extention' value='" . $extention . "' />";
                    echo "  <input class='formButton' value='" . _AJAXFM_AM_ACTIVATE_EXTENTION . "'' type='submit' />";
                    echo "  </form>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENTION_INSTALLED_OK . "</span>";
                    echo "  <br />";
                    echo "  <span style='color:green;'>" . _AJAXFM_AM_EXTENTION_ACTIVATED_OK . "</span>";
                    echo "</td>";
                    echo "<td>";
                    echo "  <form action='" . $currentFile . "' method='post'>";
                    echo "  <input type='hidden' name='step' value='desactivate' />";
                    echo "  <input type='hidden' name='extention' value='" . $extention . "' />";
                    echo "  <input class='formButton' value='" . _AJAXFM_AM_DESACTIVATE_EXTENTION . "' type='submit' />";
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
    echo "<br />";
    echo "<br />";
    
    echo "<fieldset>";
    echo "<legend style='font-weight:bold; color:#990000;'>" . _AJAXFM_AM_OPTIONS_MANAGER . "</legend>";
    echo "</fieldset>";

    xoops_cp_footer();
    break;
    } // switch ( $step )
?>