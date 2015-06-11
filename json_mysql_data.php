<?php
header("Content-Type: application/json");
if(isset($_POST['limit'])){
	$limit = preg_replace('#[^0-9]#', '', $_POST['limit']);
	require_once("../connect_db.php");
	$i = 0;
	$jsonData = '{';
        $sqlString = "SELECT * FROM lesson7 ORDER BY RAND() LIMIT $limit";
	$query = mysqli_query($dbc, $sqlString); 
	while ($row = mysqli_fetch_array($query)) {
		$i++;
    	$id = $row["id"]; 
    	$title = $row["title"];
		$cd  = $row["cd"];
                $cd = strftime("%B %d, %Y", strtotime($cd));
                $jsonData .= '"article'.$i.'":{ "id":"'.$id.'","title":"'.$title.'", "cd":"'.$cd.'" },';
	}
	$now = getdate();
    $timestamp = $now[0];
	$jsonData .= '"arbitrary":{"itemcount":'.$i.', "returntime":"'.$timestamp.'"}';
	$jsonData .= '}';
    echo $jsonData;
}
?>
