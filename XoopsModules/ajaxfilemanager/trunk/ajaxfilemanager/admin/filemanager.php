<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes



xoops_cp_header();

// main admin menu
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
    moduleAdminMenu(2, _AJAXFM_MI_ADMENU_FILEMANAGER);
} else {
    include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
    loadModuleAdminMenu (2, _AJAXFM_MI_ADMENU_FILEMANAGER);
}

echo '<div style="clear:both"> </div>';
echo '<fieldset>';
echo '<iframe style="width:100%;height:500px;border:none;" src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail' . '" >';
echo '<p>' . _AJAXFM_AM_INDEX_NOIFRAME . '</p>';
echo '</iframe>';
echo '</fieldset>';
echo '<br/>';

echo '</fieldset>';

xoops_cp_footer();
?>