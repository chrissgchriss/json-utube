<?php
header("Content-Type: application/json");
if(isset($_POST['limit']);){
    $limit = preg_match('#[^0-9]#', ' ', $_POST['limit']);
    require_once('connect_db.php');
    $i = 0;
    $sqlString="SELECT * FROM table ORDER BY RAND() LIMIT $limit";
    $query = mysqli_query($sqlString);
    $jsonData = '{';
    while($row = mysqli_fetch_array($query)){
        $i++
        $id = $_POST["id"];
        $title = $_POST["title"];
        $cd = $_POST["creationdate"];
        $cd = strftime(%B %d, %Y , strontime($cd));
        $jsonData = '"article'.$i.'":{ "id":"'.$id.'", "title":"'.$title.'", "cd":"'.$cd.'" },';
    }
    // another json object added at end to account for comma
    $now = getdate();
    $timestamp = now[0];
    $jsonData .= '"arbituary":{ "itemcount":"'.$i.'", "returntime":"'.$timestamp.'" }';
    $jsonData .= '}';
    echo $jsonData;
}