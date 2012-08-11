<?php
/*
getImage.php
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

// required param: imageName



// XOOPS PATCH - START HERE
//$editDirectory = getcwd()."/edit/";

// get xoops rooth path
$currentPath = dirname(__FILE__);
if ( DIRECTORY_SEPARATOR != "/" ) {
    $currentPath = str_replace( DIRECTORY_SEPARATOR, "/", $currentPath);
}
$xoops_root_path = substr($currentPath, 0, strpos(strtolower($currentPath), '/modules/ajaxfilemanager/imageeditor'));
define('XOOPS_ROOT_PATH', $xoops_root_path);
// get xoops rooth path - end

$tempPath = XOOPS_ROOT_PATH . '/modules/ajaxfilemanager/imageeditor/ImageEditor';
$editDirectory = $tempPath . '/edit/';
// XOOPS PATCH - END HERE



$imageName = str_replace("../", "", $_GET["imageName"]);

if(empty($imageName) || !file_exists($editDirectory . $imageName)) { exit; }

$fileInfo = pathinfo($editDirectory . $imageName);
switch($fileInfo['extension']) {
	case "gif":
		header('Content-Type: image/gif');
		$output = imagecreatefromgif($editDirectory . $imageName);
		imagegif($output, "", 100);
		break;
	case "png":
		header('Content-Type: image/png');
		$output = imagecreatefrompng($editDirectory . $imageName);
		imagepng($output);
		break;
	case "jpg":
	case "jpeg":
	default:
		header('Content-Type: image/jpeg');
		$output = imagecreatefromjpeg($editDirectory . $imageName);
		imagejpeg($output, "", 100);
		break;
}
?>