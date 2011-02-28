<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formfilemanager', 'xaddresses');

class FormFileManager extends XoopsFormElementTray
{
    /**
     * FormFileManager::FormFileManager()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param string $value 
     */
    function FormFileManager($caption, $name, $value = NULL)
    {
            $element_text = new XoopsFormText(_FORMFILEMANAGER_FILEURL, $name, 70, 255, $value);
        $this->addElement($element_text);
            $filemanagerbutton = new XoopsFormButton ('', $name . 'button', _FORMFILEMANAGER_FILEMANAGER, "button");
            $filemanagerbutton->setExtra ("onclick='openWithSelfMain(&quot;" . XOOPS_URL . "/modules/xaddresses/ajaxfilemanager/ajaxfilemanager.php?editor=xoops&amp;config=xoops&amp;view=thumbnail&amp;language=" . "en" . "&amp;elementId=" . $name . "&quot;,&quot;filemanager&quot;,800,430);'");
        $this->addElement($filemanagerbutton);
    }
}
?>