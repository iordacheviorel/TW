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
          <a href="../Home/home2.php" > acasa </a>
          <a href="../Anunturi/anunturi.php?tip=toate&mod=vanzare&oras=iasi&zona=canta&pret=200"> anunturi </a>
          <?php 
          if(isset($_SESSION['log'])){
            if($_SESSION['log'] = true){
              echo "<a href='../Login/logout.php'> delogare </a> <a href='add.php' class = 'selected' > adauga anunturi </a>";
            }else{
              echo "<a href='../Login/login.php'> autentificare/logare </a>";
            }
          }else{
            echo "<a href='../Login/login.php'> autentificare/logare </a>";
          }
          

          ?>
          
        </div>
      </div>
    </div>

    <div class="container">
          <form method="post"  action="adauga.php">
          Titlu: <input type="text" name="titlu"><br><br>
          Descriere: <input type="text" name="descriere"><br><br>
          Url poza: <input type="text" name="url"><br><br>
          Camere: <input type="number" name="camere"><br><br>
         
          Tara: <input type="text" name="tara"><br><br>
          Oras: <input type="text" name="oras"><br><br>
          Cartier: <input type="text" name="cartier"><br><br>
          <input type="submit" value="adauga"> 
          </form>
    </div>

    

  </body>


  </html>