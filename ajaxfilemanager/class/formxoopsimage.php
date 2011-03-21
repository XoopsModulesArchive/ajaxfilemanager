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
xoops_loadLanguage('formxoopsimage', 'ajaxfilemanager');
/**
 * A simple text field
 */
class FormXoopsImage extends XoopsFormElement
{
    /**
     * Size
     *
     * @var int
     * @access private
     */
    var $_size;
    
    /**
     * Maximum length of the text
     *
     * @var int
     * @access private
     */
    var $_maxlength;
    
    /**
     * Initial text
     *
     * @var string
     * @access private
     */
    var $_value;
    
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param string $value Initial text
     */
    function FormXoopsImage($caption, $name, $value = '')
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->setValue($value);
    }
    
    /**
     * Get size
     *
     * @return int
     */
    function getSize()
    {
        return $this->_size;
    }
    
    /**
     * Get maximum text length
     *
     * @return int
     */
    function getMaxlength()
    {
        return $this->_maxlength;
    }
    
    /**
     * Get initial content
     *
     * @param bool $encode To sanitizer the text? Default value should be "true"; however we have to set "false" for backward compat
     * @return string
     */
    function getValue($encode = false)
    {
        return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
    }
    
    /**
     * Set initial text value
     *
     * @param  $value string
     */
    function setValue($value)
    {
        $this->_value = $value;
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
        $html = "<div>";
        $html.= "<input type='text' name='" . $this->getName() . "' title='" . $this->getTitle() . "' size='50' maxlength='255' value='" . $this->getValue() . "' />";
        $html.= "<img src='" . XOOPS_URL . "/images/image.gif' alt='" . _FORMXOOPSIMAGE_IMAGEMANAGER . "' title='" . _FORMXOOPSIMAGE_IMAGEMANAGER . "' onclick='randomId = Math.random().toString(); this.parentNode.firstChild.id = \"input_\" + randomId; openWithSelfMain(&quot;" . XOOPS_URL . "/modules/ajaxfilemanager/imagemanager/imagemanager.php?target=input_&quot; + randomId + &quot;&amp;editor=src&quot;,&quot;imagemanager&quot;,800,600);' onmouseover='style.cursor=\"hand\"'/>";
        $html.= "<div style='height:200px;'>";
        $html.= "<img src='" . $this->getValue() . "' style='height:200px;' alt='" . _FORMXOOPSIMAGE_IMAGENOTFOUND . "' />";
        $html.= "</div>";
        $html.= "</div>";
        return $html;
    }
}
?>