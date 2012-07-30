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
 * @version         $Id $
 */

include 'admin_header.php';
$currentFile = basename(__FILE__);
$versionInfo =& $module_handler->get($xoopsModule->getVar('mid'));

// load classes

// get/check parameters/post

// render start here
xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);

echo "
    <style type=\"text/css\">
    label,text {
        display: block;
        float: left;
        margin-bottom: 2px;
    }
    label {
        text-align: right;
        width: 150px;
        padding-right: 20px;
    }
    br {
        clear: left;
    }
    </style>
";

if (file_exists(XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/help/help.html")) {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/help/help.html";
} else {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/english/help/help.html";
}
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_HELP . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>" . implode('', file($file)) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
} else {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_HELP . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>warning: help.html file not found!</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

xoops_cp_footer();
?>