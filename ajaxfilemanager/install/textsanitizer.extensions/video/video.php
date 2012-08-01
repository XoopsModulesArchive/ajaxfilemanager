<?php
/**
 * ****************************************************************************
 *  - A Project by Developers TEAM For Xoops - ( http://www.xoops.org )
 * ****************************************************************************
 *  AJAXFILEMANAGER - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           1.0
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('extension', 'ajaxfilemanager');



class MytsVideo extends MyTextSanitizerExtension
{
    function encode($textarea_id)
    {
        $config = parent::loadConfig( dirname(__FILE__) );
        $code = "<img " .
                "src='" . XOOPS_URL ."/class/textsanitizer/video/button_video.png' " . 
                "title='" . _AM_AJAXFM_VIDEO_ALT . "' " .
                "alt='" . _AM_AJAXFM_VIDEO_ALT . "' " .
                "onclick='xoopsCodeVideo(\"{$textarea_id}\",\"" . htmlspecialchars(_AM_AJAXFM_VIDEO_ENTERURL, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AM_AJAXFM_VIDEO_ENTERHEIGHT, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AM_AJAXFM_VIDEO_ENTERWIDTH, ENT_QUOTES) . "\");' " .
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

        require_once $GLOBALS['xoops']->path('class/template.php');

        $xoopsJsTpl = new XoopsTpl();
        $xoopsJsTpl->assign('video_id', $parsArray['name']);
        $xoopsJsTpl->assign('video_width', $parsArray['width']);
        $xoopsJsTpl->assign('video_height', $parsArray['height']);
        $xoopsJsTpl->assign('video_allowfullscreen', $parsArray['allowfullscreen']);
        $xoopsJsTpl->assign('video_url', $url);
        $xoopsJsTpl->assign('video_autostart', $parsArray['autostart']);
        $xoopsJsTpl->assign('video_parsArray', $parsArray); // array of parameters
        $js = $xoopsJsTpl->fetch('db:ajaxfm_video.js');
        unset($xoopsJsTpl);
        $GLOBALS['xoTheme']->addScript('', '', $js);

        $xoopsHtmlTpl = new XoopsTpl();
        $xoopsHtmlTpl->assign('video_id', $parsArray['name']);
        $xoopsHtmlTpl->assign('video_style', $parsArray['style']);
        $xoopsHtmlTpl->assign('video_parsArray', $parsArray); // array of parameters
        $html = $xoopsHtmlTpl->fetch('db:ajaxfm_video.html');
        unset($xoopsHtmlTpl);
        return $html;
    }
}
