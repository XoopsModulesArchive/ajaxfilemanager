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
 * @author          Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link            www.phpletter.com
 * @since           22/May/2007
 * @author          luciorota <lucio.rota@gmail.com>
 * @package         ajaxfilemanager
 * @since           0.1
 * @version         $Id: xoops_ajax_text_editor.php 6335 2011-03-09 21:27:37Z luciorota $
 */

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");
/**
 * Load Module config
 */
xoops_loadLanguage('main', 'ajaxfilemanager');
include_once XOOPS_ROOT_PATH . '/kernel/module.php';
$ajaxfilemanagerModule = XoopsModule::getByDirname('ajaxfilemanager');
if ($ajaxfilemanagerModule->getVar('hasconfig') == 1) {
    $config_handler =& xoops_gethandler('config');
    $ajaxfilemanagerModuleConfig = $config_handler->getConfigsByCat(0, $ajaxfilemanagerModule->getVar('mid'));
}

if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_EDITABLE) {
    die(SYS_DISABLED);
}

$session->gc();
$_GET['path'] = empty($_GET['path']) ? CONFIG_SYS_ROOT_PATH . "ajax_image_editor_demo.jpg" : $_GET['path'];
if(!empty($_GET['path']) && file_exists($_GET['path']) && is_file($_GET['path']) && isUnderRoot($_GET['path'])) {
    $path = $_GET['path'];
} else {
    die(TXT_FILE_NOT_FOUND);
}

$syntax = getFileExt($path);

switch (getFileExt($path)) {
case 'htm':
case 'html':
    $syntax = 'html';
    break;
case 'js':
    $syntax = 'js';
    break;
case 'kml':
case 'xml':
    $syntax = 'xml';
    break;
case 'php':
    $syntax = 'php';
    break;
default:
    break;
}

if(array_search(getFileExt($path), getValidTextEditorExts())=== false) {
    die(TXT_DISALLOWED_EXT);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Logan Cai" />
<meta name="website" content="http://www.phpletter.com" />
<!--<script type="text/javascript" src="jscripts/ajaxtexteditor_c.js"></script>-->

<script type="text/javascript" src="jscripts/jquery.js"></script>
<!--<script type="text/javascript" src="jscripts/form.js"></script>-->
<script type="text/javascript" src="jscripts/jquery.form.js"></script>
<script type="text/javascript" src="jscripts/select.js"></script>
<script type="text/javascript" src="jscripts/jqModal.js"></script>

<script type="text/javascript" src="jscripts/ajaxtexteditor.js"></script>

<script type="text/javascript">
    var warningExtNotSelected = '<?php echo TXT_EXT_NOT_SELECTED; ?>';
    var urlGetFolderList = '<?php echo appendQueryString(CONFIG_URL_GET_FOLDER_LIST, makeQueryString(array('path'))); ?>';
    var warningInvalidName = '<?php echo TXT_SAVE_AS_ERR_NAME_INVALID; ?>';
    var waringFolderNotSelected = '<?php echo TXT_DEST_FOLDER_NOT_SELECTED; ?>';
    var currentFolder = '<?php echo dirname($path); ?>';
    var currentName = '<?php echo basename($path); ?>';

    jQuery(document).ready(
    function() {
        jQuery('#windowSaveAs').jqm();
        jQuery('#windowProcessing').jqm({modal:true});
    }
);
</script>

<link href="theme/<?php echo CONFIG_THEME_NAME; ?>/css/ajaxtexteditor.css" type="text/css" rel="stylesheet" />
<link href="theme/<?php echo CONFIG_THEME_NAME; ?>/css/jqModal.css" type="text/css" rel="stylesheet" />
<title>Xoops Ajax Text Editor</title>
</head>
<body onunload="if(window.opener) window.opener.location.reload()">
<?php
xoops_load('XoopsCache');
XoopsCache::delete('editorlist');
include_once $GLOBALS['xoops']->path( '/class/xoopsformloader.php' );
$form = new XoopsSimpleForm('', 'form', appendQueryString(CONFIG_URL_SAVE_TEXT, makeQueryString(array('path'))), 'post', true);
//description
$editorConfigs=array();
$editorConfigs["name"] ="content";
$editorConfigs["value"] = getFileContent($path);
$editorConfigs["rows"] = 20;
$editorConfigs["cols"] = 100;
$editorConfigs["width"] = "100%";
$editorConfigs["height"] = "400px";
$editorConfigs["syntax"] = $syntax;
$editorConfigs["noHtml"] = false;
$editorConfigs["editor"] = $ajaxfilemanagerModuleConfig['text_editor'];
$editor = new XoopsFormEditor('', "content", $editorConfigs);
$form->addElement($editor, true);

if ((method_exists($editor, 'renderGetValueJS')) and ($editor->renderGetValueJS() != '')) {
    $getValueJS = $editor->renderGetValueJS();
} else {
    // MAMBA wrote: "use a patch", and so... here you are "the patch" ;-)
    // $getValueJS = $editor->renderGetValueJS();
    switch ($editorConfigs["editor"]) {
    case 'editarea' :
        $getValueJS = "editAreaLoader.getValue(&quot;" . $editorConfigs["name"] ."&quot;)";
        break;
    case 'codemirror' :
        $getValueJS = "editor_" . $editorConfigs["name"] .".mirror.getCode()";
        break;
    case 'codemirror2' :
        $getValueJS = "codemirror2_editor[&quot;" . $editorConfigs["name"] . "&quot;].mirror.getValue()";
        break;
    case 'tinymce' :
        $getValueJS = "tinyMCE.get(&quot;" . $editorConfigs["name"] ."&quot;).getContent()";
        break;
    case 'ckeditor' :
        $getValueJS = "CKEDITOR.instances." . $editorConfigs["name"] .".getData()";
        break;
    case 'dhtmltextarea' :
    case 'textarea' :
    default :
        $getValueJS = "document.getElementById(\"" . $editorConfigs["name"] ."\").value"; // DEBUG
        //$getValueJS = "$(\"#" . $editorConfigs["name"] ."\").val()"; // jQuery // DEBUG
        }
    // MAMBA wrote: "use a patch", and so... here you are "the patch" ;-)
}

$buttonSave = new XoopsFormButton ('', '_save', 'Save', 'button');
$buttonSave->setExtra("onclick='javascript:save(\"" . $editorConfigs["name"] . "\", " . $getValueJS .");'");
$buttonSaveAs = new XoopsFormButton ('', '_save_as', 'Save as', 'button');
$buttonSaveAs->setExtra("onclick='javascript:save_as(\"" . $editorConfigs["name"] . "\", " . $getValueJS .");'");
$buttonCancel = new XoopsFormButton ('', '_cancel', 'Cancel', 'button');
$buttonCancel->setExtra("onclick='javascript:window.close();'");
$elementTray = new XoopsFormElementTray ('', "&nbsp;", '');
$elementTray->addElement($buttonSave, true);
$elementTray->addElement($buttonSaveAs);
$elementTray->addElement($buttonCancel);
$form->addElement($elementTray);
$form->display();
?>
<div id="windowProcessing" class="jqmWindow" style="display:none">
    <form name="frmProcessing" id="frmProcessing" method="POST" action="<?php echo appendQueryString(CONFIG_URL_SAVE_TEXT, makeQueryString(array('path')));?>">
        <input type="hidden" name="folder" id="folder" value="<?php echo dirname($path); ?>" />
        <input type="hidden" name="name" id="name" value="<?php echo basename($path); ?>" />
        <input type="hidden" name="save_as_request" id="save_as_request" value="0" />
        <div style="display:none"><textarea name="text" id="text"></textarea></div>
    </form>
    <a href="#" class="jqmClose" id="windowSaveClose"><?php echo IMG_BTN_CANCEL; ?></a>
    <p><img src="theme/<?php echo CONFIG_THEME_NAME; ?>/images/loading.gif" /></p>
</div>

<div id="windowSaveAs" class="jqmWindow" style="display:none">
    <a href="#" class="jqmClose" id="windowSaveClose"><?php echo IMG_BTN_CANCEL; ?></a>
    <form id="formSaveAs" name="formSaveAs" action="" method="post">
    <table class="tableForm" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th colspan="2"><?php echo IMG_LBL_SAVE_AS; ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><label><?php echo IMG_LBL_NEW_NAME; ?></label></th>
            <td>
            <input type="text" id="new_name" class="input" name="new_name" value="" />
            &nbsp;.&nbsp;
            <select id="ext" name="ext">
<?php
foreach(getValidTextEditorExts() as $v) {
    echo "<option value='" . $v . "' " . (strtolower($v) == strtolower(getFileExt($path))?'selected':'') . ">" . $v . "</option>";
}
?>
            </select>
            </td>
        </tr>
        <tr>
            <th><label><?php echo IMG_LBL_SAVE_TO; ?></label></th>
            <td><select class="input" name="save_to" id="save_to"></select></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><span class="comments">*</span><?php echo IMG_NEW_NAME_COMMENTS; ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>&nbsp;</th>
            <td><input type="button" class="button" value="<?php echo IMG_BTN_SAVE_AS; ?>" onclick="return do_save_as();" /></td>
        </tr>
    </tfoot>
    </table>
    </form>
</div>
</body>
</html>