<?php
// admin/index.php
define("_AM_AJAXFM_INDEX_INFO", "Module informations");
define("_AM_AJAXFM_INDEX_SCONFIG", "Information taken from module preferences");
define("_AM_AJAXFM_INDEX_NOIFRAME", "Sorry, your browser does not support iframes.");
define('_AM_AJAXFM_WARNING_DIRNOTEXIST', "<strong style='color:red;'>WARNING: %s directory not exist!</strong>");
define('_AM_AJAXFM_WARNING_DIRCREATEIT', "Create it!");
define('_AM_AJAXFM_DIRCREATED', "%s directory created!");
define('_AM_AJAXFM_DIRNOTCREATED', "<strong style='color:red;'>WARNING: %s directory not created!</strong>");

define("_AM_AJAXFM_INDEX_SERVERSTATUS", "Server status");
define("_AM_AJAXFM_INDEX_SPHPINI", "Information taken from php.ini file");
define("_AM_AJAXFM_INDEX_SPHPINIPATH", "Server Path to php.ini: %s");
define("_AM_AJAXFM_INDEX_XOOPSPATH", "Server Path to XOOPS Root: %s");
define("_AM_AJAXFM_INDEX_SAFEMODESTATUS", "Safe Mode Status: %s");
define("_AM_AJAXFM_INDEX_REGISTERGLOBALS", "Register Globals: %s");
define("_AM_AJAXFM_INDEX_MAGICQUOTESGPC", "'magic_quotes_gpc' Status: %s");
define("_AM_AJAXFM_INDEX_SERVERUPLOADSTATUS", "Server Uploads Status: %s");
define("_AM_AJAXFM_INDEX_MAXUPLOADSIZE", "Max Upload Size Permitted: %s");
define("_AM_AJAXFM_INDEX_MAXPOSTSIZE", "Max Post Size Permitted: %s");
define("_AM_AJAXFM_INDEX_SAFEMODEPROBLEMS", " (This May Cause Problems)");
define("_AM_AJAXFM_INDEX_GDLIBSTATUS", "GD Library Support: %s");
define("_AM_AJAXFM_INDEX_ZIPLIBSTATUS", "Zip Library Support (ZipArchive class): %s");
define("_AM_AJAXFM_INDEX_GDLIBVERSION", "GD Library Version: %s");
define("_AM_AJAXFM_INDEX_GDON", "<b>Enabled</b>");
define("_AM_AJAXFM_INDEX_GDOFF", "<b>Disabled</b>");
define("_AM_AJAXFM_INDEX_ZIPON", "<b>Enabled</b>");
define("_AM_AJAXFM_INDEX_ZIPOFF", "<b>Disabled</b>");
define("_AM_AJAXFM_INDEX_OFF", "<b>OFF</b>");
define("_AM_AJAXFM_INDEX_ON", "<b>ON</b>");



// admin/permissions.php
//define('_AM_AJAXFM_PERM_ACCESS',"Use Ajax File Manager");
//define('_AM_AJAXFM_PERM_ACCESS_DESC',"IN PROGRESS");
//define('_AM_AJAXFM_PERM_UPLOAD',"Upload Files");
//define('_AM_AJAXFM_PERM_UPLOAD_DESC',"IN PROGRESS");
define('_AM_AJAXFM_PERM_EXTRA',"Module Permissions");
define('_AM_AJAXFM_PERM_EXTRA_DESC', "Webmasters CAN ALWAYS DO EVERYTHING");
define('_AM_AJAXFM_PERM_EXTRA_1', "<b>Use Ajax File Manager</b>");
define('_AM_AJAXFM_PERM_EXTRA_2', "Upload files");
define('_AM_AJAXFM_PERM_EXTRA_4', "Delete files/folders");
define('_AM_AJAXFM_PERM_EXTRA_8', "Cut files/folders");
define('_AM_AJAXFM_PERM_EXTRA_16', "Copy files/folders");
define('_AM_AJAXFM_PERM_EXTRA_32', "Create new folder");
define('_AM_AJAXFM_PERM_EXTRA_64', "Rename files/folders");
define('_AM_AJAXFM_PERM_EXTRA_128', "Image editor and text editor");
define('_AM_AJAXFM_PERM_EXTRA_512', "Create new file");
define('_AM_AJAXFM_PERM_EXTRA_1024', "Zip files/folders");
define('_AM_AJAXFM_PERM_EXTRA_2048', "Unzip files");



// admin/extensions.php
define('_AM_AJAXFM_EXTENSION_WARNING1', "<span style='color:red;'>WARNING: <br />Is possible to install, activate and disable extensions using this tool only if &quot;%s&quot; directory and &quot;%s/config.php&quot; file are writable.</span>");
define('_AM_AJAXFM_EXTENSION_WARNING2', "<span style='color:red;'>In any other case you have to copy extensions in &quot;%s&quot; directory and edit &quot;%s/config.php&quot; manually.</span>");

define('_AM_AJAXFM_EXTENSION', "Extension");
define('_AM_AJAXFM_EXTENSION_STATUS', "Status");
define('_AM_AJAXFM_EXTENSION_ACTION', "Action");
define('_AM_AJAXFM_EXTENSION_INFO', "Default extensions");
define('_AM_AJAXFM_EXTENSION_INFO_DESC', "");
define('_AM_AJAXFM_EXTRA_EXTENSION_INFO', "Extra extensions");
define('_AM_AJAXFM_EXTRA_EXTENSION_INFO_DESC', "");
define('_AM_AJAXFM_EXTENSION_NOT_INSTALLED', "Extension not installed");
define('_AM_AJAXFM_EXTENSION_NOT_ACTIVATED', "Extension not activated");
define('_AM_AJAXFM_INSTALL_EXTENSION', "Install extension");
define('_AM_AJAXFM_ACTIVATE_EXTENSION', "Activate extension");
define('_AM_AJAXFM_EXTENSION_ACTIVATED', "Extension activated");
define('_AM_AJAXFM_DISABLE_EXTENSION', "Disable extension");
define('_AM_AJAXFM_EXTENSION_DISABLED', "Extension disabled");
define('_AM_AJAXFM_EXTENSION_INSTALLED_OK', "Extension installed");
define('_AM_AJAXFM_EXT_FILE_NOT_INSTALLABLE', "Extension not installable");
define('_AM_AJAXFM_EXTENSION_ACTIVATED_OK', "Extension activated");
define('_AM_AJAXFM_EXTENSION_NOTICE', "This extension allow you to display images on all the site just by adding a <b>video</b> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
define('_AM_AJAXFM_EXT_FILE_DONT_EXIST', "Extension file don't exist on repository :<br /><b>Server : </b>%s<br /><b>File : </b>%s");
define('_AM_AJAXFM_EXT_FILE_DONT_EXIST_SHORT', "Extension file don't exist");
define('_AM_AJAXFM_EXTENSION_INSTALLED', "Extension installed");
// added v0.1 - 2011/05/31
define('_AM_AJAXFM_EDITORPLUGIN_INFO', "Editors plugins");
define('_AM_AJAXFM_EDITORPLUGIN_INFO_DESC', "");
define('_AM_AJAXFM_EDITOR', "Editor");
define('_AM_AJAXFM_EDITOR_STATUS', "Status");
define('_AM_AJAXFM_EDITOR_ACTION', "Action");
define('_AM_AJAXFM_INSTALL_EDITORPLUGIN', "Install plugin");
define('_AM_AJAXFM_UNINSTALL_EDITORPLUGIN', "Uninstall plugin");
define('_AM_AJAXFM_EDITORPLUGIN_INSTALLED', "Plugin installed");
define('_AM_AJAXFM_EDITORPLUGIN_NOT_INSTALLED', "Plugin not installed");
define('_AM_AJAXFM_EDITORPLUGIN_INSTALLED_OK', "Plugin installed");
define('_AM_AJAXFM_EDITORPLUGIN_UNINSTALLED_OK', "Plugin uninstalled");
define('_AM_AJAXFM_EDITORTINYMCE', "Tinymce");
define('_AM_AJAXFM_EDITORTINYMCE_DESC', "<span style='color:red;'>WARNING: <br />If automatic installation faults, please copy tinymce settings file &quot;%s&quot; to &quot;%s&quot;.</span>");
// added v0.1 - 2011/07/17
define('_AM_AJAXFM_IMAGE_PHP_INFO', "Xoops Smart Image Resizer - image.php");
define('_AM_AJAXFM_IMAGE_PHP_DEMO', "<h3>Demo</h3>Immagine originale<br /><img src='' /><br />src=''");
define('_AM_AJAXFM_IMAGE_PHP_SMART', "\"" . XOOPS_URL . "/image.php\" is Xoops Smart Image Resizer");
define('_AM_AJAXFM_IMAGE_PHP_SMART_DESC', "");
define('_AM_AJAXFM_IMAGE_PHP_NO_SMART', "\"" . XOOPS_URL . "/image.php\" is not Xoops Smart Image Resizer");
define('_AM_AJAXFM_IMAGE_PHP_NO_SMART_DESC', "<span style=\"color:red;\">If you want to use Xoops Smart Image Resizer functions, please copy \"" . XOOPS_ROOT_PATH . "/modules/ajaxfilemanager/image.php\" in \"" . XOOPS_ROOT_PATH . "\" and overwrite existing (original) image.php</span>");
// added v0.1 - 2011/07/26
define('_AM_AJAXFM_DUMP_IMAGES_CACHE', "Dump images cache");
define('_AM_AJAXFM_DUMP_IMAGES_CACHE_OK', "Images cache dumped");
define('_AM_AJAXFM_DUMP_IMAGES_CACHE_NTO_OK', "Warning: images cache not dumped");
// added v1.0 - 2012/07/30
define('_AM_AJAXFM_EXTENSIONS_MANAGER', "Extensions manager");
define('_AM_AJAXFM_PLUGINS_MANAGER', "Plugins manager");
define('_AM_AJAXFM_EXTRA_MANAGER', "Extra features manager");
define('_AM_AJAXFM_EDITORPLUGIN_TEST_DHTMLTEXTAREA', "Test dhtmltextarea editor");
define('_AM_AJAXFM_EDITORPLUGIN_TEST_TINYMCE', "Test tinymce editor");

//admin/about.php
define("_AM_AJAXFM_ABOUT_AUTHOR", "Author");
define("_AM_AJAXFM_ABOUT_CHANGELOG", "Change log");
define("_AM_AJAXFM_ABOUT_CREDITS", "Credits");
define("_AM_AJAXFM_ABOUT_LICENSE", "License");
define("_AM_AJAXFM_ABOUT_MODULEINFOS", "Module Informations");
define("_AM_AJAXFM_ABOUT_MODULEWEBSITE", "Support Web Site");
define("_AM_AJAXFM_ABOUT_AUTHORINFOS", "Author Informations");
define("_AM_AJAXFM_ABOUT_AUTHORWEBSITE", "Web Site");
define("_AM_AJAXFM_ABOUT_AUTHOREMAIL", "Email");
define("_AM_AJAXFM_ABOUT_RELEASEDATE", "Date of launch");
define("_AM_AJAXFM_ABOUT_STATUS", "Status");
define("_AM_AJAXFM_ABOUT_DESCRIPTION", "Module Description &quot;description.html&quot;");



//admin/help.php
define("_AM_AJAXFM_ABOUT_HELP", "Module Help &quot;help.html&quot;");

//Error NoFrameworks
define("_AM_AJAXFM_NOFRAMEWORKS","Error: You don&#39;t use the Frameworks \"admin module\". Please install this Frameworks");
define("_AM_AJAXFM_MAINTAINEDBY", "is maintained by the");
?>