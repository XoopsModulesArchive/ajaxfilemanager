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
xoops_loadLanguage('formmultiplexoopsimage', 'ajaxfilemanager');
xoops_load ('formxoopsimage', 'ajaxfilemanager'); // load custom form class

class FormMultipleXoopsImage extends XoopsFormElementTray
{
    /**
     * FormMultipleXoopsImage::FormXoopsImage()
     *
     * @param mixed $caption
     * @param mixed $name
     * @param array $values
     */
    function FormMultipleXoopsImage($caption, $name, $values = array())
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        $table_html = "
        <table>
        <tr>
            <td colspan='2'>" . "Enter Your Information" . "</td>
        </tr>";

        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEXOOPSIMAGE, $key);
            $element = new FormXoopsImage($capt, $name . "[$key]", $value);
            $table_html.= "<tr>";
            $table_html.= "<td>" . sprintf(_FORMMULTIPLEXOOPSIMAGE, $key) . "<br />"  . $element->render() . "</td>";
            $table_html.= "<td><input type='button' class='delRow' value='" . _FORMMULTIPLEXOOPSIMAGE_DELETEBUTTON . "'/></td>";
            $table_html.= "</tr>";
            unset($element);
        }

        $element = new FormXoopsImage($capt, $name . "[]", '');
        $table_html.= "<tr>";
        $table_html.= "<td>" . sprintf(_FORMMULTIPLEXOOPSIMAGE, " ") . "<br />" . $element->render() . "</td>";
        $table_html.= "<td><input type='button' class='delRow' value='" . _FORMMULTIPLEXOOPSIMAGE_DELETEBUTTON . "'/></td>";
        $table_html.= "</tr>";
        unset($element);

        $table_html.= "
        <tr>
            <td><input type='button' class='addRow' value='" . _FORMMULTIPLEXOOPSIMAGE_ADDBUTTON . "'/></td><td>&nbsp;</td>
        </tr>
        </table>
        <script type='text/javascript'>
        (function($){
            $(document).ready(function(){
                $('.addRow').btnAddRow();
                $('.delRow').btnDelRow();
            });
        })(jQuery);
        </script>";

        $element_table = new XoopsFormLabel ('', $table_html, $name . '_table');
        $this->addElement($element_table);
    }

    /**
     * XFormMultipleXoopsImage::render()
     *
     * @return
     */
    function render()
    {
        if (isset($GLOBALS['xoTheme'])) {
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
            $GLOBALS['xoTheme']->addScript('browse.php?modules/ajaxfilemanager/class/jquery.table.addrow.js');
            //$GLOBALS['xoTheme']->addScript('', '', $js);
        } else {
            echo '<script type="text/javascript" src="' . XOOPS_URL . '/Frameworks/jquery/jquery.js"></script>';
            echo '<script type="text/javascript">' . $js . '</script>';
        }
        return parent::render();//  . "<input type='reset' value=' ... ' onclick=\"return TCP.popup('" . XOOPS_URL . "/include/',document.getElementById('" . $this->getName() . "'));\">" ;
    }
}
?>