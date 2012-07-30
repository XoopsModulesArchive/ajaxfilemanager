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

/**
 * File Manager core preloads
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @author          lucio rota <lucio.rota@gmail.com>
 */
class AjaxfilemanagerCorePreload extends XoopsPreloadItem
{
    function eventCoreClassXoopsformFormdhtmltextareaCodeicon($args)
    {
        /**
         * Load Module config
         */
        include_once XOOPS_ROOT_PATH . '/kernel/module.php';
        $ajaxfilemanagerModule = XoopsModule::getByDirname('ajaxfilemanager');
        if ($ajaxfilemanagerModule->getVar('hasconfig') == 1) {
            $config_handler =& xoops_gethandler('config');
            $ajaxfilemanagerModuleConfig = $config_handler->getConfigsByCat(0, $ajaxfilemanagerModule->getVar('mid'));
        }
        if (AjaxfilemanagerCorePreload::isActive()) {
            $lang = _LANGCODE;
            switch($ajaxfilemanagerModuleConfig['standard_imagemanager']) {
            case 'ajaxfilemanager' :
                $args[0] = str_replace('imagemanager.php?target=', 'modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail&amp;language=' . _LANGCODE . '&amp;elementId=', $args[0]);
                break;
            case 'enhanced' :
                $args[0] = str_replace('imagemanager.php?target=', 'modules/ajaxfilemanager/imagemanager/imagemanager.php?editor=bbcode&amp;target=', $args[0]);
                break;
            case 'standard' :
            default:
                $args[0] = $args[0];
                break;
            }
        }
    }

    function isActive()
    {
        $module_handler =& xoops_getHandler('module');
        $module = $module_handler->getByDirname('ajaxfilemanager');
        return ($module && $module->getVar('isactive')) ? true : false;
    }
}
?>