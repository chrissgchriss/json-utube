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

//6/3/2015
<!DOCTYPE html>
    <html>
        <head>
            <style>
                div#databox {
                    padding:12px;
                    background-color: grey;
                    border: thin solid grey;
                    width: 550px; height: 310px;
                }
            </style>
            <script>
                var myTimer;
                function ajax_json_data() {
                    var databox  = document.getElementById("databox");
                    var arbitrary = document.getElementById("arbitrary");
                    var hr = new XMLHttpRequest();
                    hr.open("POST", "json_mysql_data.php", true);
                    hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    hr.onreadystatechange = function(){
                        if (hr.readystate == 4 && hr.status == 200) {
                            var d = JSON.parse(hr.responseText); // we now have JSON.parse results php ARRAY file inside of d
                            arbitrary.innerHTML = d.arbitrary.retuntime;
                            databox.innerHTML = ""; // needs to be cleared everytime - brings back 4 RAND() LIMIT $limit info from  table...
                            // the loop
                            for( var article in d ) {  // put everything you have how in d parsed as json
                                // "article1": { "id":"45rd", "title":"'.Star Trek.'", "cd":"'.December 11, 1987.'" },
                                // "article2": { "id":"67yy", "title":"'.Nine To Five'", "cd":"'.3 7, 1988.'" },
                                // "article3": { "id":"45pl", "title":"'.Monkey Max'", "cd":"'.6 11, 2015'" },
                                // "article4": { "id":"85pl", "title":"'.Avengers'", "cd":"'.5 09, 2014'" },
                                // "arbituary":{ "itemcount":"'.3.'", "returntime":"'.123458'" }
                                //
                                //
                                // the filter if...
                                // below filters it... gets 4 and puts 4 paragraphs into databox 
                                if (d[article].title) { // how does it know if it is article or arbitrary gets all 4 cus has title...
                                    databox.innerHTML += '<p><a href="page.php?id='+d[article].id+'">'+d[article].title+'</a><br>';
                                    databox.innerHTML += ''+d[article].cd+'</p>';
                                }
                            }
                            
                        }
                    }
                    hr.send("limit=4");
                    databox.innerHTML = "processing...";
                    myTimer = setTimeout('ajax_json_data()',6000); // this will force script to start every six seconds    
                }   
            </script>
        </head>
        <body>
            <h2>Timed JSON Data Request Random Items Script</h2>
            <div id="databox"></div>
            <div id="arbitrary"></div><!-- Array, then number from $i -->
            <script>ajax_json_data();</script>
        </body>
    </html>
    
    
 5/3/2015 : 10:04   
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Ajax json data from mysql database</title>
            <style>
                div#databox {
                    width: 530px;
                    height: 320px;
                    border: thin solid grey;
                    padding: 12px;
                    background-color: grey;
                }
            </style>
            <script type="text/javascript">
                $myTimer;
                function ajax_json_data() {
                    var databox = document.getItemById("databox");
                    var arbituarybox = document.getItemById("arbituarybox");
                    var hp = new XMLHttpRequest();
                    hp.open("POST","json_mysql_data", true);
                    hp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    hp.onreadystatechange = function() {
                        if (hp.readyState == 4 && hp.status == 200) {
                            var d = JSON.parse(hr.responseText);
                                arbituarybox.innerHTML = '+d[object].returnstamp+'; // access d directly
                                databox.innerHTML = "";
                                for(object in d) { // use loop to iterate over d, so need for (o in d) ??????
                                    if (d[object].title) {
                                        databox.innerHTML += '<p><a href="blog.page?='+d[object].id+'">'+d[object].title+'</a><br>';
                                        databox.innerHTML += ''+d[object].cd+'</p>';
                                    }
                                }
                        }
                    }
                    hp.send("limit=4");
                    mytimer = setTimeout('ajax_json_data()', 6000);   
                }
            </script>
        </head>
        <body>
            <h2>Timed JSON Data Request Random Items Script</h2>
            <div id="databox"></div>
            <div id="arbituarybox"></div>
            <script type="text/javascript">ajax_json_data();</script>
        </body>
    </html>
    
    
    
    
    
    
<?php
header("Content-Type: application/json");

$jsonData = '{';

$jsonData .= '"article1":{ "id":"5","title":"45454", "cd":"2323" },';
$jsonData .= '"article2":{ "id":"6","title":"45345", "cd":"1111" },';

$jsonData = chop($jsonData, ",");
$jsonData .= '}';
echo $jsonData;
?>