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
xoops_loadLanguage('formajaxfilemanager', 'ajaxfilemanager');

class FormAjaxFileManager extends XoopsFormElementTray
{
    /**
     * FormAjaxFileManager::FormAjaxFileManager()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param string $value 
     */
    function FormAjaxFileManager($caption, $name, $value = NULL)
    {
        $this->XoopsFormElementTray($caption, '&nbsp;');
            $element_text = new XoopsFormText(_FORMAJAXFILEMANAGER_FILEURL, $name, 70, 255, $value);
        $this->addElement($element_text);
            $filemanagerbutton = new XoopsFormButton ('', $name . 'button', _FORMAJAXFILEMANAGER_FILEMANAGER, "button");
            $filemanagerbutton->setExtra ("onclick='openWithSelfMain(&quot;" . XOOPS_URL . "/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=form&amp;config=ajaxfilemanager&amp;language=" . _LANGCODE . "&amp;elementId={$name}&quot;,&quot;filemanager&quot;,800,600);'");
        $this->addElement($filemanagerbutton);
    }
}
?>