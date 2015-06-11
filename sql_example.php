<!DOCTYPE html>
    <html>
        <head> <title>Sample SQL Querys</title></head>
       <body>
        <?php
// connect to your database - needs to be outside public http docs folder for security
require_once('../connect_db.php');
$list = "";
$num = 0;
// note GROUP BY determines where count is taken from, without GROUPing it counts ALL ROWS
$sql = "SELECT title, COUNT(title) AS amount FROM lesson7 GROUP BY title ORDER BY amount DESC LIMIT 12";
//$sql = "SELECT title, COUNT(title) as amount FROM lesson7 GROUP BY title";
//$sql = "SELECT title, COUNT(title) as amount FROM lesson7";
$query = mysqli_query($dbc, $sql) or die( mysqli_error($dbc) );
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $num++;
    $title = $row["title"];
    $amount = $row["amount"];
    $list .= $num.') '.$title.' - <b>'.$amount.'</b> people<br>';
    $firstresult = $list;
}
echo 'First Result<br>';
echo $list;

$list = "";
$num = 0;
// note GROUP BY determines where count is taken from, without GROUPing it counts ALL ROWS
//$sql = "SELECT title, COUNT(title) AS amount FROM lesson7 GROUP BY title ORDER BY amount DESC LIMIT 12";
$sql = "SELECT title, COUNT(title) as amount FROM lesson7 GROUP BY title";
//$sql = "SELECT title, COUNT(title) as amount FROM lesson7";
$query = mysqli_query($dbc, $sql) or die( mysqli_error($dbc) );
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $num++;
    $title = $row["title"];
    $amount = $row["amount"];
    $list .= $num.') '.$title.' - <b>'.$amount.'</b> people<br>';
}
echo 'Second Result<br>';
echo $list;

$list = "";
$num = 0;
// note GROUP BY determines where count is taken from, without GROUPing it counts ALL ROWS
//$sql = "SELECT title, COUNT(title) AS amount FROM lesson7 GROUP BY title ORDER BY amount DESC LIMIT 12";
//$sql = "SELECT title, COUNT(title) as amount FROM lesson7 GROUP BY title";
$sql = "SELECT title, COUNT(title) as amount FROM lesson7";
$query = mysqli_query($dbc, $sql) or die( mysqli_error($dbc) );
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $num++;
    $title = $row["title"];
    $amount = $row["amount"];
    $list .= $num.') '.$title.' - <b>'.$amount.'</b> people<br>';
}
mysqli_close($dbc);
echo '<div style="background-color: yellow; padding: 10px;">';
echo 'Third Result<br>';
echo $list;
echo '</div>';
?>
        <div style="background-color: grey; padding-left: 50px;"><?php echo $firstresult; ?></div>
        
    </body>
</html>






