<?php
// admin/index.php
define("_AJAXFM_AM_INDEX_INFO", "Module Informations");
define("_AJAXFM_AM_INDEX_SCONFIG", "<b>Information taken from Module Preferences:</b>");
define("_AJAXFM_AM_INDEX_NOIFRAME", "Sorry, your browser does not support iframes.");
define('_AJAXFM_AM_WARNING_DIRNOTEXIST', "<strong style='color:red;'>WARNING: %s directory not exist!</strong>");
define('_AJAXFM_AM_WARNING_DIRCREATEIT', "Create it!");
define('_AJAXFM_AM_DIRCREATED', "%s directory created!");
define('_AJAXFM_AM_DIRNOTCREATED', "<strong style='color:red;'>WARNING: %s directory not created!</strong>");

define("_AJAXFM_AM_INDEX_SERVERSTATUS", "Server Status");
define("_AJAXFM_AM_INDEX_SPHPINI", "<b>Information taken from PHP ini File:</b>");
define("_AJAXFM_AM_INDEX_SERVERPATH", "Server Path to XOOPS Root: ");
define("_AJAXFM_AM_INDEX_SAFEMODESTATUS", "Safe Mode Status: ");
define("_AJAXFM_AM_INDEX_REGISTERGLOBALS", "Register Globals: ");
define("_AJAXFM_AM_INDEX_SERVERUPLOADSTATUS", "Server Uploads Status: ");
define("_AJAXFM_AM_INDEX_MAXUPLOADSIZE", "Max Upload Size Permitted: ");
define("_AJAXFM_AM_INDEX_MAXPOSTSIZE", "Max Post Size Permitted: ");
define("_AJAXFM_AM_INDEX_SAFEMODEPROBLEMS", " (This May Cause Problems)");
define("_AJAXFM_AM_INDEX_GDLIBSTATUS", "GD Library Support: ");
define("_AJAXFM_AM_INDEX_ZIPLIBSTATUS", "Zip Library Support (ZipArchive class): ");
define("_AJAXFM_AM_INDEX_GDLIBVERSION", "GD Library Version: ");
define("_AJAXFM_AM_INDEX_GDON", "<b>Enabled</b>");
define("_AJAXFM_AM_INDEX_GDOFF", "<b>Disabled</b>");
define("_AJAXFM_AM_INDEX_ZIPON", "<b>Enabled</b>");
define("_AJAXFM_AM_INDEX_ZIPOFF", "<b>Disabled</b>");
define("_AJAXFM_AM_INDEX_OFF", "<b>OFF</b>");
define("_AJAXFM_AM_INDEX_ON", "<b>ON</b>");



// admin/permissions.php
//define('_AJAXFM_AM_PERM_ACCESS',"Use Ajax File Manager");
//define('_AJAXFM_AM_PERM_ACCESS_DESC',"IN PROGRESS");
//define('_AJAXFM_AM_PERM_UPLOAD',"Upload Files");
//define('_AJAXFM_AM_PERM_UPLOAD_DESC',"IN PROGRESS");
define('_AJAXFM_AM_PERM_EXTRA',"Module Permissions");
define('_AJAXFM_AM_PERM_EXTRA_DESC', "Webmasters CAN ALWAYS DO EVERYTHING");
define('_AJAXFM_AM_PERM_EXTRA_1', "<b>Use Ajax File Manager</b>");
define('_AJAXFM_AM_PERM_EXTRA_2', "Upload Files");
define('_AJAXFM_AM_PERM_EXTRA_4', "Delete Files");
define('_AJAXFM_AM_PERM_EXTRA_8', "Cut Files");
define('_AJAXFM_AM_PERM_EXTRA_16', "Copy Files");
define('_AJAXFM_AM_PERM_EXTRA_32', "Create New Folder");
define('_AJAXFM_AM_PERM_EXTRA_64', "Rename");
define('_AJAXFM_AM_PERM_EXTRA_128', "Image editor and Text editor");



// admin/extensions.php
define('_AJAXFM_AM_EXTENSION_WARNING1', "<span style='color:red;'>WARNING: Only if &quot;%s&quot; directory and &quot;config.php&quot; file in it are writable is possible to install, activate and disable extensions using this tool</span>");
define('_AJAXFM_AM_EXTENSION_WARNING2', "<span style='color:red;'>In any other case you have to copy extensions in &quot;%s&quot; directory and edit &quot;config.php&quot; manually</span>");

define('_AJAXFM_AM_EXTENSION', "Extension");
define('_AJAXFM_AM_EXTENSION_STATUS', "Status");
define('_AJAXFM_AM_EXTENSION_ACTION', "Action");
define('_AJAXFM_AM_EXTENSION_INFO', "Default extensions information");
define('_AJAXFM_AM_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO', "Extra extensions information");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTENSION_NOT_INSTALLED', "Extension not installed");
define('_AJAXFM_AM_EXTENSION_NOT_ACTIVATED', "Extension not activated");
define('_AJAXFM_AM_INSTALL_EXTENSION', "Install extension");
define('_AJAXFM_AM_ACTIVATE_EXTENSION', "Activate extension");
define('_AJAXFM_AM_EXTENSION_ACTIVATED', "Extension activated");
define('_AJAXFM_AM_DISABLE_EXTENSION', "Disable extension");
define('_AJAXFM_AM_EXTENSION_DISABLED', "Extension disabled");
define('_AJAXFM_AM_EXTENSION_INSTALLED_OK', "Extension installed");
define('_AJAXFM_AM_EXT_FILE_NOT_INSTALLABLE', "Extension not installable");
define('_AJAXFM_AM_EXTENSION_ACTIVATED_OK', "Extension activated");
define('_AJAXFM_AM_EXTENSION_NOTICE', "This extension allow you to display images on all the site just by adding a <b>video</b> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
define('_AJAXFM_AM_EXT_FILE_DONT_EXIST', "Extension file don't exist on repository :<br /><b>Server : </b>%s<br /><b>File : </b>%s");
define('_AJAXFM_AM_EXT_FILE_DONT_EXIST_SHORT', "Extension file don't exist");
define('_AJAXFM_AM_EXTENSION_INSTALLED', "Extension installed");



//admin/about.php
define("_AJAXFM_AM_ABOUT_AUTHOR", "Author");
define("_AJAXFM_AM_ABOUT_CHANGELOG", "Change log");
define("_AJAXFM_AM_ABOUT_CREDITS", "Credits");
define("_AJAXFM_AM_ABOUT_LICENSE", "License");
define("_AJAXFM_AM_ABOUT_MODULEINFOS", "Module Informations");
define("_AJAXFM_AM_ABOUT_MODULEWEBSITE", "Support Web Site");
define("_AJAXFM_AM_ABOUT_AUTHORINFOS", "Author Informations");
define("_AJAXFM_AM_ABOUT_AUTHORWEBSITE", "Web Site");
define("_AJAXFM_AM_ABOUT_AUTHOREMAIL", "Email");
define("_AJAXFM_AM_ABOUT_RELEASEDATE", "Date of launch");
define("_AJAXFM_AM_ABOUT_STATUS", "Status");
define("_AJAXFM_AM_ABOUT_DESCRIPTION", "Module Description &quot;description.html&quot;");
define("_AJAXFM_AM_ABOUT_HELP", "Module Help &quot;help.html&quot;");
?>