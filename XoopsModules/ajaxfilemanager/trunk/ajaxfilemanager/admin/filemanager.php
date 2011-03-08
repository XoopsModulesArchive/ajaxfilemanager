<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes

// get/check parameters/post

// render start here
xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);

echo '<div style="clear:both"> </div>';
echo '<fieldset>';
echo '<iframe' .
    ' style="width:100%;height:500px;border:none;"' .
    ' src="' . XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail&amp;language=' . _LANGCODE . '" >';
echo '<p>' . _AJAXFM_AM_INDEX_NOIFRAME . '</p>';
echo '</iframe>';
echo '</fieldset>';
echo '<br/>';

echo '</fieldset>';

xoops_cp_footer();
?>