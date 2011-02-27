<?php
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
    include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';
    // Create ajaxfilemanager main upload directory
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
    makeDir($dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
    if(!makeDir($dir)) return false;
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
    if(!is_dir($dir))
    if(!makeDir($dir)) return false;
    return true;
}
?>