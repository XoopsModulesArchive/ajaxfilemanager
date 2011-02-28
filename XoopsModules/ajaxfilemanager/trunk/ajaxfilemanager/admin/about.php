<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);
$versionInfo =& $module_handler->get($xoopsModule->getVar('mid'));



xoops_cp_header();

if (!is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php")) {
    moduleAdminMenu(4, _AJAXFM_MI_ADMENU_ABOUT);
} else {
    include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
    loadModuleAdminMenu (4, _AJAXFM_MI_ADMENU_ABOUT);
}



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
echo "<label>" . _AJAXFM_AM_ABOUT_RELEASEDATE . ":</label><text>" . $versionInfo->getInfo('release') . "</text><br />";
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