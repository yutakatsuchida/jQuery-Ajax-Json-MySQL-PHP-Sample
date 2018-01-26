<?php
$hostname = 'localhost';
$dbusername = 'root';
$dbname = 'dbusers';
// $dbconnection = mysql_connect($hostname, $dbusername, '')
//         or die('unable to connect.');
$dbconnection = new mysqli($hostname, $dbusername, '', $dbname);

if ($dbconnection->connect_error) {
  die('Connect Error: ' . $dbconnection->connect_error);
}

//echo 'scceeded';
//mysql_select_db($dbname);


$sql = "SELECT id, first_name, last_name, email FROM users";
$result = $dbconnection->query($sql);

echo $result->num_rows;
if ($result->num_rows >= 2) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";
}


// mysql_close($dbconnection);
$dbconnection->close();
?>