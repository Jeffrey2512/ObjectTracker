<?php
include 'db_connect.php';
include 'functions.php';

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$userId = $input['userId'];

$Sql_Query = "SELECT * FROM espace_objet WHERE userId = '$userId'";
$check = mysqli_fetch_array(mysqli_query($connection,$Sql_Query));
$result = mysqli_query($connection,$Sql_Query);

if(isset($check))
{
    $row = mysqli_fetch_assoc($result);
    $userId = $row["userId"];
    $userName = $row["userName"];
    $userEmail = $row["userEmail"];
    $tracker_name = $row["tracker_name"];
    $tracker_image = $row["tracker_image"];
    $tracker_adress = $row["tracker_adress"];
    $statut = $row["statut"];
    $faire_sonner = $row["faire_sonner"];
    $faire_clignoter = $row["faire_clignoter"];
    $mode_perdu = $row["mode_perdu"];
    $numero = $row["numero"];

    $Response[] = array("userId" => $userId,"userName" => $userName,"userEmail" => $userEmail,"tracker_name" => $tracker_name,"tracker_image" => $tracker_image,"tracker_adress" => $tracker_adress,"statut" => $statut,"faire_sonner" => $faire_sonner,"faire_clignoter" => $faire_clignoter,"mode_perdu" => $mode_perdu,"numero" => $numero,);  

    $SuccessTrackerListMsg = $Response;
    $SuccessTrackerListJson = json_encode($SuccessTrackerListMsg);
    echo $SuccessTrackerListJson;
}
else 
{
    $userId = "";
    $userName = "";
    $userEmail = "";
    $tracker_name = "";
    $tracker_image = "";
    $tracker_adress = "";
    $statut = "";
    $faire_sonner = "";
    $faire_clignoter = "";
    $mode_perdu = "";
    $numero = "";

    $Response[] = array("userId" => $userId,"userName" => $userName,"userEmail" => $userEmail,"tracker_name" => $tracker_name,"tracker_image" => $tracker_image,"tracker_adress" => $tracker_adress,"statut" => $statut,"faire_sonner" => $faire_sonner,"faire_clignoter" => $faire_clignoter,"mode_perdu" => $mode_perdu,"numero" => $numero,);  

    $InvalidMSG = $Response;
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon;

   
}

mysqli_close($connection);
?>








<?php
// include 'db_connect.php';
// include 'functions.php';

// $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, TRUE); 

// $userId = $input['userId'];

// $Sql_Query = "SELECT * FROM espace_objet WHERE userId = '$userId'";
// $check = mysqli_fetch_array(mysqli_query($connection,$Sql_Query));
// $result = mysqli_query($connection,$Sql_Query);

// while ($row = mysqli_fetch_all($result)) {
//     $Item = $row;
//     $jsons = json_encode($Item);
// }


// if(isset($check))
// {
//     $SuccessTrackerListMsg = 'list tracker'.$jsons;
//     $SuccessTrackerListJson = json_encode($SuccessTrackerListMsg);
//     echo $SuccessTrackerListJson; 
// }
// else
// {
 
//    $InvalidMSG = 'Vous avez pas d objet enregistre';
//    $InvalidMSGJSon = json_encode($InvalidMSG);
//    echo $InvalidMSGJSon ;
   
// }
// mysqli_close($connection);
?>