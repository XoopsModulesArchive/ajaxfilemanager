
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

if (!defined('XOOPS_ROOT_PATH')) die('XOOPS root path not defined');
$moduleDirname = basename( dirname( __FILE__ ) ) ;

$modversion['name'] = _AJAXFM_MI_NAME;
$modversion['version'] = 0.01;
$modversion['description'] = _AJAXFM_MI_DESC;
$modversion['author'] = 'Rota Lucio';
$modversion['author_mail'] = 'lucio.rota@gmail.com';
$modversion['author_website_url'] = 'http://luciorota.altervista.org';
$modversion['author_website_name'] = 'http://luciorota.altervista.org';
$modversion['credits'] = 'The XOOPS Project';
//$modversion['help'] = 'help.html';
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl.html';
$modversion['official'] = 0;
$modversion['image'] = 'images/filemanager_slogo.png';
$modversion['release_info'] = 'RC';
$modversion['release_file'] = 'RC';
$modversion['manual'] = 'Help';
$modversion['manual_file'] = 'help.html';
$modversion['dirname'] = $dirname;

$modversion['system_menu'] = 0;

//about
$modversion['status_version'] = 'RC';
$modversion['release_date'] = '2011/10/07';
$modversion['release'] = strtotime('2011/10/07'); // 'YYYY/MM/DD' format
$modversion['demo_site_url'] = 'IN PROGRESS';
$modversion['demo_site_name'] = 'IN PROGRESS';
$modversion['forum_site_url'] = 'IN PROGRESS';
$modversion['forum_site_name'] = 'IN PROGRESS';
$modversion['module_website_url'] = 'IN PROGRESS';
$modversion['module_website_name'] = 'IN PROGRESS';
$modversion['module_status'] = 'In progress';
$modversion["author_website_url"] = 'http://luciorota.altervista.org/xoops/';
$modversion["author_website_name"] = 'luciorota.altervista.org/xoops';
$modversion['min_php']=5.2;
$modversion['min_xoops']= 'XOOPS 2.4.5';

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
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_imageeditor.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_gmap.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_gmap.js';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_video.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'ajaxfm_video.js';
$modversion['templates'][$i]['description'] = '';


// Blocks



// Configs
/* XOOPS 2.5.0+
$modversion['config'][] = array(
    'name'      => 'break', 
    'title'         => '_AJAXFM_MI_PREFERENCE_BREAK_GLOBAL', 
    'description'   => '', 
    'formtype'      => 'line_break', 
    'valuetype'     => 'textbox', 
    'default'       => 'head'
    );
*/
$modversion['config'][] = array(
    "name"          => 'upload_valid_exts',
    "title"         => '_AJAXFM_MI_VALIDEXTS',
    "description"   => '_AJAXFM_MI_VALIDEXTS_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'text',
    "default"       => 'jpg,png,gif,html,htm,js,mp3,flv,kml,txt,pdf,zip',
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'upload_max_size',
    "title"         => '_AJAXFM_MI_MAXSIZE',
    "description"   => '_AJAXFM_MI_MAXSIZE_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'int',
    "default"       => 1000, // 1MB
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'default_pagination_limit',
    "title"         => '_AJAXFM_MI_DEFAULTPAGINATIONLIMIT',
    "description"   => '_AJAXFM_MI_DEFAULTPAGINATIONLIMIT_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'int',
    "default"       => 20,
    "options"       => array(5 => 5, 10 => 10, 20 => 20, 30 => 30, 50 => 50, 80 => 80, 150 => 150, 999 => 999),
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'default_view',
    "title"         => '_AJAXFM_MI_VIEW',
    "description"   => '_AJAXFM_MI_VIEW_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'text',
    "default"       => 'thumbnail',
    "options"       => array('_AJAXFM_MI_VIEW1' => 'detail', '_AJAXFM_MI_VIEW2' => 'thumbnail'),
    "category"       => 'global'
    );
include_once (XOOPS_ROOT_PATH . '/class/xoopslists.php');
$modversion['config'][] = array(
    "name"          => 'text_editor',
    "title"         => '_AJAXFM_MI_TEXTEDITOR',
    "description"   => '_AJAXFM_MI_TEXTEDITOR_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'text',
    "default"       => 'dhtmltextarea',
    "options"       => XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . '/class/xoopseditor'),
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'navigation_mode',
    "title"         => '_AJAXFM_MI_NAVIGATIONMODE',
    "description"   => '_AJAXFM_MI_NAVIGATIONMODE_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'text',
    "default"       => 'secure',
    "options"       => array('_AJAXFM_MI_NAVIGATIONMODE1' => 'secure', '_AJAXFM_MI_NAVIGATIONMODE2' => 'dangerous', '_AJAXFM_MI_NAVIGATIONMODE4' => 'themes_directory', '_AJAXFM_MI_NAVIGATIONMODE3' => 'kamikaze'),
    "category"       => 'global'
    );
/* XOOPS 2.5.0+
$modversion['config'][] = array(
    'name'      => 'break', 
    'title'         => '_AJAXFM_MI_PREFERENCE_BREAK_EXTRA', 
    'description'   => '', 
    'formtype'      => 'line_break', 
    'valuetype'     => 'textbox', 
    'default'       => 'head'
    );
*/
$modversion['config'][] = array(
    "name"          => 'standard_imagemanager',
    "title"         => '_AJAXFM_MI_XOOPSIMAGEMANAGER',
    "description"   => '_AJAXFM_MI_XOOPSIMAGEMANAGER_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'text',
    "default"       => 'standard',
    "options"       => array('_AJAXFM_MI_XOOPSIMAGEMANAGER1' => 'standard', '_AJAXFM_MI_XOOPSIMAGEMANAGER2' => 'enhanced', '_AJAXFM_MI_XOOPSIMAGEMANAGER3' => 'ajaxfilemanager'),
    "category"       => 'extra'
    );
// FTP SUPPORT IN NEXT RELEASES, MAYBE...
/*
// FTP CONFIG
 if (function_exists('ftp_connect')) {
    $modversion['config'][] = array(
        'name'      => 'break', 
        'title'         => '_AJAXFM_MI_PREFERENCE_BREAK_FTP', 
        'description'   => '', 
        'formtype'      => 'line_break', 
        'valuetype'     => 'textbox', 
        'default'       => 'head'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_enabled',
        "title"         => '_AJAXFM_MI_FTPENABLED',
        "description"   => '_AJAXFM_MI_FTPENABLED_DESC',
        "formtype"      => 'yesno',
        "valuetype"     => 'int',
        "default"       => false, // ftp not enabled
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_serverhost',
        "title"         => '_AJAXFM_MI_FTPSERVERHOST',
        "description"   => '_AJAXFM_MI_FTPSERVERHOST_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_serverport',
        "title"         => '_AJAXFM_MI_FTPSERVERPORT',
        "description"   => '_AJAXFM_MI_FTPSERVERPORT_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'int',
        "default"       => 21, // default ftp port
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_servertimeout',
        "title"         => '_AJAXFM_MI_FTPSERVERTIMEOUT',
        "description"   => '_AJAXFM_MI_FTPSERVERTIMEOUT_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'int',
        "default"       => 90,
        "category"       => 'ftp'
        );
    if (function_exists('ftp_ssl_connect')) {
        $ftp_connectiontype_options = array('_AJAXFM_MI_FTPCONNECTIONTYPE1' => 'ftp', '_AJAXFM_MI_FTPCONNECTIONTYPE2' => 'ssl');
    }else {
        $ftp_connectiontype_options = array('_AJAXFM_MI_FTPCONNECTIONTYPE1' => 'ftp');
    }
    $modversion['config'][] = array(
        "name"          => 'ftp_connectiontype',
        "title"         => '_AJAXFM_MI_FTPCONNECTIONTYPE',
        "description"   => '_AJAXFM_MI_FTPCONNECTIONTYPE_DESC',
        "formtype"      => 'select',
        "valuetype"     => 'text',
        "default"       => 'ftp',
        "options"       => $ftp_connectiontype_options,
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_connectionpassive',
        "title"         => '_AJAXFM_MI_FTPCONNECTIONPASSIVE',
        "description"   => '_AJAXFM_MI_FTPCONNECTIONPASSIVE_DESC',
        "formtype"      => 'yesno',
        "valuetype"     => 'int',
        "default"       => true,
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_username',
        "title"         => '_AJAXFM_MI_FTPUSERNAME',
        "description"   => '_AJAXFM_MI_FTPUSERNAME_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_password',
        "title"         => '_AJAXFM_MI_FTPPASSWORD',
        "description"   => '_AJAXFM_MI_FTPPASSWORD_DESC',
        "formtype"      => 'password',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_xoopsrootpath',
        "title"         => '_AJAXFM_MI_FTPXOOPSROOTPATH',
        "description"   => '_AJAXFM_MI_FTPXOOPSROOTPATH_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'text',
        "default"       => XOOPS_ROOT_PATH,
        "category"       => 'ftp'
        );
    // FTP THROUGH PROXY CONFIG
    $modversion['config'][] = array(
        "name"          => 'ftp_proxy',
        "title"         => '_AJAXFM_MI_FTPPROXY',
        "description"   => '_AJAXFM_MI_FTPPROXY_DESC',
        "formtype"      => 'select',
        "valuetype"     => 'text',
        "default"       => 'none',
        "options"       => array(_AJAXFM_MI_FTPPROXY1 => 'none', _AJAXFM_MI_FTPPROXY2 => 'http', _AJAXFM_MI_FTPPROXY3 => 'sock5'),
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_proxyaddress',
        "title"         => '_AJAXFM_MI_FTPPROXYADDRESS',
        "description"   => '_AJAXFM_MI_FTPPROXYADDRESS_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_proxyport',
        "title"         => '_AJAXFM_MI_FTPPROXYPORT',
        "description"   => '_AJAXFM_MI_FTPPROXYPORT_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'int',
        "default"       => null,
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_proxyusername',
        "title"         => '_AJAXFM_MI_FTPPROXYUSERNAME',
        "description"   => '_AJAXFM_MI_FTPPROXYUSERNAME_DESC',
        "formtype"      => 'textbox',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
    $modversion['config'][] = array(
        "name"          => 'ftp_proxypassword',
        "title"         => '_AJAXFM_MI_FTPPROXYPASSWORD',
        "description"   => '_AJAXFM_MI_FTPPROXYPASSWORD_DESC',
        "formtype"      => 'password',
        "valuetype"     => 'text',
        "default"       => '',
        "category"       => 'ftp'
        );
	}
*/
// FTP SUPPORT IN NEXT RELEASES, MAYBE...

// Comments
$modversion["hasComments"] = 0;

// Notification
$modversion["hasNotification"] = 0;
$modversion["notification"] = array();
?>