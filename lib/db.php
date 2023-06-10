<?php
    $db_host = "localhost";
    $db_name = "db_ql_shopbanhang";
    $db_user = "root";
     //$db_pass = "PN2LecKirU91/ePn";
    $db_pass = "";
    global $conn;
    $dsn = "mysql:host=$db_host; dbname=$db_name;charset=utf8";
    try{
        $conn = new PDO($dsn, $db_user, $db_pass);
        $conn->query("set names utf8");
    }catch(PDOException $ex){
        echo "Loi";
        die();
    }
?>