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

include 'admin_header.php';
$currentFile = basename(__FILE__);

// load classes

// get/check parameters/post
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'extra';



// render start here
xoops_cp_header();

$permDesc = '';
switch ($op ) {
default:
case 'extra':
    $titleOfForm = _AM_AJAXFM_PERM_EXTRA;
    $permName = 'ajaxfilemanager_extra';
    $permDesc = _AM_AJAXFM_PERM_EXTRA_DESC;
    $globalPermsArray = array(
    '1'     => _AM_AJAXFM_PERM_EXTRA_1 ,    // Use Ajax File Manager

    '512'   => _AM_AJAXFM_PERM_EXTRA_512 ,  // Create new files
    '2'     => _AM_AJAXFM_PERM_EXTRA_2 ,    // Upload files

    '32'    => _AM_AJAXFM_PERM_EXTRA_32 ,   // Create new folder

    '4'     => _AM_AJAXFM_PERM_EXTRA_4 ,    // Delete files/folders
    '8'     => _AM_AJAXFM_PERM_EXTRA_8 ,    // Cut files/folders
    '16'    => _AM_AJAXFM_PERM_EXTRA_16 ,   // Copy files/folders
    '64'    => _AM_AJAXFM_PERM_EXTRA_64 ,   // Rename files/folders

    '128'   => _AM_AJAXFM_PERM_EXTRA_128 ,  // Edit files
    '1024'  => _AM_AJAXFM_PERM_EXTRA_1024 , // Zip files/folders
    '2048'  => _AM_AJAXFM_PERM_EXTRA_2048 , // Unzip files
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

include "admin_footer.php";
