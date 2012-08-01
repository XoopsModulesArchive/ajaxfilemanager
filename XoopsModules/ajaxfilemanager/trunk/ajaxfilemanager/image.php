<?php
/**
 * ****************************************************************************
 *  - A Project by Developers TEAM For Xoops - ( http://www.xoops.org )
 * ****************************************************************************
 *  AJAXFILEMANAGER - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Rota Lucio ( http://luciorota.altervista.org/xoops/ )
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html& ...  public license
 * @package         ajaxfilemanager
 * @since           1.0
 * @author          luciorota <lucio.rota@gmail.com>
 * @version         $Id$
 */
 
// Xoops Smart Image Resizer 1.4.1+
// Resizes images, intelligently sharpens, crops based on width:height ratios, color fills
// transparent GIFs and PNGs, and caches variations for optimal performance
// Created by: Joe Lencioni (http://shiftingpixel.com)
// Date: August 6, 2008
// Based on: http://veryraw.com/history/2005/03/image-resizing-with-php/
// EXPERIMENTAL
// Imagefilter extension for PHP5+
// Created by: luciorota (lucio.rota@gmail.com)
// Date: July 17, 2008
// Xoopsed by luciorota (lucio.rota@gmail.com)
// Date: January 8, 2010

/////////////////////
// LICENSE
/////////////////////

// I love to hear when my work is being used, so if you decide to use this, feel encouraged
// to send me an email. Smart Image Resizer is released under a Creative Commons
// Attribution-Share Alike 3.0 United States license
// (http://creativecommons.org/licenses/by-sa/3.0/us/). All I ask is that you include a link
// back to Shifting Pixel (either this page or shiftingpixel.com), but don’t worry about
// including a big link on each page if you don’t want to–one will do just nicely. Feel
// free to contact me to discuss any specifics (joe@shiftingpixel.com).



//////////////
// COMMON CODE
//////////////

// PHP Version sanity check
if (version_compare('5.0.5', phpversion()) == 1) {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: this version of PHP is not fully supported. You need 4.3.2 or above.';
    exit();
}
// GD check
if (extension_loaded('gd') == false && !dl('gd.so')) {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: you are missing the GD extension for PHP, sorry but I cannot continue.';
    exit();
}
// GD Version check
$gd_info = gd_info();

if ($gd_info['PNG Support'] == false) {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: this version of the GD extension cannot output PNG images.';
    exit();
}

if (ereg_replace('[[:alpha:][:space:]()]+', '', $gd_info['GD Version']) < '2.0.1') {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: GD library is too old. Version 2.0.1 or later is required, and 2.0.28 is strongly recommended.';
    exit();
}



/////////////
// XOOPS CODE
/////////////

error_reporting(0);
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    set_magic_quotes_runtime(0);
}

if (function_exists('mb_http_output')) {
    mb_http_output('pass');
}

$xoopsOption['nocommon'] = 1;

/**
 * Load Xoops mainfile.php
  */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
  
$current_path = dirname(__FILE__);
$xoops_root_path = $current_path;
@include_once ($xoops_root_path . DS . 'mainfile.php';
if (!defined('XOOPS_ROOT_PATH')) {
    $xoops_root_path = substr($current_path, 0, stripos($current_path, DS . 'modules' . DS . 'ajaxfilemanager'));
    include_once $xoops_root_path . DS . 'mainfile.php';
    if (!defined('XOOPS_ROOT_PATH')) { die('XOOPS root path not defined'); }
}

/**
 * Define for Image Resizer
 */
define('MEMORY_TO_ALLOCATE',    '100M');
define('DEFAULT_QUALITY',       90);
define('CURRENT_DIR',           dirname(__FILE__));
define('CACHE_DIR_NAME',        '/imagecache/');
define('CACHE_DIR',             XOOPS_ROOT_PATH . '/uploads/ajaxfilemanager' . CACHE_DIR_NAME);
define('DOCUMENT_ROOT',         XOOPS_ROOT_PATH);
$document_root = DOCUMENT_ROOT;
$document_root = substr( $_SERVER['SCRIPT_FILENAME'],0,-strlen($_SERVER['SCRIPT_NAME']) ).'/';



/////////////////////////////
// PARAMETER CHECK - START
/////////////////////////////



////////////////////
// IMAGERESIZER CODE
////////////////////

if (isset($_GET['image'])) {
/**
 * IF IS A STANDARD IMAGE use Joe Lencioni's CODE to get image data
 */
    // Images must be local files, so for convenience we strip the domain if it's there
    $image = preg_replace('/^(s?f|ht)tps?:\/\/[^\/]+/i', '', (string) $_GET['image']);
    // For security, directories cannot contain ':', images cannot contain '..' or '<', and
    // images must start with '/'
    if ($image{0} != '/' || strpos(dirname($image), ':') || preg_match('/(\.\.|<|>)/', $image)) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: malformed image path. Image paths must begin with \'/\'';
        exit();
    }
    // If the image doesn't exist, or we haven't been told what it is, there's nothing
    // that we can do
    if (!$image) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: no image was specified';
        exit();
    }
    // Strip the possible trailing slash off the document root
    $docRoot    = preg_replace('/\/$/', '', $document_root);
    $image_path = $docRoot . $image;
    if (!file_exists($image_path)) {
        header('HTTP/1.1 404 Not Found');
        echo 'Error: image does not exist: ' . $image_path;
        exit();
    }
    // Get the size and MIME type of the requested image
    $file_name              = $image; // in progress
    $file_size              = GetImageSize($image_path);
    $image_width            = $file_size[0];
    $image_height           = $file_size[1];
    $file_mimetype          = $file_size['mime'];
    $image_modified_time    = filemtime($image_path);
    $image_data             = file_get_contents($image_path);
} 



/////////////
// XOOPS CODE
/////////////

elseif(isset($_GET['element_id']) || isset($_GET['id']) || isset($file_id)) {
/**
 * IF IS A XOOPS IMAGE use Xoops CODE to get image data
 */
    if (empty($file_id)) {
        $element_id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_GET['element_id']) ? intval($_GET['element_id']) : NULL);
    }
    /**
     * Include necessary Xoops stuff
     */
    include_once XOOPS_ROOT_PATH . '/include/functions.php';
    include_once XOOPS_ROOT_PATH . '/include/defines.php';
    xoops_load('load');
    xoops_load('preload');
    include_once XOOPS_ROOT_PATH . '/class/module.textsanitizer.php';
    /**
     * Get database for making it global
     * Requires XoopsLogger, XOOPS_DB_PROXY;
     */
    xoops_load('xoopslogger');
    include_once XOOPS_ROOT_PATH . '/class/database/databasefactory.php';
    $xoopsDB =& XoopsDatabaseFactory::getDatabaseConnection();
    require_once XOOPS_ROOT_PATH . '/kernel/object.php';
    require_once XOOPS_ROOT_PATH . '/kernel/module.php';
    require_once XOOPS_ROOT_PATH . '/class/criteria.php';

    /**
     * Create Instance of xos_kernel_Xoops2 Object
     * Atention, not all methods can be used at this point
     */
    XoopsLoad::load('xoopskernel');
    $xoops = new xos_kernel_Xoops2();
    $xoops->pathTranslation();
    /**
     * Set cookie dope for multiple subdomains remove the '.'. to use top level dope for session cookie;
     * Requires functions
     */
    define('XOOPS_COOKIE_DOMAIN', ($domain = xoops_getBaseDomain(XOOPS_URL)) == 'localhost' ? '' : '.' . $domain);
    /**
     * Check Proxy;
     * Requires functions
     */
    if ($_SERVER['REQUEST_METHOD'] != 'POST' || ! $xoopsSecurity->checkReferer(XOOPS_DB_CHKREF)) {
        define('XOOPS_DB_PROXY', 1);
    }
    /**
     * Get xoops configs
     * Requires functions and database loaded
     */
    $config_handler =& xoops_gethandler('config');
    $xoopsConfig = $config_handler->getConfigsByCat(XOOPS_CONF);
    /**
     * Create Instance of xoopsSecurity Object and check Supergolbals
     */
    xoops_load('xoopssecurity');
    $xoopsSecurity = new XoopsSecurity();
    $xoopsSecurity->checkSuperglobals();
    /**
     * Check Bad Ip Addressed against database and block bad ones, requires configs loaded
     */
    $xoopsSecurity->checkBadips();
    /**
     * User Sessions: get $xoopsUser!!!
     */
    $xoopsUser = '';
    $xoopsUserIsAdmin = false;
    $member_handler =& xoops_gethandler('member');
    $sess_handler =& xoops_gethandler('session');
    if ($xoopsConfig['use_ssl']
        && isset($_POST[$xoopsConfig['sslpost_name']])
        && $_POST[$xoopsConfig['sslpost_name']] != ''
    ) {
        session_id($_POST[$xoopsConfig['sslpost_name']]);
    } else if ($xoopsConfig['use_mysession'] && $xoopsConfig['session_name'] != '' && $xoopsConfig['session_expire'] > 0) {
        if (isset($_COOKIE[$xoopsConfig['session_name']])) {
            session_id($_COOKIE[$xoopsConfig['session_name']]);
        }
        if (function_exists('session_cache_expire')) {
            session_cache_expire($xoopsConfig['session_expire']);
        }
        @ini_set('session.gc_maxlifetime', $xoopsConfig['session_expire'] * 60);
    }
    session_set_save_handler(array(&$sess_handler, 'open'),
                             array(&$sess_handler, 'close'),
                             array(&$sess_handler, 'read'),
                             array(&$sess_handler, 'write'),
                             array(&$sess_handler, 'destroy'),
                             array(&$sess_handler, 'gc'));
    session_start();
    /**
     * Remove expired session for xoopsUserId
     */
    if ($xoopsConfig['use_mysession']
        && $xoopsConfig['session_name'] != ''
        && !isset($_COOKIE[$xoopsConfig['session_name']])
        && !empty($_SESSION['xoopsUserId'])
    ) {
        unset($_SESSION['xoopsUserId']);
    }
    /**
     * Load xoopsUserId from cookie if "Remember me" is enabled.
     */
    if (empty($_SESSION['xoopsUserId'])
        && !empty($xoopsConfig['usercookie'])
        && !empty($_COOKIE[$xoopsConfig['usercookie']])
    ) {
        $hash_data = @explode("-", $_COOKIE[$xoopsConfig['usercookie']], 2);
        list($_SESSION['xoopsUserId'], $hash_login) = array($hash_data[0], strval(@$hash_data[1]));
        unset($hash_data);
    }
    /**
     * Log user is and deal with Sessions and Cookies
     */
    if (!empty($_SESSION['xoopsUserId'])) {
        $xoopsUser =& $member_handler->getUser($_SESSION['xoopsUserId']);
        if (!is_object($xoopsUser) || (isset($hash_login) && md5($xoopsUser->getVar('pass') . XOOPS_DB_NAME . XOOPS_DB_PASS . XOOPS_DB_PREFIX) != $hash_login)) {
            $xoopsUser = '';
            $_SESSION = array();
            session_destroy();
            setcookie($xoopsConfig['usercookie'], 0, - 1, '/');
        } else {
            if ((intval($xoopsUser->getVar('last_login')) + 60 * 5) < time()) {
                $sql = "UPDATE " . $xoopsDB->prefix('users')
                     . " SET last_login = '" . time()
                     . "' WHERE uid = " . $_SESSION['xoopsUserId'];
                @$xoopsDB->queryF($sql);
            }
            $sess_handler->update_cookie();
            if (isset($_SESSION['xoopsUserGroups'])) {
                $xoopsUser->setGroups($_SESSION['xoopsUserGroups']);
            } else {
                $_SESSION['xoopsUserGroups'] = $xoopsUser->getGroups();
            }
            $xoopsUserIsAdmin = $xoopsUser->isAdmin();
        }
    }

    /**
     * Include necessary Module stuff
     */
    include_once 'include/defines.php';
    /**
     * Get image data from Xoops and module database/filesystem
     */
    $element_handler =& xoops_getModuleHandler('xoopsfilesystemelement', 'newfilemanager');
    if(!$element = $element_handler->get($element_id)) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: element with the requested id does not exist: id=' . $element_id;
        exit();
    }
    if($element->getVar('element_type') != XOOPS_ELEMENT_FILE) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: element with the requested id is not a file: id=' . $element_id;
        exit();
    }  
    $file_handler =& xoops_getModuleHandler('xoopsfilesystemfile', 'newfilemanager');
    if (!$file = $file_handler->getByElement($element_id)) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: file with the requested id does not exist: id=' . $element_id;
        exit();
    }
    $file_name            = $file->getVar('file_name');
    $image                = $file->getVar('file_name');
    $file_mimetype        = $file->getVar('file_mimetype');
    $image_modified_time  = $element->getVar('element_lastchangedate');
    $image_data           = file_get_contents(XOOPS_ROOT_PATH . '/' . $file->getVar('file_relativepath') . '/' . $file->getVar('file_name'));
    $source_image         = imagecreatefromstring($image_data);
    $image_width          = imagesx($source_image);
    $image_height         = imagesy($source_image);


    /**
     * Check User permissions
     */
/* IN PROGRESS
 IN PROGRESS
  IN PROGRESS
   IN PROGRESS
    IN PROGRESS
    $gperm_handler =& xoops_gethandler('groupperm');
    $newfilemanagerModule =& XoopsModule::getByDirname('newfilemanager');
    $groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
    $perm_file_category_read = $gperm_handler->checkRight( 'newfilemanager_cat_read', $file_category_id, $groups, $newfilemanagerModule->mid());
    if (!$perm_file_category_read) {
        header('HTTP/1.1 400 Bad Request');
        echo 'Error: sorry, no permission to view this image';
        exit();
    }
*/
} 



//////////////
// COMMON CODE
//////////////

else {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: no image was specified';
    exit();
}



//////////////
// COMMON CODE
//////////////

// Make sure that the requested file is actually an image
if (substr($file_mimetype, 0, 6) != 'image/') {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: requested file is not an accepted type';
    exit();
}



// Width, Height parameters
$maxWidth  = (isset($_GET['width'])) ? (int) $_GET['width'] : false;
$maxHeight = (isset($_GET['height'])) ? (int) $_GET['height'] : false;
// If either a max width or max height are not specified, we default to something
// large so the unspecified dimension isn't a constraint on our resized image.
// If neither are specified but the color is, we aren't going to be resizing at
// all, just coloring.
if (!$maxWidth && $maxHeight) {
    $maxWidth = PHP_INT_MAX;
} elseif ($maxWidth && !$maxHeight) {
    $maxHeight = PHP_INT_MAX;
} elseif (!$maxWidth && !$maxHeight) {
    $maxWidth = $image_width;
    $maxHeight = $image_height;
}

//  Color parameter
$color = (isset($_GET['color'])) ? preg_replace('/[^0-9a-fA-F]/', '', (string) $_GET['color']) : false;
// imagefilter + roundcorner by luciorota - start
$filter = (isset($_GET['filter'])) ? $_GET['filter'] : false;
$radius = (isset($_GET['radius'])) ? (string) $_GET['radius'] : false;
// imagefilter + roundcorner by luciorota - end

// If we don't have a width or height or color or filter or radius 
// we do not want to resize it, so we simply output the original image and exit
if (!isset($_GET['width']) && !isset($_GET['height']) && !isset($_GET['color']) && !isset($_GET['filter']) && !isset($_GET['radius'])) {
    $lastModifiedString = gmdate('D, d M Y H:i:s', filemtime($docRoot . '/' . $image)) . ' GMT';
    $etag = md5($image_data);

    doConditionalGet($etag, $lastModifiedString);

    header("Content-type: $mime");
    header('Content-Length: ' . strlen($image_data));
    echo $image_data;
    exit();
}



// Ratio cropping
$offsetX    = 0;
$offsetY    = 0;

if (isset($_GET['cropratio'])) {
    $cropRatio      = explode(':', (string) $_GET['cropratio']);
    if (count($cropRatio) == 2) {
        $ratioComputed      = $image_width / $image_height;
        $cropRatioComputed  = (float) $cropRatio[0] / (float) $cropRatio[1];

        if ($ratioComputed < $cropRatioComputed) {
        // Image is too tall so we will crop the top and bottom
            $origHeight     = $image_height;
            $image_height   = $image_width / $cropRatioComputed;
            $offsetY        = ($origHeight - $image_height) / 2;
        } elseif ($ratioComputed > $cropRatioComputed) {
        // Image is too wide so we will crop off the left and right sides
            $origWidth       = $image_width;
            $image_width     = $image_height * $cropRatioComputed;
            $offsetX         = ($origWidth - $image_width) / 2;
        }
    }
}

// Setting up the ratios needed for resizing. We will compare these below to determine how to
// resize the image (based on height or based on width)
$xRatio     = $maxWidth / $image_width;
$yRatio     = $maxHeight / $image_height;

if ($xRatio * $image_height < $maxHeight) {
// Resize the image based on width
    $tnHeight   = ceil($xRatio * $image_height);
    $tnWidth    = $maxWidth;
} else {
// Resize the image based on height
    $tnWidth    = ceil($yRatio * $image_width);
    $tnHeight   = $maxHeight;
}


// Determine the quality of the output image
$quality    = (isset($_GET['quality'])) ? (int) $_GET['quality'] : DEFAULT_QUALITY;

/////////////////////////////
// PARAMETER CHECK - END
/////////////////////////////



/////////////////////////////
// CACHE CHECK - START
/////////////////////////////
// Before we actually do any crazy resizing of the image, we want to make sure
// that we haven't already done this one at these dimensions. To the cache!
// Note, cache MUST BE world-readable

// We store our cached image filenames as a hash of the parameters and the original filename
$resizedImageName = 'resize_' . md5($_SERVER['REQUEST_URI']) . '_' . basename($image);
$resizedImagePath = CACHE_DIR . $resizedImageName;

/* TO DO
// HOW TO USE XOOPS CACHE?
xoops_load('XoopsCache');
XoopsCache::read($resizedImageName);
$resizedImageArray['name'] = $resizedImageName
$resizedImageArray['data'] = $image_data
$resizedImageArray['modified_date'] = ...
XoopsCache::write($resizedImageName, $resizedImageArray);
*/

// Check the modified times of the cached file and the original file.
// If the original file is older than the cached file, then we simply serve up the cached file
if (!isset($_GET['nocache']) && file_exists(CACHE_DIR . $resizedImageName)) {
    $thumb_modified_time  = filemtime(CACHE_DIR . $resizedImageName);

    if($image_modified_time < $thumb_modified_time) {
        $image_data   = file_get_contents(CACHE_DIR . $resizedImageName);

        $lastModifiedString = gmdate('D, d M Y H:i:s', $thumb_modified_time) . ' GMT';
        $etag               = md5($image_data);

        doConditionalGet($etag, $lastModifiedString);

        header("Content-type: $file_mimetype");
        header('Content-Length: ' . strlen($image_data));
        echo $image_data;
        exit();
    }
}
/////////////////////////////
// CACHE CHECK - END
/////////////////////////////



// We don't want to run out of memory
ini_set('memory_limit', MEMORY_TO_ALLOCATE);

// Set up a blank canvas for our resized image (destination)
$destination_image	= imagecreatetruecolor($tnWidth, $tnHeight);

// Set up the appropriate image handling functions based on the original image's mime type
switch ($file_mimetype) {
    case 'image/gif' :
        // We will be converting GIFs to PNGs to avoid transparency issues when resizing GIFs
        // This is maybe not the ideal solution, but IE6 can suck it
        $creationFunction   = 'ImageCreateFromGif';
        $outputFunction     = 'ImagePng';
        $file_mimetype     = 'image/png'; // We need to convert GIFs to PNGs
        $doSharpen          = false;
        $quality            = round(10 - ($quality / 10)); // We are converting the GIF to a PNG and PNG needs a compression level of 0 (no compression) through 9
        break;
    case 'image/x-png':
    case 'image/png':
        $creationFunction   = 'ImageCreateFromPng';
        $outputFunction     = 'ImagePng';
        $doSharpen          = false;
        $quality            = round(10 - ($quality / 10)); // PNG needs a compression level of 0 (no compression) through 9
        break;
    default:
        $creationFunction   = 'ImageCreateFromJpeg';
        $outputFunction     = 'ImageJpeg';
        $doSharpen          = true;
        break;
}

/////////////
// XOOPS CODE
/////////////
// Read in the original image
if (isset($_GET['image'])) {
// IF IS A STANDARD IMAGE
    $source_image	= $creationFunction($image_path);
} else {
// IF IS A XOOPS IMAGE
    // NOP because $source_image EXIST
}
//////////////
// COMMON CODE
//////////////

if (in_array($file_mimetype, array('image/gif', 'image/png'))) {
    if (!$color) {
        // If this is a GIF or a PNG, we need to set up transparency
        imagealphablending($destination_image, false);
        imagesavealpha($destination_image, true);
    } else {
        // Fill the background with the specified color for matting purposes
        if ($color[0] == '#')
            $color = substr($color, 1);

        $background = false;

        if (strlen($color) == 6)
            $background = imagecolorallocate($destination_image, hexdec($color[0].$color[1]), hexdec($color[2].$color[3]), hexdec($color[4].$color[5]));
        else if (strlen($color) == 3)
            $background = imagecolorallocate($destination_image, hexdec($color[0].$color[0]), hexdec($color[1].$color[1]), hexdec($color[2].$color[2]));
        if ($background)
            imagefill($destination_image, 0, 0, $background);
    }
}



// Resample the original image into the resized canvas we set up earlier
ImageCopyResampled($destination_image, $source_image, 0, 0, $offsetX, $offsetY, $tnWidth, $tnHeight, $image_width, $image_height);



// imagefilter + radius by luciorota - start
if ($filter) { // only for php5+
    if (!is_array($filter)) eval('imagefilter($destination_image,'.$filter.');');
    else foreach ($filter as $i => $value) eval('imagefilter($destination_image,'.$value.');');
}
if ($radius) { // only for php5+
    $radiuses = explode(',',$radius);
    switch (count($radiuses)) {
        case 1 : $radiuses[3] = $radiuses[2] = $radiuses[1] = $radiuses[0];
        break;
        case 2 : $radiuses[3] = $radiuses[0]; $radiuses[2] = $radiuses[1];
        break;
        case 3 : $radiuses[3] = $radiuses[0];
        break;
        case 4 : //nop
        break;
    }
    function RoundCornerImage($radius=0, $rotate=0, $colour='FFFFFF') {
        $corner_image = imagecreatetruecolor($radius, $radius);
        $clear_colour = imagecolorallocate($corner_image,0,0,0);
        $solid_colour = imagecolorallocate($corner_image, hexdec(substr($colour,0,2)), hexdec(substr($colour,2,2)), hexdec(substr($colour,4,2)));
        imagecolortransparent($corner_image,$clear_colour);
        imagefill($corner_image,0,0,$solid_colour);
        imagefilledellipse($corner_image,$radius,$radius,$radius * 2,$radius * 2,$clear_colour);
        if ($rotate != 0) 
            $corner_image = imagerotate($corner_image,$rotate,0);
        return $corner_image;
    }
    $source_width = imagesx($destination_image);
    $source_height = imagesy($destination_image);
    $colour = isset($_GET['colour']) ? $_GET['colour'] : 'FFFFFF';
    // top left
    if ($radiuses[0]) {imagecopymerge($destination_image,RoundCornerImage($radiuses[0],0),0,0,0,0,$radiuses[0],$radiuses[0],100);}
    // top right
    if ($radiuses[1]) {imagecopymerge($destination_image,RoundCornerImage($radiuses[1],270),$source_width - $radiuses[1],0,0,0,$radiuses[1],$radiuses[1],100);}
    // bottom right
    if ($radiuses[2]) {imagecopymerge($destination_image,RoundCornerImage($radiuses[2],180),$source_width - $radiuses[2],$source_height - $radiuses[2],0,0,$radiuses[2],$radiuses[2],100);}
    // bottom left
    if ($radiuses[3]) {imagecopymerge($destination_image,RoundCornerImage($radiuses[3],90),0,$source_height - $radiuses[3],0,0,$radiuses[3],$radiuses[3],100);}
}
// imagefilter + radius by luciorota - end



if ($doSharpen) {
    // Sharpen the image based on two things:
    //	(1) the difference between the original size and the final size
    //	(2) the final size
    $sharpness  = findSharp($image_width, $tnWidth);

    $sharpenMatrix  = array(
        array(-1, -2, -1),
        array(-2, $sharpness + 12, -2),
        array(-1, -2, -1)
    );
    $divisor        = $sharpness;
    $offset         = 0;
    imageconvolution($destination_image, $sharpenMatrix, $divisor, $offset);
}

// Make sure the cache exists. If it doesn't, then create it
if (!file_exists(CACHE_DIR))
    mkdir(CACHE_DIR, 0755);

// Make sure we can read and write the cache directory
if (!is_readable(CACHE_DIR)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: the cache directory is not readable';
    exit();
} elseif (!is_writable(CACHE_DIR)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error: the cache directory is not writable';
    exit();
}

// Write the resized image to the cache
$outputFunction($destination_image, CACHE_DIR . $resizedImageName, $quality);

// Put the data of the resized image into a variable
ob_start();
$outputFunction($destination_image, null, $quality);
$image_data   = ob_get_contents();
ob_end_clean();

// Clean up the memory
ImageDestroy($source_image);
ImageDestroy($destination_image);

// See if the browser already has the image
$lastModifiedString = gmdate('D, d M Y H:i:s', filemtime(CACHE_DIR . $resizedImageName)) . ' GMT';
$etag               = md5($image_data);

doConditionalGet($etag, $lastModifiedString);

/////////////
// XOOPS CODE
/////////////
// Send the image to the browser with some delicious headers
header("HTTP/1.1 200 OK");
// if image is cacheable
if (!isset($_GET['nocache'])) {
    header('Last-Modified: ' . gmdate("D, d M Y H:i:s", $image_modified_time) . 'GMT');
    header('Cache-control: max-age=31536000');
    header('Expires: ' . gmdate("D, d M Y H:i:s", time() + 31536000) . 'GMT');
} else {
    // KILL THE BROWSER CACHE - start
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // past date
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
    header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); // HTTP/1.0
    // KILL THE BROWSER CACHE - end
}
header("Content-type: $file_mimetype");
header('Content-disposition: filename=' . $file_name);
header('Content-Length: ' . strlen($image_data));

//////////////
// COMMON CODE
//////////////
echo $image_data;



function findSharp($orig, $final) {
// function from Ryan Rud (http://adryrun.com)
    $final  = $final * (750.0 / $orig);
    $a      = 52;
    $b      = -0.27810650887573124;
    $c      = .00047337278106508946;

    $result = $a + $b * $final + $c * $final * $final;

    return max(round($result), 0);
} // findSharp()

function doConditionalGet($etag, $lastModified) {
    header("Last-Modified: $lastModified");
    header("ETag: \"{$etag}\"");

    $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
        stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) :
        false;

    $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
        stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
        false;

    if (!$if_modified_since && !$if_none_match)
        return;

    if ($if_none_match && $if_none_match != $etag && $if_none_match != '"' . $etag . '"')
        return; // etag is there but doesn't match

    if ($if_modified_since && $if_modified_since != $lastModified)
        return; // if-modified-since is there but doesn't match

    // Nothing has changed since their last request - serve a 304 and exit
    header('HTTP/1.1 304 Not Modified');
    exit();
} // doConditionalGet()

// old pond
// a frog jumps
// the sound of water

// —Matsuo Basho
