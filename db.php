<?php
//Database Connection
function connect() {
    $username = 'root';
    $password = 'root';
   // $mysqlhost = 'db5003530627.hosting-data.io';
    $mysqlhost = 'localhost';
    $dbname = 'dbs454370';
    $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
    if($pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }else{
        die("Could not create PDO connection.");
    }
}

$sql = connect();
