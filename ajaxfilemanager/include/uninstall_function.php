<?php
function xoops_module_pre_uninstall_ajaxfilemanager(&$xoopsModule) {
    return true;
}

function xoops_module_uninstall_ajaxfilemanager(&$xoopsModule) {
    include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';
    // Desactivate and delete ajaxfilemanager textsanitizer extension
    desactivateExtension('ajaxfilemanager');
    delDir(XOOPS_ROOT_PATH . '/class/textsanitizer/ajaxfilemanager');

    // Delete newfilemanager main upload directory and all subdirectories
    delDir(XOOPS_UPLOAD_PATH . '/ajaxfilemanager');
    return true;
}
?>