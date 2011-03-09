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

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . $xoopsModule->getVar('name'). "</legend>";
echo "<div style='padding: 8px;'>";
echo "<img src='" . XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/" . $versionInfo->getInfo('image') . "' alt='' hspace='10' vspace='0' /></a>\n";
echo "<div style='padding: 5px;'><strong>" . $versionInfo->getInfo('name') . " version " . $versionInfo->getInfo('version') . "</strong></div>\n";
echo "<label>" . _AJAXFM_AM_ABOUT_RELEASEDATE . ":</label><text>" . date(_SHORTDATESTRING, $versionInfo->getInfo('release')) . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_AUTHOR . ":</label><text>" . $versionInfo->getInfo('author') . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_CREDITS . ":</label><text>" . $versionInfo->getInfo('credits') . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_LICENSE . ":</label><text><a href=\"".$versionInfo->getInfo('license_file')."\" target=\"_blank\" >" . $versionInfo->getInfo('license') . "</a></text>\n";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AJAXFM_AM_ABOUT_MODULEINFOS . "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" . _AJAXFM_AM_ABOUT_STATUS . ":</label><text>" . $versionInfo->getInfo('module_status') . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_MODULEWEBSITE . ":</label><text>" . "<a href='" . $versionInfo->getInfo('support_site_url') . "' target='_blank'>" . $versionInfo->getInfo('support_site_name') . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AJAXFM_AM_ABOUT_AUTHORINFOS . "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" . _AJAXFM_AM_ABOUT_AUTHOR . ":</label><text>" . $versionInfo->getInfo('author') . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_AUTHORWEBSITE . ":</label><text>" . "<a href='" . $versionInfo->getInfo('author_website_url') . "' target='_blank'>" . $versionInfo->getInfo('author_website_name') . "</a>" . "</text><br />";
echo "<label>" . _AJAXFM_AM_ABOUT_AUTHOREMAIL . ":</label><text>" . "<a href='emailto:" . $versionInfo->getInfo('author_mail') . "' target='_blank'>" . $versionInfo->getInfo('author_mail') . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

$file = XOOPS_ROOT_PATH. "/modules/" . $xoopsModule->getVar('dirname') . "/description.html";
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AJAXFM_AM_ABOUT_DESCRIPTION . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>". implode('', file($file)) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

$file = XOOPS_ROOT_PATH. "/modules/" . $xoopsModule->getVar('dirname') . "/help.html";
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AJAXFM_AM_ABOUT_HELP . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>" . implode('', file($file)) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

$file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/changelog.txt";
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AJAXFM_AM_ABOUT_CHANGELOG . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>" . utf8_encode(implode('<br />', file($file))) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

xoops_cp_footer();
?>