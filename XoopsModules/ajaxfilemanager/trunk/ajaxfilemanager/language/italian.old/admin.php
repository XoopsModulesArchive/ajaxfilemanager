<?php
// admin/index.php
define("_AM_AJAXFM_INDEX_INFO","Informazioni modulo");
define("_AM_AJAXFM_INDEX_SCONFIG","<b>Informazioni ottenute dalle preferenze del modulo:</b>");
define("_AM_AJAXFM_INDEX_NOIFRAME","Siamo spiacenti, il vostro browser non supporta gli ifremes.");
define('_AM_AJAXFM_WARNING_DIRNOTEXIST', "<strong style='color:red;'>ATTENZIONE: la directory %s directory non esiste!</strong>");
define('_AM_AJAXFM_WARNING_DIRCREATEIT', "Crea!");
define('_AM_AJAXFM_DIRCREATED', "la directory %s &egrave; stata creata correttemente!");
define('_AM_AJAXFM_DIRNOTCREATED', "<strong style='color:red;'>ATTENZIONE: non &egrave; stato possibile creare la directory %s!</strong>");

define('_MI_AJAXFM_FTPSUPPORT', "Supporto FTP");

define("_AM_AJAXFM_INDEX_SERVERSTATUS","Stato del server");
define("_AM_AJAXFM_INDEX_SPHPINI","<b>Informazioni ottenute da configurazione PHP:</b>");
define("_AM_AJAXFM_INDEX_SERVERPATH","Percorso assoluto di XOOPS sul server (XOOPS_ROOT_PATH): ");
define("_AM_AJAXFM_INDEX_SAFEMODESTATUS","Stato 'Safe Mode': ");
define("_AM_AJAXFM_INDEX_REGISTERGLOBALS","Stato 'Register Globals': ");
define("_AM_AJAXFM_INDEX_MAGICQUOTESGPC","Stato 'magic_quotes_gpc': ");
define("_AM_AJAXFM_INDEX_SERVERUPLOADSTATUS","Stato 'Server Uploads': ");
define("_AM_AJAXFM_INDEX_MAXUPLOADSIZE","Dimensioni massime Upload ('upload_max_filesize'): ");
define("_AM_AJAXFM_INDEX_MAXPOSTSIZE","Dimensioni massime Post ('post_max_size'): ");
define("_AM_AJAXFM_INDEX_SAFEMODEPROBLEMS"," (Potrebbe causare problemi)");
define("_AM_AJAXFM_INDEX_GDLIBSTATUS","Supporto libreria GD: ");
define("_AM_AJAXFM_INDEX_ZIPLIBSTATUS","Supporto libreria Zip (classe ZipArchive): ");
define("_AM_AJAXFM_INDEX_GDLIBVERSION","Versione libreria GD: ");
define("_AM_AJAXFM_INDEX_GDON","<b>Abilitato</b>");
define("_AM_AJAXFM_INDEX_GDOFF","<b>Sidabilitato</b>");
define("_AM_AJAXFM_INDEX_ZIPON","<b>Abilitato</b>");
define("_AM_AJAXFM_INDEX_ZIPOFF","<b>Disabilitato</b>");
define("_AM_AJAXFM_INDEX_OFF","<b>OFF</b>");
define("_AM_AJAXFM_INDEX_ON","<b>ON</b>");



// admin/permissions.php
//define('_AM_AJAXFM_PERM_ACCESS',"Use Ajax File Manager");
//define('_AM_AJAXFM_PERM_ACCESS_DESC',"IN PROGRESS");
//define('_AM_AJAXFM_PERM_UPLOAD',"Upload Files");
//define('_AM_AJAXFM_PERM_UPLOAD_DESC',"IN PROGRESS");
define('_AM_AJAXFM_PERM_EXTRA',"Permessi");
define('_AM_AJAXFM_PERM_EXTRA_DESC', "Gli utenti appartenteni al gruppo Webmasters (gli amministratori) POSSONO ESEGUIRE OGNI OPERAZIONE");
define('_AM_AJAXFM_PERM_EXTRA_1', "<b>Utilizza Ajax File Manager</b>");
define('_AM_AJAXFM_PERM_EXTRA_2', "Upload file");
define('_AM_AJAXFM_PERM_EXTRA_4', "Elimina file/directory");
define('_AM_AJAXFM_PERM_EXTRA_8', "Taglia file/directory");
define('_AM_AJAXFM_PERM_EXTRA_16', "Copia file/directory");
define('_AM_AJAXFM_PERM_EXTRA_32', "Crea nuova directory");
define('_AM_AJAXFM_PERM_EXTRA_64', "Rinomina  file/directory");
define('_AM_AJAXFM_PERM_EXTRA_128', "Modifica file d'immagine e file di testi");
define('_AM_AJAXFM_PERM_EXTRA_256', "Upload file via FTP");
define('_AM_AJAXFM_PERM_EXTRA_512', "Crea nuovo file");
define('_AM_AJAXFM_PERM_EXTRA_1024', "Comprimi(zip) file/directory");
define('_AM_AJAXFM_PERM_EXTRA_2048', "Decomprimi(unzip) file");



// admin/extensions.php
define('_AM_AJAXFM_EXTENSION_WARNING1', "<span style='color:red;'>ATTENZIONE: <br />&Egrave; possibile installare, attivare o disattivare le estensioni utilizzando questo strumento solo se la directory &quot;%s&quot; e il file &quot;%s/config.php&quot; hanno attivi i permessi in scrittura.</span>");
define('_AM_AJAXFM_EXTENSION_WARNING2', "<span style='color:red;'>In caso contrario &egrave; necessario copiare le estensioni in &quot;%s&quot; e modificare il file &quot;%s/config.php&quot; manualmente.</span>");

define('_AM_AJAXFM_EXTENSION', "Estensione");
define('_AM_AJAXFM_EXTENSION_STATUS', "Stato");
define('_AM_AJAXFM_EXTENSION_ACTION', "Azione");
define('_AM_AJAXFM_EXTENSION_INFO', "Estensioni XOOPS standard o di altri modulo");
define('_AM_AJAXFM_EXTENSION_INFO_DESC', "");
define('_AM_AJAXFM_EXTRA_EXTENSION_INFO', "Estensioni Ajax File Manager");
define('_AM_AJAXFM_EXTRA_EXTENSION_INFO_DESC', "");
define('_AM_AJAXFM_EXTENSION_NOT_INSTALLED', "Estensione non installata");
define('_AM_AJAXFM_EXTENSION_NOT_ACTIVATED', "Estensione non attivata");
define('_AM_AJAXFM_INSTALL_EXTENSION', "Installa estensione");
define('_AM_AJAXFM_ACTIVATE_EXTENSION', "Attiva estensione");
define('_AM_AJAXFM_EXTENSION_ACTIVATED', "Estensione attivata");
define('_AM_AJAXFM_DISABLE_EXTENSION', "Disattiva estensione");
define('_AM_AJAXFM_EXTENSION_DISABLED', "Estensione disattivata");
define('_AM_AJAXFM_EXTENSION_INSTALLED_OK', "Estensione installata");
define('_AM_AJAXFM_EXT_FILE_NOT_INSTALLABLE', "Estensione non installabile");
define('_AM_AJAXFM_EXTENSION_ACTIVATED_OK', "Estensione attivata");
    define('_AM_AJAXFM_EXTENSION_NOTICE', "This extension allow you to display images on all the site just by adding a <b>video</b> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
    define('_AM_AJAXFM_EXT_FILE_DONT_EXIST', "Extension file don't exist on repository :<br /><b>Server : </b>%s<br /><b>File : </b>%s");
define('_AM_AJAXFM_EXT_FILE_DONT_EXIST_SHORT', "I file dell'estensione non esistono");
define('_AM_AJAXFM_EXTENSION_INSTALLED', "Estensione installata");
// added v0.1 - 2011/05/31
define('_AM_AJAXFM_EDITORPLUGIN_INFO', "Plugin Ajax File Manager per gli editor");
define('_AM_AJAXFM_EDITORPLUGIN_INFO_DESC', "");
define('_AM_AJAXFM_EDITOR', "Editor");
define('_AM_AJAXFM_EDITOR_STATUS', "Stato");
define('_AM_AJAXFM_EDITOR_ACTION', "Azione");
define('_AM_AJAXFM_INSTALL_EDITORPLUGIN', "Installa plugin");
define('_AM_AJAXFM_UNINSTALL_EDITORPLUGIN', "Disinstalla plugin");
define('_AM_AJAXFM_EDITORPLUGIN_INSTALLED', "Plugin installato");
define('_AM_AJAXFM_EDITORPLUGIN_NOT_INSTALLED', "Plugin non installato");
define('_AM_AJAXFM_EDITORPLUGIN_INSTALLED_OK', "Plugin installato");
define('_AM_AJAXFM_EDITORPLUGIN_UNINSTALLED_OK', "Plugin disinstallato");
define('_AM_AJAXFM_EDITORTINYMCE', "Tinymce");
define('_AM_AJAXFM_EDITORTINYMCE_DESC', "<span style='color:red;'>ATTENZIONE: <br />Se la procedura automatica di installazione non funziona, copiare il file di impostazioni di Tinymce &quot;%s&quot; in &quot;%s&quot;.</span>");
// added v0.1 - 2011/07/17
// added v0.1 - 2011/07/17
define('_AM_AJAXFM_IMAGE_PHP_INFO', "Xoops Smart Image Resizer - image.php");
define('_AM_AJAXFM_IMAGE_PHP_DEMO', "<h3>Demo</h3>Original image<br /><img src='' /><br />src=''");
define('_AM_AJAXFM_IMAGE_PHP_SMART', XOOPS_URL . "/image.php\" is Xoops Smart Image Resizer");
define('_AM_AJAXFM_IMAGE_PHP_SMART_DESC', "");
define('_AM_AJAXFM_IMAGE_PHP_NO_SMART', "\"" . XOOPS_URL . "/image.php\" is not Xoops Smart Image Resizer");
define('_AM_AJAXFM_IMAGE_PHP_NO_SMART_DESC', "<span style=\"color:red;\">If you want to use Xoops Smart Image Resizer functions, please copy \"" . XOOPS_ROOT_PATH . "modules/ajaxfilemanager/image.php\" in \"" . XOOPS_ROOT_PATH . "\" and overwrite existing (original) image.php</span>");



//admin/about.php
define("_AM_AJAXFM_ABOUT_AUTHOR","Autore");
define("_AM_AJAXFM_ABOUT_CHANGELOG","Change log");
define("_AM_AJAXFM_ABOUT_CREDITS","Crediti");
define("_AM_AJAXFM_ABOUT_LICENSE","Licenza");
define("_AM_AJAXFM_ABOUT_MODULEINFOS","Informazioni sul modulo");
define("_AM_AJAXFM_ABOUT_MODULEWEBSITE","Sito web di supporto");
define("_AM_AJAXFM_ABOUT_AUTHORINFOS","Informazioni sull'autore");
define("_AM_AJAXFM_ABOUT_AUTHORWEBSITE","Sito web");
define("_AM_AJAXFM_ABOUT_AUTHOREMAIL","Email");
define("_AM_AJAXFM_ABOUT_RELEASEDATE","Data di rilascio");
define("_AM_AJAXFM_ABOUT_STATUS","Stato");
define("_AM_AJAXFM_ABOUT_DESCRIPTION","Descrizione del modulo &quot;description.html&quot;");



//admin/help.php
define("_AM_AJAXFM_ABOUT_HELP","Aiuto del modulo &quot;help.html&quot;");
?>