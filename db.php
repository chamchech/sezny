<?php
//Database Connection
function connect() {
    $username = 'dbu1074334';
    $password = 'MmMp1503!sezny!';
    $mysqlhost = 'db5003530627.hosting-data.io';
    $dbname = 'dbs2871453';
    $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
    if($pdo){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }else{
        die("Could not create PDO connection.");
    }
}

$sql = connect(); 