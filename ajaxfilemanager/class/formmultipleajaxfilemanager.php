<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formmultiajaxfilemanager', 'ajaxfilemanager');
xoops_load ('formajaxfilemanager', 'ajaxfilemanager'); // load custom form class

class FormMultipleAjaxFileManager extends XoopsFormElementTray
{
    /**
     * FormMultipleAjaxFileManager::FormMultipleAjaxFileManager()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param array $values
     */
    function FormMultipleAjaxFileManager($caption, $name, $values = NULL)
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEAJAXFILEMANAGER, $key);
            $this->addElement(new FormAjaxFileManager($capt . '<br />', $name . "[$key]", $value));
        }
        $this->addElement(new FormFileManager(_FORMMULTIPLEAJAXFILEMANAGER_NEW . '<br />', $name . "[]", NULL));
    }
}
?>