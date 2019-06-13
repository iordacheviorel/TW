<?php


    session_start();
    session_regenerate_id(true);

if (!isset($_SESSION['usern'])){
    header("location:login.php");
}
?>

<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
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
          <a href="logout.php" class = "selected" > delogare </a>
          <a href="../Anunturi/add.php"> adauga anunturi </a>
        </div>
    </div>
</div>

    <div class="container">

    <h1>Bun venit <?php   
    echo $_SESSION['usern'];
    ?>  </h1>
    </div>


</body>
</html>