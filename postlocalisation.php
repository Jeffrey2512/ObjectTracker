<?php

include 'db_connect.php';
include 'functions.php';
 
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
 
$Trame_latitude = $_GET['latitude'];
$Trame_longitude = $_GET['longitude'];
$tracker_adress = $_GET['tracker_adress'];

// Traitement lagitude
$degree_latitude = substr($Trame_latitude,0,2);
$minutee_latitude = substr($Trame_latitude,2,2);
$secondee_latitude = substr($Trame_latitude,5,5);

$degree_minute_latitude = (($minutee_latitude/60) + ((($secondee_latitude * 0.00001) * 60) / 3600));
$coordonner_latitude_exact = ($degree_latitude + $degree_minute_latitude);

// Traitement longitude
$degree_longitude = substr($Trame_longitude,0,2);
$minutee_longitude = substr($Trame_longitude,2,2);
$secondee_longitude = substr($Trame_longitude,5,5);

$degree_minute_longitude = (($minutee_longitude/60) + ((($secondee_longitude * 0.00001) * 60) / 3600));
$coordonner_longitude_exact = ($degree_longitude + $degree_minute_longitude);

// $CheckSQL = "SELECT * FROM espace_localisation WHERE dateHeurs = NOW()";
// $CheckSQL = "SELECT * FROM espace_localisation WHERE latitude = '$latitude'";
$CheckSQL = "SELECT * FROM espace_localisation WHERE latitude = '$coordonner_latitude_exact' AND longitude = '$coordonner_longitude_exact'";
$check = mysqli_fetch_array(mysqli_query($connection,$CheckSQL));

if(isset($check))
{
    $LocalisationExistMSG = 'localisation existe';
    $LocalisationExistJson = json_encode($LocalisationExistMSG);
    echo $LocalisationExistJson ; 
}
else
{
    $Sql_Query = "insert into espace_localisation (tracker_adress,latitude,longitude,dateHeurs) values ('$tracker_adress','$coordonner_latitude_exact','$coordonner_longitude_exact',NOW())";
    if(mysqli_query($connection,$Sql_Query))
    {
        $MSGSucces = 'localisation enregistre' ;
        $json = json_encode($MSGSucces);
        echo $json ;
    }
    else
    {
        $InvalidMSG = '404 quelque chose ses mal passer';
        $InvalidMSGJSon = json_encode($InvalidMSG);
        echo $InvalidMSGJSon ;
    }
}
mysqli_close($connection);
?>