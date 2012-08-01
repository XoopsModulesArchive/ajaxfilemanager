<?php
/**
 * ****************************************************************************
 *  - A Project by Developers TEAM For Xoops - ( http://www.xoops.org )
 * ****************************************************************************
 *  AJAXFILEMANAGER - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           1.0
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */

include "admin_header.php";
xoops_cp_header();
$currentFile = basename(__FILE__);

$op = (isset($_GET['op']))? $_GET['op'] : "";
if ($op = 'createdir') {
    if (isset($_GET['path'])) {
        $path = $_GET['path'];
        $msg = (ajaxfilemanager_makeDir($path)) ? _AM_AJAXFM_DIRCREATED : _AM_AJAXFM_DIRNOTCREATED;
        redirect_header($currentFile, 2, sprintf($msg, htmlentities($path)));
        exit();
    }
}

if (ajaxfilemanager_checkModuleAdmin()){
    $indexAdmin = new ModuleAdmin();
    // Module Informations - Information taken from Module Preferences
    $indexAdmin->addInfoBox(_AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG);
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG, 
        '<p class="caption-text">' . _MI_AJAXFM_VALIDEXTS . ': ' . $xoopsModuleConfig['upload_valid_exts'] . '<br />' . '<span style="font-weight: normal;">' . _MI_AJAXFM_VALIDEXTS_DESC . '</span></p>', 
        'in progress','inherit','information');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG, 
        '<p class="caption-text">' . _MI_AJAXFM_MAXSIZE . ': ' . $xoopsModuleConfig['upload_max_size'] . _MI_AJAXFM_MAXSIZE_KB . '<br />' . '<span style="font-weight: normal;">' . _MI_AJAXFM_MAXSIZE_DESC . '</span></p>', 
        'in progress','inherit','information');
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
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG, 
        '<p class="caption-text">' . _MI_AJAXFM_NAVIGATIONMODE . ': ' . constant($options[$navigation_mode_config->getVar('conf_value')]) . '<br />' . '<span style="font-weight: normal;">' . _MI_AJAXFM_NAVIGATIONMODE_DESC . '</span></p>',
        'in progress','inherit','information');

    // Server Status - Information taken from PHP ini File
    $phpiniPath = get_cfg_var('cfg_file_path');
    $safeMode = (ini_get('safe_mode')) ? _AM_AJAXFM_INDEX_ON . _AM_AJAXFM_INDEX_SAFEMODEPROBLEMS : _AM_AJAXFM_INDEX_OFF;
    $registerGlobals = (!ini_get('register_globals')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_OFF . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_ON . '</span>';
    $magicQuotesGpc = (get_magic_quotes_gpc()) ? _AM_AJAXFM_INDEX_ON : _AM_AJAXFM_INDEX_OFF;
    $downloads = (ini_get('file_uploads')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_ON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_OFF . '</span>';
    $gdLib = (function_exists('gd_info')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_GDON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_GDOFF . '</span>';
    $gdLibVersion = (function_exists('gd_info') && ($gdLibInfo = gd_info())) ? $gdLibInfo['GD Version'] : '<span style="color: red;">' . _AM_AJAXFM_INDEX_GDOFF . '</span>';
    $zipLib = (class_exists('ZipArchive')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_ZIPON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_ZIPOFF . '</span>';
    $indexAdmin->addInfoBox(_AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI);
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_SPHPINIPATH, 
        $phpiniPath,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_GDLIBSTATUS, 
        $gdLib,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_GDLIBVERSION, 
        $gdLibVersion,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_ZIPLIBSTATUS, 
        $zipLib,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_SAFEMODESTATUS, 
        $safeMode,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_REGISTERGLOBALS, 
        $registerGlobals,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_MAGICQUOTESGPC, 
        $magicQuotesGpc,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_SERVERUPLOADSTATUS, 
        $downloads,
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_MAXUPLOADSIZE, 
        ini_get('upload_max_filesize'),
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_MAXPOSTSIZE, 
        ini_get('post_max_size'),
        'inherit','default');
    $indexAdmin->addInfoBoxLine(
        _AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI, 
        _AM_AJAXFM_INDEX_XOOPSPATH, 
        XOOPS_ROOT_PATH,'inherit','default');

    $indexAdmin->addConfigBoxLine(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager', $type = 'folder');
    $indexAdmin->addConfigBoxLine(array(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager', '777'), $type = 'chmod');
    $indexAdmin->addConfigBoxLine(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/uploaded', $type = 'folder');
    $indexAdmin->addConfigBoxLine(array(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/uploaded', '777'), $type = 'chmod');
    $indexAdmin->addConfigBoxLine(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/session', $type = 'folder');
    $indexAdmin->addConfigBoxLine(array(XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager/session', '777'), $type = 'chmod');
    
    echo $indexAdmin->addNavigation('index.php');
    echo $indexAdmin->renderIndex();
}

include "admin_footer.php";
