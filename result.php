<?php
require('../connect_db.php');
$q = 'SELECT * FROM lesson7';
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