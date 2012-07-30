<?php
/**
 * Ajax File Manager
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           0.1
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */

include 'admin_header.php';
$currentFile = basename(__FILE__);
$versionInfo =& $module_handler->get($xoopsModule->getVar('mid'));

// load classes

// get/check parameters/post

// render start here
xoops_cp_header();

echo "
    <style type=\"text/css\">
    label,text {
        display: block;
        float: left;
        margin-bottom: 2px;
    }
    label {
        text-align: right;
        width: 150px;
        padding-right: 20px;
    }
    br {
        clear: left;
    }
    </style>
";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . $xoopsModule->getVar('name'). "</legend>";
echo "<div style='padding: 8px;'>";
echo "<img src='" . XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/" . $versionInfo->getInfo('image') . "' alt='' hspace='10' vspace='0' /></a>\n";
echo "<div style='padding: 5px;'><strong>" . $versionInfo->getInfo('name') . " version " . $versionInfo->getInfo('version') . "</strong></div>\n";
echo "<label>" . _AM_AJAXFM_ABOUT_RELEASEDATE . ":</label><text>" . date(_SHORTDATESTRING, $versionInfo->getInfo('release')) . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_AUTHOR . ":</label><text>" . $versionInfo->getInfo('author') . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_CREDITS . ":</label><text>" . $versionInfo->getInfo('credits') . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_LICENSE . ":</label><text><a href=\"".$versionInfo->getInfo('license_file')."\" target=\"_blank\" >" . $versionInfo->getInfo('license') . "</a></text>\n";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_MODULEINFOS . "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" . _AM_AJAXFM_ABOUT_STATUS . ":</label><text>" . $versionInfo->getInfo('module_status') . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_MODULEWEBSITE . ":</label><text>" . "<a href='" . $versionInfo->getInfo('support_site_url') . "' target='_blank'>" . $versionInfo->getInfo('support_site_name') . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_AUTHORINFOS . "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" . _AM_AJAXFM_ABOUT_AUTHOR . ":</label><text>" . $versionInfo->getInfo('author') . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_AUTHORWEBSITE . ":</label><text>" . "<a href='" . $versionInfo->getInfo('author_website_url') . "' target='_blank'>" . $versionInfo->getInfo('author_website_name') . "</a>" . "</text><br />";
echo "<label>" . _AM_AJAXFM_ABOUT_AUTHOREMAIL . ":</label><text>" . "<a href='emailto:" . $versionInfo->getInfo('author_mail') . "' target='_blank'>" . $versionInfo->getInfo('author_mail') . "</a>" . "</text><br />";
echo "</div>";

echo "<br />";

// DONATE PAYPAL
$donate = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>';
echo "<div style='padding: 8px;'>";
echo $donate;
echo "</div>";

echo "</fieldset>";
echo "<br clear=\"all\" />";

// get language 'description.html' file 
if (file_exists(XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/description.html")) {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/description.html";
} else {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/english/description.html";
}
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_DESCRIPTION . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>". implode('', file($file)) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

// get language 'changelog.txt' file 
if (file_exists(XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/changelog.txt")) {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/" . $xoopsConfig['language'] . "/changelog.txt";
} else {
    $file = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/language/english/changelog.txt";
}
if (is_readable($file)) {
    echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_AJAXFM_ABOUT_CHANGELOG . "</legend>";
    echo "<div style='padding: 8px;'>";
    echo "<div>" . utf8_encode(implode('<br />', file($file))) . "</div>";
    echo "</div>";
    echo "</fieldset>";
    echo "<br clear=\"all\" />";
}

xoops_cp_footer();
?>