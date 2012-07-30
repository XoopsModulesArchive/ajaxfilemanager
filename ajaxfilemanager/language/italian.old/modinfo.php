<?php
// $Id$
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

// Module Info

// The name of this module
define('_MI_AJAXFM_NAME', 'AjaxFileManager');

// A brief description of this module
define('_MI_AJAXFM_DESC', 'Per amministrare i file, i contenuti, le immagini del sito.');

// Names of admin menu items
define('_MI_AJAXFM_ADMENU_INDEX', 'Indice');
define('_MI_AJAXFM_ADMENU_INDEX_DESC', 'Indice');
define('_MI_AJAXFM_ADMENU_FILEMANAGER', 'Gestione file');
define('_MI_AJAXFM_ADMENU_FILEMANAGER_DESC', 'Gestione file');
define('_MI_AJAXFM_ADMENU_FTP', 'Client FTP');
define('_MI_AJAXFM_ADMENU_FTP_DESC', 'Client FTP');
define('_MI_AJAXFM_ADMENU_PERMISSIONS', 'Gestione permessi');
define('_MI_AJAXFM_ADMENU_PERMISSIONS_DESC', 'Gestione permessi');
define('_MI_AJAXFM_ADMENU_EXTENSIONS', 'Gestione estensioni &amp; plugin');
define('_MI_AJAXFM_ADMENU_EXTENSIONS_DESC', 'Gestione estensioni &amp; plugin');
define('_MI_AJAXFM_ADMENU_ABOUT', 'Informazioni su');
define('_MI_AJAXFM_ADMENU_ABOUT_DESC', 'Informazioni su');
define('_MI_AJAXFM_ADMENU_HELP', 'Aiuto');
define('_MI_AJAXFM_ADMENU_HELP_DESC', 'Aiuto');

// for config
define('_MI_AJAXFM_VALIDEXTS', 'Estensioni gestibili dal modulo');
define('_MI_AJAXFM_VALIDEXTS_DESC', 'estensioni gestibili dal modulo separate da virgola (,)<br />Per esempio: gif,jpg,png');
define('_MI_AJAXFM_MAXSIZE', 'Massima dimensione file');
define('_MI_AJAXFM_MAXSIZE_MB', 'MByte');
define('_MI_AJAXFM_MAXSIZE_DESC', 'KByte (1000 = 1MB)');
define('_MI_AJAXFM_DEFAULTPAGINATIONLIMIT', 'Numero di elementi per pagina');
define('_MI_AJAXFM_DEFAULTPAGINATIONLIMIT_DESC', '');
define('_MI_AJAXFM_VIEW', 'Visualizzazione');
define('_MI_AJAXFM_VIEW1', 'Dettagliata');
define('_MI_AJAXFM_VIEW2', 'Thumbnails');
define('_MI_AJAXFM_VIEW_DESC', 'Visualizzazioni selezionabili:<ul><li><b>Dettagliata:</b> elenco dettagliato di file; </li><li><b>Thumbnails:</b> icone con anteprime immagini. </li></ul>');
define('_MI_AJAXFM_TEXTEDITOR', 'Editor file di testo');
define('_MI_AJAXFM_TEXTEDITOR_DESC', 'Editor per modificare i file di testo/codice/...:<br /> solo i seguenti editor sono supportati correttamente: editarea, codemirror, tinymce, ckeditor, dhtmltextarea, textarea');
define('_MI_AJAXFM_NAVIGATIONMODE', 'Modalit&agrave;');
define('_MI_AJAXFM_NAVIGATIONMODE1', 'Sicura');
define('_MI_AJAXFM_NAVIGATIONMODE2', 'Non sicura');
define('_MI_AJAXFM_NAVIGATIONMODE3', '<span style="color:red">Pericolosa</span>');
define('_MI_AJAXFM_NAVIGATIONMODE4', '<span style="color:red">Directory dei temi</span>');
define('_MI_AJAXFM_NAVIGATIONMODE_DESC', 'Modalit&agrave; selezionabili:<ul><li><b>Sicura:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/uploads/ajaxfilemanager/uploaded&quot;; </li><li><b>Non sicura:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/uploads&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILI I MODULI </li><li><b style="color:red;">Directory dei temi:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/themes&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILI I TEMI E IL SITO; </li><li><b style="color:red;">Pericolosa:</b> &egrave; possibile accedere alla directory &quot;XOOPS_ROOT_PATH/&quot;; &Egrave; POSSIBILE RENDERE INUTILIZZABILE IL SITO. </li></ul>');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER', '[Extra] Gestore immagini XOOPS');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER1', 'XOOPS Default');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER2', 'XOOPS Migliorato');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER3', 'Ajax File Manager');
define('_MI_AJAXFM_XOOPSIMAGEMANAGER_DESC', 'Scegli il gestore immagini di XOOPS<br />Scegliere : XOOPS Default, XOOPS Migliorato, Ajax File Manager.');

    define('_MI_AJAXFM_FTPENABLED', '[ftp] Enable FTP mode');
    define('_MI_AJAXFM_FTPENABLED_DESC', 'If set to Yes is possible to execute ftp operations, like ftp upload, ...');
    define('_MI_AJAXFM_FTPSERVERHOST', '[ftp] FTP server address');
    define('_MI_AJAXFM_FTPSERVERHOST_DESC', "This parameter shouldn't have any trailing slashes and shouldn't be prefixed with ftp://");
    define('_MI_AJAXFM_FTPSERVERPORT', '[ftp] FTP server port');
    define('_MI_AJAXFM_FTPSERVERPORT_DESC', "This parameter specifies an alternate port to connect to. If it is omitted or set to zero, then the default FTP port, 21, will be use.");
    define('_MI_AJAXFM_FTPSERVERTIMEOUT', '[ftp] FTP server timeout');
    define('_MI_AJAXFM_FTPSERVERTIMEOUT_DESC', "This parameter specifies the timeout for all subsequent network operations. If omitted, the default value is 90 seconds.");
    define('_MI_AJAXFM_FTPCONNECTIONTYPE', '[ftp] FTP connection type');
    define('_MI_AJAXFM_FTPCONNECTIONTYPE_DESC', "Selectables modes:<ul><li><b>ftp</b> opens a standard FTP connection;</li><li><b>ssl</b> opens a secure SSL-FTP connection.</li></ul><br /><i>NOTE: SSL-FTP connection is only available if both the ftp module and the OpenSSL support is built statically into php, this means that on Windows this function will be undefined in the official PHP builds. To make this function available on Windows you must compile your own PHP binaries.</i>");
    define('_MI_AJAXFM_FTPCONNECTIONTYPE1', 'ftp');
    define('_MI_AJAXFM_FTPCONNECTIONTYPE2', 'ssl');
    define('_MI_AJAXFM_FTPCONNECTIONPASSIVE', '[ftp] Use passive mode');
    define('_MI_AJAXFM_FTPCONNECTIONPASSIVE_DESC', "In passive mode, data connections are initiated by the client, rather than by the server. It may be needed if the client is behind firewall.");
    define('_MI_AJAXFM_FTPUSERNAME', '[ftp] FTP Login username');
    define('_MI_AJAXFM_FTPUSERNAME_DESC', 'The username (USER)'); 
    define('_MI_AJAXFM_FTPPASSWORD', '[ftp] FTP login password');
    define('_MI_AJAXFM_FTPPASSWORD_DESC', 'The password (PASS)');
    define('_MI_AJAXFM_FTPXOOPSROOTPATH', '[ftp] Xoops Rooth Path for ftp connection');
    define('_MI_AJAXFM_FTPXOOPSROOTPATH_DESC', ''); 

    define('_MI_AJAXFM_FTPPROXY', '[ftp] Proxy');
    define('_MI_AJAXFM_FTPPROXY_DESC', "// TO DO");
    define('_MI_AJAXFM_FTPPROXY1', 'none');
    define('_MI_AJAXFM_FTPPROXY2', 'HTTP/1.1');
    define('_MI_AJAXFM_FTPPROXY3', 'SOCK5');
    define('_MI_AJAXFM_FTPPROXYADDRESS', '[ftp] Proxy address');
    define('_MI_AJAXFM_FTPPROXYADDRESS_DESC', "// TO DO<br />This parameter shouldn't have any trailing slashes:");
    define('_MI_AJAXFM_FTPPROXYPORT', '[ftp] Proxy port');
    define('_MI_AJAXFM_FTPPROXYPORT_DESC', "// TO DO<br />");
    define('_MI_AJAXFM_FTPPROXYUSERNAME', '[ftp] Proxy Login username');
    define('_MI_AJAXFM_FTPPROXYUSERNAME_DESC', '// TO DO'); 
    define('_MI_AJAXFM_FTPPROXYPASSWORD', '[ftp] Proxy login password');
    define('_MI_AJAXFM_FTPPROXYPASSWORD_DESC', '// TO DO');

// for install/uninstall/update
define('_MI_AJAXFM_WARNING_DIRNOTCREATED', '<strong><span style="color:red;">ATTENZIONE: non &%egrave; stato possibile creare la directory %s!</span></strong><br />');
?>