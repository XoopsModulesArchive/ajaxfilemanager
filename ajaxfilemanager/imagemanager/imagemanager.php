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
include dirname(__FILE__) . '/../include/functions.php';

xoops_loadLanguage('imagemanager', 'ajaxfilemanager');

if (isset($_REQUEST['target'])) {
    $target = $_REQUEST['target'];
} else {
    exit('Target not set');
}

$op = 'list';
if (isset($_GET['op']) && $_GET['op'] == 'upload') {
    $op = 'upload';
} elseif (isset($_POST['op']) && $_POST['op'] == 'doupload') {
    $op = 'doupload';
}

$editor = 'bbcode';
if (isset($_REQUEST['editor'])) {
    $editor = $_REQUEST['editor'];
}



if (!is_object($xoopsUser)) {
    $group = array(XOOPS_GROUP_ANONYMOUS);
} else {
    $group = $xoopsUser->getGroups();
}
if ($op == 'list') {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
    $xoopsTpl->assign('lang_imgmanager', _IMGMANAGER);
    $xoopsTpl->assign('sitename', htmlspecialchars($xoopsConfig['sitename'], ENT_QUOTES));
    $target = htmlspecialchars($target, ENT_QUOTES);
    $xoopsTpl->assign('target', $target);
    $xoopsTpl->assign('editor', $editor);
    $imgcat_handler =& xoops_gethandler('imagecategory');
    $catlist =& $imgcat_handler->getList($group, 'imgcat_read', 1);
    $catcount = count($catlist);
    $xoopsTpl->assign('lang_align', _ALIGN);
    $xoopsTpl->assign('lang_add', _ADD);
    $xoopsTpl->assign('lang_close', _CLOSE);
    if ($catcount > 0) {
        $xoopsTpl->assign('lang_go', _GO);
        $catshow = (!isset($_GET['cat_id'])) ? 0 : intval($_GET['cat_id']);
        $catshow = (!empty($catshow) && in_array($catshow, array_keys($catlist))) ? $catshow : 0;
        $xoopsTpl->assign('show_cat', $catshow);
        if ($catshow > 0) {
            $xoopsTpl->assign('lang_addimage', _ADDIMAGE);
        }
        $catlist = array('0' => '--') + $catlist;
        $cat_options = '';
        foreach ($catlist as $c_id => $c_name) {
            $sel = '';
            if ($c_id == $catshow) {
                $sel = ' selected="selected"';
            }
            $cat_options .= '<option value="' . $c_id . '"' . $sel . '>' . $c_name . '</option>';
        }
        $xoopsTpl->assign('cat_options', $cat_options);
        if ($catshow > 0) {
            $image_handler =& xoops_gethandler('image');
            $criteria = new CriteriaCompo(new Criteria('imgcat_id', $catshow));
            $criteria->add(new Criteria('image_display', 1));
            $total = $image_handler->getCount($criteria);
            if ($total > 0) {
                $imgcat_handler =& xoops_gethandler('imagecategory');
                $imgcat =& $imgcat_handler->get($catshow);
                $xoopsTpl->assign('image_total', $total);
                $xoopsTpl->assign('lang_image', _IMAGE);
                $xoopsTpl->assign('lang_imagename', _IMAGENAME);
                $xoopsTpl->assign('lang_imagemime', _IMAGEMIME);
                $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
                $criteria->setLimit(10);
                $criteria->setStart($start);
                $storetype = $imgcat->getVar('imgcat_storetype');
                if ($storetype == 'db') {
                    $criteria->setSort('i.image_weight ASC, i.image_id');
                    $criteria->setOrder('DESC');
                    $images = $image_handler->getObjects($criteria, false, true);
                } else {
                    $criteria->setSort('image_weight ASC, image_id');
                    $criteria->setOrder('DESC');
                    $images = $image_handler->getObjects($criteria, false, false);
                }
                $imgcount = count($images);
                $max = ($imgcount > 10) ? 10 : $imgcount;

                for ($i = 0; $i < $max; $i++) {
                    if ($storetype == 'db') {
                        $lcode = '[img align=left id=' . $images[$i]->getVar('image_id') . ']' . $images[$i]->getVar('image_nicename') . '[/img]';
                        $code  = '[img align=center id=' . $images[$i]->getVar('image_id') . ']' . $images[$i]->getVar('image_nicename') . '[/img]';
                        $rcode = '[img align=right id=' . $images[$i]->getVar('image_id') . ']' . $images[$i]->getVar('image_nicename') . '[/img]';
                        $src   = XOOPS_URL . "/image.php?id=" . $images[$i]->getVar('image_id');
                    } else {
                        $lcode = '[img align=left]' . XOOPS_UPLOAD_URL . '/' . $images[$i]->getVar('image_name') . '[/img]';
                        $code  = '[img align=center]' . XOOPS_UPLOAD_URL . '/' . $images[$i]->getVar('image_name') . '[/img]';
                        $rcode = '[img align=right]' . XOOPS_UPLOAD_URL . '/' . $images[$i]->getVar('image_name') . '[/img]';
                        $src   = XOOPS_UPLOAD_URL . '/' . $images[$i]->getVar('image_name');
                    }
                    $xoopsTpl->append('images', array('id' => $images[$i]->getVar('image_id'), 'nicename' => $images[$i]->getVar('image_nicename'), 'mimetype' => $images[$i]->getVar('image_mimetype'), 'src' => $src, 'lxcode' => $lcode, 'xcode' => $code, 'rxcode' => $rcode));
                }
                if ($total > 10) {
                    include_once $GLOBALS['xoops']->path('class/pagenav.php');
                    $nav = new XoopsPageNav($total, 10, $start, 'start', 'target='.$target.'&amp;cat_id='.$catshow);
                    $xoopsTpl->assign('pagenav', $nav->renderNav());
                }
            } else {
                $xoopsTpl->assign('image_total', 0);
            }
        }
        $xoopsTpl->assign('xsize', 800);
        $xoopsTpl->assign('ysize', 600);
    } else {
        $xoopsTpl->assign('xsize', 800);
        $xoopsTpl->assign('ysize', 600);
    }
    $xoopsTpl->display('db:ajaxfm_imagemanager.html');
    exit();
}

if ($op == 'upload') {
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
    $xoopsTpl->assign('target', $target);
    $xoopsTpl->assign('editor', $editor);
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
    $form->addElement(new XoopsFormHidden('editor', $editor));
    $form->addElement(new XoopsFormButton('', 'img_button', _SUBMIT, 'submit'));
    $form->assign($xoopsTpl);
    $xoopsTpl->assign('lang_close', _CLOSE);
    $xoopsTpl->display('db:ajaxfm_imagemanager2.html');
    exit();
}

if ($op == 'doupload') {
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

?>