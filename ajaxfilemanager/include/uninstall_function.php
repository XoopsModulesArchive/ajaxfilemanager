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

function xoops_module_pre_uninstall_ajaxfilemanager(&$xoopsModule) {
    return true;
}

function xoops_module_uninstall_ajaxfilemanager(&$xoopsModule) {
    include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';
    // Desactivate and delete ajaxfilemanager textsanitizer extension
    ajaxfilemanager_desactivateExtension('ajaxfilemanager');
    ajaxfilemanager_delDir(XOOPS_ROOT_PATH . '/class/textsanitizer/ajaxfilemanager');

    // Delete newfilemanager main upload directory and all subdirectories
    ajaxfilemanager_delDir(XOOPS_UPLOAD_PATH . '/ajaxfilemanager');
    return true;
}
?>