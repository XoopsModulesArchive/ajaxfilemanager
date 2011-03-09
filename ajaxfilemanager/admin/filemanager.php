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