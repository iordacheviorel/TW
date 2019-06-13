
<html>
<head>
    <title>User Login and Regstration</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php $msg= ""; ?>
<body>

 <div class= "navbar-container">
      <div class="navbar">
        <div class= "logo">
          <a> perfect place </a>
        </div>
        <div class= "meniu">
          <a href="../Home/home2.php" > acasa </a>
          <a href="../Anunturi/anunturi.php?tip=toate&mod=vanzare&oras=iasi&zona=canta&pret=200"> anunturi </a>
          <?php if(isset($_SESSION['log'])){
            if($_SESSION['log'] = true){
              echo "<a href='../Login/logout.php' class = 'selected'> delogare </a> <a href='add.php'  > adauga anunturi </a>";
            }else{
              echo "<a href='../Login/login.php' class = 'selected' > autentificare/logare </a>";
            }
          }else{
            echo "<a href='../Login/login.php' class = 'selected'> autentificare/logare </a>";
          }
          ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="login-box">
        <div class="row">
            <div class="col-md-6 login-left">
                <h2>Conectare</h2>
                <?php if($msg != "") echo $msg . "<br><br>"; ?>
                <form action="validation.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user" minlength="3" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" minlength="3" class="form-control" required>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Autentificare</button>
                </form>
            </div>
            <div class="col-md-6 login-right">
                <h2>Inregistrare</h2>
                <?php if($msg != "") echo $msg . "<br><br>"; ?>
                <form action="registration.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user" minlength="3" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" minlength="3" class="form-control" required>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Creare Cont</button>
                </form>
            </div>
            </div>
    </div>
</div>
</body>
</html>
