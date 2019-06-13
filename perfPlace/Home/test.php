<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'perf_place';

$conn = new mysqli('localhost', $user, $password, $db) or die("Unable to connect!");

$sql = "SET PASSWORD FOR root@localhost = PASSWORD('')";
$result = $conn->query($sql);


?>