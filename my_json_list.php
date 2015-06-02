<?php
// make sure application knows it is json data not php
header("Content-Type: application/json");
// we are sending (static variables) via POST birds and bees - var1=birds&var2=bees
$var1 = $_POST["var1"]; // birds
$var2 = $_POST["var2"]; // bees
// create a json object with one object inside - same as you were doing with mylist...
// now it is putting what was in POST[] into json object - which are key value pairs not just arrays...
$jsonData = '
{
"obj1":{"propertyA":"'.$var1.'" , "propertyB":"'.$var2.'"}
}';
echo $jsonData;
?>