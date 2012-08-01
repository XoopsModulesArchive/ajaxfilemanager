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

include "../../../mainfile.php";
include_once XOOPS_ROOT_PATH . '/kernel/module.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
include XOOPS_ROOT_PATH . "/header.php";
$currentFile = basename(__FILE__);

xoops_load ('formajaxfilemanager', 'ajaxfilemanager'); // load custom form class
xoops_load ('formmultipleajaxfilemanager', 'ajaxfilemanager'); // load custom form class
xoops_load ('formxoopsimage', 'ajaxfilemanager'); // load custom form class
xoops_load ('formmultiplexoopsimage', 'ajaxfilemanager'); // load custom form class


$FormAjaxFileManager = isset($_REQUEST['FormAjaxFileManager']) ? $_REQUEST['FormAjaxFileManager'] : null;
$FormMultipleAjaxFileManager = array();
if (isset($_REQUEST['FormMultipleAjaxFileManager'])) {
    $ret = array();
    foreach ($_REQUEST['FormMultipleAjaxFileManager'] as $val) {if ($val != '') $ret[] = $val;}
    $FormMultipleAjaxFileManager = $ret;
}

$FormXoopsImage = isset($_REQUEST['FormXoopsImage']) ? $_REQUEST['FormXoopsImage'] : null;
$FormMultipleXoopsImage = array();
if (isset($_REQUEST['FormMultipleXoopsImage'])) {
    $ret = array();
    foreach ($_REQUEST['FormMultipleXoopsImage'] as $val) {if ($val != '') $ret[] = $val;}
    $FormMultipleXoopsImage = $ret;
}


$sample_form = new XoopsThemeForm('', 'sample_form', $currentFile);
$sample_form->setExtra('enctype="multipart/form-data"');

$sample_form->addElement(new FormAjaxFileManager('FormAjaxFileManager', 'FormAjaxFileManager', 40, 255), true);
$sample_form->addElement(new FormMultipleAjaxFileManager('FormMultipleAjaxFileManager', 'FormMultipleAjaxFileManager', 40, 255, $FormMultipleAjaxFileManager), true);
$sample_form->addElement(new FormXoopsImage('FormXoopsImage', 'FormXoopsImage', 40, 255, $FormXoopsImage), true);
$sample_form->addElement(new FormMultipleXoopsImage('FormMultipleXoopsImage', 'FormMultipleXoopsImage', 40, 255, $FormMultipleXoopsImage), true);

$sample_form->addElement(new XoopsFormButton('', 'save', _SUBMIT, 'submit'));
$sample_form->display();

include XOOPS_ROOT_PATH.'/footer.php';
