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
    xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname'));
    include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';

    $ret = true;
    $msg = '';
    // Create ajaxfilemanager main upload directory
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager";
	if (!makeDir($dir))
        $msg.= sprintf(_AJAXFM_MI_WARNING_DIRNOTCREATED, $dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/uploaded";
	if (!makeDir($dir))
        $msg.= sprintf(_AJAXFM_MI_WARNING_DIRNOTCREATED, $dir);
    $dir = XOOPS_ROOT_PATH . "/uploads/ajaxfilemanager/session";
	if (!makeDir($dir))
        $msg.= sprintf(_AJAXFM_MI_WARNING_DIRNOTCREATED, $dir);
    if (empty($msg))
        return $ret;
    else
        return $msg;
}
?>