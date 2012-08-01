<?php
/**
 * ****************************************************************************
 *  - A Project by Developers TEAM For Xoops - ( http://www.xoops.org )
 * ****************************************************************************
 *  AJAXFILEMANAGER - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           1.0
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');
xoops_loadLanguage('formmultipleajaxfilemanager', 'ajaxfilemanager');
xoops_load ('formajaxfilemanager', 'ajaxfilemanager'); // load custom form class

class FormMultipleAjaxFileManager extends XoopsFormElementTray
{
    /**
     * FormMultipleAjaxFileManager::FormMultipleAjaxFileManager()
     *
     * @param mixed $caption
     * @param mixed $name "name" attribute
     * @param int   $size Size
     * @param int   $maxlength Maximum length of text
     * @param array $values
     */
    function FormMultipleAjaxFileManager($caption, $name, $size, $maxlength, $values = array())
    {
        $this->XoopsFormElementTray($caption, '<hr />');
        $table_html = "";
        $table_html.= "<table>";

        foreach ($values as $key=>$value) {
            $capt = sprintf(_FORMMULTIPLEAJAXFILEMANAGER, $key);
            $element = new FormAjaxFileManager($capt, $name . "[$key]", $size, $maxlength, $value);
            $table_html.= "<tr>";
            $table_html.= "<td>";
            //$table_html.= sprintf(_FORMMULTIPLEAJAXFILEMANAGER, $key);
            //$table_html.= "<br />";
            $table_html.= $element->render();
            $table_html.= "</td>";
            $table_html.= "<td>";
            $table_html.= "<input type='button' class='delRow' value='" . _FORMMULTIPLEAJAXFILEMANAGER_DELETE . "' />";
            $table_html.= "</td>";
            $table_html.= "</tr>";
            unset($element);
        }

        $capt = sprintf(_FORMMULTIPLEAJAXFILEMANAGER, '');
        $element = new FormAjaxFileManager($capt, $name . "[]", $size, $maxlength, NULL);
        $table_html.= "<tr>";
        $table_html.= "<td>";
        $table_html.= sprintf(_FORMMULTIPLEAJAXFILEMANAGER, "");
        //$table_html.= "<br />";
        $table_html.= $element->render();
        $table_html.= "</td>";
        $table_html.= "<td>";
        $table_html.= "<input type='button' class='delRow' value='" . _FORMMULTIPLEAJAXFILEMANAGER_DELETE . "' />";
        $table_html.= "</td>";
        $table_html.= "</tr>";
        unset($element);

        $table_html.= "<tr>";
        $table_html.= "<td>&nbsp;</td>";
        $table_html.= "<td><input type='button' class='addRow' value='" . _FORMMULTIPLEAJAXFILEMANAGER_NEW . "' /></td>";
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
     * FormMultipleAjaxFileManager::render()
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
