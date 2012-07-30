<?php
// Module Info

// The name of this module
define("_MI_AJAXFM_NAME", "AjaxFileManager");

// A brief description of this module
define("_MI_AJAXFM_DESC", "Pour l'administration des fichiers/contenus/images du site.");

// Names of admin menu items
define("_MI_AJAXFM_ADMENU_INDEX", "Index");
define("_MI_AJAXFM_ADMENU_INDEX_DESC", "Index");
define("_MI_AJAXFM_ADMENU_FILEMANAGER", "Fichiers");
define("_MI_AJAXFM_ADMENU_FILEMANAGER_DESC", "Gestion des fichiers");
define("_MI_AJAXFM_ADMENU_FTP", "Client FTP");
define("_MI_AJAXFM_ADMENU_FTP_DESC", "Client FTP");
define("_MI_AJAXFM_ADMENU_PERMISSIONS", "Permissions");
define("_MI_AJAXFM_ADMENU_PERMISSIONS_DESC", "Gestion des Permissions");
define("_MI_AJAXFM_ADMENU_EXTENSIONS", "Extensions");
define("_MI_AJAXFM_ADMENU_EXTENSIONS_DESC", "Gestion des Extensions");
define("_MI_AJAXFM_ADMENU_ABOUT", "A propos");
define("_MI_AJAXFM_ADMENU_ABOUT_DESC", "A propos");
define("_MI_AJAXFM_ADMENU_HELP", "Aide");
define("_MI_AJAXFM_ADMENU_HELP_DESC", "Aide");

// for config
define("_MI_AJAXFM_VALIDEXTS", "Extensions valides pour l'upload");
define("_MI_AJAXFM_VALIDEXTS_DESC", "Extensions separées par des virgules (,)<br />Par exemple: gif,jpg,png");
define("_MI_AJAXFM_MAXSIZE", "Taille Maximum d'upload");
define("_MI_AJAXFM_MAXSIZE_MB", "MBytes");
define("_MI_AJAXFM_MAXSIZE_DESC", "KBytes (1000 = 1MB)");
define("_MI_AJAXFM_DEFAULTPAGINATIONLIMIT", "Nombre de fichiers affichés par page par défaut");
define("_MI_AJAXFM_DEFAULTPAGINATIONLIMIT_DESC", "");
define("_MI_AJAXFM_VIEW", "Mode de navigation");
define("_MI_AJAXFM_VIEW1", "Détails");
define("_MI_AJAXFM_VIEW2", "Miniatures");
define("_MI_AJAXFM_VIEW_DESC", "Modes sélectionnables :<ul><li><strong>Détails</strong> Liste détaillée des fichiers</li><li><strong>Miniatures</strong> Petites images avec un apercu</li></ul>");
define("_MI_AJAXFM_TEXTEDITOR", "Editeur de texte");
define("_MI_AJAXFM_TEXTEDITOR_DESC", "Choisissez un éditeur de texte<br />Seuls ces éditeurs sont supportés: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea");
define("_MI_AJAXFM_NAVIGATIONMODE", "Mode de navigation");
define("_MI_AJAXFM_NAVIGATIONMODE1", "Sécurisé");
define("_MI_AJAXFM_NAVIGATIONMODE2", "Dangereux");
define("_MI_AJAXFM_NAVIGATIONMODE3", "<span style='color:red'>Kamikaze</span>");
define("_MI_AJAXFM_NAVIGATIONMODE4", "<span style='color:red'>Dossiers des themes</span>");
define("_MI_AJAXFM_NAVIGATIONMODE_DESC", "Modes sélectionnables:<ul><li><strong>Securisé</strong> Vous ne pouvez naviguer que dans le dossier du module 'uploads/ajaxfilemanager/'</li><li><strong>Dangereux</strong> Vous pouvez naviguer dans tous les dossiers du répertoire 'uploads/', VOUS POURRIEZ DETRUIRE LES FICHIERS UPLOADES PAR LES AUTRES MODULES !</li><li><strong style='color:red;'>Kamikaze</strong> Vous pouvez naviguer dans tout vos répertoires, VOUS POURRIEZ TOUT DETRUIRE ET TUER VOTRE SITE !!!</li></ul>");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER", "[Extra] Gestionnaire d'image XOOPS");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER1", "Defaut");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER2", "Avancé");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER3", "Ajax File Manager");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER_DESC", "Choix du gestionnaire d'image pour Xoops<br />Choisir entre: default, avancé, ajaxfilemanager");

define("_MI_AJAXFM_FTPENABLED", "[ftp] Activer le mode FTP");
define("_MI_AJAXFM_FTPENABLED_DESC", "Si OUI, il est possible d\effectuer des actions ftp tel que l'upload, ...");
define("_MI_AJAXFM_FTPSERVERHOST", "[ftp] Adresse du serveur FTP");
define("_MI_AJAXFM_FTPSERVERHOST_DESC", "Ce paramètre ne doit pas avoir de slash, ni débuter par ftp://");
define("_MI_AJAXFM_FTPSERVERPORT", "[ftp] Port du serveur FTP");
define("_MI_AJAXFM_FTPSERVERPORT_DESC", "Ce paramètre spécifie un port de connection alternatif. S'il n'est pas renseigné ou mis a 0, alors le port 21 sera utilisé par défaut.");
define("_MI_AJAXFM_FTPSERVERTIMEOUT", "[ftp] Timeout du serveur FTP");
define("_MI_AJAXFM_FTPSERVERTIMEOUT_DESC", "Ce paramètre spécifie le timeout pour toutes les opérations. S\il n\est pas renseigné, la valeur par défaut sera de 90 secondes.");
define("_MI_AJAXFM_FTPCONNECTIONTYPE", "[ftp] Type de connection FTP");
define("_MI_AJAXFM_FTPCONNECTIONTYPE_DESC", "Modes sélectables :<ul><li><strong>ftp</strong> ouvre une connection FTP standard;</li><li><strong>ssl</strong> ouvre une connection sécurisée SSL-FTP.</li></ul><br /><i>NOTE: la connection SSL-FTP est seulement possible si a la fois, le module ftp et le support OpenSSL sont construits statistiquement dans php, ce qui signifie que cette fonction sur windows ne sera pas définie sur une construction PHP officielle. Pour rendre possible cette fonction sous windows, vous devez compiler votre propre PHP binaire.</i>");
define("_MI_AJAXFM_FTPCONNECTIONTYPE1", "ftp");
define("_MI_AJAXFM_FTPCONNECTIONTYPE2", "ssl");
define("_MI_AJAXFM_FTPCONNECTIONPASSIVE", "[ftp] Utiliser le mode passif");
define("_MI_AJAXFM_FTPCONNECTIONPASSIVE_DESC", "En mode passif, les connections sont initié par le client, plutot que par le serveur. Cela peut etre nécessaire si le client est derriere un firewall.");
define("_MI_AJAXFM_FTPUSERNAME", "[ftp] Nom d'utilisateur FTP (login)");
define("_MI_AJAXFM_FTPUSERNAME_DESC", "Nom d'utilisateur (UTILISATEUR)"); 
define("_MI_AJAXFM_FTPPASSWORD", "[ftp] Mode passe de connection FTP");
define("_MI_AJAXFM_FTPPASSWORD_DESC", "Le mot de passe (PASSWORD)");
define("_MI_AJAXFM_FTPXOOPSROOTPATH", "[ftp] Dossier racine pour la connection FTP (root path)");
define("_MI_AJAXFM_FTPXOOPSROOTPATH_DESC", ""); 

define("_MI_AJAXFM_FTPPROXY", "[ftp] Proxy");
define("_MI_AJAXFM_FTPPROXY_DESC", "// A faire");
define("_MI_AJAXFM_FTPPROXY1", "aucun");
define("_MI_AJAXFM_FTPPROXY2", "HTTP/1.1");
define("_MI_AJAXFM_FTPPROXY3", "SOCK5");
define("_MI_AJAXFM_FTPPROXYADDRESS", "[ftp] Adresse proxy");
define("_MI_AJAXFM_FTPPROXYADDRESS_DESC", "// A faire<br />This parameter shouldn't have any trailing slashes:");
define("_MI_AJAXFM_FTPPROXYPORT", "[ftp] Port proxy");
define("_MI_AJAXFM_FTPPROXYPORT_DESC", "// A faire<br />");
define("_MI_AJAXFM_FTPPROXYUSERNAME", "[ftp] Proxy Login username");
define("_MI_AJAXFM_FTPPROXYUSERNAME_DESC", "// TO DO"); 
define("_MI_AJAXFM_FTPPROXYPASSWORD", "[ftp] Proxy login password");
define("_MI_AJAXFM_FTPPROXYPASSWORD_DESC", "// TO DO");
// for install/uninstall/update
define("_MI_AJAXFM_WARNING_DIRNOTCREATED", "<strong><span style='color:red;'>ATTENTION: dossier %s non créé!</span></strong><br />");

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