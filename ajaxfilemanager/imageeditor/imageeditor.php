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

$currentFile = basename(__FILE__);
include dirname(__FILE__) . '/../../../mainfile.php';

xoops_loadLanguage('imageeditor', 'ajaxfilemanager');

if (isset($_REQUEST['path'])) {
    $path = $_REQUEST['path'];
} else {
    exit('Path not set');
}

$op = 'edit';
/*
if (isset($_GET['op']) && $_GET['op'] == 'saveas') {
    $op = 'saveas';
} elseif (isset($_POST['op']) && $_POST['op'] == 'save') {
    $op = 'doupload';
}

$editor = 'bbcode';
if (isset($_REQUEST['editor'])) {
    $editor = $_REQUEST['editor'];
}
*/


if (!is_object($xoopsUser)) {
    $group = array(XOOPS_GROUP_ANONYMOUS);
} else {
    $group = $xoopsUser->getGroups();
}
if ($op == 'edit') {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
    $xoopsTpl->assign('sitename', htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES));
    $xoopsTpl->assign('xsize', 800);
    $xoopsTpl->assign('ysize', 600);
    include_once (XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imageeditor/class.imageeditor.php');
    $imageeditor = new XoopsImageEditor('test', null, $path, true);
    $output = $imageeditor->render();
    $xoopsTpl->assign('editor', $output);

    $xoopsTpl->assign('path', $path);

    $xoopsTpl->display('db:ajaxfm_imageeditor.html');
    exit();
}
/*
if ($op == 'save') {
    $imgcat_handler =& xoops_gethandler('imagecategory');
    $imgcat_id = intval($_GET['imgcat_id']);
    $imgcat =& $imgcat_handler->get($imgcat_id);
    $error = false;
    if (!is_object($imgcat)) {
        $error = true;
    } else {
        $imgcatperm_handler =& xoops_gethandler('groupperm');
        if (is_object($xoopsUser)) {
            if (! $imgcatperm_handler->checkRight('imgcat_write', $imgcat_id, $xoopsUser->getGroups())) {
                $error = true;
            }
        } else {
            if (! $imgcatperm_handler->checkRight('imgcat_write', $imgcat_id, XOOPS_GROUP_ANONYMOUS)) {
                $error = true;
            }
        }
    }
    if ($error != false) {
        xoops_header(false);
        echo '</head><body><div style="text-align:center;"><input value="'._BACK.'" type="button" onclick="javascript:history.go(-1);" /></div>';
        xoops_footer();
        exit();
    }
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
    $xoopsTpl->assign('show_cat', $imgcat_id);
    $xoopsTpl->assign('lang_imgmanager', _IMGMANAGER);
    $xoopsTpl->assign('sitename', htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES));
    $xoopsTpl->assign('target', htmlspecialchars($_GET['target'], ENT_QUOTES));
    include_once $GLOBALS['xoops']->path('class/xoopsformloader.php');
    $form = new XoopsThemeForm('', 'image_form', 'imagemanager.php', 'post', true);
    $form->setExtra('enctype="multipart/form-data"');
    $form->addElement(new XoopsFormText(_IMAGENAME, 'image_nicename', 20, 255), true);
    $form->addElement(new XoopsFormLabel(_IMAGECAT, $imgcat->getVar('imgcat_name')));
    $form->addElement(new XoopsFormFile(_IMAGEFILE, 'image_file', $imgcat->getVar('imgcat_maxsize')), true);
    $form->addElement(new XoopsFormLabel(_IMGMAXSIZE, $imgcat->getVar('imgcat_maxsize')));
    $form->addElement(new XoopsFormLabel(_IMGMAXWIDTH, $imgcat->getVar('imgcat_maxwidth')));
    $form->addElement(new XoopsFormLabel(_IMGMAXHEIGHT, $imgcat->getVar('imgcat_maxheight')));
    $form->addElement(new XoopsFormRadioYN (_IMAGEMANAGER_RESIZEIMAGE, 'resize_image', true, _YES, _NO));
    $form->addElement(new XoopsFormHidden('imgcat_id', $imgcat_id));
    $form->addElement(new XoopsFormHidden('op', 'doupload'));
    $form->addElement(new XoopsFormHidden('target', $target));
    $form->addElement(new XoopsFormButton('', 'img_button', _SUBMIT, 'submit'));
    $form->assign($xoopsTpl);
    $xoopsTpl->assign('lang_close', _CLOSE);
    $xoopsTpl->display('db:ajaxfm_imagemanager2.html');
    exit();
}

if ($op == 'saveas') {
    if ($GLOBALS['xoopsSecurity']->check()) {
        $image_nicename = isset($_POST['image_nicename']) ? $_POST['image_nicename'] : '';
        $xoops_upload_file = isset($_POST['xoops_upload_file']) ? $_POST['xoops_upload_file'] : array();
        $imgcat_id = isset($_POST['imgcat_id']) ? intval($_POST['imgcat_id']) : 0;
        include_once $GLOBALS['xoops']->path('class/uploader.php');
        $imgcat_handler =& xoops_gethandler('imagecategory');
        $imgcat =& $imgcat_handler->get($imgcat_id);
        $error = false;
        if (!is_object($imgcat)) {
            $error = true;
        } else {
            $imgcatperm_handler =& xoops_gethandler('groupperm');
            if (is_object($xoopsUser)) {
                if (!$imgcatperm_handler->checkRight('imgcat_write', $imgcat_id, $xoopsUser->getGroups())) {
                    $error = true;
                }
            } else {
                if (!$imgcatperm_handler->checkRight('imgcat_write', $imgcat_id, XOOPS_GROUP_ANONYMOUS)) {
                    $error = true;
                }
            }
        }
    } else {
        $error = true;
    }
    if ($error != false) {
        xoops_header(false);
        echo '</head><body><div style="text-align:center;">' . implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()) . '<br /><input value="' . _BACK . '" type="button" onclick="javascript:history.go(-1);" /></div>';
        xoops_footer();
        exit();
    }
    if (isset($_POST['resize_image']) && ($_POST['resize_image'] == true)) {
        // calculates the available memory for upload // IN PROGRESS
        // temporary solution 
        $memoryAvailable = @round((ajaxfilemanager_letToNum(ini_get('memory_limit')) - memory_get_usage())/3);
        $maxUploadSize = min(ajaxfilemanager_letToNum(ini_get('post_max_size')), ajaxfilemanager_letToNum(ini_get('upload_max_filesize')), $memoryAvailable);
        $maxFileSize = $maxUploadSize;
        $uploader = new XoopsMediaUploader(XOOPS_UPLOAD_PATH, array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'), $maxFileSize);
    } else {
        $uploader = new XoopsMediaUploader(XOOPS_UPLOAD_PATH, array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'), $imgcat->getVar('imgcat_maxsize'), $imgcat->getVar('imgcat_maxwidth'), $imgcat->getVar('imgcat_maxheight'));
    }
    $uploader->setPrefix('img');
    if ($uploader->fetchMedia($xoops_upload_file[0])) {
        if (!$uploader->upload()) {
            $err = $uploader->getErrors();
        } else {
            // resize image if too big using WideImage library // IN PROGRESS
            //require_once(XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imagemanager/libs/wideimage/WideImage.php');
            require_once(XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/Frameworks/wideimage/wideimage/WideImage.php');
            $in = WideImage::load($uploader->getSavedDestination());
            // Get the original geometry and calculate scales
            $width = $in->getWidth();
            $height = $in->getHeight();
            $widthFactor = $width / $imgcat->getVar('imgcat_maxwidth');
            $heightFactor = $height / $imgcat->getVar('imgcat_maxheight');
            // resize image if image size is > than max size, $widthFactor or $heightFactor > 1 
            if (($widthFactor > 1) || ($heightFactor > 1)) {
                $resizeFactor = max($widthFactor, $heightFactor);
                $newWidth = round($width / $resizeFactor);
                $newHeight = round($height / $resizeFactor);
                // Resize the original image
                $out = $in->resize($newWidth, $newHeight, 'fill');
                $out->saveToFile($uploader->getSavedDestination());
                $out->destroy();
            }
            $in->destroy();
            // check image or resized image file size
            if (filesize($uploader->getSavedDestination()) > $imgcat->getVar('imgcat_maxsize')) {
                $uploader->setErrors(_ER_UP_INVALIDFILESIZE);
                $err = $uploader->getErrors();
            } else {
                $image_handler =& xoops_gethandler('image');
                $image =& $image_handler->create();
                $image->setVar('image_name', $uploader->getSavedFileName());
                $image->setVar('image_nicename', $image_nicename);
                $image->setVar('image_mimetype', $uploader->getMediaType());
                $image->setVar('image_created', time());
                $image->setVar('image_display', 1);
                $image->setVar('image_weight', 0);
                $image->setVar('imgcat_id', $imgcat_id);
                if ($imgcat->getVar('imgcat_storetype') == 'db') {
                    $fp = @fopen($uploader->getSavedDestination(), 'rb');
                    $fbinary = @fread($fp, filesize($uploader->getSavedDestination()));
                    @fclose($fp);
                    $image->setVar('image_body', $fbinary, true);
                    @unlink($uploader->getSavedDestination());
                }
                if (!$image_handler->insert($image)) {
                    $err = sprintf(_FAILSAVEIMG, $image->getVar('image_nicename'));
                }
            }
        }
    } else {
        $err = sprintf(_FAILFETCHIMG, 0);
        $err .= '<br />' . implode('<br />', $uploader->getErrors(false));
    }
    if (isset($err)) {
        xoops_header(false);
        xoops_error($err);
        echo '</head><body><div style="text-align:center;"><input value="' . _BACK . '" type="button" onclick="javascript:history.go(-1);" /></div>';
        xoops_footer();
        exit();
    }
    header('location: ' . $currentFile . '?cat_id=' . $imgcat_id . '&target=' . $target . '&editor=' . $editor);
}
*/
?>