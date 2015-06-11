<?php
require(connect_db.php);
$q = 'SHOW TABLES';
$r = mysqli_query($dbc,$q);

if($r) {
    echo '<h1>Tables on the Lesson 7 Database</h1>';
    while ($row = mysqli_fetch_array($r, MYSQLI_NUM)){
        echo'<br>'.$row[0];
    }
    mysqli_free_results($r);
    mysqli_close($dbc);
}
else{
    echo '<p>.mysqli_error($dbc).'</p>';
}
?>