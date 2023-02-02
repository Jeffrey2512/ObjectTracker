<?php

include 'db_connect.php';
include 'functions.php';

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$inputJSON = file_get_contents('php://input');
$obj = json_decode($inputJSON, TRUE);

$userId = $obj['userId'];
$userName = $obj['userName'];
$userEmail = $obj['userEmail'];
$tracker_name = $obj['tracker_name'];
$tracker_adress = $obj['tracker_adress'];
$tracker_image = $obj['tracker_image'];
$statut = $obj['statut'];
$faire_sonner = $obj['faire_sonner'];
$faire_clignoter = $obj['faire_clignoter'];
$mode_perdu = $obj['mode_perdu'];
$numero = $obj['numero'];

$CheckSQL = "SELECT * FROM espace_objet WHERE tracker_adress = '$tracker_adress'";
$check = mysqli_fetch_array(mysqli_query($connection,$CheckSQL));

if(isset($check))
{
    $TrackerExistMSG = 'Vous ne pouvez pas ajouter ce tracker';
    $TrackerExistJson = json_encode($TrackerExistMSG);
    echo $TrackerExistJson ; 
}
else
{
    $Sql_Query = "insert into espace_objet (userId,userName,userEmail,tracker_name,tracker_adress,tracker_image,statut,faire_sonner,faire_clignoter,mode_perdu,numero) values ($userId,'$userName','$userEmail','$tracker_name','$tracker_adress','$tracker_image','$statut','$faire_sonner','$faire_clignoter','$mode_perdu','$numero')";
    if(mysqli_query($connection,$Sql_Query))
    {
        $MSG = 'L objet a ete enregistre avec succes' ;
        $json = json_encode($MSG);
        echo $json ;
    }
    else
    {
        $MError = 'Essayez a nouveau';
        $json = json_encode($MError);
        echo $json ;
    }
}
mysqli_close($connection);

?>