<?php
include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes

// get/check parameters/post
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'extra';



// render start here
xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);
/*
include_once $GLOBALS['xoops']->path( '/class/xoopsformloader.php' );
$opForm = new XoopsSimpleForm('', 'opform', $currentFile, 'get');
$opSelect = new XoopsFormSelect("", 'op', $op);
$opSelect->setExtra('onchange="document.forms.opform.submit()"');
$opSelect->addOption('access', _AJAXFM_AM_PERM_ACCESS);
$opSelect->addOption('upload', _AJAXFM_AM_PERM_UPLOAD);
$opSelect->addOption('extra', _AJAXFM_AM_PERM_EXTRA);
$opForm->addElement($opSelect);
$opForm->display();
*/
$permDesc = '';
switch ($op ) {
/*
case 'access':
    $titleOfForm = _AJAXFM_AM_PERM_ACCESS;
    $permName = 'ajaxfilemanager_access';
    $permDesc = _AJAXFM_AM_PERM_ACCESS_DESC;
    $anonymous = true;
    break;

case 'upload':
    $titleOfForm = _AJAXFM_AM_PERM_UPLOAD;
    $permName = 'ajaxfilemanager_upload';
    $permDesc = _AJAXFM_AM_PERM_UPLOAD_DESC;
    $anonymous = true;
    break;
*/
default:
case 'extra':
    $titleOfForm = _AJAXFM_AM_PERM_EXTRA;
    $permName = 'ajaxfilemanager_extra';
    $permDesc = _AJAXFM_AM_PERM_EXTRA_DESC;
    $globalPermsArray = array(
    '1' => _AJAXFM_AM_PERM_EXTRA_1 , // Use Ajax File Manager
    '2' => _AJAXFM_AM_PERM_EXTRA_2 , // Upload Files
    '4' => _AJAXFM_AM_PERM_EXTRA_4 , // Delete Files
    '8' => _AJAXFM_AM_PERM_EXTRA_8 , // Cut Files
    '16' => _AJAXFM_AM_PERM_EXTRA_16 , // Copy Files
    '32' => _AJAXFM_AM_PERM_EXTRA_32 , // Create New Folder
    '64' => _AJAXFM_AM_PERM_EXTRA_64 , // Rename
    '128' => _AJAXFM_AM_PERM_EXTRA_128 , // Edit
    );
    $anonymous = true;
    break;
}
$moduleId = $GLOBALS['xoopsModule']->getVar('mid');
include_once $GLOBALS['xoops']->path( '/class/xoopsform/grouppermform.php' );
$permissionsForm = new XoopsGroupPermForm($titleOfForm, $moduleId, $permName, $permDesc, 'admin/' . $currentFile, $anonymous);
if ($op == 'extra') {
    foreach( $globalPermsArray as $permId => $permName ) {
        $permissionsForm->addItem($permId, $permName) ;
    }
} else {
    // NOP
}
$permissionsForm->display();
unset ($permissionsForm);

xoops_cp_footer();
?>