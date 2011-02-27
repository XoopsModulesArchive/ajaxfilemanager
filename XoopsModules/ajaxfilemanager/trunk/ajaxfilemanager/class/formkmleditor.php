<?php
defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formkmleditor', 'xaddresses');

class FormKmlEditor extends XoopsFormElementTray
{
    /**
     * FormXoopsImage::FormKmlEditor()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param string $value 
     */
    function FormKmlEditor($caption, $name, $value = NULL)
    {
        $this->XoopsFormElementTray($caption, '<br />');
            $textarea = new XoopsFormTextArea(_FORMKLMEDITOR_KMLCODE . '<br />', $name, $value, 6, 60);
            //$element_textarea->setExtra ("onchange='window.xoopsGetElementById(\"" . $name . "_image\").src = this.value;'");
        $this->addElement($textarea);
            $kmleditorbutton = new XoopsFormButton ('', $name . 'button', _FORMKMLEDITOR_KMLEDITOR, "button");
            $kmleditorbutton->setExtra ("onclick=\"openWithSelfMain(&quot;" . XOOPS_URL . "/modules/xaddresses/kmleditor/kmleditor.php?target=" . $name . "&quot;,&quot;kmleditor&quot;,800,600);\"");
        $this->addElement($kmleditorbutton);
    }
}
?>