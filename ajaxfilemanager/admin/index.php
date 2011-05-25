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



$op = (isset($_GET['op']))? $_GET['op'] : "";
if ($op = 'createdir') {
    if (isset($_GET['path'])) {
        $path = $_GET['path'];
        $msg = (makeDir($path)) ? _AJAXFM_AM_DIRCREATED : _AJAXFM_AM_DIRNOTCREATED;
        redirect_header($currentFile, 2, sprintf($msg, htmlentities($path)));
        exit();
    }
}



xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);

// index menu
include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/class/menu.php';
//$menu = new moduleMenu();
$menu = new testMenu();
foreach ($adminmenu as $menuitem) {
    $menu->addItem($menuitem['name'], '../' . $menuitem['link'], '../' . $menuitem['icon'], $menuitem['title']);
}

$menu->addItem('Preferences', '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule ->getVar('mid') . '&amp;&confcat_id=1', '../images/icons/32x32/prefs.png', _PREFERENCES);

echo $menu->getCSS();
echo '<table width="100%" border="0" cellspacing="10" cellpadding="4">';
echo '<tr>';



echo '<td>' . $menu->render() . '</td>';

echo '<td valign="top" width="60%">';
echo '<fieldset><legend class="CPmediumTitle">' . _AJAXFM_AM_INDEX_INFO . '</legend>';
echo '<h3>' . _AJAXFM_AM_INDEX_SCONFIG . '</h3>';

echo '<p class="caption-text">' . _AJAXFM_MI_VALIDEXTS . ': ' . $xoopsModuleConfig['upload_valid_exts'];
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _AJAXFM_MI_VALIDEXTS_DESC . '</span>';
echo '</p>';

echo '<p class="caption-text">' . _AJAXFM_MI_MAXSIZE . ': ' . $xoopsModuleConfig['upload_max_size'] . _AJAXFM_MI_MAXSIZE_MB;
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _AJAXFM_MI_MAXSIZE_DESC . '</span>';
echo '</p>';

$config_handler =& xoops_gethandler('config');
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('conf_modid', $xoopsModule->id()));
$criteria->add(new Criteria('conf_name', 'navigation_mode'));
$config = $config_handler->getConfigs($criteria);
$navigation_mode_config = $config[0];
$navigation_mode_options = $config_handler->getConfigOptions(new Criteria('conf_id', $navigation_mode_config->getVar('conf_id')));
foreach ($navigation_mode_options as $option) {
    $options[$option->getVar('confop_value')] = $option->getVar('confop_name');
}
echo '<p class="caption-text">' . _AJAXFM_MI_NAVIGATIONMODE . ': ' . constant($options[$navigation_mode_config->getVar('conf_value')]);
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _AJAXFM_MI_NAVIGATIONMODE_DESC . '</span>';
echo '</p>';

// check if ftp server exists and module can log to it
$useFtp = false;
if($xoopsModuleConfig['ftp_enabled'] && function_exists('ftp_connect') && !empty($xoopsModuleConfig['ftp_serverhost'])) {
    // set up basic connection
    switch ($xoopsModuleConfig['ftp_connectiontype']) {
        case 'ssl':
            // Opens an Secure SSL-FTP connection
            $connId = ftp_ssl_connect ($xoopsModuleConfig['ftp_serverhost'], $xoopsModuleConfig['ftp_serverport'], $xoopsModuleConfig['ftp_servertimeout']);        
            break;
        case 'ftp':
        default:
            // Opens an FTP connection
            $connId = ftp_connect($xoopsModuleConfig['ftp_serverhost'], $xoopsModuleConfig['ftp_serverport'], $xoopsModuleConfig['ftp_servertimeout']);
            break;
    }
    if ($connId) {
        $loginResult = ftp_login($connId, $xoopsModuleConfig['ftp_username'], $xoopsModuleConfig['ftp_password']);
        if ($loginResult) {
            $pasiveResult = ftp_pasv($connId, $xoopsModuleConfig['ftp_connectionpassive']);
            if ($pasiveResult) {
                if (is_array(ftp_nlist($connId, "."))) {
                $useFtp = true;  
                
                }
            }
        }
        ftp_close($connId);
    }
}
echo '<p class="caption-text">' . _AJAXFM_MI_FTPSUPPORT . ': ' . ($useFtp ? _AJAXFM_AM_INDEX_ON : _AJAXFM_AM_INDEX_OFF). '</p>';



$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
if (!file_exists($dir)) {
    printf(_AJAXFM_AM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AJAXFM_AM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
echo '</fieldset>';

echo '<br/>';

echo '<fieldset><legend class="CPmediumTitle">' . _AJAXFM_AM_INDEX_SERVERSTATUS . '</legend>';
echo '<h3>' . _AJAXFM_AM_INDEX_SPHPINI . '</h3>';
$safeMode = (ini_get('safe_mode')) ? _AJAXFM_AM_INDEX_ON . _AJAXFM_AM_INDEX_SAFEMODEPROBLEMS : _AJAXFM_AM_INDEX_OFF;
$registerGlobals = (!ini_get('register_globals')) ? '<span style="color: green;">' . _AJAXFM_AM_INDEX_OFF . '</span>' : '<span style="color: red;">' . _AJAXFM_AM_INDEX_ON . '</span>';
$magicQuotesGpc = (get_magic_quotes_gpc()) ? _AJAXFM_AM_INDEX_ON : _AJAXFM_AM_INDEX_OFF;
$downloads = (ini_get('file_uploads')) ? '<span style="color: green;">' . _AJAXFM_AM_INDEX_ON . '</span>' : '<span style="color: red;">' . _AJAXFM_AM_INDEX_OFF . '</span>';
$gdLib = (function_exists('gd_info')) ? '<span style="color: green;">' . _AJAXFM_AM_INDEX_GDON . '</span>' : '<span style="color: red;">' . _AJAXFM_AM_INDEX_GDOFF . '</span>';
$zipLib = (class_exists('ZipArchive')) ? '<span style="color: green;">' . _AJAXFM_AM_INDEX_ZIPON . '</span>' : '<span style="color: red;">' . _AJAXFM_AM_INDEX_ZIPOFF . '</span>';
echo '<ul>';
echo '<li>' . _AJAXFM_AM_INDEX_GDLIBSTATUS . $gdLib;
if (function_exists('gd_info')) {
    if (true == $gdLib = gd_info()) {
        echo '<li>' . _AJAXFM_AM_INDEX_GDLIBVERSION . '<b>' . $gdLib['GD Version'] . '</b>';
    }
}
echo '<li>' . _AJAXFM_AM_INDEX_ZIPLIBSTATUS . $zipLib;
echo '</ul>';
echo '<ul>';
echo '<li>' . _AJAXFM_AM_INDEX_SAFEMODESTATUS . $safeMode;
echo '<li>' . _AJAXFM_AM_INDEX_REGISTERGLOBALS . $registerGlobals;
echo '<li>' . _AJAXFM_AM_INDEX_MAGICQUOTESGPC . $magicQuotesGpc;
echo '<li>' . _AJAXFM_AM_INDEX_SERVERUPLOADSTATUS . $downloads;
echo '<li>' . _AJAXFM_AM_INDEX_MAXUPLOADSIZE . ' <b><span style="color: blue;">' . ini_get('upload_max_filesize') . '</span></b>';
echo '<li>' . _AJAXFM_AM_INDEX_MAXPOSTSIZE . ' <b><span style="color: blue;">' . ini_get('post_max_size') . '</span></b>';
echo '<li>' . _AJAXFM_AM_INDEX_SERVERPATH . ' <b>' . XOOPS_ROOT_PATH . '</b>';

echo '</ul>';
echo '</fieldset>';



echo '</td></tr>';
echo '</table>';

xoops_cp_footer();
?>