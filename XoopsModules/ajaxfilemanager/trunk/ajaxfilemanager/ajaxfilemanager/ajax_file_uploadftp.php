<?php
/**
 * processing the uploaded files
 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link www.phpletter.com
 * @since 22/May/2007
 *
 */	
sleep(3);
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");

$error = "";
$info = "";

error_log(print_r($_REQUEST,true));
error_log(print_r($_FILES,true));
error_log(print_r($ajaxfilemanagerModuleConfig,true));
$destinationFile = backslashToSlash($xoopsModuleConfig['ftp_xoopsrootpath'] . DS . $_GET['folder']);
error_log($destinationFile);

// check if ftp server exists and module can log to it
$useFtp = false;
if($xoopsModuleConfig['ftp_enabled'] && function_exists('ftp_connect') && !empty($xoopsModuleConfig['ftp_serverhost'])) {
    // set up basic connection
    switch ($xoopsModuleConfig['ftp_connectiontype']) {
        case 'ssl':
            // Opens an Secure SSL-FTP connection
            $connId = ftp_ssl_connect ($xoopsModuleConfig['ftp_serverhost'], $xoopsModuleConfig['ftp_serverport'], $xoopsModuleConfig['ftp_servertimeout']);        
            break;
        case 'ftp':
        default:
            // Opens an FTP connection
            $connId = ftp_connect($xoopsModuleConfig['ftp_serverhost'], $xoopsModuleConfig['ftp_serverport'], $xoopsModuleConfig['ftp_servertimeout']);
            break;
    }
    if ($connId) {
        $loginResult = ftp_login($connId, $xoopsModuleConfig['ftp_username'], $xoopsModuleConfig['ftp_password']);
        if ($loginResult) {
            $pasiveResult = ftp_pasv($connId, $xoopsModuleConfig['ftp_connectionpassive']);
            if ($pasiveResult) {
                if (is_array(ftp_nlist($connId, "."))) {
                $useFtp = true;  
                
                }
            }
        } else {
            $error = "login error // IN PROGRESS";
        }
    } else {
        $error = "ftp server not available // IN PROGRESS";
        ftp_quit($connId);
    }
} else {
    $error = "ftp not enabled // IN PROGRESS";
}

if(!$useFtp) {
error_log("ftp not ok[" . $error . "]");
    // NOP
} else {
error_log("ftp ok");
    //include_once(CLASS_UPLOAD);
    //$upload = new Upload();
    //$upload->setInvalidFileExt(explode(",", CONFIG_UPLOAD_INVALID_EXTS));
    if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_UPLOAD) {
        $error = SYS_DISABLED;
    } elseif(empty($_GET['folder']) || !isUnderRoot($_GET['folder'])) {
        $error = ERR_FOLDER_PATH_NOT_ALLOWED;
    //} else if(!$upload->isFileUploaded('file')) {
    //    $error = ERR_FILE_NOT_UPLOADED;
    //} else if(!$upload->moveUploadedFile($_GET['folder'])) {
    //    $error = ERR_FILE_MOVE_FAILED;
    //} elseif(!$upload->isPermittedFileExt(explode(",", CONFIG_UPLOAD_VALID_EXTS))) {
    //    $error = ERR_FILE_TYPE_NOT_ALLOWED;
    //} elseif(defined('CONFIG_UPLOAD_MAXSIZE') && CONFIG_UPLOAD_MAXSIZE && $upload->isSizeTooBig(CONFIG_UPLOAD_MAXSIZE)) {
    //     $error = sprintf(ERROR_FILE_TOO_BID, transformFileSize(CONFIG_UPLOAD_MAXSIZE));
    } else {

        // get uploaded file informations
        $myFile = $_FILES['file']; // This will make an array out of the file information that was stored.
        $file = $myFile['tmp_name'];  //Converts the array into a new string containing the path name on the server where your file is.
        $myFileName = basename($myFile['name']); //Retrieve filename out of file path
        $myFileType = $myFile['type']; //Retrieve file type (mimetype)
        $myFileSize = $myFile['size']; //Retrieve file size (bytes)
        $myFileError = $myFile['error']; //Retrieve file error ( 0 = no error)

        if($myFileError != 0) {
            $error = "file error // IN PROGRESS";
        } else {
            $destinationFile = $xoopsModuleConfig['ftp_xoopsrootpath'] . DS . $_GET['folder'];
            
            $upload = ftp_put($connId, $destinationFile, $file, FTP_BINARY);  // upload the file
            if (!$upload) {
                // check upload status
                echo "<span style='color:#FF0000'><h2>FTP upload of $myFileName has failed!</h2></span> <br />";
            } else {
                echo "<span style='color:#339900'><h2>Uploading $myFileName Completed Successfully!</h2></span><br /><br />";
            }

            ftp_close($connId); // close the FTP stream

            // get file informations
            //include_once(CLASS_FILE);
            //$path = $upload->getFilePath();
            $path = $destinationFile;
            $obj = new file($path);
            $tem = $obj->getFileInfo();
            if(sizeof($tem))
            {
                include_once(CLASS_MANAGER);
                $manager = new manager($path, false);
                $fileType = $manager->getFileType($myFileName);
                foreach($fileType as $k=>$v) {
                    $tem[$k] = $v;
                }
                $tem['path'] = backslashToSlash($path);
                $tem['type'] = "file";
                $tem['size'] = transformFileSize($tem['size']);
                $tem['ctime'] = date(DATE_TIME_FORMAT, $tem['ctime']);
                $tem['mtime'] = date(DATE_TIME_FORMAT, $tem['mtime']);
                $tem['short_name'] = shortenFileName($tem['name']);
                $tem['flag'] = 'noFlag';
                $obj->close();
                foreach($tem as $k=>$v) {
                    $info .= sprintf(", %s:'%s'", $k, $v);
                }
                $info .= sprintf(", url:'%s'",  getFileUrl($path));
                $info .= sprintf(", tipedit:'%s'",  TIP_DOC_RENAME);
            } else {
                $error = ERR_FILE_NOT_AVAILABLE;
            }
        }
    }
}
echo "{";
echo "error:'" . $error . "'";
echo $info;
echo "}";
?>