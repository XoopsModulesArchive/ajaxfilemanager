<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formmultiplefilemanager', 'xaddresses');
xoops_load ('formxoopsfilemanager', 'xaddresses'); // load custom form class

class FormMultipleFileManager extends XoopsFormElementTray
{
    /**
     * FormMultipleFileManager::FormXoopsImage()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param array $values
     */
    function FormMultipleFileManager($caption, $name, $values = NULL)
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEFILEMANAGER, $key);
            $this->addElement(new FormFileManager($capt . '<br />', $name . "[$key]", $value));
        }
        $this->addElement(new FormFileManager(_FORMMULTIPLEFILEMANAGER_NEW . '<br />', $name . "[]", NULL));
    }
}
?>