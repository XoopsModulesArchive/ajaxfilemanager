<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes



xoops_cp_header();

// main admin menu
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
    moduleAdminMenu(1, _AJAXFM_MI_ADMENU_INDEX);
} else {
    include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
    loadModuleAdminMenu (1, _AJAXFM_MI_ADMENU_INDEX);
}

// index menu
include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/menu.php';
$menu = new moduleMenu();
if (!isset($adminmenu)) include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
foreach ($adminmenu as $menuitem) {
    $menu->addItem($menuitem['name'], '../' . $menuitem['link'], '../' . $menuitem['icon'], $menuitem['title']);
}
$menu->addItem('Preferences', '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule ->getVar('mid') . '&amp;&confcat_id=1', '../images/icons/32x32/prefs.png', _PREFERENCES);

echo $menu->getCSS();
echo '<table width="100%" border="0" cellspacing="10" cellpadding="4">';
echo '<tr><td>' . $menu->render() . '</td>';

echo '<td valign="top" width="80%">';
echo '<fieldset><legend class="CPmediumTitle">' . _AJAXFM_AM_INDEX_INFO . '</legend>';
echo '<br/>';
echo '<br/>';
echo '</fieldset>';

echo '<br/>';

echo '<fieldset>';
echo '<iframe style="width:100%;height:500px;border:none;" src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail' . '" >';
echo '<p>' . _AJAXFM_AM_INDEX_NOIFRAME . '</p>';
echo '</iframe>';
echo '</fieldset>';
echo '<br/>';

echo '</fieldset>';
echo '</td></tr>';
echo '</table>';


xoops_cp_footer();
?>