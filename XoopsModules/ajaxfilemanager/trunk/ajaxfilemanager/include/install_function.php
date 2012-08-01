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

function xoops_module_pre_install_ajaxfilemanager(&$xoopsModule) {
    // Check if this XOOPS version is supported
    $minSupportedVersion = explode('.', '2.4.5');
    $currentVersion = explode('.', substr(XOOPS_VERSION, 6));

    if($currentVersion[0] > $minSupportedVersion[0]) {
        return true;
        } elseif($currentVersion[0] == $minSupportedVersion[0]) {
            if($currentVersion[1] > $minSupportedVersion[1]) {
                return true;
            } elseif($currentVersion[1] == $minSupportedVersion[1]) {
                if($currentVersion[2] > $minSupportedVersion[2]) {
                    return true;
                } elseif ($currentVersion[2] == $minSupportedVersion[2]) {
                    return true;
                }
            }
        }
    return false;
}



function xoops_module_install_ajaxfilemanager(&$xoopsModule) {
    xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname'));
    include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';

    $ret = true;
    $msg = '';
    // Create ajaxfilemanager main upload directory
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
	if (!ajaxfilemanager_makeDir($dir))
        $msg.= sprintf(_MI_AJAXFM_WARNING_DIRNOTCREATED, $dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
	if (!ajaxfilemanager_makeDir($dir))
        $msg.= sprintf(_MI_AJAXFM_WARNING_DIRNOTCREATED, $dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
	if (!ajaxfilemanager_makeDir($dir))
        $msg.= sprintf(_MI_AJAXFM_WARNING_DIRNOTCREATED, $dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/imagecache";
	if (!ajaxfilemanager_makeDir($dir))
        $msg.= sprintf(_MI_AJAXFM_WARNING_DIRNOTCREATED, $dir);
    if (empty($msg))
        return $ret;
    else
        return $msg;
}
