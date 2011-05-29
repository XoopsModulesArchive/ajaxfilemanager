<?php
// $Id$
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

// Module Info

// The name of this module
define('_AJAXFM_MI_NAME', 'AjaxFileManager');

// A brief description of this module
define('_AJAXFM_MI_DESC', 'Per amministrare i file, i contenuti, le immagini del sito.');

// Names of admin menu items
define('_AJAXFM_MI_ADMENU_INDEX', 'Indice');
define('_AJAXFM_MI_ADMENU_INDEX_DESC', 'Indice');
define('_AJAXFM_MI_ADMENU_FILEMANAGER', 'Gestione file');
define('_AJAXFM_MI_ADMENU_FILEMANAGER_DESC', 'Gestione file');
define('_AJAXFM_MI_ADMENU_FTP', 'Client FTP');
define('_AJAXFM_MI_ADMENU_FTP_DESC', 'Client FTP');
define('_AJAXFM_MI_ADMENU_PERMISSIONS', 'Gestione permessi');
define('_AJAXFM_MI_ADMENU_PERMISSIONS_DESC', 'Gestione permessi');
define('_AJAXFM_MI_ADMENU_EXTENSIONS', 'Gestione estensioni &amp; plugin');
define('_AJAXFM_MI_ADMENU_EXTENSIONS_DESC', 'Gestione estensioni &amp; plugin');
define('_AJAXFM_MI_ADMENU_ABOUT', 'Informazioni su');
define('_AJAXFM_MI_ADMENU_ABOUT_DESC', 'Informazioni su');
define('_AJAXFM_MI_ADMENU_HELP', 'Aiuto');
define('_AJAXFM_MI_ADMENU_HELP_DESC', 'Aiuto');

// for config
define('_AJAXFM_MI_VALIDEXTS', 'Estensioni gestibili dal modulo');
define('_AJAXFM_MI_VALIDEXTS_DESC', 'estensioni gestibili dal modulo separate da virgola (,)<br />Per esempio: gif,jpg,png');
define('_AJAXFM_MI_MAXSIZE', 'Massima dimensione file');
define('_AJAXFM_MI_MAXSIZE_MB', 'MByte');
define('_AJAXFM_MI_MAXSIZE_DESC', 'KByte (1000 = 1MB)');
define('_AJAXFM_MI_DEFAULTPAGINATIONLIMIT', 'Numero di elementi per pagina');
define('_AJAXFM_MI_DEFAULTPAGINATIONLIMIT_DESC', '');
define('_AJAXFM_MI_VIEW', 'Visualizzazione');
define('_AJAXFM_MI_VIEW1', 'Dettagliata');
define('_AJAXFM_MI_VIEW2', 'Thumbnails');
define('_AJAXFM_MI_VIEW_DESC', 'Visualizzazioni selezionabili:<ul><li><b>Dettagliata:</b> elenco dettagliato di file; </li><li><b>Thumbnails:</b> icone con anteprime immagini. </li></ul>');
define('_AJAXFM_MI_TEXTEDITOR', 'Editor file di testo');
define('_AJAXFM_MI_TEXTEDITOR_DESC', 'Editor per modificare i file di testo/codice/...:<br /> solo i seguenti editor sono supportati correttamente: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea');
define('_AJAXFM_MI_NAVIGATIONMODE', 'Modalit&agrave;');
define('_AJAXFM_MI_NAVIGATIONMODE1', 'Sicura');
define('_AJAXFM_MI_NAVIGATIONMODE2', 'Non sicura');
define('_AJAXFM_MI_NAVIGATIONMODE3', '<span style="color:red">Pericolosa</span>');
define('_AJAXFM_MI_NAVIGATIONMODE4', '<span style="color:red">Directory dei temi</span>');
define('_AJAXFM_MI_NAVIGATIONMODE_DESC', 'Modalit&agrave; selezionabili:<ul><li><b>Sicura:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/uploads/ajaxfilemanager/uploaded&quot;; </li><li><b>Non sicura:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/uploads&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILI I MODULI </li><li><b style="color:red;">Directory dei temi:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/themes&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILI I TEMI E IL SITO; </li><li><b style="color:red;">Pericolosa:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILE IL SITO. </li></ul>');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER', '[Extra] Gestore immagini XOOPS');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER1', 'XOOPS Default');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER2', 'XOOPS Migliorato');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER3', 'Ajax File Manager');
define('_AJAXFM_MI_XOOPSIMAGEMANAGER_DESC', 'Scegli il gestore immagini di XOOPS<br />Scegliere : XOOPS Default, XOOPS Migliorato, Ajax File Manager.');

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
define('_AJAXFM_MI_WARNING_DIRNOTCREATED', '<strong><span style="color:red;">ATTENZIONE: non &%egrave; stato possibile creare la directory %s!</span></strong><br />');
?>