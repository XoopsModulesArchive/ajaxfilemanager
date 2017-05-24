<?php
$current_file = basename(__FILE__);

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('NWLINE')or define('NWLINE', "\n");

include_once '../../../include/cp_header.php';

// Include module functions
xoops_cp_header();

echo "<h3>DEMO IMAGE EDITOR</h3>";
$path = "C:/Users/lucio/Desktop/logo_caritas.jpg";

//$myts = MyTextSanitizer::getInstance();
//$path = $myts->addSlashes($path);

echo '<img onmouseover="style.cursor=&quot;hand&quot;" onclick="openWithSelfMain(&quot;http://localhost/xoops.245/modules/ajaxfilemanager/imageeditor/imageeditor.php?editor=bbcode&amp;path=' . $path . '&quot;,&quot;imgeditor&quot;,800,600);" title="Inside images" alt="Inside images" src="http://localhost/xoops.245/modules/ajaxfilemanager/imageeditor/images/imageeditor.gif" style="">';

xoops_cp_footer();
?>