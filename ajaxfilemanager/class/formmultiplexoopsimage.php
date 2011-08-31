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
    function FormMultipleXoopsImage($caption, $name, $size, $maxlength, $values = array(), $previewformat = null)
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        $table_html = "<table>";

        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEXOOPSIMAGE, $key);
            $element = new FormXoopsImage($capt, $name . "[$key]", $size, $maxlength, $value, $previewformat);
            $table_html.= "<tr>";
            $table_html.= "<td>";
            //$table_html.= sprintf(_FORMMULTIPLEXOOPSIMAGE, $key);
            //$table_html.= "<br />";
            $table_html.= $element->render();
            $table_html.= "</td>";
            $table_html.= "<td>";
            $table_html.= "<input type='button' class='delRow' value='" . _FORMMULTIPLEXOOPSIMAGE_DELETE . "'/>";
            $table_html.= "</td>";
            $table_html.= "</tr>";
            unset($element);
        }

        $capt = sprintf(_FORMMULTIPLEXOOPSIMAGE, '');
        $element = new FormXoopsImage($capt, $name . "[]", $size, $maxlength, '');
        $table_html.= "<tr>";
        $table_html.= "<td>";
        $table_html.= sprintf(_FORMMULTIPLEXOOPSIMAGE, " ");
        //$table_html.= "<br />";
        $table_html.= $element->render();
        $table_html.= "</td>";
        $table_html.= "<td>";
        $table_html.= "<input type='button' class='delRow' value='" . _FORMMULTIPLEXOOPSIMAGE_DELETE . "'/>";
        $table_html.= "</td>";
        $table_html.= "</tr>";
        unset($element);

        $table_html.= "<tr>";
        $table_html.= "<td>&nbsp;</td>";
        $table_html.= "<td><input type='button' class='addRow' value='" . _FORMMULTIPLEXOOPSIMAGE_NEW . "'/></td>";
        $table_html.= "</tr>";
        $table_html.= "</table>";
        $table_html.= "
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
            $GLOBALS['xoTheme']->addScript('http://code.jquery.com/jquery.min.js');
            $GLOBALS['xoTheme']->addScript('browse.php?modules/ajaxfilemanager/class/jquery.table.addrow.js');
            //$GLOBALS['xoTheme']->addScript('', '', $js);
        } else {
            echo '<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>';
            echo '<script type="text/javascript">' . $js . '</script>';
        }
        return parent::render();//  . "<input type='reset' value=' ... ' onclick=\"return TCP.popup('" . XOOPS_URL . "/include/',document.getElementById('" . $this->getName() . "'));\">" ;
    }
}
?>