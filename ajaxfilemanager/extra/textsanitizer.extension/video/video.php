<?php
/**
 * TextSanitizer extension
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         class
 * @subpackage      textsanitizer
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: youtube.php 4897 2010-06-19 02:55:48Z phppp $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('extention', 'newfilemanager');



class MytsVideo extends MyTextSanitizerExtension
{
    function encode($textarea_id)
    {
        $config = parent::loadConfig( dirname(__FILE__) );
        $code = "<img " .
                "src='" . XOOPS_URL ."/class/textsanitizer/video/button_video.png' " . 
                "alt='" . _AJAXFM_AM_VIDEO_ALT . "' " .
                "onclick='xoopsCodeVideo(\"{$textarea_id}\",\"" . htmlspecialchars(_AJAXFM_AM_VIDEO_ENTERURL, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AJAXFM_AM_VIDEO_ENTERHEIGHT, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AJAXFM_AM_VIDEO_ENTERWIDTH, ENT_QUOTES) . "\");' " .
                "onmouseover='style.cursor=\"hand\"'/>" .
                "&nbsp;";
        $javascript = <<<EOH
            function xoopsCodeVideo(id, enterVideoPhrase, enterVideoHeightPhrase, enterVideoWidthPhrase)
            {
                var selection = xoopsGetSelect(id);
                if (selection.length > 0) {
                    var text = selection;
                } else {
                    var text = prompt(enterVideoPhrase, "");
                }
                var domobj = xoopsGetElementById(id);
                if ( text.length > 0 ) {
                    var text2 = prompt(enterVideoWidthPhrase, "425");
                    var text3 = prompt(enterVideoHeightPhrase, "350");
                    var result = "[video width="+text2+",height="+text3+"]" + text + "[/video]";
                    xoopsInsertText(domobj, result);
                }
                domobj.focus();
            }
EOH;

        return array($code, $javascript);
    }

    function load(&$ts)
    {
        $ts->patterns[] = "/\[video(.*)\]([^\"]*)\[\/video\]/esU";
        $ts->replacements[] = __CLASS__ . "::decode( '\\2', '\\1' )";
    }

    function decode($url, $arg)
    {
        static $isJwplayerJsLoaded = false;
        static $jwplayerId = 0;

        if ( !isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])  ) {
            include_once $GLOBALS['xoops']->path( "/class/theme.php" );
            $GLOBALS['xoTheme'] = new xos_opal_Theme();
            }
        if(!$isJwplayerJsLoaded ) {
            $isJwplayerJsLoaded = true;
            $GLOBALS['xoTheme']->addScript(XOOPS_URL . '/class/textsanitizer/video/jwplayer/swfobject.js');
        }
        //error_log(print_r($GLOBALS,true));
        //if (!preg_match("/^http:\/\/(www\.)?youtube\.com\/watch\?v=(.*)/i", $url, $matches)) {
        //    trigger_error("Not matched: {$url} {$width} {$height}", E_USER_WARNING);
        //    return "";
        //}
        $parsArray = array(
            'name' => 'Jwplayer_' . $jwplayerId++,
            'style' => '',
            'width' => 200,
            'height' => 200,
            'autostart' => 'true',
            'allowfullscreen' => 'true',
            );
        if (!empty($arg)) {
            $argArray = explode(',', $arg);
            foreach($argArray as $value) {
                $valueArray = explode('=', $value);
                $parsArray[trim($valueArray[0])] = trim($valueArray[1]);
            }
        }

        $html = "<div id='{$parsArray['name']}' style='{$parsArray['style']}'>" . _AJAXFM_AM_VIDEO_LOADHERE . "</div>";
        $js = "xoopsOnloadEvent(function(){\n" .
              "    so = new SWFObject('" . XOOPS_URL . "/class/textsanitizer/video/jwplayer/player.swf', '{$parsArray['name']}', '{$parsArray['width']}', '{$parsArray['height']}', '9');\n" .
              "    so.addParam('allowfullscreen', '{$parsArray['allowfullscreen']}');\n" .
              "    so.addParam('allowscriptaccess', 'always');\n" .
              "    so.addVariable('file', '{$url}');\n" .
              "    so.addVariable('autostart', '{$parsArray['autostart']}');\n" .
              "    so.write('{$parsArray['name']}');\n" .
              "});\n";
        $GLOBALS['xoTheme']->addScript('', '' ,$js);
        return $html;
    }
}
?>