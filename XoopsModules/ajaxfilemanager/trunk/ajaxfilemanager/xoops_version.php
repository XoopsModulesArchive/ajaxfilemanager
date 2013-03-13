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
 * @since           1.0
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */
if (!defined('XOOPS_ROOT_PATH')){ exit(); }
$dirname = basename( dirname( __FILE__ ) ) ;
include_once XOOPS_ROOT_PATH . "/modules/{$dirname}/include/functions.php";
xoops_load('XoopsLists');

$modversion['name'] = _MI_AJAXFM_NAME;
$modversion['version'] = '1.1';
$modversion['description'] = _MI_AJAXFM_DESC;
$modversion['author'] = 'Rota Lucio';
$modversion['author_mail'] = 'lucio.rota@gmail.com';
$modversion['author_website_url'] = 'http://luciorota.altervista.org';
$modversion['author_website_name'] = 'http://luciorota.altervista.org';
$modversion['credits'] = 'The XOOPS Project, <a href=http://www.phpletter.com/">PHPletter.com Open Source Development Team</a>';
//$modversion['help'] = 'help.html';
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl.html';
    
$modversion['release_info'] = 'beta';
$modversion['release_file'] = XOOPS_URL . "/modules/{$dirname}/docs/RC";
$modversion['release_date'] = "2013/003/31"; // 'Y/m/d'
    
$modversion['manual'] = 'Help';
$modversion['manual_file'] = XOOPS_URL . "/modules/{$dirname}/docs/help.html";
$modversion['min_php'] = '5.2';
$modversion['min_xoops'] = '2.5.5';
$modversion['min_admin']= '1.1';
$modversion['min_db']= array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');
$modversion['image'] = 'images/filemanager_slogo.png';
$modversion['dirname'] = "{$dirname}";
$modversion['official'] = false;
    
$modversion['dirmoduleadmin'] = "Frameworks/moduleclasses";
$modversion['icons16'] = "modules/{$dirname}/images/icons/16x16";
$modversion['icons32'] = "modules/{$dirname}/images/icons/32x32";
    
//About
$modversion['demo_site_url'] = '';
$modversion['demo_site_name'] = '';
$modversion['forum_site_url'] = '';
$modversion['forum_site_name'] = '';
$modversion['module_website_url'] = '';
$modversion['module_website_name'] = '';
//$modversion['support_site_url']	= "http://www.xoops.org";
//$modversion['support_site_name'] = "www.xoops.org";
$modversion['release'] = "release";
$modversion['module_status'] = 'beta'; //"Stable";

// Admin things
$modversion['hasAdmin'] = true;
// Admin system menu
$modversion['system_menu'] = true;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Mysql file

// Scripts to run upon installation or update
$modversion['onInstall'] = 'include/install_function.php';
$modversion['onUpdate'] = 'include/update_function.php';
$modversion['onUninstall'] = 'include/uninstall_function.php';

// Main menu
$modversion['hasMain'] = false;



// Blocks
    

    
// Search
$modversion['hasSearch'] = false;



// Comments
$modversion['hasComments'] = false;



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



// Preferences/Config
$i = 0;
$i++;
$modversion['config'][$i]['name']           = 'break_filemanager'; 
$modversion['config'][$i]['title']          = '_MI_AJAXFM_BREAK_FILEMANAGER';
$modversion['config'][$i]['description']    = '';
$modversion['config'][$i]['formtype']       = 'line_break'; 
$modversion['config'][$i]['valuetype']      = 'textbox'; 
$modversion['config'][$i]['default']        = 'head';
$modversion['config'][$i]["category"]       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'upload_valid_exts';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_VALIDEXTS';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_VALIDEXTS_DESC';
$modversion['config'][$i]['formtype']       = 'textbox';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = 'jpg,png,gif,html,htm,js,mp3,flv,kml,txt,pdf,zip';
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'upload_max_size';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_MAXSIZE';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_MAXSIZE_DESC';
$modversion['config'][$i]['formtype']       = 'textbox';
$modversion['config'][$i]['valuetype']      = 'int';
$modversion['config'][$i]['default']        = 1000; // 1MB
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'default_pagination_limit';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_DEFAULTPAGINATIONLIMIT';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_DEFAULTPAGINATIONLIMIT_DESC';
$modversion['config'][$i]['formtype']       = 'select';
$modversion['config'][$i]['valuetype']      = 'int';
$modversion['config'][$i]['default']        = 20;
$modversion['config'][$i]['options']        = array(5 => 5, 10 => 10, 20 => 20, 30 => 30, 50 => 50, 80 => 80, 150 => 150, 999 => 999);
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'default_view';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_VIEW';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_VIEW_DESC';
$modversion['config'][$i]['formtype']       = 'select';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = 'thumbnail';
$modversion['config'][$i]['options']        = array('_MI_AJAXFM_VIEW1' => 'detail', '_MI_AJAXFM_VIEW2' => 'thumbnail');
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'text_editor';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_TEXTEDITOR';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_TEXTEDITOR_DESC';
$modversion['config'][$i]['formtype']       = 'select';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = 'dhtmltextarea';
$modversion['config'][$i]['options']        = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . '/class/xoopseditor');
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'navigation_mode';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_NAVIGATIONMODE';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_NAVIGATIONMODE_DESC';
$modversion['config'][$i]['formtype']       = 'select';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = 'secure';
$modversion['config'][$i]['options']        = array('_MI_AJAXFM_NAVIGATIONMODE1' => 'secure', '_MI_AJAXFM_NAVIGATIONMODE2' => 'dangerous', '_MI_AJAXFM_NAVIGATIONMODE4' => 'themes_directory', '_MI_AJAXFM_NAVIGATIONMODE3' => 'kamikaze');
$modversion['config'][$i]['category']       = 'global';
$i++;
$modversion['config'][$i]['name']           = 'break_imagemanager';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_BREAK_IMAGEMANAGER'; 
$modversion['config'][$i]['description']    = ''; 
$modversion['config'][$i]['formtype']       = 'line_break';
$modversion['config'][$i]['valuetype']      = 'textbox';
$modversion['config'][$i]['default']        = 'head';
$i++;
$modversion['config'][$i]['name']           = 'standard_imagemanager';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_XOOPSIMAGEMANAGER';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_XOOPSIMAGEMANAGER_DESC';
$modversion['config'][$i]['formtype']       = 'select';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = 'standard';
$modversion['config'][$i]['options']        = array('_MI_AJAXFM_XOOPSIMAGEMANAGER1' => 'standard', '_MI_AJAXFM_XOOPSIMAGEMANAGER2' => 'enhanced', '_MI_AJAXFM_XOOPSIMAGEMANAGER3' => 'ajaxfilemanager');
$modversion['config'][$i]['category']       = 'extra';
$i++;
$modversion['config'][$i]['name']           = 'break_plugins';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_BREAK_PLUGINS';
$modversion['config'][$i]['description']    = '';
$modversion['config'][$i]['formtype']       = 'line_break';
$modversion['config'][$i]['valuetype']      = 'textbox';
$modversion['config'][$i]['default']        = 'head';
$i++;
$modversion['config'][$i]['name']           = 'jwplayer_license_key';
$modversion['config'][$i]['title']          = '_MI_AJAXFM_JWPLAYER_LICENSE_KEY';
$modversion['config'][$i]['description']    = '_MI_AJAXFM_JWPLAYER_LICENSE_KEY_DESC';
$modversion['config'][$i]['formtype']       = 'textbox';
$modversion['config'][$i]['valuetype']      = 'text';
$modversion['config'][$i]['default']        = '';
$modversion['config'][$i]['category']       = 'global';


// Notification
$modversion["hasNotification"] = false;
$modversion["notification"] = array();
?>