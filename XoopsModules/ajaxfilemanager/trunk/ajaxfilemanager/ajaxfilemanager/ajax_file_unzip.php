<?php
/**
 * unzip selected files
 * @author Lucio Rota (lucio [dot] rota [at] gmail [dot] com)
 * @since 30/March/2011
 *
 */

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "inc" . DIRECTORY_SEPARATOR . "config.php");
$error = "";
if(CONFIG_SYS_VIEW_ONLY || !CONFIG_OPTIONS_unzip) {
    $error = SYS_DISABLED;
} elseif(count($_GET['unzip']) == 0) {
    $error = ERR_NAME_EMPTY;
} elseif(!file_exists($_GET['unzip'])) {
    $error = ERR_FILE_NOT_AVAILABLE;
} elseif(!isUnderRoot($_GET['unzip'])) {
    $error = ERR_FOLDER_PATH_NOT_ALLOWED;
} elseif(!is_file($_GET['unzip'])) {
    $error = ERR_FILE_NOT_AVAILABLE;
}

if($error == "") {
    $archiveFilePath = backslashToSlash($_GET['unzip']);
    $relativeTo = backslashToSlash(getParentPath(getRealPath($_GET['unzip'])));
    $unzipTo = $relativeTo; // TEMPORARY SOLUTION
    $checkOverwrite = true; // if true is not possible to overwrite files, MORE SECURE SOLUTION

    require_once('inc/pclzip.lib.php'); // PclZip library http://www.phpconcept.net/pclzip
    $archive = new PclZip($archiveFilePath);

    // get file list
    $filesList = $archive->listContent();

    if (!$filesList) {
        // if there are errors in archive
        $error = $archive->errorInfo(true);
    } elseif (count($filesList) == 0) {
        // if archive is empty
        $error = ERR_ZIP_FILE_EMPTY;
    } else {
        // if archive is ok

        if ($checkOverwrite) {
            // check if archived files exists
            foreach ($filesList as $key=>$file) {
                $unzipFilePath = backslashToSlash((addTrailingSlash($unzipTo)) . $file['filename']);
                if (file_exists($unzipFilePath)) {
                    $error = ERR_UNZIP_NOT_POSSIBLE_OVERWRITE;
                    break; // break foreach
                }
            }
        }

        if($error == "") {
            $returned = $archive->extract(PCLZIP_OPT_PATH, backslashToSlash(addTrailingSlash($unzipTo)));
            if (!$returned) {
                $error = $archive->errorInfo(true);
            } else {
                // NOP
            }
        }
    }
}

// TO IMPROVE: REFRESH FILES LIST

echo "{";
echo "error:'" . $error . "'";
//echo $info;
echo "}";
?>