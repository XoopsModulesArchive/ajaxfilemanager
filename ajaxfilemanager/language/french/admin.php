<?php
// admin/index.php
define("_AJAXFM_AM_INDEX_INFO", "Informations sur le module");
define("_AJAXFM_AM_INDEX_SCONFIG", "<b>Information taken from Module Preferences:</b>");
define("_AJAXFM_AM_INDEX_NOIFRAME", "D&eacute;sol&eacute;, votre navigateur n'accepte pas les iframes.");
define('_AJAXFM_AM_WARNING_DIRNOTEXIST', "<strong style='color:red;'>ATTENTION: le dossier %s n'existe pas!</strong>");
define('_AJAXFM_AM_WARNING_DIRCREATEIT', "Cr&eacute;ez le !");
define('_AJAXFM_AM_DIRCREATED', "Dossier %s cr&eacute;&eacute; !");
define('_AJAXFM_AM_DIRNOTCREATED', "<strong style='color:red;'>ATTENTION: le dossier %s n'a pas &eacute;t&eacute; cr&eacute;&eacute; !</strong>");

define('_AJAXFM_MI_FTPSUPPORT', "Support FTP");
define("_AJAXFM_AM_INDEX_SERVERSTATUS", "Statut du serveur");
define("_AJAXFM_AM_INDEX_SPHPINI", "<b>Information du fichier PHP ini:</b>");
define("_AJAXFM_AM_INDEX_SERVERPATH", "Adresse Serveur vers la racine XOOPS : ");
define("_AJAXFM_AM_INDEX_SAFEMODESTATUS", "Statut Safe Mode : ");
define("_AJAXFM_AM_INDEX_REGISTERGLOBALS", "Register Globals: ");
define("_AJAXFM_AM_INDEX_SERVERUPLOADSTATUS", "Statut de l'upload sur le serveur: ");
define("_AJAXFM_AM_INDEX_MAXUPLOADSIZE", "Taille d'upload max autoris&eacute; : ");
define("_AJAXFM_AM_INDEX_MAXPOSTSIZE", "Max Post Size Permitted: ");
define("_AJAXFM_AM_INDEX_SAFEMODEPROBLEMS", " (This May Cause Problems)");
define("_AJAXFM_AM_INDEX_GDLIBSTATUS", "Support GD Library : ");
define("_AJAXFM_AM_INDEX_ZIPLIBSTATUS", "Support Zip Library (ZipArchive class): ");
define("_AJAXFM_AM_INDEX_GDLIBVERSION", "Version GD Library : ");
define("_AJAXFM_AM_INDEX_GDON", "<b>Activ&eacute;</b>");
define("_AJAXFM_AM_INDEX_GDOFF", "<b>D&eacute;sactiv&eacute;</b>");
define("_AJAXFM_AM_INDEX_ZIPON", "<b>Activ&eacute;</b>");
define("_AJAXFM_AM_INDEX_ZIPOFF", "<b>D&eacute;sactiv&eacute;</b>");
define("_AJAXFM_AM_INDEX_OFF", "<b>OFF</b>");
define("_AJAXFM_AM_INDEX_ON", "<b>ON</b>");



// admin/permissions.php
//define('_AJAXFM_AM_PERM_ACCESS',"Utiliser Ajax File Manager");
//define('_AJAXFM_AM_PERM_ACCESS_DESC',"EN COURS");
//define('_AJAXFM_AM_PERM_UPLOAD',"Fichiers upload&eacute;s");
//define('_AJAXFM_AM_PERM_UPLOAD_DESC',"EN COURS");
define('_AJAXFM_AM_PERM_EXTRA',"Permissions du module");
define('_AJAXFM_AM_PERM_EXTRA_DESC', "Les administrateurs PEUVENT TOUJOURS TOUT FAIRE !");
define('_AJAXFM_AM_PERM_EXTRA_1', "<b>Utiliser Ajax File Manager</b>");
define('_AJAXFM_AM_PERM_EXTRA_2', "Uploader des fichiers");
define('_AJAXFM_AM_PERM_EXTRA_4', "Supprimer des fichiers");
define('_AJAXFM_AM_PERM_EXTRA_8', "Couper des fichiers");
define('_AJAXFM_AM_PERM_EXTRA_16', "Copier des fichiers");
define('_AJAXFM_AM_PERM_EXTRA_32', "Cr&eacute;er un dossier");
define('_AJAXFM_AM_PERM_EXTRA_64', "Renommer");
define('_AJAXFM_AM_PERM_EXTRA_128', "Editeurs d'image et de texte");
define('_AJAXFM_AM_PERM_EXTRA_256', "Uploader les fichiers par FTP");
define('_AJAXFM_AM_PERM_EXTRA_512', "Cr&eacute;er un nouveau fichier");
define('_AJAXFM_AM_PERM_EXTRA_1024', "Zipper les fichiers/dossiers");
define('_AJAXFM_AM_PERM_EXTRA_2048', "D&eacute;zipper les fichiers");



// admin/extensions.php
define('_AJAXFM_AM_EXTENSION_WARNING1', "<span style='color:red;'>WARNING: Only if &quot;%s&quot; directory and &quot;config.php&quot; file in it are writable is possible to install, activate and disable extensions using this tool</span>");
define('_AJAXFM_AM_EXTENSION_WARNING2', "<span style='color:red;'>In any other case you have to copy extensions in &quot;%s&quot; directory and edit &quot;config.php&quot; manually</span>");

define('_AJAXFM_AM_EXTENSION', "Extension");
define('_AJAXFM_AM_EXTENSION_STATUS', "Statut");
define('_AJAXFM_AM_EXTENSION_ACTION', "Action");
define('_AJAXFM_AM_EXTENSION_INFO', "Default extensions information");
define('_AJAXFM_AM_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO', "Extra extensions information");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTENSION_NOT_INSTALLED', "Extension non install&eacute;");
define('_AJAXFM_AM_EXTENSION_NOT_ACTIVATED', "Extension non activ&eacute;");
define('_AJAXFM_AM_INSTALL_EXTENSION', "Installer l'extension");
define('_AJAXFM_AM_ACTIVATE_EXTENSION', "Activer l'extension");
define('_AJAXFM_AM_EXTENSION_ACTIVATED', "Extension activ&eacute;e");
define('_AJAXFM_AM_DISABLE_EXTENSION', "D&eacute;sactiver l'extension");
define('_AJAXFM_AM_EXTENSION_DISABLED', "Extension d&eacute;sactiv&eacute;e");
define('_AJAXFM_AM_EXTENSION_INSTALLED_OK', "Extension install&eacute;e");
define('_AJAXFM_AM_EXT_FILE_NOT_INSTALLABLE', "Extension non install&eacute;e");
define('_AJAXFM_AM_EXTENSION_ACTIVATED_OK', "Extension activat&eacute;e");
define('_AJAXFM_AM_EXTENSION_NOTICE', "This extension allow you to display images on all the site just by adding a <b>video</b> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
define('_AJAXFM_AM_EXT_FILE_DONT_EXIST', "Le fichier d'extension n'existe pas dans le dossier :<br /><b>Serveur : </b>%s<br /><b>Fichier : </b>%s");
define('_AJAXFM_AM_EXT_FILE_DONT_EXIST_SHORT', "Le fichier d'extension n'existe pas");
define('_AJAXFM_AM_EXTENSION_INSTALLED', "Extension install&eacute;e");



//admin/about.php
define("_AJAXFM_AM_ABOUT_AUTHOR", "Auteur");
define("_AJAXFM_AM_ABOUT_CHANGELOG", "Change log");
define("_AJAXFM_AM_ABOUT_CREDITS", "Credits");
define("_AJAXFM_AM_ABOUT_LICENSE", "License");
define("_AJAXFM_AM_ABOUT_MODULEINFOS", "Informations sur le module");
define("_AJAXFM_AM_ABOUT_MODULEWEBSITE", "Site web du support");
define("_AJAXFM_AM_ABOUT_AUTHORINFOS", "Informations sur l'auteur");
define("_AJAXFM_AM_ABOUT_AUTHORWEBSITE", "Site Web");
define("_AJAXFM_AM_ABOUT_AUTHOREMAIL", "Email");
define("_AJAXFM_AM_ABOUT_RELEASEDATE", "Date de lancement");
define("_AJAXFM_AM_ABOUT_STATUS", "Statut");
define("_AJAXFM_AM_ABOUT_DESCRIPTION", "Description du module &quot;description.html&quot;");
//admin/help.php
define("_AJAXFM_AM_ABOUT_HELP", "Aide &quot;help.html&quot;");
?>