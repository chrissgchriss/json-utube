<!DOCTYPE html>
<html>
<head>
<style>
div#databox {
	padding:12px;
	background: #F3F3F3;
	border:#CCC 1px solid;
	width:550px;
	height:310px;
        margin-top: 20px;
}
</style>
<script>
var myTimer;
function ajax_json_data(){
	var databox = document.getElementById("databox");
	var arbitrarybox = document.getElementById("arbitrarybox");
    var hr = new XMLHttpRequest();
    hr.open("POST", "json_mysql_data.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var d = JSON.parse(hr.responseText);
			arbitrarybox.innerHTML = d.arbitrary.returntime;
			databox.innerHTML = "";
			for(var o in d){
				if(d[o].title){
				    databox.innerHTML += '<p><a href="page.php?id='+d[o].id+'">'+d[o].title+'</a><br>';
					databox.innerHTML += ''+d[o].cd+'</p>';
				}
			}
	    }
    }
    hr.send("limit=4");
    databox.innerHTML = "requesting...";
	myTimer = setTimeout('ajax_json_data()',36000);
}
</script>
</head>
<body>
<h2>Timed JSON Data Request Random Items Script</h2>


<?php
require('../connect_db.php');
$q = 'SELECT title FROM lesson7';
$r = mysqli_query($dbc,$q);

if($r) {
    echo '<h1>Tables on the Lesson 7 Database</h1>';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
        echo'<br>'.$row['id'].'____'.$row['title'].'___'.$row['cd'];
    }
    mysqli_free_result($r);
    mysqli_close($dbc);
}
else{
    echo '<p>'.mysqli_error($dbc).'</p>';
}
?>

//<?php
//require('connect_db.php');
//$q = 'SELECT title FROM lesson7';
//$r = mysql_query($sqlString) or die (mysql_error()); 
//
//if($r) {
//    echo '<h3>Using older mysql query NOT mysqli to test</h3>';
//    while ($row = mysql_fetch_array($r)){
//        echo'<br>'.$row['id'].'____'.$row['title'].'___'.$row['cd'];
//    }
//}
//else{
//    echo '<p>'.mysql_error($dbc).'</p>';
//    echo "something went wrong ---";
//}
//?>



<div id="databox"></div>
<div id="arbitrarybox"></div>
<script>ajax_json_data();</script>
</body>
</html>