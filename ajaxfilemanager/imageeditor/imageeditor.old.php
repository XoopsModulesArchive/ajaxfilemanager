<?php
include 'admin_header.php';
$current_file = basename(__FILE__);



// EDIT AN IMAGE -----------------------------------------------------------------------------------
// paths for image editor... DO NOT CHANGE
$originalDirectory = NFM_UPLOADS_PATH . '/imageeditor/original/';
$activeDirectory = NFM_UPLOADS_PATH . '/imageeditor/active/';
$activeUrl = XOOPS_URL . '/uploads/newfilemanager/imageeditor/active/';
$editDirectory = NFM_UPLOADS_PATH . '/imageeditor/edit/';
$undoDirectory = NFM_UPLOADS_PATH . '/imageeditor/undo/';

switch ( $op ) {
    case 'image.edit' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $image =& $file_handler->get($file_id);
        if (!is_object($image)) {
            redirect_header($current_file, 1);
        }

        // load category object
        $file_category_id = $image->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {
            redirect_header($current_file, 1);
        }

        garbage_collection($originalDirectory);
        garbage_collection($activeDirectory);
        garbage_collection($editDirectory);
        garbage_collection($undoDirectory);

        // check if image stored in db/as file
        $storetype = $filecategory->getVar('file_category_storetype');

        $image_src = '' . XOOPS_URL . '/modules/newfilemanager/image.php?id=' . $file_id . '&amp;nocache';
        $image_path = '' . XOOPS_ROOT_PATH . '/modules/newfilemanager/image.php?id=' . $file_id . '&amp;nocache';
        $image_type = $image->getVar('file_mimetype');
        $file_name =  $image->getVar('file_name');
        $session_file_name = session_id() . '_' . $file_name;
        // copy file from xoops database to imageedit directory
        $temp_image =& imagecreatefromstring($image->getVar('file_body'));
        if ($temp_image != false) {
            switch ($image_type) {
                case 'image/gif':
                    $outputFunction     = 'imagegif';
                    break;
                case 'image/x-png':
                case 'image/png':
                    $outputFunction     = 'imagepng';
                    break;
                default:
                    $outputFunction     = 'imagejpeg';
                    break;
            }
            if (!$outputFunction($temp_image, $originalDirectory . $session_file_name)) {
                $errors[] = 'An error occurred.'; // DEBUG
            }
            if (!copy ($originalDirectory . $session_file_name, $activeDirectory . $session_file_name)
                || !copy ($originalDirectory . $session_file_name, $editDirectory . $session_file_name)
                || !copy ($originalDirectory . $session_file_name, $undoDirectory . $session_file_name)) {
                $errors[] = 'An error occurred.'; // DEBUG
            }
            //imagedestroy($temp_image);
        }
        else {
            $errors[] = 'An error occurred.'; // DEBUG
        }

        // Define Stylesheet
        $xoTheme->addStylesheet( XOOPS_URL . '/modules/newfilemanager/libraries/imageeditor/ImageEditor.css' );
        // Define scripts
        $xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
        $xoTheme->addScript('browse.php?modules/newfilemanager/libraries/imageeditor/PageInfo.js');
        $xoTheme->addScript('browse.php?modules/newfilemanager/libraries/imageeditor/ImageEditor.js');
        $xoTheme->addScript('', '', 'xoopsOnloadEvent(function(){ImageEditor.init("'.$session_file_name.'", "image");})');

        // generate breadcrumb
        $paths = newfilemanager_breadcrumb($file_category_id);
        $breadcrumb = '<a href="' . $current_file . '">' . _NFM_AM_IMGMAIN . '</a>';
        $breadcrumb.= _BC_SEPARATOR;
        foreach($paths as $path) {
            $breadcrumb.= '<a href="' . $current_file . '?op=category.list&amp;file_category_id=' . $path['id'] . '">' . $path['name'] . '</a>';
            $breadcrumb.= _BC_SEPARATOR;
        }
        $breadcrumb.= $image->getVar('file_nicename', 'E');

        $output= $breadcrumb;
        $output.= '<br /><br />';

        $output.= '<div id="image-editor">';
        $output.= '<div class="toolbar">';
        $output.= '<button onclick="ImageEditor.viewOriginal()">' . _IMAGEEDITOR_VIEW_ORIGINAL . '</button>';
        $output.= '<button onclick="ImageEditor.viewActive()">' . _IMAGEEDITOR_VIEW_ACTIVE . '</button>';
        $output.= '<button onclick="ImageEditor.save()">' . _IMAGEEDITOR_SAVE_AS_ACTIVE . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.undo()">' . _IMAGEEDITOR_UNDOREDO . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="location.href=\'' . $current_file . '?op=image.edit_update&file_id=' . $file_id . '\'">' . _IMAGEEDITOR_SAVE_ACTIVE . '</button>';
        $output.= '<button onclick="location.href=\'' . $current_file . '?op=image.edit_save_as_form&file_id=' . $file_id . '\'">' . _IMAGEEDITOR_SAVE_EDITED_AS . '</button>';
        $output.= '</div>';

        $output.= '<div class="toolbar">';
        $output.= '' . _IMAGEEDITOR_W . '<input id="txt-width" type="text" size="3" maxlength="4" />';
        $output.= '' . _IMAGEEDITOR_H . '<input id="txt-height" type="text" size="3" maxlength="4" />';
        $output.= '<input id="chk-constrain" type="checkbox" checked="checked" />' . _IMAGEEDITOR_CONSTRAIN . '';
        $output.= '<button onclick="ImageEditor.resize();">' . _IMAGEEDITOR_RESIZE . '</button>';
        $output.= '<button onclick="ImageEditor.crop()">' . _IMAGEEDITOR_CROP . '</button>';
        $output.= '<span id="crop-size"></span>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.mirror()">' . _IMAGEEDITOR_MIRROR . '</button>';
        $output.= '<button onclick="ImageEditor.flip()">' . _IMAGEEDITOR_FLIP . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.rotate(90)">' . _IMAGEEDITOR_ROTATE_90CCW . '</button>';
        $output.= '<button onclick="ImageEditor.rotate(270)">' . _IMAGEEDITOR_ROTATE_90CW . '</button>';
        $output.= '<button onclick="ImageEditor.rotate(document.getElementById(\'txt-deg\').value)">' . _IMAGEEDITOR_ROTATE_1 . '</button>&nbsp;<input id="txt-deg" type="text" size="3" maxlength="4" />' . _IMAGEEDITOR_ROTATE_2 . '';
        $output.= '</div>';

        $output.= '<div class="toolbar">';
        $output.= '<button onclick="ImageEditor.grayscale()">' . _IMAGEEDITOR_GRAYSCALE . '</button>';
        $output.= '<button onclick="ImageEditor.sepia()">' . _IMAGEEDITOR_SEPIA . '</button>';
        $output.= '<button onclick="ImageEditor.pencil()">' . _IMAGEEDITOR_PENCIL . '</button>';
        $output.= '<button onclick="ImageEditor.emboss()">' . _IMAGEEDITOR_EMBOSS . '</button>';
        $output.= '<button onclick="ImageEditor.sblur()">' . _IMAGEEDITOR_BLUR . '</button>';
        $output.= '<button onclick="ImageEditor.smooth()">' . _IMAGEEDITOR_SMOOTH . '</button>';
        $output.= '<button onclick="ImageEditor.invert()">' . _IMAGEEDITOR_INVERT . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.brightnessdec()">' . _IMAGEEDITOR_MINUS . '</button>';
        $output.= _IMAGEEDITOR_BRIGHTNESS;
        $output.= '<button onclick="ImageEditor.brightnessinc()">' . _IMAGEEDITOR_PLUS . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.contrastinc()">' . _IMAGEEDITOR_MINUS . '</button>';
        $output.= _IMAGEEDITOR_CONTRAST;
        $output.= '<button onclick="ImageEditor.contrastdec()">' . _IMAGEEDITOR_PLUS . '</button>';
        $output.= '<span class="spacer">' . _IMAGEEDITOR_SPACER . '</span>';
        $output.= '<button onclick="ImageEditor.colorize(document.getElementById(\'txt_red\').value, document.getElementById(\'txt_green\').value, document.getElementById(\'txt_blue\').value)">' . _IMAGEEDITOR_COLORIZE . '</button>';
        $output.= '&nbsp;' . _IMAGEEDITOR_RED . '<input id="txt_red" type="text" size="3" maxlength="4" />';
        $output.= '&nbsp;' . _IMAGEEDITOR_GREEN . '<input id="txt_green" type="text" size="3" maxlength="4" />';
        $output.= '&nbsp;' . _IMAGEEDITOR_BLUE . '<input id="txt_blue" type="text" size="3" maxlength="4" />';
        $output.= '</div>';

        $output.= '<div id="image"></div>';
        $output.= '</div>';
        echo $output;
        break;

    case 'image.edit_update' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}


        xoops_confirm(array('op' => 'image.edit_update_ok', 'file_id' => $file_id), $current_file, _NFM_AM_RUOVERWRITEIMG);

        break;

    case 'image.edit_update_ok' :
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($current_file, 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $image =& $file_handler->get($file_id);
        if (!is_object($image)) {redirect_header($current_file, 1);}
        // load category object
        $file_category_id = $image->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {redirect_header($current_file, 1);}

        $image->setVar('file_created', time());
        $image_type = $image->getVar('file_mimetype');
        $file_name =  $image->getVar('file_name');
        $session_file_name = session_id() . '_' . $file_name;

        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        $fbinary = @file_get_contents($activeDirectory . $session_file_name);
        $image->setVar('file_body', $fbinary, true);
        $image->setVar('file_created', time());
        @unlink($activeDirectory . $session_file_name);
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        if (!$file_handler->insert($image)) {
            $errors[] = sprintf(_FAILSAVEIMG, $image->getVar('file_nicename'));
        }
        garbage_collection($originalDirectory, '', $file_name);
        garbage_collection($activeDirectory, '', $file_name);
        garbage_collection($editDirectory, '', $file_name);
        garbage_collection($undoDirectory, '', $file_name);
        redirect_header($current_file . "?op=category.list&amp;file_category_id=" . $file_category_id, 2, _NFM_AM_DBUPDATED);
        break;

    case 'image.edit_save_as_form' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $image =& $file_handler->get($file_id);
        if (!is_object($image)) {redirect_header($current_file, 1);}
        // load category object
        $file_category_id = $image->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {redirect_header($current_file, 1);}

        //image is stored as file in directory editor/active as session_id() . '_' . $file_name
        $file_name =  $image->getVar('file_name');
        $session_file_name = session_id() . '_' . $file_name;

        $image_src = $activeUrl . $session_file_name;
        $image_path = $activeDirectory . $session_file_name;
        $imagefile_size = filesize($activeDirectory . $session_file_name);

        // set right image width - start
        $max_image_width = 150;
        $file_size = getimagesize($image_src);
        $image_width = ($file_size[0] > $max_image_width) ? $max_image_width : $file_size[0];
        // set right image width - end

        $output.= '<a href="' . $current_file . '">' . _NFM_AM_IMGMAIN . '</a>';
        $output.= '&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;';
        $output.= '<a href="' . $current_file . '?op=category.list&amp;file_category_id='.$file_category_id.'">' . $filecategory->getVar('file_category_name') . '</a>';
        $output.= '&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;';
        $output.= $image->getVar('file_nicename', 'E');
        $output.= '<br /><br />';
        $form = new XoopsThemeForm(_NFM_AM_ASNEWIMAGE, 'image_form', $current_file, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_NFM_AM_FILENAME, 'file_nicename', 50, 255, sprintf(_IMAGEEDITOR_OF, $image->getVar('file_nicename'))), true);
        $form->addElement(new XoopsFormText(_NFM_AM_IMAGEALTERNATIVE, 'file_alternative', 50, 255, $image->getVar('file_alternative')), true);
            $file_descriptionTextArea = new XoopsFormTextArea(_NFM_AM_FILEDESCRIPTION, 'file_description', $image->getVar('file_description'), 5, 100);
            $file_descriptionTextArea->setDescription (_NFM_AM_FILEDESCRIPTION);
        $form->addElement($file_descriptionTextArea);
        $select = new XoopsFormSelect(_NFM_AM_FILECATEGORY, 'file_category_id', $image->getVar('file_category_id'));
        $select->addOptionArray($filecategory_handler->getList($groups, 'newfilemanager_cat_write'));
        $form->addElement($select, true);
        //$form->addElement(new XoopsFormFile(_NFM_AM_FILEFILE, 'image_file', 5000000));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEID, $image->getVar('file_id'), 'file_id'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEDATE, gmdate(_NFM_AM_DATESTRING, $image->getVar('file_created')), 'file_created'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEMIME, $image->getVar('file_mimetype'), 'file_mimetype'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_IMAGESIZE, sprintf(_NFM_AM_IMAGESIZE_CONTENT, $file_size[0], $file_size[1], $imagefile_size), 'file_mimetype'));
            $image_html = '<img style="width:' . $image_width . 'px;height:auto;"';
            $image_html.= ' id="imageid' . $image->getVar('file_id') . '"';
            $image_html.= ' src="' . $image_src . '"';
            $image_html.= ' alt="' . $image->getVar('file_alternative', 'E') . '"';
            $image_html.= ' title="' . $image->getVar('file_nicename', 'E') . '"';
            $image_html.= ' onclick="javascript:alert(\'ZOOM IN PROGRESS\');"'; // IN PROGRESS
            $image_html.= ' />';
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEFILE, $image_html, 'image_file'));
        $form->addElement(new XoopsFormText(_NFM_AM_FILEWEIGHT, 'file_weight', 3, 4, $image->getVar('file_weight')));
        $form->addElement(new XoopsFormRadioYN(_IMGDISPLAY, 'file_display', $image->getVar('file_display'), _YES, _NO));
        $form->addElement(new XoopsFormHidden('oldfile_id', $file_id));
        $form->addElement(new XoopsFormHidden('op', 'image.edit_save_as_ok'));
        $form->addElement(new XoopsFormHidden('fct', 'images'));
        $form->addElement(new XoopsFormButtonTray('img_button', _SUBMIT, 'submit', '', false));
        $output.= $form->render();
        echo $output;
        break;

    case 'image.edit_save_as_ok' :
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($current_file, 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // get/check parameters
        $oldfile_id = intval($oldfile_id);
        if ($oldfile_id <= 0) {redirect_header($current_file, 1);}
        $newfile_category_id = intval($file_category_id);
        if ($newfile_category_id <= 0) {redirect_header($current_file, 1);}

        // load old image object
        $oldimage =& $file_handler->get($oldfile_id);
        if (!is_object($oldimage)) {redirect_header($current_file, 1);}
        // load new category object
        $newimagecategory =& $filecategory_handler->get($newfile_category_id);
        if (!is_object($newimagecategory)) {redirect_header($current_file, 1);}

        // create new image
        $newimage =& $file_handler->create();

        // create a new name (filename) for new image
        $oldimagename = explode('.', $oldimage->getVar('file_name')); // FUNZIONA MA NON MI PIACE
        $newimagename = uniqid('img') . '.' . $oldimagename[1]; // FUNZIONA MA NON MI PIACE

        // set values of new image
        $newimage->setVar('file_name', $newimagename);
        $newimage->setVar('file_nicename', $file_nicename);
        $newimage->setVar('file_alternative', $file_alternative);
        $newimage->setVar('file_mimetype', $oldimage->getVar('file_mimetype'));
        $newimage->setVar('file_created', time());
        $newimage->setVar('file_display', (empty($file_display) ? 0 : 1));
        $newimage->setVar('file_weight', $file_weight);
        $newimage->setVar('file_category_id', $file_category_id);
        $newimage->setVar('file_description', $file_description); // IN PROGRESS

        // get binary image data from old image and store in $fbinary
        //image is stored as file in directory editor/active as session_id() . '_' . $file_name
        $session_file_name = session_id() . '_' . $oldimage->getVar('file_name');
        $fbinary = @file_get_contents($activeDirectory . $session_file_name);
        if (!$fbinary) {
            $errors[] = sprintf(_FAILGETOLDIMGDATA, $oldimage->getVar('file_nicename'));
            }
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // save binary image data in new image
        $newimage->setVar('file_body', $fbinary, true);

        // insert image in database
        if (!$file_handler->insert($newimage)) {
            $errors[] = sprintf(_FAILSAVEIMG, $newimage->getVar('file_nicename'));
        }
        if (count($errors) > 0) {
            // Call Header
            xoops_cp_header();
            xoops_error($errors);
            xoops_cp_footer();
            exit();
        }
        garbage_collection($originalDirectory, '', $session_file_name);
        garbage_collection($activeDirectory, '', $session_file_name);
        garbage_collection($editDirectory, '', $session_file_name);
        garbage_collection($undoDirectory, '', $session_file_name);
        redirect_header($current_file . "?op=category.list&amp;file_category_id=" . $file_category_id, 2, _NFM_AM_DBUPDATED); // IN PROGRESS
        break;
    } // switch ( $op )

// EDIT A TEXT -----------------------------------------------------------------------------------

switch ( $op ) {
    case 'text.edit' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $text =& $file_handler->get($file_id);
        if (!is_object($text)) {
            redirect_header($current_file, 1);
        }

        // load category object
        $file_category_id = $text->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {
            redirect_header($current_file, 1);
        }

        // check if image stored in db/as file
        $storetype = $filecategory->getVar('file_category_storetype');

        //$text_src = '' . XOOPS_URL . '/modules/newfilemanager/text.php?id=' . $file_id;
        //$text_path = '' . XOOPS_ROOT_PATH . '/modules/newfilemanager/text.php?id=' . $file_id;
        $text_type = $text->getVar('file_mimetype');
        $text_name =  $text->getVar('file_name');
        $text_value = $text->getVar('file_body');

        // generate breadcrumb
        $paths = newfilemanager_breadcrumb($file_category_id);
        $breadcrumb = '<a href="' . $current_file . '">' . _NFM_AM_IMGMAIN . '</a>';
        $breadcrumb.= _BC_SEPARATOR;
        foreach($paths as $path) {
            $breadcrumb.= '<a href="' . $current_file . '?op=category.list&amp;file_category_id=' . $path['id'] . '">' . $path['name'] . '</a>';
            $breadcrumb.= _BC_SEPARATOR;
        }
        $breadcrumb.= $text->getVar('file_nicename', 'E');

        echo $breadcrumb;
        echo '<br /><br />';


        echo "<div>\n";
        echo "<form op='" . $current_file . "' method='post'>\n";
        echo "<input type='hidden' name='id' value='" .$id. "'>\n";

        $text_value = str_replace("<", "&lt;", $text_value);

        if(preg_match('/\.sql$/i',$$text_type))      {$syntax = 'sql';}
        else if(preg_match('/\js$/i',$$text_type))   {$syntax = 'js';}
        else if(preg_match('/\html$/i',$text_type))  {$syntax = 'html';}
        else if(preg_match('/\htm$/i',$text_type))   {$syntax = 'html';}
        else if(preg_match('/\pl$/i',$text_type))    {$syntax = 'perl';}
        else if(preg_match('/\py$/i',$text_type))    {$syntax = 'python';}
        else if(preg_match('/\php$/i',$text_type))   {$syntax = 'php';}
        else if(preg_match('/\php3$/i',$text_type))  {$syntax = 'php';}
        else if(preg_match('/\phtml$/i',$text_type)) {$syntax = 'php';}
        else if(preg_match('/\xml$/i',$text_type))   {$syntax = 'xml';}
        else if(preg_match('/\css$/i',$text_type))   {$syntax = 'css';}
        else                            {$syntax = '';}

        xoops_load('XoopsFormEditor');
        $options['editor'] = $xoopsModuleConfig['text_editor'];
        $options['name'] = 'edited_code';
        $options['value'] = $text_value;
        // optional configs
        $options['rows'] = 25; // default value = 5
        $options['cols'] = 60; // default value = 50
        $options['width'] = '100%'; // default value = 100%
        $options['height'] = '400px'; // default value = 400px
        $options['syntax'] = $syntax; // for EditArea editor
        $editor = new XoopsFormEditor('edited_code', 'edited_code', $options, true, 'textarea');
        echo $editor->render();

        echo "<br \><br \>\n";
        echo "<input type='image' src='images/actions/save.png' alt='" . _FM_AM_SAVE . "' border='0'>\n";
        echo "<a href='" . $current_file . "?$file_id=" . $$file_id . "&rep='>";
        echo "<img src='images/actions/close.png' alt='" . _FM_AM_CLOSE . "' border='0'>";
        echo "</a>\n";
        echo "</form>\n";
        break;

    case 'text.edit_update' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}


        xoops_confirm(array('op' => 'text.edit_update_ok', 'file_id' => $file_id), $current_file, _NFM_AM_RUOVERWRITEIMG);

        break;

    case 'text.edit_update_ok' :
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($current_file, 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $text =& $file_handler->get($file_id);
        if (!is_object($image)) {redirect_header($current_file, 1);}
        // load category object
        $file_category_id = $text->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {redirect_header($current_file, 1);}

        $text->setVar('file_created', time());
        $text_type = $image->getVar('file_mimetype');
        $text_name =  $image->getVar('file_name');

        $text->setVar('file_body', $fbinary, true);
        $text->setVar('file_created', time());
        if (!$file_handler->insert($text)) {
            $errors[] = sprintf(_FAILSAVEIMG, $text->getVar('file_nicename'));
        }
        redirect_header($current_file . "?op=category.list&amp;file_category_id=" . $file_category_id, 2, _NFM_AM_DBUPDATED);
        break;

    case 'text.edit_save_as_form' :
        // get/check parameters
        $file_id = intval($file_id);
        if ($file_id <= 0) {redirect_header($current_file, 1);}

        // load image object
        $image =& $file_handler->get($file_id);
        if (!is_object($image)) {redirect_header($current_file, 1);}
        // load category object
        $file_category_id = $image->getVar('file_category_id');
        $filecategory =& $filecategory_handler->get($file_category_id);
        if (!is_object($filecategory)) {redirect_header($current_file, 1);}

        //image is stored as file in directory editor/active as session_id() . '_' . $file_name
        $file_name =  $image->getVar('file_name');
        $session_file_name = session_id() . '_' . $file_name;

        $image_src = $activeUrl . $session_file_name;
        $image_path = $activeDirectory . $session_file_name;
        $imagefile_size = filesize($activeDirectory . $session_file_name);

        // set right image width - start
        $max_image_width = 150;
        $file_size = getimagesize($image_src);
        $image_width = ($file_size[0] > $max_image_width) ? $max_image_width : $file_size[0];
        // set right image width - end

        $output.= '<a href="' . $current_file . '">' . _NFM_AM_IMGMAIN . '</a>';
        $output.= '&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;';
        $output.= '<a href="' . $current_file . '?op=category.list&amp;file_category_id='.$file_category_id.'">' . $filecategory->getVar('file_category_name') . '</a>';
        $output.= '&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;';
        $output.= $image->getVar('file_nicename', 'E');
        $output.= '<br /><br />';
        $form = new XoopsThemeForm(_NFM_AM_ASNEWIMAGE, 'image_form', $current_file, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_NFM_AM_FILENAME, 'file_nicename', 50, 255, sprintf(_IMAGEEDITOR_OF, $image->getVar('file_nicename'))), true);
        $form->addElement(new XoopsFormText(_NFM_AM_IMAGEALTERNATIVE, 'file_alternative', 50, 255, $image->getVar('file_alternative')), true);
            $file_descriptionTextArea = new XoopsFormTextArea(_NFM_AM_FILEDESCRIPTION, 'file_description', $image->getVar('file_description'), 5, 100);
            $file_descriptionTextArea->setDescription (_NFM_AM_FILEDESCRIPTION);
        $form->addElement($file_descriptionTextArea);
        $select = new XoopsFormSelect(_NFM_AM_FILECATEGORY, 'file_category_id', $image->getVar('file_category_id'));
        $select->addOptionArray($filecategory_handler->getList($groups, 'newfilemanager_cat_write'));
        $form->addElement($select, true);
        //$form->addElement(new XoopsFormFile(_NFM_AM_FILEFILE, 'image_file', 5000000));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEID, $image->getVar('file_id'), 'file_id'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEDATE, gmdate(_NFM_AM_DATESTRING, $image->getVar('file_created')), 'file_created'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEMIME, $image->getVar('file_mimetype'), 'file_mimetype'));
        $form->addElement(new XoopsFormLabel (_NFM_AM_IMAGESIZE, sprintf(_NFM_AM_IMAGESIZE_CONTENT, $file_size[0], $file_size[1], $imagefile_size), 'file_mimetype'));
            $image_html = '<img style="width:' . $image_width . 'px;height:auto;"';
            $image_html.= ' id="imageid' . $image->getVar('file_id') . '"';
            $image_html.= ' src="' . $image_src . '"';
            $image_html.= ' alt="' . $image->getVar('file_alternative', 'E') . '"';
            $image_html.= ' title="' . $image->getVar('file_nicename', 'E') . '"';
            $image_html.= ' onclick="javascript:alert(\'ZOOM IN PROGRESS\');"'; // IN PROGRESS
            $image_html.= ' />';
        $form->addElement(new XoopsFormLabel (_NFM_AM_FILEFILE, $image_html, 'image_file'));
        $form->addElement(new XoopsFormText(_NFM_AM_FILEWEIGHT, 'file_weight', 3, 4, $image->getVar('file_weight')));
        $form->addElement(new XoopsFormRadioYN(_IMGDISPLAY, 'file_display', $image->getVar('file_display'), _YES, _NO));
        $form->addElement(new XoopsFormHidden('oldfile_id', $file_id));
        $form->addElement(new XoopsFormHidden('op', 'image.edit_save_as_ok'));
        $form->addElement(new XoopsFormHidden('fct', 'images'));
        $form->addElement(new XoopsFormButtonTray('img_button', _SUBMIT, 'submit', '', false));
        $output.= $form->render();
        echo $output;
        break;

    case 'text.edit_save_as_ok' :
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($current_file, 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // get/check parameters
        $oldfile_id = intval($oldfile_id);
        if ($oldfile_id <= 0) {redirect_header($current_file, 1);}
        $newfile_category_id = intval($file_category_id);
        if ($newfile_category_id <= 0) {redirect_header($current_file, 1);}

        // load old image object
        $oldimage =& $file_handler->get($oldfile_id);
        if (!is_object($oldimage)) {redirect_header($current_file, 1);}
        // load new category object
        $newimagecategory =& $filecategory_handler->get($newfile_category_id);
        if (!is_object($newimagecategory)) {redirect_header($current_file, 1);}

        // create new image
        $newimage =& $file_handler->create();

        // create a new name (filename) for new image
        $oldimagename = explode('.', $oldimage->getVar('file_name')); // FUNZIONA MA NON MI PIACE
        $newimagename = uniqid('img') . '.' . $oldimagename[1]; // FUNZIONA MA NON MI PIACE

        // set values of new image
        $newimage->setVar('file_name', $newimagename);
        $newimage->setVar('file_nicename', $file_nicename);
        $newimage->setVar('file_alternative', $file_alternative);
        $newimage->setVar('file_mimetype', $oldimage->getVar('file_mimetype'));
        $newimage->setVar('file_created', time());
        $newimage->setVar('file_display', (empty($file_display) ? 0 : 1));
        $newimage->setVar('file_weight', $file_weight);
        $newimage->setVar('file_category_id', $file_category_id);
        $newimage->setVar('file_description', $file_description); // IN PROGRESS

        // get binary image data from old image and store in $fbinary
        //image is stored as file in directory editor/active as session_id() . '_' . $file_name
        $session_file_name = session_id() . '_' . $oldimage->getVar('file_name');
        $fbinary = @file_get_contents($activeDirectory . $session_file_name);
        if (!$fbinary) {
            $errors[] = sprintf(_FAILGETOLDIMGDATA, $oldimage->getVar('file_nicename'));
            }
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // IN PROGRESS
        // save binary image data in new image
        $newimage->setVar('file_body', $fbinary, true);

        // insert image in database
        if (!$file_handler->insert($newimage)) {
            $errors[] = sprintf(_FAILSAVEIMG, $newimage->getVar('file_nicename'));
        }
        if (count($errors) > 0) {
            // Call Header
            xoops_cp_header();
            xoops_error($errors);
            xoops_cp_footer();
            exit();
        }
        garbage_collection($originalDirectory, '', $session_file_name);
        garbage_collection($activeDirectory, '', $session_file_name);
        garbage_collection($editDirectory, '', $session_file_name);
        garbage_collection($undoDirectory, '', $session_file_name);
        redirect_header($current_file . "?op=category.list&amp;file_category_id=" . $file_category_id, 2, _NFM_AM_DBUPDATED); // IN PROGRESS
        break;
    } // switch ( $op )




?>
