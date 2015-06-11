<?php
require('connect_db.php');

if(mysqli_ping($dbc))
{
    echo 'MySQL Server'.mysqli_get_server_info($dbc).'on'.mysqli_get_host_info($dbc);
}
echo 'ok from here';
$q = 'SHOW TABLES';
$r = mysqli_query($dbc,$q);

if($r) {
    echo '<h1>Tables on the Lesson 7 Database</h1>';
    while ($row = mysqli_fetch_array($r, MYSQLI_NUM)){
        echo'<br>'.$row[0];
    }
    mysqli_free_result($r);
    mysqli_close($dbc);
}
else{
    echo '<p>'.mysqli_error($dbc).'</p>';
}
?>