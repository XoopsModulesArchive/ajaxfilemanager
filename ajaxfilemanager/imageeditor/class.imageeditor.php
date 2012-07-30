<?php
include_once '../../../mainfile.php';
defined('XOOPS_ROOT_PATH') or die('Restricted access');
include_once("functions.php");


//xoops_loadLanguage('formxoopsimage', 'ajaxfilemanager');
/**
 * A simple text field
 */
class XoopsImageEditor
{
    /**
     * Initial text
     *
     * @var string
     * @access private
     */
    var $_elementId;

    /**
     * Initial text
     *
     * @var string
     * @access private
     */
    var $_value;

    /**
     * As src or as
     *
     * @var string
     * @access private
     */
    var $_asPath;

    /**
     * As path
     *
     * @var string
     * @access private
     */
    var $_sessionImagename;

    /**
     * As src or as
     *
     * @var string
     * @access private
     */
    var $_caption;

    var $_tempPath;
    var $_originalDirectory;
    var $_activeDirectory;
    var $_editDirectory;
    var $_undoDirectory;


    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param string $value Initial text
     * @param bool   $as_src If true image is passed as src, otherwise as php image data
     */
    function __construct($caption, $elementId, $value = '', $asPath = true)
    {
        if (empty($elementId)) {
            $elementId = md5(uniqid(rand(), true));
        }
        $this->setCaption($caption);
        $this->setElementId($elementId);
        $this->setValue($value);
        $this->setAsPath($asPath);
        
        $this->_tempPath = XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imageeditor/ImageEditor';
        $this->_originalDirectory = $this->_tempPath . '/original/';
        $this->_activeDirectory =   $this->_tempPath . '/active/';
        $this->_editDirectory =     $this->_tempPath . '/edit/';
        $this->_undoDirectory =     $this->_tempPath . '/undo/';

        // create directories if not exists
        ajaxfilemanager_makeDir($this->_originalDirectory);
        ajaxfilemanager_makeDir($this->_originalDirectory);
        ajaxfilemanager_makeDir($this->_activeDirectory);
        ajaxfilemanager_makeDir($this->_undoDirectory);
    }

    /**
     * Set initial caption
     *
     * @param  $value string
     */
    function setCaption($caption)
    {
        $this->_caption = $caption;
    }

    /**
     * Get as_src
     *
     * @return bool
     */
    function getCaption()
    {
        return $this->_caption;
    }


    /**
     * Set initial as_src value
     *
     * @param  $value string
     */
    function setElementId($elementId)
    {
        $this->_elementId = $elementId;
    }

    /**
     * Get as_src
     *
     * @return bool
     */
    function getElementId()
    {
        return $this->_elementId;
    }

    /**
     * Set initial asPath value
     *
     * @param  $value string
     */
    function setAsPath($asPath)
    {
        $this->_asPath = $asPath;
    }

    /**
     * Get asPath
     *
     * @return bool
     */
    function getAsPath()
    {
        return $this->_asPath;
    }

    /**
     * Get initial content
     *
     * @return string
     */
    function getValue()
    {
        return $this->_value;
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
        static $isImageEditorJsLoaded = false;

        garbage_collection($this->_originalDirectory);
        garbage_collection($this->_activeDirectory);
        garbage_collection($this->_editDirectory);
        garbage_collection($this->_undoDirectory);

        $imagePath = $this->getValue();
        $imageName = basename($imagePath);

        $this->_sessionImagename = session_id() . '_' . $imageName;
        if (!copy ($imagePath, $this->_originalDirectory . $this->_sessionImagename))
            exit('An error occurred #1');

        if (!copy ($this->_originalDirectory . $this->_sessionImagename, $this->_activeDirectory . $this->_sessionImagename)
            || !copy ($this->_originalDirectory . $this->_sessionImagename, $this->_editDirectory . $this->_sessionImagename)
            || !copy ($this->_originalDirectory . $this->_sessionImagename, $this->_undoDirectory . $this->_sessionImagename)) {
            exit('An error occurred #2');
        }

        xoops_loadLanguage('imageeditor', 'ajaxfilemanager');






        $output = '';



        if ( isset($GLOBALS['xoTheme']) && is_object($GLOBALS['xoTheme']) ) {
            if ( $isImageEditorJsLoaded==false ) {
                // Define Stylesheet
                $GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/ajaxfilemanager/imageeditor/ImageEditor/ImageEditor.css');
                // Define scripts
                $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
                $GLOBALS['xoTheme']->addScript('browse.php?modules/ajaxfilemanager/imageeditor/ImageEditor/PageInfo.js');
                $GLOBALS['xoTheme']->addScript('browse.php?modules/ajaxfilemanager/imageeditor/ImageEditor/ImageEditor.js');
                $GLOBALS['xoTheme']->addScript('', '', 'xoopsOnloadEvent(function(){ImageEditor.init("' . $this->_sessionImagename . '", "' . $this->getElementId() . '");})');
                $isImageEditorJsLoaded = true;
            }
        } else {
            if ( $isImageEditorJsLoaded==false ) {
                $output .= "<style>@import url(" . XOOPS_URL . "/modules/ajaxfilemanager/imageeditor/ImageEditor/ImageEditor.css" . ");</style>\n";
                $output .= "<script src='" . XOOPS_URL . "/Frameworks/jquery/jquery.js" . "' type='text/javascript'></script>\n";
                $output .= "<script src='" . XOOPS_URL . "/modules/ajaxfilemanager/imageeditor/ImageEditor/PageInfo.js" . "' type='text/javascript'></script>\n";
                $output .= "<script src='" . XOOPS_URL . "/modules/ajaxfilemanager/imageeditor/ImageEditor/ImageEditor.js" . "' type='text/javascript'></script>\n";
                $output .= "<script type='text/javascript'>" . "xoopsOnloadEvent(function(){ImageEditor.init('" . $this->_sessionImagename . "', '" . $this->getElementId() . "');})" . "</script>\n";
            }
        }

        $output.= "<div id='image-editor'>\n";
        //$output.= "<h3>" . $this->getCaption() . "</h3>\n";
        $output.= "<div class='toolbar'>";
        $output.= "<button onclick='ImageEditor.viewOriginal()'>" . _IMAGEEDITOR_VIEW_ORIGINAL . "</button>";
        $output.= "<button onclick='ImageEditor.viewActive()'>" . _IMAGEEDITOR_VIEW_ACTIVE . "</button>";
        $output.= "<button onclick='ImageEditor.save()'>" . _IMAGEEDITOR_SAVE_AS_ACTIVE . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.undo()'>" . _IMAGEEDITOR_UNDOREDO . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        //$output.= "<button onclick='location.href=\"" . $current_file . "?op=image.edit_update&file_id=" . $file_id . "\"'>" . _IMAGEEDITOR_SAVE_ACTIVE . "</button>";
        //$output.= "<button onclick='location.href=\"" . $current_file . "?op=image.edit_save_as_form&file_id=" . $file_id . "\"'>" . _IMAGEEDITOR_SAVE_EDITED_AS . "</button>";
        $output.= "</div>\n";

        $output.= "<div class='toolbar'>";
        $output.= "" . _IMAGEEDITOR_W . "<input id='txt-width' type='text' size='3' maxlength='4' />";
        $output.= "" . _IMAGEEDITOR_H . "<input id='txt-height' type='text' size='3' maxlength='4' />";
        $output.= "<input id='chk-constrain' type='checkbox' checked='checked' />" . _IMAGEEDITOR_CONSTRAIN . "";
        $output.= "<button onclick='ImageEditor.resize();'>" . _IMAGEEDITOR_RESIZE . "</button>";
        $output.= "<button onclick='ImageEditor.crop()'>" . _IMAGEEDITOR_CROP . "</button>";
        $output.= "<span id='crop-size'></span>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.mirror()'>" . _IMAGEEDITOR_MIRROR . "</button>";
        $output.= "<button onclick='ImageEditor.flip()'>" . _IMAGEEDITOR_FLIP . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.rotate(90)'>" . _IMAGEEDITOR_ROTATE_90CCW . "</button>";
        $output.= "<button onclick='ImageEditor.rotate(270)'>" . _IMAGEEDITOR_ROTATE_90CW . "</button>";
        $output.= "<button onclick='ImageEditor.rotate(document.getElementById(\"txt-deg\").value)'>" . _IMAGEEDITOR_ROTATE_1 . "</button>&nbsp;<input id='txt-deg' type='text' size='3' maxlength='4' />" . _IMAGEEDITOR_ROTATE_2 . "";
        $output.= "</div>\n";

        $output.= "<div class='toolbar'>";
        $output.= "<button onclick='ImageEditor.grayscale()'>" . _IMAGEEDITOR_GRAYSCALE . "</button>";
        $output.= "<button onclick='ImageEditor.sepia()'>" . _IMAGEEDITOR_SEPIA . "</button>";
        $output.= "<button onclick='ImageEditor.pencil()'>" . _IMAGEEDITOR_PENCIL . "</button>";
        $output.= "<button onclick='ImageEditor.emboss()'>" . _IMAGEEDITOR_EMBOSS . "</button>";
        $output.= "<button onclick='ImageEditor.sblur()'>" . _IMAGEEDITOR_BLUR . "</button>";
        $output.= "<button onclick='ImageEditor.smooth()'>" . _IMAGEEDITOR_SMOOTH . "</button>";
        $output.= "<button onclick='ImageEditor.invert()'>" . _IMAGEEDITOR_INVERT . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.brightnessdec()'>" . _IMAGEEDITOR_MINUS . "</button>";
        $output.= _IMAGEEDITOR_BRIGHTNESS;
        $output.= "<button onclick='ImageEditor.brightnessinc()'>" . _IMAGEEDITOR_PLUS . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.contrastinc()'>" . _IMAGEEDITOR_MINUS . "</button>";
        $output.= _IMAGEEDITOR_CONTRAST;
        $output.= "<button onclick='ImageEditor.contrastdec()'>" . _IMAGEEDITOR_PLUS . "</button>";
        $output.= "<span class='spacer'>" . _IMAGEEDITOR_SPACER . "</span>";
        $output.= "<button onclick='ImageEditor.colorize(document.getElementById(\"txt_red\").value, document.getElementById(\"txt_green\").value, document.getElementById(\"txt_blue\").value)'>" . _IMAGEEDITOR_COLORIZE . "</button>";
        $output.= "&nbsp;" . _IMAGEEDITOR_RED . "<input id='txt_red' type='text' size='3' maxlength='4' />";
        $output.= "&nbsp;" . _IMAGEEDITOR_GREEN . "<input id='txt_green' type='text' size='3' maxlength='4' />";
        $output.= "&nbsp;" . _IMAGEEDITOR_BLUE . "<input id='txt_blue' type='text' size='3' maxlength='4' />";
        $output.= "</div>\n";

        $output.= "<div id='" . $this->getElementId() . "'></div>\n";
        $output.= "</div>";
        return $output;
    }
}
?>