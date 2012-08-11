<?php
/*
processImage.php
Copyright (C) 2004-2006 Peter Frueh (http://www.ajaxprogrammer.com/)
Additional code contributions and modifications by David Fuller, Olli Jarva, and Simon Jensen

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/
function hexrgb($hexstr) {
    $int = hexdec($hexstr);
    return array(
        "red" => 0xFF & ($int >> 0x10),
        "green" => 0xFF & ($int >> 0x8),
        "blue" => 0xFF & $int
        );
}
// required params: imageName

header("Content-Type: text/plain");



// XOOPS PATCH - START HERE
//$originalDirectory = getcwd()."/original/";
//$activeDirectory = getcwd()."/active/";
//$editDirectory = getcwd()."/edit/";
//$undoDirectory = getcwd()."/undo/";
//$imageName = $_REQUEST["imageName"];
//$action = $_REQUEST["action"];

// get xoops rooth path
$currentPath = dirname(__FILE__);
if ( DIRECTORY_SEPARATOR != "/" ) {
    $currentPath = str_replace( DIRECTORY_SEPARATOR, '/', $currentPath);
}
$xoops_root_path = substr($currentPath, 0, strpos(strtolower($currentPath), '/modules/ajaxfilemanager/imageeditor'));
define('XOOPS_ROOT_PATH', $xoops_root_path);
// get xoops rooth path - end

//require_once(XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imageeditor/libraries/wideimage/lib/WideImage.php');
require_once(XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/Frameworks/wideimage/wideimage/WideImage.php');

$tempPath = XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imageeditor/ImageEditor';
$originalDirectory = $tempPath . '/original/';
$activeDirectory = $tempPath . '/active/';
$editDirectory = $tempPath . '/edit/';
$undoDirectory = $tempPath . '/undo/';
$imageName = $_REQUEST['imageName'];
$action = $_REQUEST['action'];
// XOOPS PATCH - END HERE



if (empty($imageName) || !file_exists($originalDirectory . $imageName)) {
        echo "{imageFound:false}";
        exit;
}

if (!file_exists($editDirectory . $imageName)) {
        copy($originalDirectory . $imageName, $editDirectory . $imageName);
}
if (!file_exists($activeDirectory. $imageName)) {
        copy($originalDirectory . $imageName, $activeDirectory . $imageName);
}

if ($action == "undo") {
    if (file_exists($undoDirectory . $imageName)) {
        rename($editDirectory . $imageName, $undoDirectory . $imageName . ".current");
        rename($undoDirectory . $imageName, $editDirectory . $imageName);
        rename($undoDirectory .$imageName . ".current", $undoDirectory . $imageName);
    }
} else {
    copy($editDirectory . $imageName, $undoDirectory . $imageName);
}

$fileInfo = pathinfo($editDirectory . $imageName);
$extension = $fileInfo['extension'];

switch($action) {
    case "viewOriginal":
        copy($originalDirectory . $imageName, $editDirectory . $imageName);
        break;

    case "viewActive":
        copy($activeDirectory . $imageName, $editDirectory . $imageName);
        break;

    case "save":
        copy($editDirectory . $imageName, $activeDirectory . $imageName);
        break;

    case "resize": // additional required params: w, h
        $out_w = $_REQUEST["w"];
        $out_h = $_REQUEST["h"];
        if (!is_numeric($out_w) || !is_numeric($out_h)) { exit; }
        if ($out_w < 1 || $out_w > 2000) { exit; }
        if ($out_h < 1 || $out_h > 2000) { exit; }
        list($in_w, $in_h) = getimagesize($editDirectory . $imageName);

        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->resize($out_w, $out_h, 'fill');
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "rotate": // additional required params: degrees (90, 180, 270 or any with WideImage )
        $degrees = $_REQUEST["degrees"];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->rotate($degrees);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "mirror": // no additional params.
        $degrees = $_REQUEST["degrees"];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->mirror();
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "flip":    // no additional params.
        $degrees = $_REQUEST["degrees"];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->flip();
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "crop": // additional required params: x, y, w, h
        $x = $_REQUEST["x"];
        $y = $_REQUEST["y"];
        $w = $_REQUEST["w"];
        $h = $_REQUEST["h"];
        if (!is_numeric($x) || !is_numeric($y) || !is_numeric($w) || !is_numeric($h)) { exit; }
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->crop($x, $y, $w, $h);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "grayscale":	// no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->asGrayscale();
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "sepia":  // no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_GRAYSCALE)->applyFilter(IMG_FILTER_COLORIZE, 100, 50, 0);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "pencil":  // no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_EDGEDETECT);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "emboss":	// no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_EMBOSS);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "colorize":    // param color = RGB decimal colors (-255 to +255)
        $color_red = $_REQUEST["color_red"];
        $color_green = $_REQUEST["color_green"];
        $color_blue = $_REQUEST["color_blue"];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_COLORIZE, $color_red, $color_green, $color_blue);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;
/* IN PROGRESS
    case "hue": // param color = hex color
        $color_red = $_REQUEST["color_red"];
        $color_green = $_REQUEST["color_green"];
        $color_blue = $_REQUEST["color_blue"];
        $in = WideImage::load($editDirectory.$imageName);
            $rgb = $color_red + $color_green + $color_blue;
            $col = array($color_red/$rgb, $color_blue/$rgb, $color_green/$rgb);
            $height = $in->getHeight();
            $width = $in->getWidth();
            for($x=0; $x<$width; $x++){
                for($y=0; $y<$height; $y++){
                    $rgb = $in->getRGBAt( $x, $y);
                    $r = $col[0];
                    $g = $col[1];
                    $r = $col[2];
                    $newR = $r*$col[0] + $g*$col[1] + $b*$col[2];
                    $newG = $r*$col[2] + $g*$col[0] + $b*$col[1];
                    $newB = $r*$col[1] + $g*$col[2] + $b*$col[0];
                    $in->setRGBAt( $x, $y, array($newR, $newG, $newB));
                }
            }
        $in->saveToFile($editDirectory.$imageName);
        $in->destroy();
        break;
*/
    case "blur":    // no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_GAUSSIAN_BLUR);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "smooth":  // no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_SMOOTH, 5);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "invert":  // no additional params.
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->asNegative();
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "brightness":  // param amt = amount to brightness (up or down)
        $amt = $_REQUEST['amt'];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_BRIGHTNESS, $amt);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;

    case "contrast":   // param amt = amount to cotrast (up or down)
        $amt = $_REQUEST['amt'];
        $in = WideImage::load($editDirectory . $imageName);
        $out = $in->applyFilter(IMG_FILTER_CONTRAST, $amt);
        $out->saveToFile($editDirectory . $imageName);
        $in->destroy();
        $out->destroy();
        break;
}

list($w, $h) = getimagesize($editDirectory . $imageName);
echo '{imageFound:true,imageName:"' . $imageName . '",w:' . $w . ',h:' . $h . '}';
?>