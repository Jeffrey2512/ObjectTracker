<?php

include 'db_connect.php';
include 'functions.php';
 
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
 
$mode_perdu = $obj['mode_perdu'];
$numero = $obj['numero'];
$tracker_adress = $obj['tracker_adress'];

 
$CheckSQL = "SELECT * FROM espace_objet WHERE tracker_adress = '$tracker_adress'";
$check = mysqli_fetch_array(mysqli_query($connection,$CheckSQL));
 
if(isset($check))
{
    $Sql_Query = " UPDATE espace_objet SET mode_perdu = '$mode_perdu',numero = '$numero' WHERE tracker_adress = '$tracker_adress'";
    if(mysqli_query($connection,$Sql_Query))
    {
        $MSG = 'Mode perdu effecter' ;
        $json = json_encode($MSG);
        echo $json ;
    }
    else
    {
        $MError = 'Essayez à nouveau';
        $json = json_encode($MError);
        echo $json ;
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