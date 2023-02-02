<?php

include 'db_connect.php';
include 'functions.php';
 
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
 
$name = $obj['name'];
$email = $obj['email'];
$password = $obj['password'];
 
$CheckSQL = "SELECT * FROM espace_membre WHERE email = '$email'";
$check = mysqli_fetch_array(mysqli_query($connection,$CheckSQL));
 
if(isset($check))
{
    $EmailExistMSG = 'L email existe déjà, veuillez réessayer !!!';
    $EmailExistJson = json_encode($EmailExistMSG);
    echo $EmailExistJson ; 
}
else
{
    $Sql_Query = "insert into espace_membre (name,email,password) values ('$name','$email','$password')";
    if(mysqli_query($connection,$Sql_Query))
    {
        $MSG = 'Utilisateur enregistré avec succès' ;
        $json = json_encode($MSG);
        echo $json ;
    }
    else
    {
        echo 'Essayez à nouveau';
    }
}
mysqli_close($connection);
?>