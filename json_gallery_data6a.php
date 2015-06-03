<?php
header("Content-Type: application/json");
$folder = $_POST["folder"];
$jsonData = '{';
$dir = $folder."/";
$dirHandle = opendir($dir);
$i = 0;
while($file = readdir($dirHandle)){
    if(!is_dir($file) && preg_match("/.jpg|.gif|.png/i", $file)){
            $i++;
            $src = "$dir$file";
    //$jsonData .= '"img'.$i.'":{ "num":"'.$i.'","src":"'.$src.'", "name":"'.$file.'" },';
    //$jsonData .= '"img'.$i.'":{ "num":"'.$i.'","src":"'.$src.'" },';
    $jsonData .= '"img'.$i.'":{ "num":"'.$i.'","src":"'.$src.'" },';   
    }  
}
closedir($dirHandle);
$jsonData = chop($jsonData,",");
$jsonData .= '}';
echo $jsonData;
?>

