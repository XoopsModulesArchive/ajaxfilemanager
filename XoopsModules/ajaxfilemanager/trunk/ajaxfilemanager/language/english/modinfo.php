<?php
// $Id$
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
define('_AJAXFM_MI_NAVIGATIONMODE', 'Navigation mode');
define('_AJAXFM_MI_NAVIGATIONMODE1', 'Secure');
define('_AJAXFM_MI_NAVIGATIONMODE2', 'Dangerous');
define('_AJAXFM_MI_NAVIGATIONMODE3', '<span style="color:red">Kamikaze</span>');
define('_AJAXFM_MI_NAVIGATIONMODE_DESC', 'Selectables modes:<ul><li><b>Secure</b> You can surf only Ajax File Manager upload directory</li><li><b>Dangerous</b> You can surf all modules upload directories, YOU COULD DESTROY MODULE UPLOADS</li><li><b style="color:red;">Kamikaze</b> You can surf all Xoops site, YOU COULD DESTROY EVERYTHING AND KILL YOUR SITE</li>');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER', '[Extra] Xoops image manager');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER1', 'Default');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER2', 'Enhanced');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER3', 'Ajax File Manager');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER_DESC', 'Choose image manager for Xoops<br />Choose between: default, enhanced, ajaxfilemanager');



// for install/uninstall/update
define('_AJAXFM_MI_WARNING_DIRNOTCREATED', '<strong><span style="color:red;">WARNING: %s directory not created!</span></strong><br />');
?>