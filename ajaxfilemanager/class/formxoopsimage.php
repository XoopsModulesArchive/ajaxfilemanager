<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formxoopsimage', 'xaddresses');

class FormXoopsImage extends XoopsFormElementTray
{
    /**
     * FormXoopsImage::FormXoopsImage()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param string $value 
     */
    function FormXoopsImage($caption, $name, $value = NULL)
    {
        $this->XoopsFormElementTray($caption, '<br />');
            $imageurltray = new XoopsFormElementTray('', '&nbsp;');
                $element_text = new XoopsFormText(_FORMXOOPSIMAGE_IMAGEURL, $name, 70, 255, $value);
                $element_text->setExtra ("onchange='window.xoopsGetElementById(\"" . $name . "_image\").src = this.value;'");
            $imageurltray->addElement($element_text);
                $xoopsimagemanagerbutton = new XoopsFormButton ('', $name . 'button', _FORMXOOPSIMAGE_IMAGEMANAGER, "button");
                $xoopsimagemanagerbutton->setExtra ("onclick='openWithSelfMain(&quot;" . XOOPS_URL . "/modules/xaddresses/imagemanager/imagemanager.php?target=" . $name . "&quot;,&quot;imagemanager&quot;,800,600);'");
            $imageurltray->addElement($xoopsimagemanagerbutton);
        $this->addElement($imageurltray);
            $preview_html = "<img title='" . "PREVIEW" . "' id='" . $name . "_image' alt='" . _FORMXOOPSIMAGE_IMAGENOTFOUND . "' src='" . $value . "' style='width:auto;height:200px;'>";
            $element_preview = new XoopsFormLabel ('', $preview_html, $name . '_preview');
        $this->addElement($element_preview);
    }
}
?>