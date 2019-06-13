<?php

session_start();
session_regenerate_id(true);
//header('location:login.php');
$con= mysqli_connect('127.0.0.1', 'root', '', 'perf_place', '3306');
//$mysql= mysqli_connect('localhost', 'root', '123456');
$msg= "";

$name = $_POST['user'];
$password = $_POST['password'];

$s = "select * from utilizator where nume = '$name' ";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    echo "Username already taken";
   
    // header("location:login.php");
} else{
    $hash= password_hash($password, PASSWORD_BCRYPT);
    $reg= "insert into utilizator(nume , parola) values ('$name' , '$hash')";
    mysqli_query($con , $reg);
    echo "Registration Successful";
   
    // header("location:login.php");

}
?>