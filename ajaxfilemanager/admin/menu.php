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

$adminmenu = array();
$i = 0;
$i++;
$adminmenu[$i]['name'] = 'Index';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_INDEX_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/house.png";
$i++;
$adminmenu[$i]['name'] = 'Filemanager';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_FILEMANAGER;
$adminmenu[$i]['link'] = "admin/filemanager.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_FILEMANAGER_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/installer_box.png";
// FTP SUPPORT IN NEXT RELEASES
/*
$i++;
$adminmenu[$i]['name'] = 'Ftp';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_FTP;
$adminmenu[$i]['link'] = "admin/ftp.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_FTP_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/ftp.png";
*/
// FTP SUPPORT IN NEXT RELEASES
$i++;
$adminmenu[$i]['name'] = 'Extension';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_EXTENSIONS;
$adminmenu[$i]['link'] = "admin/extensions.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_EXTENSIONS_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/plugin.png";
$i++;
$adminmenu[$i]['name'] = 'Permissions';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_PERMISSIONS;
$adminmenu[$i]['link'] = "admin/permissions.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_PERMISSIONS_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/lock.png";
$i++;
$adminmenu[$i]['name'] = 'About';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_ABOUT;
$adminmenu[$i]['link'] = "admin/about.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_ABOUT_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/information.png";
$i++;
$adminmenu[$i]['name'] = 'Help';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_HELP;
$adminmenu[$i]['link'] = "admin/help.php";
$adminmenu[$i]['desc'] = _AJAXFM_MI_ADMENU_HELP_DESC;
$adminmenu[$i]['icon'] = "images/icons/32x32/help.png";
?>