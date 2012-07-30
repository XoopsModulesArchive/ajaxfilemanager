<?php
/**
 * Create a new directory that contains the file index.html
 *
 */
function ajaxfilemanager_makeDir($dir, $perm = 0777) {
    if (!is_dir($dir)){
        if (!@mkdir($dir, $perm)){
            return false;
        } else {
            if ($fileHandler = @fopen($dir . '/index.html', 'w'))
                fwrite($fileHandler, '<script>history.go(-1);</script>');
            @fclose($fileHandler);
            return true;
        }
    }
}



/**
 * Garbage collection IN PROGRESS
 *
 */
function garbage_collection($directoryPath, $sessionId = null, $filename = null)
{
    global $SessionHandler, $xoopsDB;
    // create a handler for the directory
    $directoryHandler = opendir($directoryPath);
    $SessionHandler = new XoopsSessionHandler($xoopsDB);
    // keep going until all files in directory have been read
    while ($file = readdir($directoryHandler)) {
        // if $file isn't this directory or its parent,
        // add it to the results array
        if ($file != '.' && $file != '..') {
            $file_as_array = explode('_', $file);
            if (count($file_as_array) != 2)
                continue;
            $file_session_id = $file_as_array[0];
            $file_filename = $file_as_array[1];
            if (is_null($sessionId)) {
                if ($SessionHandler->read($file_session_id) != '') {
                    // session is active
                    // NOP
                } else {
                    // if session is not active, delete file
                    unlink($directoryPath . '/' . $file); // IN PROGRESS check if all right!
                    continue;
                }
            } else {
                if ($SessionHandler->read($sessionId) != '') {
                    // if $sessionId session is active, delete file
                    @unlink($directoryPath . '/' . $file); // IN PROGRESS check if all right!
                    continue;
                } else {
                    // session is not active
                    // NOP
                }
            }
            if (is_null($filename)) {
                // NOP
            } else {
            if ($file_filename == $filename)
                // if $filename file exist, delete file
                @unlink($directoryPath . '/' . $file); // IN PROGRESS check if all right!
                continue;
            }
        }
    }
    // tidy up: close the handler
    closedir($directoryHandler);
}
?>