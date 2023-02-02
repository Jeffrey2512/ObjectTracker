<?php
include 'db_connect.php';
include 'functions.php';

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$tracker_adress = $input['tracker_adress'];

$Sql_Query = "SELECT * FROM espace_localisation WHERE tracker_adress = '$tracker_adress'";
$check = mysqli_fetch_array(mysqli_query($connection,$Sql_Query));
$result = mysqli_query($connection,$Sql_Query);

if(isset($check))
{
    $row = mysqli_fetch_assoc($result);
    $tracker_adress = $row["tracker_adress"];
    $latitude = $row["latitude"];
    $longitude = $row["longitude"];
    $dateHeurs = new DateTime($row["dateHeurs"]);
    

    $Response[] = array("tracker_adress" => $tracker_adress,"latitude" => $latitude,"longitude" => $longitude,"dateHeurs" => $dateHeurs);  

    $SuccessTrackerListMsg = $Response;
    $SuccessTrackerListJson = json_encode($SuccessTrackerListMsg);
    echo $SuccessTrackerListJson;
}
else 
{
    $tracker_adress = "";
    $latitude = "";
    $longitude = "";
    $dateHeurs = "";
    

    $Response[] = array("tracker_adress" => $tracker_adress,"latitude" => $latitude,"longitude" => $longitude,"dateHeurs" => $dateHeurs);  

    $InvalidMSG = $Response;
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon;

   
}

mysqli_close($connection);
?>