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
 * @version         $Id: formxoopsimage.php 6335 2011-03-09 21:27:37Z luciorota $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formxoopsimage', 'ajaxfilemanager');

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
                $element_text->setExtra ("onchange='xoopsGetElementById(\"" . $name . "_image\").src = this.value;'");
            $imageurltray->addElement($element_text);
                $button_html = "<img src='" . XOOPS_URL . "/images/image.gif' alt='" . _FORMXOOPSIMAGE_IMAGEMANAGER . "' title='" . _FORMXOOPSIMAGE_IMAGEMANAGER . "' onclick='openWithSelfMain(&quot;" . XOOPS_URL . "/modules/ajaxfilemanager/imagemanager/imagemanager.php?target=" . $name . "&amp;editor=src&quot;,&quot;imagemanager&quot;,800,600);' onmouseover='style.cursor=\"hand\"'/>";
                $xoopsimagemanagerbutton = new XoopsFormLabel ('', $button_html, $name . '_button');
            $imageurltray->addElement($xoopsimagemanagerbutton);
        $this->addElement($imageurltray);
            $preview_html = "<img title='" . "PREVIEW" . "' id='" . $name . "_image' alt='" . _FORMXOOPSIMAGE_IMAGENOTFOUND . "' src='" . $value . "' style='width:auto;height:200px;'>";
            $element_preview = new XoopsFormLabel ('', $preview_html, $name . '_preview');
        $this->addElement($element_preview);
    }
}
?>