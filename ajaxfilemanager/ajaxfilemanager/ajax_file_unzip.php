<?php
// IN PROGRESS
// IN PROGRESS
// IN PROGRESS
/**
 * unzip selected file
 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link www.phpletter.com
 * @since 22/April/2007
 *
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");
$error = "";
if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_ZIP) {
    $error = SYS_DISABLED;
} elseif(!empty($_GET['zip'])) {
    //zip  the selected file from context menu
    if(!file_exists($_GET['zip'])) {
        $error = ERR_FILE_NOT_AVAILABLE;
    } elseif(!isUnderRoot($_GET['zip'])) {
        $error = ERR_FOLDER_PATH_NOT_ALLOWED;
    } else {
            include_once(CLASS_FILE);
            $file = new file();
            if(is_dir($_GET['zip']) 
                 &&  isValidPattern(CONFIG_SYS_INC_DIR_PATTERN, getBaseName($_GET['zip'])) 
                 && !isInvalidPattern(CONFIG_SYS_EXC_DIR_PATTERN, getBaseName($_GET['zip'])))
                {
                $file->delete(addTrailingSlash(backslashToSlash($_GET['zip'])));
            } elseif(is_file($_GET['zip']) 
                && isValidPattern(CONFIG_SYS_INC_FILE_PATTERN, getBaseName($_GET['zip']))
                && !isInvalidPattern(CONFIG_SYS_EXC_FILE_PATTERN, getBaseName($_GET['zip']))
                )
            {
                    $file->zip(($_GET['zip']));
                }
        } 
} else {
    if(!isset($_POST['selectedDoc']) || !is_array($_POST['selectedDoc']) || sizeof($_POST['selectedDoc']) < 1) {
        $error = ERR_NOT_FILE_SELECTED;
    } else {
        include_once(CLASS_FILE);
        $file = new file();
        foreach($_POST['selectedDoc'] as $doc) {
            if(file_exists($doc) && isUnderRoot($doc)) {
                if(is_dir($doc)
                     &&  isValidPattern(CONFIG_SYS_INC_DIR_PATTERN, $doc) 
                     && !isInvalidPattern(CONFIG_SYS_EXC_DIR_PATTERN, $doc))
                    {
                    $file->delete(addTrailingSlash(backslashToSlash($doc)));
                } elseif(is_file($doc) 
                     && isValidPattern(CONFIG_SYS_INC_FILE_PATTERN, $doc)
                     && !isInvalidPattern(CONFIG_SYS_EXC_FILE_PATTERN, $doc))
                {
                    $file->zip($doc);
                }
            }
        }
    }
}
echo "{error:'" . $error . "'}";
?>