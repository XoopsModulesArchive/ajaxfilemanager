<?php
// $Id: modinfo.php 2411 2008-11-14 21:01:07Z julionc $
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

// Module Info

// The name of this module
define('_AJAXFM_MI_NAME', 'AjaxFileManager');

// A brief description of this module
define('_AJAXFM_MI_DESC', 'For administration of files/contents/images of the site.');

// Names of admin menu items
define('_AJAXFM_MI_ADMENU_INDEX', 'Index');
define('_AJAXFM_MI_ADMENU_FILEMANAGER', 'File Manager');
define('_AJAXFM_MI_ADMENU_FTP', 'Ftp client');
define('_AJAXFM_MI_ADMENU_PERMISSIONS', 'Permissions Manager');
define('_AJAXFM_MI_ADMENU_EXTENSIONS', 'Extensions Manager');
define('_AJAXFM_MI_ADMENU_ABOUT', 'About');

// for config
define('_AJAXFM_MI_VALIDEXTS', 'Upload valid extensions');
define('_AJAXFM_MI_VALIDEXTS_DESC', 'extensions separated by comma (,)<br />For exemple: &quot;gif,jpg,png&quot;');
define('_AJAXFM_MI_MAXSIZE', 'Max upload size');
define('_AJAXFM_MI_MAXSIZE_MB', 'MBytes');
define('_AJAXFM_MI_MAXSIZE_DESC', 'KBytes (1000 = 1MB)');
define('_AJAXFM_MI_TEXTEDITOR', 'Text editor');
define('_AJAXFM_MI_TEXTEDITOR_DESC', 'Choose text editor<br />Only these editors are properly supported: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea');

// for install/uninstall/update
define('_AJAXFM_MI_WARNING_DIRNOTCREATED', '<strong><span style="color:red;">WARNING: %s directory not created!</span></strong><br />');
?>