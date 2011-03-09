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