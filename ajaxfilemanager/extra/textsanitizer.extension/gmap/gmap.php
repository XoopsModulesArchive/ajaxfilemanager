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

defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('extension', 'ajaxfilemanager');



class MytsGmap extends MyTextSanitizerExtension
{
    function encode($textarea_id)
    {
        $config = parent::loadConfig( dirname(__FILE__) );
        $code = "<img " .
                "src='" . XOOPS_URL ."/class/textsanitizer/gmap/button_gmap.png' " . 
                "title='" . _AJAXFM_AM_GMAP_ALT . "' " .
                "alt='" . _AJAXFM_AM_GMAP_ALT . "' " .
                "onclick='xoopsCodeGmap(\"{$textarea_id}\",\"" . htmlspecialchars(_AJAXFM_AM_GMAP_ENTERURL, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AJAXFM_AM_GMAP_ENTERHEIGHT, ENT_QUOTES) . "\",\"" . htmlspecialchars(_AJAXFM_AM_GMAP_ENTERWIDTH, ENT_QUOTES) . "\");' " .
                "onmouseover='style.cursor=\"hand\"'/>" .
                "&nbsp;";
        $javascript = <<<EOH
            function xoopsCodeGmap(id, enterGmapPhrase, enterGmapHeightPhrase, enterGmapWidthPhrase)
            {
                var selection = xoopsGetSelect(id);
                if (selection.length > 0) {
                    var text = selection;
                } else {
                    var text = prompt(enterGmapPhrase, "");
                }
                var domobj = xoopsGetElementById(id);
                if ( text.length > 0 ) {
                    var text2 = prompt(enterGmapWidthPhrase, "425");
                    var text3 = prompt(enterGmapHeightPhrase, "350");
                    var result = "[gmap width="+text2+",height="+text3+"]" + text + "[/gmap]";
                    xoopsInsertText(domobj, result);
                }
                domobj.focus();
            }
EOH;

        return array($code, $javascript);
    }

    function load(&$ts)
    {
        $ts->patterns[] = "/\[gmap(.*)\]([^\"]*)\[\/gmap\]/esU";
        $ts->replacements[] = __CLASS__ . "::decode( '\\2', '\\1' )";
    }

    function decode($url, $arg)
    {
        static $isGoogleMapJsLoaded = false;
        static $googleMapId = 0;
        
        if ( !isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])  ) {
            include_once $GLOBALS['xoops']->path( "/class/theme.php" );
            $GLOBALS['xoTheme'] = new xos_opal_Theme();
            }
        if(!$isGoogleMapJsLoaded ) {
            $isGoogleMapJsLoaded = true;
            $GLOBALS['xoTheme']->addScript('http://maps.google.com/maps/api/js?sensor=false');
        }
        //if (!preg_match("/^http:\/\/(www\.)?youtube\.com\/watch\?v=(.*)/i", $url, $matches)) {
        //    trigger_error("Not matched: {$url} {$width} {$height}", E_USER_WARNING);
        //    return "";
        //}
        $parsArray = array(
            'name' => 'GoogleMap_' . $googleMapId++,
            'lat' => 0,
            'lng' => 0,
            'zoom' => 8,
            'style' => 'width:200px;height:200px;',
            'width' => 200,
            'height' => 200,
            );
        if (!empty($arg)) {
            $argArray = explode(',', $arg);
            foreach($argArray as $value) {
                $valueArray = explode('=', $value);
                $parsArray[trim($valueArray[0])] = trim($valueArray[1]);
            }
        }

        $html = "<div id='{$parsArray['name']}' style='{$parsArray['style']}'>GOOGLE MAP HERE...</div>";
        $js = "xoopsOnloadEvent(function(){\n" .
              "    var myLatlng = new google.maps.LatLng({$parsArray['lat']}, {$parsArray['lng']});\n" .
              "    var myOptions = {\n" .
              "        zoom: {$parsArray['zoom']},\n" .
              "        center: myLatlng,\n" .
              "        mapTypeId: google.maps.MapTypeId.ROADMAP\n" .
              "    };\n" .
              "    var map = new google.maps.Map(document.getElementById('{$parsArray['name']}'), myOptions);\n" .
              "    var georssLayer = new google.maps.KmlLayer('{$url}');\n" .
              "    georssLayer.setMap(map);\n" .
              "});\n";
        $GLOBALS['xoTheme']->addScript('', '' ,$js);
        return $html;
    }
}
?>