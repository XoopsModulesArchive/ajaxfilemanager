<?php
if (!defined('XOOPS_ROOT_PATH')) die('XOOPS root path not defined');

$modversion['name'] = _AJAXFM_MI_NAME;
$modversion['version'] = 0.01;
$modversion['description'] = _AJAXFM_MI_DESC;
$modversion['author'] = "luciorota + Logan Cai - www.phpletter.com";
$modversion['credits'] = "The XOOPS Project";
$modversion['help'] = "help.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/filemanager_slogo.png";
$modversion['dirname'] = "ajaxfilemanager";
//extra informations
$modversion["release"] = "16-02-2011";
$modversion["module_status"] = "Stable";
$modversion['support_site_url'] = "http://www.xoops.org";
$modversion['support_site_name'] = "www.xoops.org";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Scripts to run upon installation or update
$modversion['onInstall'] = 'include/install_function.php';
$modversion['onUpdate'] = 'include/update_function.php';
$modversion['onUninstall'] = 'include/uninstall_function.php';

// Mysql file

// Templates
$i = 0;
// Image Manager Templates
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_imagemanager.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_imagemanager2.html';
$modversion['templates'][$i]['description'] = '';

// Blocks

// Preferences
$i = 0;
$i++;
$modversion['config'][$i]['name'] = 'website_document_root_path';
$modversion['config'][$i]['title'] = '_AJAXFM_MI_ROOTPATH';
$modversion['config'][$i]['description'] = '_AJAXFM_MI_ROOTPATH_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'c:\\';
$i++;
$modversion['config'][$i]['name'] = 'upload_valid_exts';
$modversion['config'][$i]['title'] = '_AJAXFM_MI_VALIDEXTS';
$modversion['config'][$i]['description'] = '_AJAXFM_MI_VALIDEXTS_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'gif,jpg,png,mp3,flv,kml,txt';
$i++;
$modversion['config'][$i]['name'] = 'upload_max_size';
$modversion['config'][$i]['title'] = '_AJAXFM_MI_MAXSIZE';
$modversion['config'][$i]['description'] = '_AJAXFM_MI_MAXSIZE_DESC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1000; //1MB

//


?>