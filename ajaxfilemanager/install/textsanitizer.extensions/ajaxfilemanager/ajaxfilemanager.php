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



class MytsAjaxfilemanager extends MyTextSanitizerExtension
{
    function encode($textarea_id)
    {
        // use Ajax File Manager permission check
        include_once XOOPS_ROOT_PATH . '/kernel/module.php';
        $ajaxfilemanagerModule = XoopsModule::getByDirname('ajaxfilemanager');
        $gpermHandler =& xoops_gethandler('groupperm');
        $groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $permAccess = ($gpermHandler->checkRight('ajaxfilemanager_extra', 1, $groups, $ajaxfilemanagerModule->getVar('mid'))) ? true : false ;
        if ($permAccess) {
            $code = "<img " .
                    "src='" . XOOPS_URL ."/class/textsanitizer/ajaxfilemanager/button_ajaxfilemanager.png' " .
                    "title='" . _AM_AJAXFM_AJAXFILEMANAGER_ALT . "' " .
                    "alt='" . _AM_AJAXFM_AJAXFILEMANAGER_ALT . "' " .
                    "onclick='openWithSelfMain(&quot;" . XOOPS_URL ."/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;language=" . _LANGCODE . "&amp;elementId={$textarea_id}&quot;, &quot;ajaxfilemanager&quot;, 800, 600);' " .
                    "onmouseover='style.cursor=\"hand\"'/>" .
                    "&nbsp;";
            $javascript = "";
        } else {
            $code = '';
            $javascript = '';
        }

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