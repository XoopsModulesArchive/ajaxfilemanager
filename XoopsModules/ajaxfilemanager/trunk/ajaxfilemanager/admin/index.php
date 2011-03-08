<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes



$op = (isset($_GET['op']))? $_GET['op'] : "";
if ($op = 'createdir') {
    if (isset($_GET['path'])) {
        $path = $_GET['path'];
        $msg = (makeDir($path)) ? _AJAXFM_AM_DIRCREATED : _AJAXFM_AM_DIRNOTCREATED;
        redirect_header($currentFile, 2, sprintf($msg, htmlentities($path)));
        exit();
    }
}



xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);

// index menu
include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/menu.php';
//$menu = new moduleMenu();
$menu = new testMenu();
foreach ($adminmenu as $menuitem) {
    $menu->addItem($menuitem['name'], '../' . $menuitem['link'], '../' . $menuitem['icon'], $menuitem['title']);
}

$menu->addItem('Preferences', '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule ->getVar('mid') . '&amp;&confcat_id=1', '../images/icons/32x32/prefs.png', _PREFERENCES);

echo $menu->getCSS();
echo '<table width="100%" border="0" cellspacing="10" cellpadding="4">';
echo '<tr><td>' . $menu->render() . '</td>';

echo '<td valign="top" width="60%">';
echo '<fieldset><legend class="CPmediumTitle">' . _AJAXFM_AM_INDEX_INFO . '</legend>';
echo '<p>';
echo _AJAXFM_MI_VALIDEXTS . ': ' . $xoopsModuleConfig['upload_valid_exts'];
echo '</p>';
echo '<p>';
echo _AJAXFM_MI_MAXSIZE . ': ' . $xoopsModuleConfig['upload_max_size'] . _AJAXFM_MI_MAXSIZE_MB;
echo '</p>';

$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}

echo '</fieldset>';
echo '</td></tr>';
echo '</table>';


xoops_cp_footer();
?>