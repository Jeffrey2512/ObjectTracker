<?php
include 'db_connect.php';
include 'functions.php';

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); 

$email = $input['email'];
$password = $input['password'];

$Sql_Query = "SELECT * FROM espace_membre WHERE email = '$email' and password = '$password'";
$check = mysqli_fetch_array(mysqli_query($connection,$Sql_Query));
$result = mysqli_query($connection,$Sql_Query);

if(isset($check))
{
    $row = mysqli_fetch_assoc($result);
    $userId = $row["userId"];
    $name = $row["name"];
    $email = $row["email"];
    $password = $row["password"];
    

    $Response[] = array("userId" => $userId,"name" => $name,"email" => $email,"password" => $password);  

    $SuccessLoginMsg = $Response;
    $SuccessLoginJson = json_encode($SuccessLoginMsg);
    echo $SuccessLoginJson;
}
else 
{
    $InvalidMSG = 'Nom d utilisateur ou mot de passe invalide Veuillez réessayer';
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon ;

   
}

mysqli_close($connection);

?>