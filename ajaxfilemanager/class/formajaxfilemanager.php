<?php
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
            $element_text = new XoopsFormText(_FORMAJAXFILEMANAGER_FILEURL, $name, 70, 255, $value);
        $this->addElement($element_text);
            $filemanagerbutton = new XoopsFormButton ('', $name . 'button', _FORMAJAXFILEMANAGER_FILEMANAGER, "button");
            $filemanagerbutton->setExtra ("onclick='openWithSelfMain(&quot;" . XOOPS_URL . "/modules/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?editor=ajaxfilemanager&amp;config=ajaxfilemanager&amp;view=thumbnail&amp;language=" . _LANGCODE . "&amp;elementId={$name}&quot;,&quot;filemanager&quot;,800,600);'");
        $this->addElement($filemanagerbutton);
    }
}
?>