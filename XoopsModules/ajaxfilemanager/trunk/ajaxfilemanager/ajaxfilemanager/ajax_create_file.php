<?php
/**
 * create a file
 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link www.phpletter.com
 * @since 22/May/2007
 * @author Rota Lucio (lucio [dot] rota [at] gmail [dot] com)
 * @link 
 * @since 24/March/2011
 *
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");	
@ob_start();
displayArray($_POST);
writeInfo(@ob_get_clean());	

$error = "";
$info = "";	
/*
$_POST['new_file'] = substr(md5(time()), 1, 5);
$_POST['currentFilePath'] = "../../uploaded/";
*/
if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_NEWFILE) {
    $error = SYS_DISABLED;
} elseif(empty($_POST['new_file'])) {
    $error  =  ERR_FILE_NAME_EMPTY;
} elseif(!preg_match("/^[a-zA-Z0-9_\- ]+$/", $_POST['new_file'])) {
    $error  =  ERR_FILE_FORMAT;
} else if(empty($_POST['currentFilePath']) || !isUnderRoot($_POST['currentFilePath'])) {
    $error = ERR_FILE_PATH_NOT_ALLOWED;
} elseif(file_exists(addTrailingSlash($_POST['currentFilePath']) . $_POST['new_file'] . '.' . $_POST['ext'] )) {
    $error = ERR_FILE_EXISTS;
} else {
    include_once(CLASS_FILE);
    $file = new file();
    if($file->mkfile(addTrailingSlash($_POST['currentFilePath']) . $_POST['new_file'] . '.' . $_POST['ext'], 0775)) {
        include_once(CLASS_MANAGER);
        $manager = new manager(addTrailingSlash($_POST['currentFilePath']) . $_POST['new_file'] . '.' . $_POST['ext'], false);
        $pathInfo = $manager->getFolderInfo(addTrailingSlash($_POST['currentFilePath']) . $_POST['new_file'] . '.' . $_POST['ext']);
        $filePath = addTrailingSlash($_POST['currentFilePath']) . $_POST['new_file'] . '.' . $_POST['ext'];
        $fileType = $manager->getFileType($filePath, false);
        $fileType['name'] = $_POST['new_file'] . '.' . $_POST['ext']; // IN PROGRESS
        $fileType['is_writable'] = true;
        $fileType['is_readable'] = true;
        $fileType['type'] = 'file';
        foreach($fileType as $k=>$v) {
            switch ($k) {
            case "ctime";
            case "mtime":
            case "atime":
                $v = date(DATE_TIME_FORMAT, $v);
                break;
            case 'name':
                $info .= sprintf(", %s:'%s'", 'short_name', shortenFileName($v));
                break;
            //case 'cssClass':
                //$v = 'folderEmpty';
                //break;
            }
            $info .= sprintf(", %s:'%s'", $k, $v);
        }
    } else {
        $error = ERR_FILE_CREATION_FAILED;
    }
    //$error = "For security reason, file creation function has been disabled.";
}

echo "{";
echo "error:'" . $error . "'";
echo $info;
echo "}";
?>