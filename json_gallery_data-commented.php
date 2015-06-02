<?php
header("Content-Type: application/json");
$folder = $_POST["folder"]; // this becomes gallery1
$jsonData = '{'; // will be used later as the first character of a compounding remember the mylist.json file { } ?
$dir = $folder,"/"; // gallery1/
$dirHandle = opendir($dir); // i guess opens this directory?
$i = 0;
while ($file = readdir($dirHandle)) { // represents each independent file is being read
    if(!is_dir($file) && strpos($file, '.jpg')) { // if the file is NOT a directory and it has a dot jpg extention -strpos means spring position
        // if passes above if - then we start making our json data object
        $i++; // loops
        $src = "$dir$file"; // puting together the $src and $file so becomes gallery1/unknownfile.jpg
        // img2
        // {img3:{"1:" ""src:"gallery1/unknownfile.jpg}
        // img4 -- $i can now be 3,4,5 whatever...
        // $jsonData, which started up there is just compounding so { }
        $jsonData .= '"img'.$i.'":( "num":"'{'.$i.'","src":"'.$src.'","name":"'.$file.'"},');
    }
}
closedir($dirHandle);
$jsonData = chop($jsonData, ","); //removes the last comma 
//
$jsonData .= '}'; //compound the closing curly brace -- open curly brace above, middle loop adds the images and close here
echo $jsonData;

// all this creates json data objects, like before...see mylist.json {
    "img1":{"num":"1",   "src":"gallery1/eyesclosed3.jpg",    "name":"eyesclosed3.jpg" },
    "img2":{"num":"2",   "src":"gallery1/strongman.jpg",      "name":"strongman.jpg" },
    "img3":{"num":"3",   "src":"gallery1/rotatinglemon.jpg",  "name":"rotatinglemon.jpg" },
    "img4":{"num":"4",   "src":"gallery1/killerbees.jpg",     "name":"killerbees.jpg" }
    
}
?>