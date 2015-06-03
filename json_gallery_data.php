<?php
header("Content-Type: application/json");
$folder = $_POST["folder"];
$jsonData = '{';
//$dir = $folder."/";
$dir = gallery1."/";
$dirHandle = opendir($dir); 
$i = 0;
while ($file = readdir($dirHandle)) {
	if(!is_dir($file) && strpos($file, '.JPG')){
		$i++;
		$src = "$dir$file";
$jsonData .= '"img'.$i.'":{ "num":"'.$i.'","src":"'.$src.'", "name":"'.$file.'" },';
    }
}
closedir($dirHandle);
$jsonData = chop($jsonData, ",");
$jsonData .= '}';
echo $jsonData;
?>