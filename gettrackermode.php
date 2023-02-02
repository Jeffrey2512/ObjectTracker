<?php
include 'db_connect.php';
include 'functions.php';

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$tracker_adress = $input['tracker_adress'];

$Sql_Query = "SELECT * FROM espace_objet WHERE tracker_adress = '$tracker_adress'";
$check = mysqli_fetch_array(mysqli_query($connection,$Sql_Query));
$result = mysqli_query($connection,$Sql_Query);

if(isset($check))
{
    $row = mysqli_fetch_assoc($result);
    $mode_perdu = $row["mode_perdu"];
    

    $Response[] = array("mode_perdu" => $mode_perdu,);  

    $SuccessTrackerListMsg = $Response;
    $SuccessTrackerListJson = json_encode($SuccessTrackerListMsg);
    echo $SuccessTrackerListJson;
}
else 
{
      
    $InvalidMSG = '404 quelque chose ses mal passer';
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon ;
   
}

mysqli_close($connection);
?>
