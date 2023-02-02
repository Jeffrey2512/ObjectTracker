<?php

include 'db_connect.php';
include 'functions.php';
 
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
 

$faire_sonner = $obj['faire_sonner'];
$tracker_adress = $obj['tracker_adress'];

 
$CheckSQL = "SELECT * FROM espace_objet WHERE tracker_adress = '$tracker_adress'";
$check = mysqli_fetch_array(mysqli_query($connection,$CheckSQL));
 
if(isset($check))
{
    $Sql_Query = " UPDATE espace_objet SET faire_sonner = '$faire_sonner' WHERE tracker_adress = '$tracker_adress'";
    if(mysqli_query($connection,$Sql_Query))
    {
        $MSG = 'faire_sonner effectuer' ;
        $json = json_encode($MSG);
        echo $json ;
    }
    else
    {
        $InvalidMSG = 'Connection non etablie';
        $InvalidMSGJSon = json_encode($InvalidMSG);
        echo $InvalidMSGJSon ;
    }
}
else
{
    $InvalidMSG = '404 quelque chose ses mal passer';
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon ;
}
mysqli_close($connection);
?>