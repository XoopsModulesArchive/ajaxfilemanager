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
 
$dirname = basename( dirname( dirname( __FILE__ ) ) ) ;
$module_handler =& xoops_gethandler("module");
$xoopsModule =& XoopsModule::getByDirname($dirname);
$moduleInfo =& $module_handler->get($xoopsModule->getVar("mid"));
$pathImageAdmin = $moduleInfo->getInfo("icons32");	

$adminmenu = array();
$i = 1;
$i++;
$adminmenu[$i]['name'] = 'Index';
$adminmenu[$i]['title'] = _MI_AJAXFM_ADMENU_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$adminmenu[$i]['desc'] = _MI_AJAXFM_ADMENU_INDEX_DESC;
$adminmenu[$i]['icon'] = "../../{$pathImageAdmin}/house.png";
$i++;
$adminmenu[$i]['name'] = 'Filemanager';
$adminmenu[$i]['title'] = _MI_AJAXFM_ADMENU_FILEMANAGER;
$adminmenu[$i]['link'] = "admin/filemanager.php";
$adminmenu[$i]['desc'] = _MI_AJAXFM_ADMENU_FILEMANAGER_DESC;
$adminmenu[$i]['icon'] = "../../{$pathImageAdmin}/installer_box.png";
$i++;
$adminmenu[$i]['name'] = 'Extension';
$adminmenu[$i]['title'] = _MI_AJAXFM_ADMENU_EXTENSIONS;
$adminmenu[$i]['link'] = "admin/extensions.php";
$adminmenu[$i]['desc'] = _MI_AJAXFM_ADMENU_EXTENSIONS_DESC;
$adminmenu[$i]['icon'] = "../../{$pathImageAdmin}/plugin.png";
$i++;
$adminmenu[$i]['name'] = 'Permissions';
$adminmenu[$i]['title'] = _MI_AJAXFM_ADMENU_PERMISSIONS;
$adminmenu[$i]['link'] = "admin/permissions.php";
$adminmenu[$i]['desc'] = _MI_AJAXFM_ADMENU_PERMISSIONS_DESC;
$adminmenu[$i]['icon'] = "../../{$pathImageAdmin}/lock.png";
$i++;
$adminmenu[$i]['name'] = 'About';
$adminmenu[$i]['title'] = _MI_AJAXFM_ADMENU_ABOUT;
$adminmenu[$i]['link'] = "admin/about.php";
$adminmenu[$i]['desc'] = _MI_AJAXFM_ADMENU_ABOUT_DESC;
$adminmenu[$i]['icon'] = "../../{$pathImageAdmin}/information.png";
unset( $i );
