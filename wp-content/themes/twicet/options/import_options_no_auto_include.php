<?php 
if (!function_exists('scandir')) {
	function scandir($directory, $sorting_order=0) {
		if(!is_dir($directory)) {
			return false; 
		}
		$files = array();
		$handle = opendir($directory);
		while (false !== ($filename = readdir($handle))) {
			$files[] = $filename; 
		}
		closedir($handle);
 
		if($sorting_order == 1) {
			rsort($files); 
		} else {
			sort($files); 
		}
		return $files;
		}
}

function ordnerinhalt($folder='.') {
	$content = "";
 	global $include_result;
	foreach(scandir($folder) as $file) {
		if($file[0] != '.') { // Versteckte Dateien nicht anzeigen
			if(is_dir($folder.'/'.$file)) {
				$folderArray[] = $file;
			} else {
				$fileArray[] = $file;
			}
		}
	}
	
	if(isset($folderArray)) {
		foreach($folderArray as $row) {
			$include_result[] = ordnerinhalt($folder.'/'.$row); // rekursive Funktion
		}
	}


	// ...dann die Dateien ausgeben
	if(isset($fileArray)) {
		foreach($fileArray as $row) {
			if(preg_match("/.php$/",$row) &&! preg_match("/no_auto_include.php$/",$row) ){
			$include_result[] = $folder.'/'.$row; //Dateien verlinken
			}
		}
	}
	
	// Rekursion ende
	return $content;
}

function contains_content($var){
	return $var != "";
}


$include_result[] = ordnerinhalt(dirname(__FILE__));
$includes = array_filter($include_result, "contains_content");
arsort($includes);

foreach ($includes as $include)
{
include_once($include);
}


?>