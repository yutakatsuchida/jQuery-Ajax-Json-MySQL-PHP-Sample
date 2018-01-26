<?php

// If users access this file directly, redirect to index.html automatically
if (
    !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
    && (!empty($_SERVER['SCRIPT_FILENAME']) && basename($_SERVER['PHP_SELF']) === basename($_SERVER['SCRIPT_FILENAME']))
    ) 
{
    header ('location: index.html');
    die ('No data');
}

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
    //var_dump($result->fetch_assoc());

    //echo $result->num_rows;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $users[] = array(
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'email' => $row['email']
      ); 
      //var_dump($row);
      // echo "<tr>"
      //   ."<th scope='row'>" . $row["id"]. "</th>"
      //   ."<td>" . $row["first_name"] . "</td>"
      //   ."<td>" . $row["last_name"] . "</td>"
      //   ."<td>" . $row["email"] . "</td>";
      // $users[] = array(
      //   'id' => $row->id,
      //   'first_name' => $row->first_name
      // );
      // echo($users);
    }
    } else {
      echo "0 results";
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $users );
    exit;

// mysql_close($dbconnection);
$dbconnection->close();
?> 
  </body>
</html>
