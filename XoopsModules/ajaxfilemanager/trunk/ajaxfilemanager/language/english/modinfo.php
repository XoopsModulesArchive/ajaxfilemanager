<?php
// $Id: modinfo.php 2411 2008-11-14 21:01:07Z julionc $
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

// Module Info

// The name of this module
define('_AJAXFM_MI_NAME', 'AjaxFileManager');

// A brief description of this module
define('_AJAXFM_MI_DESC', 'For administration of files/contents/images of the site.');

// Names of admin menu items
define('_AJAXFM_MI_ADMENU_INDEX', 'Index');
define('_AJAXFM_MI_ADMENU_FTP', 'Ftp client');
define('_AJAXFM_MI_ADMENU_EXTENTION', 'Extention Manager');
define('_AJAXFM_MI_ADMENU_ABOUT', 'About');

// for config
define('_AJAXFM_MI_ROOTPATH', 'Website root path //IN PROGRESS');
define('_AJAXFM_MI_ROOTPATH_DESC', "1. create a php script file (let's call it document_root.php)<br />" .
         "2. add the following codes in in<br />" .
         "  &lt;?php<br />" .
         "      echo dirname(__FILE__);<br />" .
         "  ?&gt;<br />" .
         "3. upload document_root.php to you website root folder which will only be reached when you visit http://www.domain-name.com or http://localhost/ at localhost computer<br />" .
         "4. run it via http://www.domain-name.com/document_root.php or http://localhost/docuent_root.php if localhost computer, the url has to be exactly like that<br />" .
         "5. the value shown on the screen is CONFIG_WEBSITE_DOCUMENT_ROOT should be<br />" .
         "6. enjoy it");
define('_AJAXFM_MI_VALIDEXTS', 'Upload valid extensions');
define('_AJAXFM_MI_VALIDEXTS_DESC', 'extensions separated by comma (,)<br />For exemple: &quot;gif,jpg,png&quot;');
define('_AJAXFM_MI_MAXSIZE', 'MAx upload size');
define('_AJAXFM_MI_MAXSIZE_DESC', 'KBytes (1000 = 1MB)');
?>
