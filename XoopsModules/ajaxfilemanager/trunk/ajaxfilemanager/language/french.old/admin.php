<?php
// admin/index.php
define("_AM_AJAXFM_INDEX_INFO", "Informations sur le module");
define("_AM_AJAXFM_INDEX_SCONFIG", "<strong>Information taken from Module Preferences:</strong>");
define("_AM_AJAXFM_INDEX_NOIFRAME", "Désolé, votre navigateur n'accepte pas les iframes.");
define("_AM_AJAXFM_WARNING_DIRNOTEXIST", "<strong style='color:red;'>ATTENTION: le dossier %s n'existe pas !</strong>");
define("_AM_AJAXFM_WARNING_DIRCREATEIT", "Créez le !");
define("_AM_AJAXFM_DIRCREATED", "Dossier %s créé !");
define("_AM_AJAXFM_DIRNOTCREATED", "<strong style='color:red;'>ATTENTION : le dossier %s n'a pas été créé !</strong>");

define("_MI_AJAXFM_FTPSUPPORT", "Support FTP");
define("_AM_AJAXFM_INDEX_SERVERSTATUS", "Statut du serveur");
define("_AM_AJAXFM_INDEX_SPHPINI", "<strong>Information du fichier PHP ini:</strong>");
define("_AM_AJAXFM_INDEX_SERVERPATH", "Adresse Serveur vers la racine XOOPS : ");
define("_AM_AJAXFM_INDEX_SAFEMODESTATUS", "Statut Safe Mode : ");
define("_AM_AJAXFM_INDEX_REGISTERGLOBALS", "Register Globals : ");
define("_AM_AJAXFM_INDEX_MAGICQUOTESGPC", "Statut de 'magic_quotes_gpc': ");
define("_AM_AJAXFM_INDEX_SERVERUPLOADSTATUS", "Statut de l'upload sur le serveur : ");
define("_AM_AJAXFM_INDEX_MAXUPLOADSIZE", "Taille d'upload max autorisé : ");
define("_AM_AJAXFM_INDEX_MAXPOSTSIZE", "Max Post Size Permitted : ");
define("_AM_AJAXFM_INDEX_SAFEMODEPROBLEMS", " (Ceci peut être à l'origine de problème)");
define("_AM_AJAXFM_INDEX_GDLIBSTATUS", "GD Library Support : ");
define("_AM_AJAXFM_INDEX_ZIPLIBSTATUS", "Support Zip Library (ZipArchive class): ");
define("_AM_AJAXFM_INDEX_GDLIBVERSION", "GD Library Version : ");
define("_AM_AJAXFM_INDEX_GDON", "<strong>Activé</strong>");
define("_AM_AJAXFM_INDEX_GDOFF", "<strong>Désactivé</strong>");
define("_AM_AJAXFM_INDEX_ZIPON", "<strong>Activ&eacute;</strong>");
define("_AM_AJAXFM_INDEX_ZIPOFF", "<strong>Désactivé</strong>");
define("_AM_AJAXFM_INDEX_OFF", "<strong>OFF</strong>");
define("_AM_AJAXFM_INDEX_ON", "<strong>ON</strong>");



// admin/permissions.php
//define('_AM_AJAXFM_PERM_ACCESS',"Utiliser Ajax File Manager");
//define('_AM_AJAXFM_PERM_ACCESS_DESC',"EN COURS");
//define('_AM_AJAXFM_PERM_UPLOAD',"Fichiers uploadés");
//define('_AM_AJAXFM_PERM_UPLOAD_DESC',"EN COURS");
define("_AM_AJAXFM_PERM_EXTRA","Permissions du module");
define("_AM_AJAXFM_PERM_EXTRA_DESC", "Les administrateurs PEUVENT TOUJOURS TOUT FAIRE !");
define("_AM_AJAXFM_PERM_EXTRA_1", "<strong>Utiliser Ajax File Manager</strong>");
define("_AM_AJAXFM_PERM_EXTRA_2", "Uploader des fichiers");
define("_AM_AJAXFM_PERM_EXTRA_4", "Supprimer des fichiers");
define("_AM_AJAXFM_PERM_EXTRA_8", "Couper des fichiers");
define("_AM_AJAXFM_PERM_EXTRA_16", "Copier des fichiers");
define("_AM_AJAXFM_PERM_EXTRA_32", "Créer un dossier");
define("_AM_AJAXFM_PERM_EXTRA_64", "Renommer");
define("_AM_AJAXFM_PERM_EXTRA_128", "Editeurs d'image et de texte");
define("_AM_AJAXFM_PERM_EXTRA_256", "Uploader les fichiers par FTP");
define("_AM_AJAXFM_PERM_EXTRA_512", "Créer un nouveau fichier");
define("_AM_AJAXFM_PERM_EXTRA_1024", "Zipper les fichiers/dossiers");
define("_AM_AJAXFM_PERM_EXTRA_2048", "Dézipper les fichiers");



// admin/extensions.php
define("_AM_AJAXFM_EXTENSION_WARNING1", "<span style='color:red;'>WARNING: Only if \"%s\" directory and \"config.php\" file in it are writable is possible to install, activate and disable extensions using this tool</span>");
define("_AM_AJAXFM_EXTENSION_WARNING2", "<span style='color:red;'>In any other case you have to copy extensions in \"%s\" directory and edit \"config.php\" manually</span>");

define("_AM_AJAXFM_EXTENSION", "Extension");
define("_AM_AJAXFM_EXTENSION_STATUS", "Statut");
define("_AM_AJAXFM_EXTENSION_ACTION", "Action");
define("_AM_AJAXFM_EXTENSION_INFO", "Default extensions information");
define("_AM_AJAXFM_EXTENSION_INFO_DESC", "");
define("_AM_AJAXFM_EXTRA_EXTENSION_INFO", "Extra extensions information");
define("_AM_AJAXFM_EXTRA_EXTENSION_INFO_DESC", "");
define("_AM_AJAXFM_EXTENSION_NOT_INSTALLED", "Extension non installé");
define("_AM_AJAXFM_EXTENSION_NOT_ACTIVATED", "Extension non activé");
define("_AM_AJAXFM_INSTALL_EXTENSION", "Installer l'extension");
define("_AM_AJAXFM_ACTIVATE_EXTENSION", "Activer l'extension");
define("_AM_AJAXFM_EXTENSION_ACTIVATED", "Extension activée");
define("_AM_AJAXFM_DISABLE_EXTENSION", "Désactiver l'extension");
define("_AM_AJAXFM_EXTENSION_DISABLED", "Extension désactivée");
define("_AM_AJAXFM_EXTENSION_INSTALLED_OK", "Extension installée");
define("_AM_AJAXFM_EXT_FILE_NOT_INSTALLABLE", "Extension non installée");
define("_AM_AJAXFM_EXTENSION_ACTIVATED_OK", "Extension activatée");
define("_AM_AJAXFM_EXTENSION_NOTICE", "This extension allow you to display images on all the site just by adding a <strong>vidéo</strong> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
define("_AM_AJAXFM_EXT_FILE_DONT_EXIST", "Le fichier d'extension n'existe pas dans le dossier :<br /><strong>Serveur : </strong>%s<br /><strong>Fichier : </strong>%s");
define("_AM_AJAXFM_EXT_FILE_DONT_EXIST_SHORT", "Le fichier d'extension n'existe pas");
define("_AM_AJAXFM_EXTENSION_INSTALLED", "Extension installée");



//admin/about.php
define("_AM_AJAXFM_ABOUT_AUTHOR", "Auteur");
define("_AM_AJAXFM_ABOUT_CHANGELOG", "Change log");
define("_AM_AJAXFM_ABOUT_CREDITS", "Crédits");
define("_AM_AJAXFM_ABOUT_LICENSE", "License");
define("_AM_AJAXFM_ABOUT_MODULEINFOS", "Informations sur le module");
define("_AM_AJAXFM_ABOUT_MODULEWEBSITE", "Site internet du support");
define("_AM_AJAXFM_ABOUT_AUTHORINFOS", "Informations sur l'auteur");
define("_AM_AJAXFM_ABOUT_AUTHORWEBSITE", "Site Internet");
define("_AM_AJAXFM_ABOUT_AUTHOREMAIL", "Adresse email");
define("_AM_AJAXFM_ABOUT_RELEASEDATE", "Date de lancement");
define("_AM_AJAXFM_ABOUT_STATUS", "Statut");
define("_AM_AJAXFM_ABOUT_DESCRIPTION", "Description du module \"description.html\"");
//admin/help.php
define("_AM_AJAXFM_ABOUT_HELP", "Aide \"help.html\"");

/**
 * @translation     Communauté Francophone des Utilisateurs de Xoops
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans Bom
 *
 * @Translator      fdeconiac (francoisdeconiac@gmail.com)
 *
 * @version         $Id $
**/
?>