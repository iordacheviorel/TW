<?php

session_start();
session_regenerate_id(true);
$msg= "";
$con= mysqli_connect('127.0.0.1', 'root', '', 'perf_place', '3306');
//$mysql= mysqli_connect('localhost', 'root', '123456');
$name = $_POST['user'];
$password = $_POST['password'];
//test1234=$2y$10$IN2ea0fkKCh0DfDul3WJkO6Nz5A4ghu7C3gil.cnuX4fvYy9fkS2W
//$name = $con->real_escape_string($_POST['user']);
//$password = $con->real_escape_string($_POST['password']);

//$sql= $con->query("select * from usertable where name = '$name' ");
////echo "nu intra";
//if($sql->num_rows > 0){
//    echo "intra in if";
  //  $data= $sql->fetch_array();
    //   if($data!=NULL) echo "dif de null";

    //if(password_verify($password, $data['password'])) {
      //  echo "si aici intra";
        //header('location:home.php');

    //}else echo "nu intraaaaaaaaaaaa";

//}    else{
  //  $msg="nuuuuuuuuuuuuu";
//}

$s = "select * from utilizator where nume = '$name' ";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num > 0){
    $data= mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION['usern'] = $name;
    if(password_verify($password, $data['parola'])) {
        $_SESSION['log'] = true;
        header('location:home.php');

    }else $msg= "Parola gresita !";

}

?>