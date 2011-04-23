<?php
// Module Info

// The name of this module
define("_AJAXFM_MI_NAME", "AjaxFileManager");

// A brief description of this module
define("_AJAXFM_MI_DESC", "Pour l'administration des fichiers/contenus/images du site.");

// Names of admin menu items
define("_AJAXFM_MI_ADMENU_INDEX", "Index");
define("_AJAXFM_MI_ADMENU_INDEX_DESC", "Index");
define("_AJAXFM_MI_ADMENU_FILEMANAGER", "Fichiers");
define("_AJAXFM_MI_ADMENU_FILEMANAGER_DESC", "Gestion des fichiers");
define("_AJAXFM_MI_ADMENU_FTP", "Client FTP");
define("_AJAXFM_MI_ADMENU_FTP_DESC", "Client FTP");
define("_AJAXFM_MI_ADMENU_PERMISSIONS", "Permissions");
define("_AJAXFM_MI_ADMENU_PERMISSIONS_DESC", "Gestion des Permissions");
define("_AJAXFM_MI_ADMENU_EXTENSIONS", "Extensions");
define("_AJAXFM_MI_ADMENU_EXTENSIONS_DESC", "Gestion des Extensions");
define("_AJAXFM_MI_ADMENU_ABOUT", "A propos");
define("_AJAXFM_MI_ADMENU_ABOUT_DESC", "A propos");
define("_AJAXFM_MI_ADMENU_HELP", "Aide");
define("_AJAXFM_MI_ADMENU_HELP_DESC", "Aide");

// for config
define("_AJAXFM_MI_VALIDEXTS", "Extensions valides pour l'upload");
define("_AJAXFM_MI_VALIDEXTS_DESC", "Extensions separées par des virgules (,)<br />Par exemple: gif,jpg,png");
define("_AJAXFM_MI_MAXSIZE", "Taille Maximum d'upload");
define("_AJAXFM_MI_MAXSIZE_MB", "MBytes");
define("_AJAXFM_MI_MAXSIZE_DESC", "KBytes (1000 = 1MB)");
define("_AJAXFM_MI_DEFAULTPAGINATIONLIMIT", "Nombre de fichiers affichés par page par défaut");
define("_AJAXFM_MI_DEFAULTPAGINATIONLIMIT_DESC", "");
define("_AJAXFM_MI_VIEW", "Mode de navigation");
define("_AJAXFM_MI_VIEW1", "Détails");
define("_AJAXFM_MI_VIEW2", "Miniatures");
define("_AJAXFM_MI_VIEW_DESC", "Modes sélectionnables :<ul><li><strong>Détails</strong> Liste détaillée des fichiers</li><li><strong>Miniatures</strong> Petites images avec un apercu</li></ul>");
define("_AJAXFM_MI_TEXTEDITOR", "Editeur de texte");
define("_AJAXFM_MI_TEXTEDITOR_DESC", "Choisissez un éditeur de texte<br />Seuls ces éditeurs sont supportés: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea");
define("_AJAXFM_MI_NAVIGATIONMODE", "Mode de navigation");
define("_AJAXFM_MI_NAVIGATIONMODE1", "Sécurisé");
define("_AJAXFM_MI_NAVIGATIONMODE2", "Dangereux");
define("_AJAXFM_MI_NAVIGATIONMODE3", "<span style='color:red'>Kamikaze</span>");
define("_AJAXFM_MI_NAVIGATIONMODE4", "<span style='color:red'>Dossiers des themes</span>");
define("_AJAXFM_MI_NAVIGATIONMODE_DESC", "Modes sélectionnables:<ul><li><strong>Securisé</strong> Vous ne pouvez naviguer que dans le dossier du module 'uploads/ajaxfilemanager/'</li><li><strong>Dangereux</strong> Vous pouvez naviguer dans tous les dossiers du répertoire 'uploads/', VOUS POURRIEZ DETRUIRE LES FICHIERS UPLOADES PAR LES AUTRES MODULES !</li><li><strong style='color:red;'>Kamikaze</strong> Vous pouvez naviguer dans tout vos répertoires, VOUS POURRIEZ TOUT DETRUIRE ET TUER VOTRE SITE !!!</li></ul>");
define("_AJAXFM_MI_XOOPSIMAGEMANAGER", "[Extra] Gestionnaire d'image XOOPS");
define("_AJAXFM_MI_XOOPSIMAGEMANAGER1", "Defaut");
define("_AJAXFM_MI_XOOPSIMAGEMANAGER2", "Avancé");
define("_AJAXFM_MI_XOOPSIMAGEMANAGER3", "Ajax File Manager");
define("_AJAXFM_MI_XOOPSIMAGEMANAGER_DESC", "Choix du gestionnaire d'image pour Xoops<br />Choisir entre: default, avancé, ajaxfilemanager");

define("_AJAXFM_MI_FTPENABLED", "[ftp] Activer le mode FTP");
define("_AJAXFM_MI_FTPENABLED_DESC", "Si OUI, il est possible d\effectuer des actions ftp tel que l'upload, ...");
define("_AJAXFM_MI_FTPSERVERHOST", "[ftp] Adresse du serveur FTP");
define("_AJAXFM_MI_FTPSERVERHOST_DESC", "Ce paramètre ne doit pas avoir de slash, ni débuter par ftp://");
define("_AJAXFM_MI_FTPSERVERPORT", "[ftp] Port du serveur FTP");
define("_AJAXFM_MI_FTPSERVERPORT_DESC", "Ce paramètre spécifie un port de connection alternatif. S'il n'est pas renseigné ou mis a 0, alors le port 21 sera utilisé par défaut.");
define("_AJAXFM_MI_FTPSERVERTIMEOUT", "[ftp] Timeout du serveur FTP");
define("_AJAXFM_MI_FTPSERVERTIMEOUT_DESC", "Ce paramètre spécifie le timeout pour toutes les opérations. S\il n\est pas renseigné, la valeur par défaut sera de 90 secondes.");
define("_AJAXFM_MI_FTPCONNECTIONTYPE", "[ftp] Type de connection FTP");
define("_AJAXFM_MI_FTPCONNECTIONTYPE_DESC", "Modes sélectables :<ul><li><strong>ftp</strong> ouvre une connection FTP standard;</li><li><strong>ssl</strong> ouvre une connection sécurisée SSL-FTP.</li></ul><br /><i>NOTE: la connection SSL-FTP est seulement possible si a la fois, le module ftp et le support OpenSSL sont construits statistiquement dans php, ce qui signifie que cette fonction sur windows ne sera pas définie sur une construction PHP officielle. Pour rendre possible cette fonction sous windows, vous devez compiler votre propre PHP binaire.</i>");
define("_AJAXFM_MI_FTPCONNECTIONTYPE1", "ftp");
define("_AJAXFM_MI_FTPCONNECTIONTYPE2", "ssl");
define("_AJAXFM_MI_FTPCONNECTIONPASSIVE", "[ftp] Utiliser le mode passif");
define("_AJAXFM_MI_FTPCONNECTIONPASSIVE_DESC", "En mode passif, les connections sont initié par le client, plutot que par le serveur. Cela peut etre nécessaire si le client est derriere un firewall.");
define("_AJAXFM_MI_FTPUSERNAME", "[ftp] Nom d'utilisateur FTP (login)");
define("_AJAXFM_MI_FTPUSERNAME_DESC", "Nom d'utilisateur (UTILISATEUR)"); 
define("_AJAXFM_MI_FTPPASSWORD", "[ftp] Mode passe de connection FTP");
define("_AJAXFM_MI_FTPPASSWORD_DESC", "Le mot de passe (PASSWORD)");
define("_AJAXFM_MI_FTPXOOPSROOTPATH", "[ftp] Dossier racine pour la connection FTP (root path)");
define("_AJAXFM_MI_FTPXOOPSROOTPATH_DESC", ""); 

define("_AJAXFM_MI_FTPPROXY", "[ftp] Proxy");
define("_AJAXFM_MI_FTPPROXY_DESC", "// A faire");
define("_AJAXFM_MI_FTPPROXY1", "aucun");
define("_AJAXFM_MI_FTPPROXY2", "HTTP/1.1");
define("_AJAXFM_MI_FTPPROXY3", "SOCK5");
define("_AJAXFM_MI_FTPPROXYADDRESS", "[ftp] Adresse proxy");
define("_AJAXFM_MI_FTPPROXYADDRESS_DESC", "// A faire<br />This parameter shouldn't have any trailing slashes:");
define("_AJAXFM_MI_FTPPROXYPORT", "[ftp] Port proxy");
define("_AJAXFM_MI_FTPPROXYPORT_DESC", "// A faire<br />");
define("_AJAXFM_MI_FTPPROXYUSERNAME", "[ftp] Proxy Login username");
define("_AJAXFM_MI_FTPPROXYUSERNAME_DESC", "// TO DO"); 
define("_AJAXFM_MI_FTPPROXYPASSWORD", "[ftp] Proxy login password");
define("_AJAXFM_MI_FTPPROXYPASSWORD_DESC", "// TO DO");
// for install/uninstall/update
define("_AJAXFM_MI_WARNING_DIRNOTCREATED", "<strong><span style='color:red;'>ATTENTION: dossier %s non créé!</span></strong><br />");

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