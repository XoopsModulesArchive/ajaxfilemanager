<?php
/**
 * zip selected files
 * @author Lucio Rota (lucio [dot] rota [at] gmail [dot] com)
 * @since 28/March/2011
 *
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");

$error = "";
if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_ZIP) {
    $error = SYS_DISABLED;
} elseif(count($_POST['zip_name']) == 0) {
    $error = ERR_NAME_EMPTY;
} elseif(!preg_match("/^[a-zA-Z0-9 _\-.]+$/", $_POST['zip_name'])) {
    $error = ERR_NAME_FORMAT;
} elseif(file_exists(addTrailingSlash(getParentPath($_POST['zip_path'])) . DIRECTORY_SEPARATOR . $_POST['zip_name'] . '.zip')) {
    $error = ERR_ZIP_EXIST;
} elseif(!isset($_POST['zip_path']) || empty($_POST['zip_path'])) {
    $error = ERR_NOT_FILE_SELECTED;
}

if($error == "") {
    $filesToZip = array();
    if (isset($_POST['zip_selected'])) {
        $filesToZip = $_POST['zip_selected'];
    } else {
        $filesToZip[] = $_POST['zip_path'];
    }
    // convert paths from relative to absolute
    foreach ($filesToZip as $key => $value) {
        $filesToZip[$key] = backslashToSlash(getRealPath($value));
    }
    $relativeTo = backslashToSlash(getParentPath(getRealPath($_POST['zip_path'])));
    $zipFilePath = backslashToSlash((addTrailingSlash(getParentPath($_POST['zip_path'])) . DIRECTORY_SEPARATOR . $_POST['zip_name'] . '.zip'));

    // get all files and sub files
    function dir_tree($dir) {
        $path = '';
        $stack[] = $dir;
        while ($stack) {
            $thisdir = array_pop($stack);
            if ($dircont = scandir($thisdir)) {
                $i=0;
                while (isset($dircont[$i])) {
                    if ($dircont[$i] !== '.' && $dircont[$i] !== '..') {
                        $current_file = "{$thisdir}/{$dircont[$i]}";
                        if (is_file($current_file)) {
                            $path[] = "{$thisdir}/{$dircont[$i]}";
                        } elseif (is_dir($current_file)) {
                            $path[] = "{$thisdir}/{$dircont[$i]}";
                            $stack[] = $current_file;
                        }
                    }
                    $i++;
                }
            }
        }
        return $path;
    }
    $allFilesToZip = array();
    foreach ($filesToZip as $key => $value) {
        if (is_dir()) {
            $allFilesToZip = array_add($allFilesToZip, dir_tree($value));
        } else {
            $allFilesToZip[] = $value;
        }
    }

    require_once('inc/pclzip.lib.php'); // PclZip library http://www.phpconcept.net/pclzip
    $archive = new PclZip($zipFilePath);
    foreach ($allFilesToZip as $key => $value) {
        if(!$archive->add($value, PCLZIP_OPT_REMOVE_PATH, $relativeTo)) {
            $error = ERR_ZIP_ADD_FILE;
            break;
        }
    }

    // get/return new file info
    include_once(CLASS_FILE);
    $objFile = new file($zipFilePath);
    $fileInfo = $objFile->getFileInfo();
    include_once(CLASS_MANAGER);
    $manager = new manager($zipFilePath, false);
    $pathInfo = $manager->getFolderInfo($zipFilePath);
    $fileInfo = array_merge($pathInfo, $manager->getFileType($zipFilePath, false));

    foreach($fileInfo as $k=>$v) {
        switch ($k) {
        case "ctime":
        case "mtime":
        case "atime":
            $fileInfo[$k] = date(DATE_TIME_FORMAT, $v);
            break;
        case 'name':
            $fileInfo['short_name'] = shortenFileName($v);
            break;
        }
    }
}

$ret = $fileInfo;
// append error
$ret['error'] = $error;

echo json_encode($ret);
?>