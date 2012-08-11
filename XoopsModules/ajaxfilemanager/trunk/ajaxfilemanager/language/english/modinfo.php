<?php
// $Id$
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

// Module Info

// The name of this module
define('_MI_AJAXFM_NAME','AjaxFileManager');

// A brief description of this module
define('_MI_AJAXFM_DESC','For administration of files/contents/images of the site.');

// Names of admin menu items
define('_MI_AJAXFM_ADMENU_INDEX','Index');
define('_MI_AJAXFM_ADMENU_INDEX_DESC','Index');
define('_MI_AJAXFM_ADMENU_FILEMANAGER','File Manager');
define('_MI_AJAXFM_ADMENU_FILEMANAGER_DESC','File Manager');
define('_MI_AJAXFM_ADMENU_FTP','Ftp client');
define('_MI_AJAXFM_ADMENU_FTP_DESC','Ftp client');
define('_MI_AJAXFM_ADMENU_PERMISSIONS','Permissions Manager');
define('_MI_AJAXFM_ADMENU_PERMISSIONS_DESC','Permissions Manager');
define('_MI_AJAXFM_ADMENU_EXTENSIONS','Extensions &amp; plugins Manager');
define('_MI_AJAXFM_ADMENU_EXTENSIONS_DESC','Extensions &amp; plugins Manager');
define('_MI_AJAXFM_ADMENU_ABOUT','About');
define('_MI_AJAXFM_ADMENU_ABOUT_DESC','About');
define('_MI_AJAXFM_ADMENU_HELP','Help');
define('_MI_AJAXFM_ADMENU_HELP_DESC','Help');

// for config
define('_MI_AJAXFM_VALIDEXTS','Upload valid extensions');
define('_MI_AJAXFM_VALIDEXTS_DESC','extensions separated by comma (,)<br />For exemple: gif,jpg,png');
define('_MI_AJAXFM_MAXSIZE','Max upload size');
define('_MI_AJAXFM_MAXSIZE_MB','MBytes');
define('_MI_AJAXFM_MAXSIZE_KB','kBytes');
define('_MI_AJAXFM_MAXSIZE_DESC','KBytes (1000kB = 1MB)');
define('_MI_AJAXFM_DEFAULTPAGINATIONLIMIT','Default items per page');
define('_MI_AJAXFM_DEFAULTPAGINATIONLIMIT_DESC','');
define('_MI_AJAXFM_VIEW','Navigation mode');
define('_MI_AJAXFM_VIEW1','Details');
define('_MI_AJAXFM_VIEW2','Thumbnails');
define('_MI_AJAXFM_VIEW_DESC','Selectables modes:<ul><li><b>Details</b> Detailed files list; </li><li><b>Thumbnails</b> Small Thumbnails with images preview. </li></ul>');
define('_MI_AJAXFM_TEXTEDITOR','Text editor');
define('_MI_AJAXFM_TEXTEDITOR_DESC','Choose text editor<br />Only these editors are properly supported: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea');
define('_MI_AJAXFM_NAVIGATIONMODE','Navigation mode');
define('_MI_AJAXFM_NAVIGATIONMODE1','Secure');
define('_MI_AJAXFM_NAVIGATIONMODE2','Dangerous');
define('_MI_AJAXFM_NAVIGATIONMODE3','<span style="color:red">Kamikaze</span>');
define('_MI_AJAXFM_NAVIGATIONMODE4','<span style="color:red">Themes Directory</span>');
define('_MI_AJAXFM_NAVIGATIONMODE_DESC','Selectables modes:<ul><li><b>Secure</b> You can surf only Ajax File Manager upload directory; </li><li><b>Dangerous</b> You can surf all modules upload directories, YOU COULD DESTROY MODULE UPLOADS; </li><li><b style="color:red;">Themes Directory</b> You can surf only themes directories, YOU COULD DESTROY THEMES AND KILL YOUR SITE; </li><li><b style="color:red;">Kamikaze</b> You can surf all Xoops site, YOU COULD DESTROY EVERYTHING AND KILL YOUR SITE. </li></ul>');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER','[Extra] Xoops image manager');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER1','Default');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER2','Enhanced');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER3','Ajax File Manager');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER_DESC','Choose image manager for Xoops<br />Choose between: default, enhanced, ajaxfilemanager.');
// added v1.0 - 2012/07/30
define('_MI_AJAXFM_BREAK_FILEMANAGER','<b>Ajax File Manager options</b>');
define('_MI_AJAXFM_BREAK_IMAGEMANAGER','<b>Xoops Image manager options</b>');

// for install/uninstall/update
define('_MI_AJAXFM_WARNING_DIRNOTCREATED','<strong><span style="color:red;">WARNING: %s directory not created!</span></strong><br />');
?>