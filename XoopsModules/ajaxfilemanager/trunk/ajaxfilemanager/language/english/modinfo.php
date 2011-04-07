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
define('_AJAXFM_MI_VALIDEXTS_DESC', 'extensions separated by comma (,)<br />For exemple: gif,jpg,png');
define('_AJAXFM_MI_MAXSIZE', 'Max upload size');
define('_AJAXFM_MI_MAXSIZE_MB', 'MBytes');
define('_AJAXFM_MI_MAXSIZE_DESC', 'KBytes (1000 = 1MB)');
define('_AJAXFM_MI_DEFAULTPAGINATIONLIMIT', 'Default items per page');
define('_AJAXFM_MI_DEFAULTPAGINATIONLIMIT_DESC', '');
define('_AJAXFM_MI_VIEW', 'Navigation mode');
define('_AJAXFM_MI_VIEW1', 'Details');
define('_AJAXFM_MI_VIEW2', 'Thumbnails');
define('_AJAXFM_MI_VIEW_DESC', 'Selectables modes:<ul><li><b>Details</b> Detailed files list; </li><li><b>Thumbnails</b> Small Thumbnails with images preview. </li></ul>');
define('_AJAXFM_MI_TEXTEDITOR', 'Text editor');
define('_AJAXFM_MI_TEXTEDITOR_DESC', 'Choose text editor<br />Only these editors are properly supported: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea');
define('_AJAXFM_MI_NAVIGATIONMODE', 'Navigation mode');
define('_AJAXFM_MI_NAVIGATIONMODE1', 'Secure');
define('_AJAXFM_MI_NAVIGATIONMODE2', 'Dangerous');
define('_AJAXFM_MI_NAVIGATIONMODE3', '<span style="color:red">Kamikaze</span>');
define('_AJAXFM_MI_NAVIGATIONMODE4', '<span style="color:red">Themes Directory</span>');
define('_AJAXFM_MI_NAVIGATIONMODE_DESC', 'Selectables modes:<ul><li><b>Secure</b> You can surf only Ajax File Manager upload directory; </li><li><b>Dangerous</b> You can surf all modules upload directories, YOU COULD DESTROY MODULE UPLOADS; </li><li><b style="color:red;">Themes Directory</b> You can surf only themes directories, YOU COULD DESTROY THEMES AND KILL YOUR SITE; </li><li><b style="color:red;">Kamikaze</b> You can surf all Xoops site, YOU COULD DESTROY EVERYTHING AND KILL YOUR SITE. </li></ul>');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER', '[Extra] Xoops image manager');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER1', 'Default');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER2', 'Enhanced');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER3', 'Ajax File Manager');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER_DESC', 'Choose image manager for Xoops<br />Choose between: default, enhanced, ajaxfilemanager.');

define('_AJAXFM_MI_FTPENABLED', '[ftp] Enable FTP mode');
define('_AJAXFM_MI_FTPENABLED_DESC', 'If set to Yes is possible to execute ftp operations, like ftp upload, ...');
define('_AJAXFM_MI_FTPSERVERHOST', '[ftp] FTP server address');
define('_AJAXFM_MI_FTPSERVERHOST_DESC', "This parameter shouldn't have any trailing slashes and shouldn't be prefixed with ftp://");
define('_AJAXFM_MI_FTPSERVERPORT', '[ftp] FTP server port');
define('_AJAXFM_MI_FTPSERVERPORT_DESC', "This parameter specifies an alternate port to connect to. If it is omitted or set to zero, then the default FTP port, 21, will be use.");
define('_AJAXFM_MI_FTPSERVERTIMEOUT', '[ftp] FTP server timeout');
define('_AJAXFM_MI_FTPSERVERTIMEOUT_DESC', "This parameter specifies the timeout for all subsequent network operations. If omitted, the default value is 90 seconds.");
define('_AJAXFM_MI_FTPCONNECTIONTYPE', '[ftp] FTP connection type');
define('_AJAXFM_MI_FTPCONNECTIONTYPE_DESC', "Selectables modes:<ul><li><b>ftp</b> opens a standard FTP connection;</li><li><b>ssl</b> opens a secure SSL-FTP connection.</li></ul><br /><i>NOTE: SSL-FTP connection is only available if both the ftp module and the OpenSSL support is built statically into php, this means that on Windows this function will be undefined in the official PHP builds. To make this function available on Windows you must compile your own PHP binaries.</i>");
define('_AJAXFM_MI_FTPCONNECTIONTYPE1', 'ftp');
define('_AJAXFM_MI_FTPCONNECTIONTYPE2', 'ssl');
define('_AJAXFM_MI_FTPCONNECTIONPASSIVE', '[ftp] Use passive mode');
define('_AJAXFM_MI_FTPCONNECTIONPASSIVE_DESC', "In passive mode, data connections are initiated by the client, rather than by the server. It may be needed if the client is behind firewall.");
define('_AJAXFM_MI_FTPUSERNAME', '[ftp] FTP Login username');
define('_AJAXFM_MI_FTPUSERNAME_DESC', 'The username (USER)'); 
define('_AJAXFM_MI_FTPPASSWORD', '[ftp] FTP login password');
define('_AJAXFM_MI_FTPPASSWORD_DESC', 'The password (PASS)');
define('_AJAXFM_MI_FTPXOOPSROOTPATH', '[ftp] Xoops Rooth Path for ftp connection');
define('_AJAXFM_MI_FTPXOOPSROOTPATH_DESC', ''); 

define('_AJAXFM_MI_FTPPROXY', '[ftp] Proxy');
define('_AJAXFM_MI_FTPPROXY_DESC', "// TO DO");
define('_AJAXFM_MI_FTPPROXY1', 'none');
define('_AJAXFM_MI_FTPPROXY2', 'HTTP/1.1');
define('_AJAXFM_MI_FTPPROXY3', 'SOCK5');
define('_AJAXFM_MI_FTPPROXYADDRESS', '[ftp] Proxy address');
define('_AJAXFM_MI_FTPPROXYADDRESS_DESC', "// TO DO<br />This parameter shouldn't have any trailing slashes:");
define('_AJAXFM_MI_FTPPROXYPORT', '[ftp] Proxy port');
define('_AJAXFM_MI_FTPPROXYPORT_DESC', "// TO DO<br />");
define('_AJAXFM_MI_FTPPROXYUSERNAME', '[ftp] Proxy Login username');
define('_AJAXFM_MI_FTPPROXYUSERNAME_DESC', '// TO DO'); 
define('_AJAXFM_MI_FTPPROXYPASSWORD', '[ftp] Proxy login password');
define('_AJAXFM_MI_FTPPROXYPASSWORD_DESC', '// TO DO');

// for install/uninstall/update
define('_AJAXFM_MI_WARNING_DIRNOTCREATED', '<strong><span style="color:red;">WARNING: %s directory not created!</span></strong><br />');
?>