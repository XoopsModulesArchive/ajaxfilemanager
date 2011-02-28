<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * TextSanitizer extension
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         class
 * @subpackage      textsanitizer
 * @since           2.4.5
 * @author          Lucio ROta <lucio.rota@gmail.com>
 * @version         
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('extention', 'ajaxfilemanager');



class MytsAjaxfilemanager extends MyTextSanitizerExtension
{
    function encode($textarea_id)
    {
        $code = "<img " .
                "src='" . XOOPS_URL ."/class/textsanitizer/ajaxfilemanager/button_ajaxfilemanager.png' " .
                "title='" . _AJAXFM_AM_AJAXFILEMANAGER_ALT . "' " .
                "alt='" . _AJAXFM_AM_AJAXFILEMANAGER_ALT . "' " .
                "onclick='openWithSelfMain(&quot;" . XOOPS_URL ."/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail&amp;language=en&amp;elementId={$textarea_id}&quot;, &quot;ajaxfilemanager&quot;, 800, 600);' " .
                "onmouseover='style.cursor=\"hand\"'/>" .
                "&nbsp;";
        $javascript = "";

        return array(
            $code ,
            $javascript);
    }

    function load(&$ts)
    {
        //NOP
    }
}
?>