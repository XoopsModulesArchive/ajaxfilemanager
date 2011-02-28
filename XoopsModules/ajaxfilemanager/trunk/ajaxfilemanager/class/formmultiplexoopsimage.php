<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formmultiplexoopsimage', 'xaddresses');
xoops_load ('formxoopsimage', 'xaddresses'); // load custom form class

class FormMultipleXoopsImage extends XoopsFormElementTray
{
    /**
     * FormMultipleXoopsImage::FormXoopsImage()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param array $values
     */
    function FormMultipleXoopsImage($caption, $name, $values = NULL)
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEXOOPSIMAGE, $key);
            $this->addElement(new FormXoopsImage($capt . '<br />', $name . "[$key]", $value));
        }
        $this->addElement(new FormXoopsImage(_FORMMULTIPLEXOOPSIMAGE_NEW . '<br />', $name . "[]", NULL));
    }
}
?>