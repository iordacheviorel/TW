<?php 
session_start();
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Anunturi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>

    <link rel="stylesheet" type="text/css" href="style_anunturi.css">
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
          <a href="anunturi.php" class = "selected" > anunturi </a>
          <?php 
         if(isset($_SESSION['log'])){
            if($_SESSION['log'] = true){
              echo "<a href='../Login/logout.php'> delogare </a> <a href='add.php'  > adauga anunturi </a>";
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
      
     
      <div class = "filter-bar">
        <div class = "filtre">
            <form class = "filtre">
                <select name="tip">
                    <option id = "toate" value="toate">Toate</option>
                    <option id = "apartament"  value="apartament">Apartament</option>
                    <option id = "casa"  value="casa">Casa</option>
                    <option id = "teren"  value="teren">Teren</option>
                </select>
            
                <select name="mod">
                    <option id = "vanzare" value="vanzare">Vanzare</option>
                    <option id = "inchiriere" value="inchiriere">Inchiriere</option>
                </select>
                <select name="oras">
                    <option id = "iasi" value="iasi">Iasi</option>
                    <option id = "bucuresti" value="bucuresti">Bucuresti</option>
                    <option id = "suceava" value="suceava">Suceava</option>
                </select>
                <select name="zona">
                    <option id = "canta" value="canta">Canta</option>
                    <option id = "pacurari" value="pacurari">Pacurari</option>
                    <option id = "tatarasi" value="tatarasi">Tatarasi</option>
                    <option id = "copou" value="copou">Copou</option>
                    <option id = "dacia" value="dacia">Dacia</option>
                    <option id = "piata" value="piata">Piata Unirii</option>
                    <option id = "independentei" value="independentei">Independentei</option>
                </select>
        
                <select name="pret">
                    <option id = "200" value="200">Maxim 200 euro</option>
                    <option id = "500" value="500">Maxim 200 euro</option>
                    <option id = "1000" value="1000">Maxim 200</option>
                    <option id = "2000" value="2000">Maxim 200</option>
                    <option id = "10000" value="10000">Maxim 200</option>
                </select>

                <input type = "submit" value = "cauta">
            </form>
        </div>
    </div>
             
    <div id="mapid"></div>
<div class="sugested">

<?php
    $user = 'root';
    $pass = '';
    $db = 'perf_place';



    $conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect!");
    mysqli_query($conn, "SET NAMES utf8");

    $tip = $_GET["tip"];
    $mod = $_GET["mod"];
    $oras = $_GET["oras"];
    $zona = $_GET["zona"];
    $pret = $_GET["pret"];

   

    $sql = "SELECT * from anunt where id >= 1" ;
    
    if(isset($tip) && $tip !== "toate"){
        $sql .= " and lower(tip) = '$tip'";
    }
    // if(isset($mod)){
    //     if($mod == "vanzare"){
    //         $mod = 0;
    //     }else{
    //         $mod = 1;
    //     }
    //     $sql .= " and mod = '$mod'";
    // }
    if(isset($oras)){
        $sql .= " and lower(oras) = '$oras'";
    }
    if(isset($zona)){
        $sql .= " and lower(cartier) = '$zona'";
    }
   

    // if(isset($pret)){
    //     $sql .= " and pret <= '$pret'";
    // }

    //echo $sql;
    $result = $conn->query($sql);

    $coord = array();
    $price = array();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            
            $url = $row["poze"];
            $url = explode(";", $url);
            
            
            $id = $row["id"];

            $title = $row["titlu"];
            $tip = $row["tip"];
            $suprafata = $row["suprafata"];
            $camere = $row["nrCamere"];
            $pret = $row["pret"];
            $zona = $row["oras"] .  '/' . $row["cartier"];
            $vanzare = $row["vanzare"];
            $descriere = $row["descriere"];
            $nrBai = $row['nrBai'];
            if($vanzare == 0){
                $vanzare = 'vanzare';
            }else{
                $vanzare = 'inchiriere';
            }

            $res = ''; 
            if(!empty($tip)){
                $res .= $tip;
            } 

            if(!empty($suprafata )){
                $res .= " | " . $suprafata . " mp";
            } 

            if(!empty($camere)){
                $res .= " | " . $camere . " camere";
            }

            $lat = $row["lat"];
            $lon = $row["lon"];
            array_push($coord, array($lat, $lon));
            array_push($price, array($id, $pret));

    
?>

<a href="../AnuntIndividual/individual.php?id_anunt= <?php echo $id ?> ">

<div class="card-sugested hide">
    <div class="card-top">
        <div class = "left">
            <p id="special"><?php echo $vanzare ?></p>
            <h3><?php echo $title ?></h3>
            <p><?php echo $res ?> 
            </p>
        </div>
               
        <div class = "right">
            <p id = "price"><?php echo $pret ?> EUR</p>
            <p><?php echo $zona ?></p>
        </div>
    </div>
    <div class="img"></div>
</div>
</a>


<?php 
}


}else{
    echo "0 results";
}
?>
</div>

</div>
<button id="more" onclick=showmore()>Arata mai multe anunturi!</button>             


      <!-- <a href="../AnuntIndividual/individual.php">
        <div class="card-sugested">
            <div class="card-top">
                <div class = "left">
                        <p id="special">VANZARE</p>
                        <h3>Locuinta in complex Rezidential in zona de Nord</h3>
                        <p>Case-Vile | 97m | 4 camere</p>
                </div>
    
                <div class = "right">
                    <p id = "price-small">86.000 EUR</p>
                    <p>Tunari, Bucuresti-Ilfov / Nord</p>
                </div>
                </div>
                <div class="img"></div>
                </div>
            </a>
        </div>  -->

<div class="footer">

</div>

<script>
  
  var id = "<?php echo $_GET["tip"] ?>";
  document.getElementById(id).selected = "true";
  id = "<?php echo $_GET["oras"] ?>";
  document.getElementById(id).selected = "true";
  id = "<?php echo $_GET["zona"] ?>";
  document.getElementById(id).selected = "true";


  var recomend = document.getElementsByClassName("card-sugested");
    if(recomend.length > 10){
        
        var more = document.getElementById("more").style.display = 'block';
       
    }
    var last = 0;
    showmore();
    function showmore(){
        for(i=last; i<last+10; i++){
            console.log(recomend[i].class);
            recomend[i].className = "card-sugested";
        }
        last += 10;
    }
 


// map

var mymap = L.map('mapid').setView([47.17, 27.57], 13);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYWxlY3NhMDkiLCJhIjoiY2p2cnFpN2ZyMDhwOTQzbWs0ZnkybTk4ZiJ9.-ntXjzjOa3rTf5zuaHWeRA'
}).addTo(mymap);

var marker = L.marker([47.17, 27.57]).addTo(mymap);
var lat = 0;
var lon = 0;
var cnt = <?php echo count($coord); ?>;
 var pret = <?php echo json_encode($price); ?>;
<?php 
$i = 0;
$json_ar = json_encode($coord);
?>
var coord = <?php echo $json_ar; ?>;
console.log(coord);
for(var i = 0; i < cnt; i++){
    lat = coord[i][0];
    lon = coord[i][1];
  
    console.log(coord[i][0]);
    console.log(coord[i][1]);
    marker = L.marker([lat, lon]).addTo(mymap);
    let link = "<a href='http://localhost/perfPlace/AnuntIndividual/individual.php?id_anunt=" + pret[i][0] +"'>Vezi locuinta</a>";
     marker.bindPopup( pret[i][1 ]+ " EUR <br>" + link).openPopup();
    
    
}

// mymap.setView([47.17, 27.57], 13);


</script>
</body>
</html>