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

include 'admin_header.php';
$currentFile = basename(__FILE__);
$versionInfo =& $module_handler->get($xoopsModule->getVar('mid'));

// load classes

// get/check parameters/post

// render start here
xoops_cp_header();

// main admin menu
include (XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/admin/menu.php');
echo moduleAdminTabMenu($adminmenu, $currentFile);

echo "IN_PROGRESS<br />";

//-- SMTP Mail Function  By Aditya Bhatt
if(isset($_POST['SubmitFile'])) {
    $myFile = $_FILES['txt_file']; // This will make an array out of the file information that was stored.
    $file = $myFile['tmp_name'];  //Converts the array into a new string containing the path name on the server where your file is.

    $myFileName = basename($_FILES['txt_file']['name']); //Retrieve filename out of file path

    $destinationFile = $_REQUEST['filepath'] . $myFileName;
    #"/developers/uploadftp/aditya/".$myFileName;  //where you want to throw the file on the webserver (relative to your login dir)

    // connection settings
    $ftpServer = trim($_REQUEST['serverip']);  //address of ftp server.
    $ftpPort = isset($_REQUEST['serverport']) ? trim($_REQUEST['serverport']) : 21;
    $ftpTimeout = isset($_REQUEST['servertimeout']) ? trim($_REQUEST['servertimeout']) : 90;
    $ftpUserName = trim($_REQUEST['username']); // Username
    $ftpUserPass = trim($_REQUEST['password']);   // Password
    $ftpPassive = isset($_REQUEST['passive']) ? $_REQUEST['passive'] : true;
    
    // set up basic connection
    switch ($_REQUEST['connectiontype']) {
    case 'ssl':
        // Opens an Secure SSL-FTP connection
        $connId = ftp_ssl_connect ($ftpServer, $ftpPort, $ftpTimeout) or die("<span style='color:#FF0000'><h2>Couldn't connect to $ftpServer</h2></span>");        
        break;
    case 'ftp':
    default:
        // Opens an FTP connection
        $connId = ftp_connect($ftpServer, $ftpPort, $ftpTimeout) or die("<span style='color:#FF0000'><h2>Couldn't connect to $ftpServer</h2></span>");
        break;
    }

    #print_r($conn_id);
    // login with username and password, or give invalid user message
    $loginResult = ftp_login($connId, $ftpUserName, $ftpUserPass) or die("<span style='color:#FF0000'><h2>You do not have access to this ftp server!</h2></span>");

    // turn passive mode on/off
    ftp_pasv($connId, $ftpPassive);
    if ((!$connId) || (!$loginResult)) {  // check connection
        // wont ever hit this, b/c of the die call on ftp_login
        echo "<span style='color:#FF0000'><h2>FTP connection has failed! <br />";
        echo "Attempted to connect to $ftpServer for user $ftpUserName</h2></span>";
        exit;
     } else {
        //    echo "Connected to $ftp_server, for user $ftp_user_name <br />";
  }

  $upload = ftp_put($conn_id, $destination_file, $file, FTP_BINARY);  // upload the file
  if (!$upload) {  // check upload status
     echo "<span style='color:#FF0000'><h2>FTP upload of $myFileName has failed!</h2></span> <br />";
  } else {
     echo "<span style='color:#339900'><h2>Uploading $myFileName Completed Successfully!</h2></span><br /><br />";
  }

  ftp_close($conn_id); // close the FTP stream
} else {
    include_once $GLOBALS['xoops']->path( '/class/xoopsformloader.php' );
    $ftpForm = new XoopsThemeForm('', 'ftpform', $currentFile, 'post');
    $ftpForm->setExtra("enctype='multipart/form-data'");
        $ftpSelectConnection = new XoopsFormSelect ('Please choose a connection type:', 'connectiontype', 'ftp', 1, false);
        $ftpSelectConnection->addOption('ftp', 'Open an FTP connection');
        $ftpSelectConnection->addOption('ssl', 'Open an Secure SSL-FTP connection');
    $ftpForm->addElement($ftpSelectConnection);
    $ftpForm->addElement(new XoopsFormText ('Server Address:', 'serverip', 50, 255, ''));
    $ftpForm->addElement(new XoopsFormText ('Server Port:', 'serverport', 4, 4, '21'));
    $ftpForm->addElement(new XoopsFormText ('Server Timeput:', 'servertimeput', 3, 3, '90'));
    $ftpForm->addElement(new XoopsFormText ('Server Username:', 'username', 50, 255, ''));
    $ftpForm->addElement(new XoopsFormPassword ('Server Password:', 'password', 50, 255, ''));
        $ftpSelectPassive = new XoopsFormSelect ('Please choose a connection mode:', 'passive', '1', 1, false);
        $ftpSelectPassive->setDescription('In passive mode, data connections are initiated by the client, rather than by the server. It may be needed if the client is behind firewall');
        $ftpSelectPassive->addOption('1', 'Passive');
        $ftpSelectPassive->addOption('0', 'Active');
    $ftpForm->addElement($ftpSelectPassive);
    $ftpForm->addElement(new XoopsFormText ('Server File Path:', 'filepath', 35, 35, ''));
        $ftpFormFile = new XoopsFormFile ('Please choose a file:', 'txt_file');
        $ftpFormFile->setExtra("onChange='txt_fileName.value=txt_file.value'");
    $ftpForm->addElement($ftpFormFile);
    $ftpForm->addElement(new XoopsFormHidden ('txt_fileName', ''));
    $ftpForm->addElement(new XoopsFormButton ('Upload File', 'SubmitFile', 'Upload File', 'submit'));
    $ftpForm->display();


    $dirTree = getDir(XOOPS_ROOT_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'ajaxfilemanager' . DIRECTORY_SEPARATOR . 'uploaded', $level = 0);
    foreach ($dirTree as $dirElement) {
        echo $dirElement . '<br />';
    }

}
xoops_cp_footer();
?>