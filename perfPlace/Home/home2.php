<?php 
session_start();
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style_home.css">

  </head>
  <body>
    <div class= "navbar-container">
      <div class="navbar">
        <div class= "logo">
          <a> perfect place </a>
        </div>
        <div class= "meniu">
          <a href="home2.php" class = "selected" > acasa </a>
          <a href="../Anunturi/anunturi.php?tip=toate&mod=vanzare&oras=iasi&zona=canta&pret=200"> anunturi </a>
          <?php 
          if(isset($_SESSION['log'])){
            if($_SESSION['log'] = true){
              echo "<a href='../Login/logout.php'> delogare </a> <a href='../Anunturi/add.php' > adauga anunturi </a>";
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

    <div onclick = "hide()" class="page-container">
      <div class="content">
        <h1> E timpul sa te muti? </h1>
        <h3> Aici gasesti peste 200.000 de anunturi imobiliare </h3>
      
        <div class= "search-container">
          <form class = "search-container">
            <input type="text" autocomplete="off" id="search-bar" placeholder="Introdu locatia unde vrei sa cauti..">
            <input type ="submit" id = "myButton" value="search" >
          </form>
          <div id = "result" ></div>
        </div>
      

        <div class ="card-container">
          <div class="card">
            <img src = "images/house.png">
            <p class = "msg"> Tot ce trebuie sa stii despre noua ta locuinta </p>
          </div>

           <div class="card">
            <img src = "images/house.png">
            <p class = "msg"> Tot ce trebuie sa stii despre noua ta locuinta </p>
          </div>

           <div class="card">
            <img src = "images/house.png">
            <p class = "msg"> Tot ce trebuie sa stii despre noua ta locuinta </p>
          </div>
        </div>
      </div>
    </div>

  </body>

  <script>
    var textBox = document.getElementById('search-bar'),
	  resultContainer = document.getElementById('result')

    var ajax = null;
    var loadedUsers = 0;
    var res;

    textBox.onkeyup = function() {
      resultContainer.style.display = "block";
      resultContainer.style.visibility = "visible";

      var val = this.value;
      val = val.replace(/^\s|\s $/, "");

      if (val !== "") {	
        searchForData(val);
      } else {
        clearResult();
      }
    }
    
    resultContainer.onscroll = function(){
      var val = textBox.value;
      val = val.replace(/^\s|\s $/, "");

      if (val !== "") {	
        searchForData(val, true);
      } else {
        clearResult();
      }
  

    }


    function searchForData(value, isLoadMoreMode) {
        if (ajax && typeof ajax.abort === 'function') {
          ajax.abort(); // abort previous requests
        }

        if (isLoadMoreMode !== true) {
          clearResult();
        }

        ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
            try {
              var json = JSON.parse(this.responseText);
              res = json;
            } catch (e) {
              noUsers();
              console.log(e);
              return;
            }

            if (json.length === 0) {
              if (isLoadMoreMode) {
                //alert('No more to load');
              } else {
                noUsers();
              }
            } else {
              showUsers(json);
            }
          }
        }
        
        ajax.open('GET', 'search.php?username=' +  value +  '&startFrom=' +  loadedUsers , true);
        ajax.send();
    }


    function showUsers(data) {

      getResults(data);

    }

    function getResults(data){
      len = 15;
      if(data.length < len){
        len = data.length;
      }

      loadedUsers  += len;

      for (var i = 0; i < len; i++ ) {
        var userData = data[i];
        var x;
        if(userData['mod'] == 0){ x = "vanzare";} else { x = "inchiriat"; }
        var txt = userData['tip'] + ' de ' + x + ' in ' + userData['tara'] + ', ' + userData['oras'] + ', ' + userData['cartier'] + ', la pretul de ' + userData['pret'] + ' euro';
        resultContainer.innerHTML += "<a href = '../AnuntIndividual/individual.php?id_anunt=" + userData['id'] + "'>" + txt +" </a><br>";
      }
    }


    function clearResult() {
      resultContainer.innerHTML = "";
      loadedUsers = 0;
    }

    function noUsers() {
      resultContainer.innerHTML = "Niciun anunt";
    }

  
    function hide(){
      resultContainer.style.display = "none";
      resultContainer.style.visibility = "invisible";
    }

    document.getElementById("myButton").onclick = function () {
        location.href = "www.yoursite.com";
    };
  </script>
  </html>