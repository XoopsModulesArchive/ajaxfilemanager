<?php
// admin/index.php
define("_AJAXFM_AM_INDEX_INFO", "Informazioni modulo");
define("_AJAXFM_AM_INDEX_SCONFIG", "<b>Informazioni ottenute dalle preferenze del modulo:</b>");
define("_AJAXFM_AM_INDEX_NOIFRAME", "Siamo spiacenti, il vostro browser non supporta gli ifremes.");
define('_AJAXFM_AM_WARNING_DIRNOTEXIST', "<strong style='color:red;'>ATTENZIONE: la directory %s directory non esiste!</strong>");
define('_AJAXFM_AM_WARNING_DIRCREATEIT', "Crea!");
define('_AJAXFM_AM_DIRCREATED', "la directory %s &egrave; stata creata correttemente!");
define('_AJAXFM_AM_DIRNOTCREATED', "<strong style='color:red;'>ATTENZIONE: non &egrave; stato possibile creare la directory %s!</strong>");

define('_AJAXFM_MI_FTPSUPPORT', "Supporto FTP");

define("_AJAXFM_AM_INDEX_SERVERSTATUS", "Stato del server");
define("_AJAXFM_AM_INDEX_SPHPINI", "<b>Informazioni ottenute da configurazione PHP:</b>");
define("_AJAXFM_AM_INDEX_SERVERPATH", "Percorso assoluto di XOOPS sul server (XOOPS_ROOT_PATH): ");
define("_AJAXFM_AM_INDEX_SAFEMODESTATUS", "Stato 'Safe Mode': ");
define("_AJAXFM_AM_INDEX_REGISTERGLOBALS", "Stato 'Register Globals': ");
define("_AJAXFM_AM_INDEX_SERVERUPLOADSTATUS", "Stato 'Server Uploads': ");
define("_AJAXFM_AM_INDEX_MAXUPLOADSIZE", "Dimensioni massime Upload ('upload_max_filesize'): ");
define("_AJAXFM_AM_INDEX_MAXPOSTSIZE", "Dimensioni massime Post ('post_max_size'): ");
define("_AJAXFM_AM_INDEX_SAFEMODEPROBLEMS", " (Potrebbe causare problemi)");
define("_AJAXFM_AM_INDEX_GDLIBSTATUS", "Supporto libreria GD: ");
define("_AJAXFM_AM_INDEX_ZIPLIBSTATUS", "Supporto libreria Zip (classe ZipArchive): ");
define("_AJAXFM_AM_INDEX_GDLIBVERSION", "Versione libreria GD: ");
define("_AJAXFM_AM_INDEX_GDON", "<b>Abilitato</b>");
define("_AJAXFM_AM_INDEX_GDOFF", "<b>Sidabilitato</b>");
define("_AJAXFM_AM_INDEX_ZIPON", "<b>Abilitato</b>");
define("_AJAXFM_AM_INDEX_ZIPOFF", "<b>Disabilitato</b>");
define("_AJAXFM_AM_INDEX_OFF", "<b>OFF</b>");
define("_AJAXFM_AM_INDEX_ON", "<b>ON</b>");



// admin/permissions.php
//define('_AJAXFM_AM_PERM_ACCESS',"Use Ajax File Manager");
//define('_AJAXFM_AM_PERM_ACCESS_DESC',"IN PROGRESS");
//define('_AJAXFM_AM_PERM_UPLOAD',"Upload Files");
//define('_AJAXFM_AM_PERM_UPLOAD_DESC',"IN PROGRESS");
define('_AJAXFM_AM_PERM_EXTRA',"Permessi");
define('_AJAXFM_AM_PERM_EXTRA_DESC', "Gli utenti appartenteni al gruppo Webmasters (gli amministratori) POSSONO ESEGUIRE OGNI OPERAZIONE");
define('_AJAXFM_AM_PERM_EXTRA_1', "<b>Utilizza Ajax File Manager</b>");
define('_AJAXFM_AM_PERM_EXTRA_2', "Upload file");
define('_AJAXFM_AM_PERM_EXTRA_4', "Elimina file/directory");
define('_AJAXFM_AM_PERM_EXTRA_8', "Taglia file/directory");
define('_AJAXFM_AM_PERM_EXTRA_16', "Copia file/directory");
define('_AJAXFM_AM_PERM_EXTRA_32', "Crea nuova directory");
define('_AJAXFM_AM_PERM_EXTRA_64', "Rinomina  file/directory");
define('_AJAXFM_AM_PERM_EXTRA_128', "Modifica file d'immagine e file di testi");
define('_AJAXFM_AM_PERM_EXTRA_256', "Upload file via FTP");
define('_AJAXFM_AM_PERM_EXTRA_512', "Crea nuovo file");
define('_AJAXFM_AM_PERM_EXTRA_1024', "Comprimi(zip) file/directory");
define('_AJAXFM_AM_PERM_EXTRA_2048', "Decomprimi(unzip) file");



// admin/extensions.php
define('_AJAXFM_AM_EXTENSION_WARNING1', "<span style='color:red;'>ATTENZIONE: <br />&Egrave; possibile installare, attivare o disattivare le estensioni utilizzando questo strumento solo se la directory &quot;%s&quot; e il file &quot;%s/config.php&quot; hanno attivi i permessi in scrittura.</span>");
define('_AJAXFM_AM_EXTENSION_WARNING2', "<span style='color:red;'>In caso contrario &egrave; necessario copiare le estensioni in &quot;%s&quot; e modificare il file &quot;%s/config.php&quot; manualmente.</span>");

define('_AJAXFM_AM_EXTENSION', "Estensione");
define('_AJAXFM_AM_EXTENSION_STATUS', "Stato");
define('_AJAXFM_AM_EXTENSION_ACTION', "Azione");
define('_AJAXFM_AM_EXTENSION_INFO', "Estensioni XOOPS standard o di altri modulo");
define('_AJAXFM_AM_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO', "Estensioni Ajax File Manager");
define('_AJAXFM_AM_EXTRA_EXTENSION_INFO_DESC', "");
define('_AJAXFM_AM_EXTENSION_NOT_INSTALLED', "Estensione non installata");
define('_AJAXFM_AM_EXTENSION_NOT_ACTIVATED', "Estensione non attivata");
define('_AJAXFM_AM_INSTALL_EXTENSION', "Installa estensione");
define('_AJAXFM_AM_ACTIVATE_EXTENSION', "Attiva estensione");
define('_AJAXFM_AM_EXTENSION_ACTIVATED', "Estensione attivata");
define('_AJAXFM_AM_DISABLE_EXTENSION', "Disattiva estensione");
define('_AJAXFM_AM_EXTENSION_DISABLED', "Estensione disattivata");
define('_AJAXFM_AM_EXTENSION_INSTALLED_OK', "Estensione installata");
define('_AJAXFM_AM_EXT_FILE_NOT_INSTALLABLE', "Estensione non installabile");
define('_AJAXFM_AM_EXTENSION_ACTIVATED_OK', "Estensione attivata");
    define('_AJAXFM_AM_EXTENSION_NOTICE', "This extension allow you to display images on all the site just by adding a <b>video</b> tag to your text. A button (<img src=\"../images/image_button.png\" />) is displayed on XOOPS editor.");
    define('_AJAXFM_AM_EXT_FILE_DONT_EXIST', "Extension file don't exist on repository :<br /><b>Server : </b>%s<br /><b>File : </b>%s");
define('_AJAXFM_AM_EXT_FILE_DONT_EXIST_SHORT', "I file dell'estensione non esistono");
define('_AJAXFM_AM_EXTENSION_INSTALLED', "Estensione installata");



//admin/about.php
define("_AJAXFM_AM_ABOUT_AUTHOR", "Autore");
define("_AJAXFM_AM_ABOUT_CHANGELOG", "Change log");
define("_AJAXFM_AM_ABOUT_CREDITS", "Crediti");
define("_AJAXFM_AM_ABOUT_LICENSE", "Licenza");
define("_AJAXFM_AM_ABOUT_MODULEINFOS", "Informazioni sul modulo");
define("_AJAXFM_AM_ABOUT_MODULEWEBSITE", "Sito web di supporto");
define("_AJAXFM_AM_ABOUT_AUTHORINFOS", "Informazioni sull'autore");
define("_AJAXFM_AM_ABOUT_AUTHORWEBSITE", "Sito web");
define("_AJAXFM_AM_ABOUT_AUTHOREMAIL", "Email");
define("_AJAXFM_AM_ABOUT_RELEASEDATE", "Data di rilascio");
define("_AJAXFM_AM_ABOUT_STATUS", "Stato");
define("_AJAXFM_AM_ABOUT_DESCRIPTION", "Descrizione del modulo &quot;description.html&quot;");



//admin/help.php
define("_AJAXFM_AM_ABOUT_HELP", "Aiuto del modulo &quot;help.html&quot;");
?>