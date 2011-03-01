<?php
if (!defined('XOOPS_ROOT_PATH')) die('XOOPS root path not defined');
$moduleDirname = basename( dirname( __FILE__ ) ) ;



$modversion['name'] = _AJAXFM_MI_NAME;
$modversion['version'] = 0.01;
$modversion['description'] = _AJAXFM_MI_DESC;
$modversion['author'] = "luciorota + Logan Cai - www.phpletter.com";
$modversion['credits'] = "The XOOPS Project";
$modversion['help'] = "help.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['license_url'] = "http://www.gnu.org/licenses/gpl.html";
$modversion['official'] = 0;
$modversion['image'] = "images/filemanager_slogo.png";
$modversion['dirname'] = "ajaxfilemanager";
//extra informations
$modversion['release'] = '01-03-2011';
$modversion['module_status'] = 'Stable';
$modversion['support_site_url'] = 'http://www.xoops.org';
$modversion['support_site_name'] = 'www.xoops.org';
$modversion['author_website_url']	= 'http://xoops.org';
$modversion['author_website_name']	= 'XOOPS';



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



// Configs
$modversion['config'] = array();
$modversion['config'][1] = array(
    "name"          => 'upload_valid_exts',
    "title"         => '_AJAXFM_MI_VALIDEXTS',
    "description"   => '_AJAXFM_MI_VALIDEXTS_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'text',
    "default"       => 'gif,jpg,png,mp3,flv,kml,txt',
    );
$modversion['config'][] = array(
    "name"          => 'upload_max_size',
    "title"         => '_AJAXFM_MI_MAXSIZE',
    "description"   => '_AJAXFM_MI_MAXSIZE_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'int',
    "default"       => 1000, //1MB
    );

// Comments
$modversion["hasComments"] = 0;

// Notification
$modversion["hasNotification"] = 0;
$modversion["notification"] = array();


?>