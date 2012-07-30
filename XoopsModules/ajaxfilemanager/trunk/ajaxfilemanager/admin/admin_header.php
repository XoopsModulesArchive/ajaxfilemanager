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

// Include xoops admin header
include "../../../include/cp_header.php";

include_once(XOOPS_ROOT_PATH."/kernel/module.php");
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH."/class/tree.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/pagenav.php";
include_once XOOPS_ROOT_PATH."/class/xoopsform/grouppermform.php";

// Include module functions
include_once("../include/functions.php");



$pathDir = $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin');
$globalLanguage = $GLOBALS['xoopsConfig']['language'];

if ( file_exists($pathDir . '/language/' . $globalLanguage . '/main.php')){
	include_once $pathDir . '/language/' . $globalLanguage . '/main.php';        
} else {
	include_once $pathDir . '/language/english/main.php';        
}
    
if ( file_exists($pathDir . '/moduleadmin.php')){
	include_once $pathDir . '/moduleadmin.php';
	//return true;
} else {
	xoops_cp_header();
	echo xoops_error(_AM_AJAXFM_NOFRAMEWORKS);
	xoops_cp_footer();
	//return false;
}

$dirname = basename(dirname(dirname( __FILE__ ) ));
$module_handler =& xoops_gethandler('module');
$xoopsModule = & $module_handler->getByDirname($dirname); 
$moduleInfo =& $module_handler->get($xoopsModule->getVar('mid'));
$pathImageIcon = XOOPS_URL .'/'. $moduleInfo->getInfo('icons16');
$pathImageAdmin = XOOPS_URL .'/'. $moduleInfo->getInfo('icons32');
$pathImageModule = XOOPS_URL . '/modules/'. $GLOBALS['xoopsModule']->getVar('dirname') .'/images';



$myts =& MyTextSanitizer::getInstance();

if ( $xoopsUser ) {
    $xoopsModule = XoopsModule::getByDirname('ajaxfilemanager');
    if ( !$xoopsUser->isAdmin($GLOBALS['xoopsModule']->mid()) ) {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL."/",3,_NOPERM);
    exit();
}

if ( !isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])  ) {
    include_once $GLOBALS['xoops']->path( "/class/template.php" );
    $GLOBALS['xoopsTpl'] = new XoopsTpl();
}

// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $GLOBALS['xoopsModule']->getVar('dirname'));
xoops_loadLanguage('modinfo', $GLOBALS['xoopsModule']->getVar('dirname'));

include_once 'admin_functions.php'; // admin functions
?>