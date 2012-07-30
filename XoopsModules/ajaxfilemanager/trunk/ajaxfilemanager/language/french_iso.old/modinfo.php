<?php
// Module Info

// The name of this module
define("_MI_AJAXFM_NAME", "AjaxFileManager");

// A brief description of this module
define("_MI_AJAXFM_DESC", "Pour l'administration des fichiers/contenus/images du site.");

// Names of admin menu items
define("_MI_AJAXFM_ADMENU_INDEX", "Index");
define("_MI_AJAXFM_ADMENU_FILEMANAGER", "Fichiers");
define("_MI_AJAXFM_ADMENU_FTP", "Client FTP");
define("_MI_AJAXFM_ADMENU_PERMISSIONS", "Permissions");
define("_MI_AJAXFM_ADMENU_EXTENSIONS", "Extensions");
define("_MI_AJAXFM_ADMENU_ABOUT", "A propos");

// for config
define("_MI_AJAXFM_VALIDEXTS", "Extensions valides pour l'upload");
define("_MI_AJAXFM_VALIDEXTS_DESC", "Extensions separ�es par des virgules (,)<br />Par exemple: gif,jpg,png");
define("_MI_AJAXFM_MAXSIZE", "Taille Maximum d'upload");
define("_MI_AJAXFM_MAXSIZE_MB", "MBytes");
define("_MI_AJAXFM_MAXSIZE_DESC", "KBytes (1000 = 1MB)");
define("_MI_AJAXFM_DEFAULTPAGINATIONLIMIT", "Nombre de fichiers affich�s par page par d�faut");
define("_MI_AJAXFM_DEFAULTPAGINATIONLIMIT_DESC", "");
define("_MI_AJAXFM_VIEW", "Mode de navigation");
define("_MI_AJAXFM_VIEW1", "D�tails");
define("_MI_AJAXFM_VIEW2", "Miniatures");
define("_MI_AJAXFM_VIEW_DESC", "Modes s�lectionnables :<ul><li><strong>D�tails</strong> Liste d�taill�e des fichiers</li><li><strong>Miniatures</strong> Petites images avec un apercu</li></ul>");
define("_MI_AJAXFM_TEXTEDITOR", "Editeur de texte");
define("_MI_AJAXFM_TEXTEDITOR_DESC", "Choisissez un �diteur de texte<br />Seuls ces �diteurs sont support�s: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea");
define("_MI_AJAXFM_NAVIGATIONMODE", "Mode de navigation");
define("_MI_AJAXFM_NAVIGATIONMODE1", "S�curis�");
define("_MI_AJAXFM_NAVIGATIONMODE2", "Dangereux");
define("_MI_AJAXFM_NAVIGATIONMODE3", "<span style='color:red'>Kamikaze</span>");
define("_MI_AJAXFM_NAVIGATIONMODE_DESC", "Modes s�lectionnables:<ul><li><strong>Securis�</strong> Vous ne pouvez naviguer que dans le dossier du module 'uploads/ajaxfilemanager/'</li><li><strong>Dangereux</strong> Vous pouvez naviguer dans tous les dossiers du r�pertoire 'uploads/', VOUS POURRIEZ DETRUIRE LES FICHIERS UPLOADES PAR LES AUTRES MODULES !</li><li><strong style='color:red;'>Kamikaze</strong> Vous pouvez naviguer dans tout vos r�pertoires, VOUS POURRIEZ TOUT DETRUIRE ET TUER VOTRE SITE !!!</li></ul>");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER", "[Extra] Gestionnaire d'image XOOPS");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER1", "Defaut");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER2", "Avanc�");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER3", "Ajax File Manager");
define("_MI_AJAXFM_XOOPSIMAGEMANAGER_DESC", "Choix du gestionnaire d'image pour Xoops<br />Choisir entre: default, avanc�, ajaxfilemanager");

// for install/uninstall/update
define("_MI_AJAXFM_WARNING_DIRNOTCREATED", "<strong><span style='color:red;'>ATTENTION: dossier %s non cr��!</span></strong><br />");

/**
 * @translation     Communaut� Francophone des Utilisateurs de Xoops
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: ISO-8859-1
 *
 * @Translator      fdeconiac (francoisdeconiac@gmail.com)
 *
 * @version         $Id $
**/
?>