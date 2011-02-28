<?php

function xoops_module_pre_install_ajaximagemanager(&$xoopsModule) {
 
 // Check if this XOOPS version is supported
 $minSupportedVersion = explode('.', '2.4.0');
 $currentVersion = explode('.', substr(XOOPS_VERSION,6));
 
 if($currentVersion[0] > $minSupportedVersion[0]) {
  return true;
 } elseif($currentVersion[0] == $minSupportedVersion[0]) {
  if($currentVersion[1] > $minSupportedVersion[1]) {
   return true;
  } elseif($currentVersion[1] == $minSupportedVersion[1]) {
   if($currentVersion[2] > $minSupportedVersion[2]) {
    return true;
   } elseif ($currentVersion[2] == $minSupportedVersion[2]) {
    return true;
   }
  }
 }
 
 return false;

}

function xoops_module_install_ajaximagemanager(&$xoopsModule) {
	
	// Create ajaximagemanager main upload directory
	$dir = XOOPS_ROOT_PATH."/uploads/ajaximagemanager";
	if(!is_dir($dir))
		mkdir($dir);
	$dir = XOOPS_ROOT_PATH."/uploads/ajaximagemanager/uploaded";
	if(!is_dir($dir))
		mkdir($dir);
	
	return true;
}

?>
