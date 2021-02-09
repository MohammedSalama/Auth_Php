<?php

session_start();

require '../inc/db.php';

if(isset($_POST['submit']))
{
    $name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
    $mobile = filter_var($_POST['mobile'] , FILTER_SANITIZE_STRING);
    $password = password_hash (filter_var($_POST['password'] , FILTER_SANITIZE_STRING) , PASSWORD_DEFAULT);

    // echo '<pre>';
    // print_r($password);
    // echo '</pre>';

    // insert into database
    $sql = "INSERT INTO users (`name` , email , mobile , `password`) 
    VALUES ( ? , ? , ? , ?)";

    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([$name , $email , $mobile , $password]);

    $_SESSION['success'] = "U insert valid data";

}

header("location:../register.php");