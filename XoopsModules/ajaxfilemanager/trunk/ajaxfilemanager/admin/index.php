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

if (xaddresses_checkModuleAdmin()){
    $indexAdmin = new ModuleAdmin();
/* IN PROGRESS
    $indexAdmin->addInfoBox(_AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG);
    $indexAdmin->addInfoBoxLine(_AM_AJAXFM_INDEX_INFO . ' - ' . _AM_AJAXFM_INDEX_SCONFIG, 'test', 'in progress','inherit','information');
    $indexAdmin->addInfoBox(_AM_AJAXFM_INDEX_SERVERSTATUS . ' - ' . _AM_AJAXFM_INDEX_SPHPINI);
*/
    echo $indexAdmin->addNavigation('index.php');
    echo $indexAdmin->renderIndex();
}

echo '<fieldset><legend class="CPmediumTitle">' . _AM_AJAXFM_INDEX_INFO . '</legend>';
echo '<h3>' . _AM_AJAXFM_INDEX_SCONFIG . '</h3>';

echo '<p class="caption-text">' . _MI_AJAXFM_VALIDEXTS . ': ' . $xoopsModuleConfig['upload_valid_exts'];
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _MI_AJAXFM_VALIDEXTS_DESC . '</span>';
echo '</p>';

echo '<p class="caption-text">' . _MI_AJAXFM_MAXSIZE . ': ' . $xoopsModuleConfig['upload_max_size'] . _MI_AJAXFM_MAXSIZE_MB;
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _MI_AJAXFM_MAXSIZE_DESC . '</span>';
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
echo '<p class="caption-text">' . _MI_AJAXFM_NAVIGATIONMODE . ': ' . constant($options[$navigation_mode_config->getVar('conf_value')]);
echo '<br />';
echo '<br />';
echo '<span style="font-weight: normal;">' . _MI_AJAXFM_NAVIGATIONMODE_DESC . '</span>';
echo '</p>';

// check if ajaxfilemanager upload directories exist
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
if (!file_exists($dir)) {
    printf(_AM_AJAXFM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AM_AJAXFM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
if (!file_exists($dir)) {
    printf(_AM_AJAXFM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AM_AJAXFM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
$dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
if (!file_exists($dir)) {
    printf(_AM_AJAXFM_WARNING_DIRNOTEXIST, htmlentities($dir));
    echo '<br/>';
    echo "<a href='" . $currentFile ."?op=createdir&path=" . $dir . "'>" . _AM_AJAXFM_WARNING_DIRCREATEIT . "</a>";
    echo '<br/>';
}
echo '</fieldset>';


echo '<br/>';


echo '<fieldset><legend class="CPmediumTitle">' . _AM_AJAXFM_INDEX_SERVERSTATUS . '</legend>';
echo '<h3>' . _AM_AJAXFM_INDEX_SPHPINI . '</h3>';
$safeMode = (ini_get('safe_mode')) ? _AM_AJAXFM_INDEX_ON . _AM_AJAXFM_INDEX_SAFEMODEPROBLEMS : _AM_AJAXFM_INDEX_OFF;
$registerGlobals = (!ini_get('register_globals')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_OFF . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_ON . '</span>';
$magicQuotesGpc = (get_magic_quotes_gpc()) ? _AM_AJAXFM_INDEX_ON : _AM_AJAXFM_INDEX_OFF;
$downloads = (ini_get('file_uploads')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_ON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_OFF . '</span>';
$gdLib = (function_exists('gd_info')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_GDON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_GDOFF . '</span>';
$zipLib = (class_exists('ZipArchive')) ? '<span style="color: green;">' . _AM_AJAXFM_INDEX_ZIPON . '</span>' : '<span style="color: red;">' . _AM_AJAXFM_INDEX_ZIPOFF . '</span>';
echo '<ul>';
echo '<li>' . _AM_AJAXFM_INDEX_GDLIBSTATUS . $gdLib;
if (function_exists('gd_info')) {
    if (true == $gdLib = gd_info()) {
        echo '<li>' . _AM_AJAXFM_INDEX_GDLIBVERSION . '<b>' . $gdLib['GD Version'] . '</b>';
    }
}
echo '<li>' . _AM_AJAXFM_INDEX_ZIPLIBSTATUS . $zipLib;
echo '</ul>';
echo '<ul>';
echo '<li>' . _AM_AJAXFM_INDEX_SAFEMODESTATUS . $safeMode;
echo '<li>' . _AM_AJAXFM_INDEX_REGISTERGLOBALS . $registerGlobals;
echo '<li>' . _AM_AJAXFM_INDEX_MAGICQUOTESGPC . $magicQuotesGpc;
echo '<li>' . _AM_AJAXFM_INDEX_SERVERUPLOADSTATUS . $downloads;
echo '<li>' . _AM_AJAXFM_INDEX_MAXUPLOADSIZE . ' <b><span style="color: blue;">' . ini_get('upload_max_filesize') . '</span></b>';
echo '<li>' . _AM_AJAXFM_INDEX_MAXPOSTSIZE . ' <b><span style="color: blue;">' . ini_get('post_max_size') . '</span></b>';
echo '<li>' . _AM_AJAXFM_INDEX_SERVERPATH . ' <b>' . XOOPS_ROOT_PATH . '</b>';

echo '</ul>';
echo '</fieldset>';

include "admin_footer.php";
?>