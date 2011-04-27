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

function moduleAdminTabMenu($adminmenu = array(), $currentFile = 0, $breadcrumb = " &gt; ")
{
    if (is_int($currentFile)) {
        $currentOption = $currentFile;
    } else if (is_string($currentFile)) {
        foreach($adminmenu as $key=>$adminitem ) {
            preg_match( "/.*[\\/]([^\\/]+.php)\?*.*/", $adminitem['link'], $matches);
            if ($matches[1] == $currentFile) $currentOption = $key;
        }
    } else {
        return false;
    }

    $moduleLink = XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/';
    /* Nice buttons styles */
    $adminTabCss = "
        <style type='text/css'>
        #buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
        #buttonbar { float:left; width:100%; background: #e7e7e7 url('" . $moduleLink . "images/deco/bg.png') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
        #buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
        #buttonbar li { display:inline; margin:0; padding:0; }
        #buttonbar a { float:left; background:url('" . $moduleLink . "images/deco/left_both.png') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
        #buttonbar a span { float:left; display:block; background:url('" . $moduleLink . "images/deco/right_both.png') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
        /* Commented Backslash Hack hides rule from IE5-Mac \*/
        #buttonbar a span {float:none;}
        /* End IE5-Mac hack */
        #buttonbar a:hover span { color:#333; }
        #buttonbar .current a { background-position:0 -150px; border-width:0; }
        #buttonbar .current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
        #buttonbar a:hover { background-position:0% -150px; }
        #buttonbar a:hover span { background-position:100% -150px; }
        div.CPbigTitle{
            font-size: 12px;
            color: #606060;
            background: no-repeat left top;
            font-weight: bold;
            height: 30px;
            vertical-align: middle;
            padding: 10px 0 0 40px;
            /*border-bottom: 3px solid #393e41;*/
            border-bottom: none;
        }
        </style>
    ";
    
    global $xoopsConfig;
    xoops_loadLanguage('modinfo', $GLOBALS['xoopsModule']->getVar('dirname'));

    $adminTabHtml = '';
    $adminTabHtml.= "<div id='buttontop'>";
    $adminTabHtml.= "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
    $adminTabHtml.= "<td style='font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;'>";
    $adminTabHtml.= "<a class='nobutton' href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $GLOBALS['xoopsModule']->getVar('mid') . "'>" . _PREFERENCES . "</a>";
    $adminTabHtml.= " | ";
    $adminTabHtml.= "<a href='" . $moduleLink . "index.php'>" . $GLOBALS['xoopsModule']->getVar('name') . "</a>";
    $adminTabHtml.= "</td>";
    $adminTabHtml.= "<td style='font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;'><b>" . $GLOBALS['xoopsModule']->getVar('name') . $breadcrumb . $adminmenu[$currentOption]["title"] . "</b> </td>";
    $adminTabHtml.= "</tr></table>";
    $adminTabHtml.= "</div>";
    
    $adminTabHtml.= "<div id='buttonbar'>";
    $adminTabHtml.= "<ul>";

    foreach(array_keys($adminmenu) as $key ) {
        $adminTabHtml.= (($currentOption == $key)? '<li class="current">':'<li>') . '<a href="' . $moduleLink . $adminmenu[$key]["link"] . '"><span>' . $adminmenu[$key]["title"] . '</span></a></li>';
    }

    $adminTabHtml.= "</ul></div>";
    $adminTabHtml.= "<br style='clear:both;' >";

    $adminTabHtml.= '<div class="CPbigTitle" style="background-image: url(../' . $adminmenu[$currentOption]["icon"] .'); background-repeat: no-repeat; background-position: left; padding-left: 48px; height: 48px;">';
    $adminTabHtml.= '<strong>' . $adminmenu[$currentOption]["title"] . '</strong>';
    $adminTabHtml.= '</div>';

    return $adminTabCss . $adminTabHtml;
}



function moduleAdminSubmenu ($submenuItems) {
    echo "<div class='head'>";
    echo implode($submenuItems, ' | ');
    echo "</div>";
}
?>