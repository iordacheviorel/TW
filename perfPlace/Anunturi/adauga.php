<?php 
session_start();
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style_add.css">
    <meta charset="UTF-8">
  </head>
  <body>
    <div class= "navbar-container">
      <div class="navbar">
        <div class= "logo">
          <a> perfect place </a>
        </div>
        <div class= "meniu">
          <a href="home2.php" > acasa </a>
          <a href="../Anunturi/anunturi.php?tip=toate&mod=vanzare&oras=iasi&zona=canta&pret=200"> anunturi </a>
          <?php 
          if(isset($_SESSION['log'])){
            if($_SESSION['log'] = true){
              echo "<a href='../Login/logout.php'> delogare </a>";
            }else{
              echo "<a href='../Login/login.php'> autentificare/logare </a>";
            }
          }else{
            echo "<a href='../Login/login.php'> autentificare/logare </a>";
          }
          

          ?>
          <a href="Anunturi/add.php" class = "selected" > adauga anunturi </a>
        </div>
      </div>
    </div>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perf_place";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$titlu = $_POST['titlu'];
$descriere = $_POST['descriere'];
$url = $_POST['url'];
$camere = $_POST['camere'];
$tara = $_POST['tara'];
$oras = $_POST['oras'];
$cartier = $_POST['cartier'];

$sql = "INSERT INTO anunt (titlu, descriere, poze, nrCamere, tara, oras, cartier, id_proprietar ) values
 ('$titlu','$descriere', '$url', '$camere', '$tara', '$oras', '$cartier', 2)";

if (mysqli_query($conn, $sql)) {
    echo "Adaugare cu succes";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

  </body>


</html>