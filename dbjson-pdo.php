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

// database connection
$dsn = 'mysql:dbname=dbusers;host=localhost;charset=utf8';
$dbusername = 'root';
$password = '';

try
{
    // initialization
    $users = null;

    // connect the database with PDO object
    $dbconnection = new PDO($dsn, $dbusername, $password);

    // get datas in table 'users'
    $sql = 'SELECT * FROM users';
    $result = $dbconnection->query($sql);

    // put data into array.
    while ($row = $result->fetchObject())
    {
      //var_dump($row);
         $users[] = array(
            'id'=> $row->id,
            'first_name' => $row->first_name,
            'last_name' => $row->last_name,
            'email' => $row->email
        );
    }

    // convert the data into json format
    header('Content-Type: application/json');
    echo json_encode( $users );
    exit;
}
catch (PDOException $e)
{
    // exception
    die('Error:' . $e->getMessage());
}