<?php
$adminmenu = array();
$i = 0;
$i++;
$adminmenu[$i]['name'] = 'Index';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/house.png";
$i++;
$adminmenu[$i]['name'] = 'Filemanager';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_FILEMANAGER;
$adminmenu[$i]['link'] = "admin/filemanager.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/installer_box.png";
/*
$i++;
$adminmenu[$i]['name'] = 'Ftp';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_FTP;
$adminmenu[$i]['link'] = "admin/ftp.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/ftp.png";
*/
$i++;
$adminmenu[$i]['name'] = 'Extension';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_EXTENSIONS;
$adminmenu[$i]['link'] = "admin/extensions.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/plugin.png";
$i++;
$adminmenu[$i]['name'] = 'Permissions';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_PERMISSIONS;
$adminmenu[$i]['link'] = "admin/permissions.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/lock.png";
$i++;
$adminmenu[$i]['name'] = 'About';
$adminmenu[$i]['title'] = _AJAXFM_MI_ADMENU_ABOUT;
$adminmenu[$i]['link'] = "admin/about.php";
$adminmenu[$i]['icon'] = "images/icons/32x32/information.png";
?>