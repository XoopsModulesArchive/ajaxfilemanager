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
$modversion['author'] = 'luciorota + Logan Cai - www.phpletter.com';
$modversion['author_mail'] = 'lucio.rota@gmail.com';
$modversion['author_website_url'] = 'http://luciorota.altervista.org';
$modversion['author_website_name'] = 'http://luciorota.altervista.org';
$modversion['credits'] = 'The XOOPS Project';
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl.html';
$modversion['official'] = 0;
$modversion['image'] = 'images/filemanager_slogo.png';
$modversion['release_info'] = 'IN PROGRESS';
$modversion['release_file'] = 'IN PROGRESS';
$modversion['manual'] = 'Help';
$modversion['manual_file'] = 'help.html';
$modversion['dirname'] = $dirname;
//About
$modversion['demo_site_url'] = 'IN PROGRESS';
$modversion['demo_site_name'] = 'IN PROGRESS';
$modversion['forum_site_url'] = 'IN PROGRESS';
$modversion['forum_site_name'] = 'IN PROGRESS';
$modversion['module_website_url'] = 'IN PROGRESS';
$modversion['module_website_name'] = 'IN PROGRESS';
$modversion['release'] = strtotime('2011/03/24'); // 'YYYY/MM/DD' format
$modversion['module_status'] = 'In progress';

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
$modversion['config'] = array();
$modversion['config'][1] = array(
    "name"          => 'upload_valid_exts',
    "title"         => '_AJAXFM_MI_VALIDEXTS',
    "description"   => '_AJAXFM_MI_VALIDEXTS_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'text',
    "default"       => 'gif,jpg,png,html,htm,mp3,flv,kml,txt,pdf',
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'upload_max_size',
    "title"         => '_AJAXFM_MI_MAXSIZE',
    "description"   => '_AJAXFM_MI_MAXSIZE_DESC',
    "formtype"      => 'textbox',
    "valuetype"     => 'int',
    "default"       => 1000, //1MB
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'default_pagination_limit',
    "title"         => '_AJAXFM_MI_DEFAULTPAGINATIONLIMIT',
    "description"   => '_AJAXFM_MI_DEFAULTPAGINATIONLIMIT_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'int',
    "default"       => 10,
    "options"       => array(5 => 5, 10 => 10, 20 => 20, 30 => 30, 50 => 50, 80 => 80, 150 => 150, 999 => 999),
    "category"       => 'global'
    );
$modversion['config'][] = array(
    "name"          => 'default_view',
    "title"         => '_AJAXFM_MI_VIEW',
    "description"   => '_AJAXFM_MI_VIEW_DESC',
    "formtype"      => 'select',
    "valuetype"     => 'text',
    "default"       => 'detail',
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



// Comments
$modversion["hasComments"] = 0;

// Notification
$modversion["hasNotification"] = 0;
$modversion["notification"] = array();


?>