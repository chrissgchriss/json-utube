<?php
header("Content-Type: application/json");
$folder = $_POST["folder"];
$jsonData = '{';
$dir = $folder,"/";
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


//6/1/2015
<?php
header("Content-Type: application/json");//header
$folder = $_POST['folder'];// get post info
$jsonData = '{'; // put in first bracket
$dir = $folder,"/"; // want directory gallery+/file.JPG aka gallery1/IMG_1447.JPG
$dirhandle = opendir($dir); // open the directory, read contents, close it - like mysqli_fetch_array(ASSOC_ARRRAY)
$i = 0; // start variable for look at zero
while( $file = readdir($dirhandle)){ // do while loop
    if(!is_dir($file) && strpos($file, '.JPG')){ // if not a folder and is a JPG
        $1++; // make loop increment
        $src=$dir+$file // finally...put directory and file together
             //"img   1  ":{"num":"  1    ",   "src":"gallery1/eyesclosed3.jpg",    "name":"eyesclosed3.jpg" },
$jsonData .= '"img'   .$i.   '":{"num":"'   .$i.   '","src":"'   .$src.   '"},';// middle of jsonData
    }
}
closedir($dirHandle); // just like mysqli_close
$jsonData = chop($jsonData, ","); // take out last comma
$jsonData .= '}'; // put in final ends
// print to screen
?>


//6/2/2015
<?php
header("Content-Type: application/json"); 
$folder = $_POST['folder'];
$jsonData = '{'; 
$dir = $folder."/";
$dirHandle = opendir($dir); // this puts everything into $dirHandle
$i=0;
while ( $file = readdir($dirHandle)) { // this puts everything in $file
    if( !is_dir($file) && strpos($file, '.JPG')){ 
        $i++;
        //1. forgot to create a junk variable to put directory and file together aka gallery1/IMG_1447.JPG
        $src = "$dir$file";
        $jsonData = '"img' .$i. '":{num":"' .$i. '", "src":"' .$src. '",}'
    }
}    
closedir($dirHandle); //2. because $dir is inside $dirHandle 
$jsonData = trim($jsonData, "," );
$jsonData .= '};'
echo $jsonData;         
?>