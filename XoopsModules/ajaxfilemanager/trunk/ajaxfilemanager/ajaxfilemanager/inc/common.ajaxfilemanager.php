<?php
/**
 * XOOPS NO COMMON initialization file
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 */
defined('XOOPS_MAINFILE_INCLUDED') or die('Restricted access');

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    set_magic_quotes_runtime(0);
}

global $xoops, $xoopsPreload, $xoopsLogger, $xoopsErrorHandler, $xoopsSecurity, $sess_handler;

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('NWLINE')or define('NWLINE', "\n");

/**
 * Include files with definitions
 */
include_once XOOPS_ROOT_PATH . DS . 'include' . DS . 'defines.php';
include_once XOOPS_ROOT_PATH . DS . 'include' . DS . 'version.php';
include_once XOOPS_ROOT_PATH . DS . 'include' . DS . 'license.php';
/**
 * Include XoopsLoad
 */
require_once XOOPS_ROOT_PATH . DS . 'class' . DS . 'xoopsload.php';
/**
 *  Create Instance of Preload Object
 */
XoopsLoad::load('preload');
$xoopsPreload =& XoopsPreload::getInstance();
$xoopsPreload->triggerEvent('core.include.common.start');
/**
 * Create Instance of xos_kernel_Xoops2 Object
 * Atention, not all methods can be used at this point
 */
XoopsLoad::load('xoopskernel');
$xoops = new xos_kernel_Xoops2();
$xoops->pathTranslation();
$xoopsRequestUri =& $_SERVER['REQUEST_URI'];// Deprecated (use the corrected $_SERVER variable now)
/**
 * Create Instance of xoopsSecurity Object and check Supergolbals
 */
XoopsLoad::load('xoopssecurity');
$xoopsSecurity = new XoopsSecurity();
$xoopsSecurity->checkSuperglobals();
/**
 * Create Instantance XoopsLogger Object
 */
XoopsLoad::load('xoopslogger');
$xoopsLogger =& XoopsLogger::getInstance();
$xoopsErrorHandler =& XoopsLogger::getInstance();
$xoopsLogger->startTime();
$xoopsLogger->startTime('XOOPS Boot');
/**
 * Include Required Files
 */
include_once $xoops->path('kernel/object.php');
include_once $xoops->path('class/criteria.php');
include_once $xoops->path('class/module.textsanitizer.php');
include_once $xoops->path('include/functions.php');
/**
 * Get database for making it global
 * Requires XoopsLogger, XOOPS_DB_PROXY;
 */
include_once $xoops->path('class/database/databasefactory.php');
$xoopsDB =& XoopsDatabaseFactory::getDatabaseConnection();
/**
 * Get xoops configs
 * Requires functions and database loaded
 */
$config_handler =& xoops_gethandler('config');
$xoopsConfig = $config_handler->getConfigsByCat(XOOPS_CONF);
/**
 * Merge file and db configs.
 */
if (file_exists($file = $GLOBALS['xoops']->path('var/configs/xoopsconfig.php'))) {
    $fileConfigs = include $file;
    $xoopsConfig = array_merge($xoopsConfig, (array) $fileConfigs);
    unset($fileConfigs, $file);
} else {
    trigger_error('File Path Error: ' . 'var/configs/xoopsconfig.php' . ' does not exist.');
}
?>
