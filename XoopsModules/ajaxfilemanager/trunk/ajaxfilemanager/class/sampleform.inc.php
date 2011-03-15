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

include "../../../mainfile.php";
include_once XOOPS_ROOT_PATH . '/class/xoopsmodule.php';
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

$sample_form->addElement(new FormAjaxFileManager('FormAjaxFileManager', 'FormAjaxFileManager', $FormAjaxFileManager), true);
$sample_form->addElement(new FormMultipleAjaxFileManager('FormMultipleAjaxFileManager', 'FormMultipleAjaxFileManager', $FormMultipleAjaxFileManager), true);
$sample_form->addElement(new FormXoopsImage('FormXoopsImage', 'FormXoopsImage', $FormXoopsImage), true);
$sample_form->addElement(new FormMultipleXoopsImage('FormMultipleXoopsImage', 'FormMultipleXoopsImage', $FormMultipleXoopsImage), true);

$sample_form->addElement(new XoopsFormButton('', 'save', _SUBMIT, 'submit'));
$sample_form->display();



include XOOPS_ROOT_PATH.'/footer.php';
?>