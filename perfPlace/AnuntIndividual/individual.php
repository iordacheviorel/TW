<?php 
session_start();
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Anunt</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
  <link href="style_individual.css" rel="stylesheet" type="text/css">

    <!-- <link href="\C:\Users\x\bower_components\leaflet-layer-overpass\dist\OverPassLayer.css" rel="stylesheet" type = "text/css"> -->
    <style>
        .leaflet-control-minZoomIndicator {
            font-size: 2em;
            background: #ffffff;
            background-color: rgba(255,255,255,0.7);
            border-radius: 10px;
            padding: 1px 15px;
            opacity: 0.5;   
        }

    </style>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class= "navbar-container">
      <div class="navbar">
        <div class= "logo">
          <a> perfect place </a>
        </div>
        <div class= "meniu">
          <a href="../Home/home2.php" > acasa </a>
          <a href="../Anunturi/anunturi.php?tip=toate&mod=vanzare&oras=iasi&zona=canta&pret=200" class ="selected"> anunturi </a>
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

     



<div class="main-container">

    


<?php

    $user = 'root';
    $pass = '';
    $db = 'perf_place';



    $conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect!");
    mysqli_query($conn, "SET NAMES utf8");

    $id_anunt = $_GET['id_anunt'];
    $sql = "SELECT * from anunt where id = '$id_anunt'";

    $result = $conn->query($sql);
  
    

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $url = $row["poze"];
            $url = explode(";", $url);

            $oras = $row["oras"];
            $lat = $row['lat'];
            $lon = $row['lon'];
            $title = $row["titlu"];
            $tip = $row["tip"];
            $suprafata = $row["suprafata"];
            $camere = $row["nrCamere"];
            $pret = $row["pret"];
            $zona = $row["oras"] .  '/' . $row["cartier"];
            $vanzare = $row["vanzare"];
            $vanzare_bin = $row["vanzare"];
            $descriere = $row["descriere"];
            $nrBai = $row['nrBai'];
            if($vanzare == 0){
                $vanzare = 'vanzare';
            }else{
                $vanzare = 'inchiriere';
            }
        }
    }else{
        echo "0 results";
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

    
?> 

    <div class="content">
        <div class="content-left">
            <div class="card">
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
            
                <div class = "img-layout">
                    <figure class = "fig1"> <img  src = <?php echo "images/".$url[0] ?> /> </figure>
                    <figure class = "fig2">  <img src = <?php echo "images/".$url[1] ?> /> </figure>
                    <figure class = "fig3"> <img src =  <?php echo "images/".$url[2] ?> /> </figure>
                </div>

                <div class = "detalii">
                    <div class = "info">
                        <p>Zona</p>
                        <p><?php echo $zona ?></p>
                    </div>
                    <div class = "info">
                        <p>Suprafata teren</p>
                        <p><?php echo $suprafata . " mp" ?></p>
                    </div>
                    <div class = "info">
                        <p>Numar camere</p>
                        <p><?php echo $camere ?></p>
                    </div>
                    <div class = "info">
                        <p>Numar bai</p>
                        <p><?php echo $nrBai ?></p>
                    </div>
                  
                </div>

                <p> 
                   <?php echo $descriere ?>
                </p>
            </div>
        
        <div class="contact"><div class="contact-wrap"> <p id="contact">Contact</p> <p>Numar telefon: 0712345678</p> <p>Oras: Iasi</p> <p>Salveaza anuntul</p> </div></div>
        </div>
    

        <div id="content-right">
        <div class = "filtre">
                    
                        <a href="">Scoli</a>
                         <a href="">Parcari</a>
                        <a href="">Farmacii</a>
                        <a href="">Magazine</a>
                        <a href="">Spitale</a>
                    </ul>
                </div>
            <div id="mapid">
                
               
            </div>
        </div>
    </div>






    <p class="similar">Locuinte similare</p>
    <div class="sugested">

        <?php
       
            $sql = "SELECT * from anunt where tip = '$tip' and vanzare = '$vanzare_bin' and pret <= $pret + 2.000" ;
            $result = $conn->query($sql);
        
        
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
                    <p id = "price2"><?php echo $pret ?> EUR</p>
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
<div class="footer">

</div>





<script> L.Control.MinZoomIndicator = L.Control.extend({
  options: {
    position: 'bottomleft',
  },

  /**
  * map: layerId -> zoomlevel
  */
  _layers: {},

  /** TODO check if nessesary
  */
  initialize: function (options) {
    L.Util.setOptions(this, options);
    this._layers = new Object();
  },

  /**
  * adds a layer with minzoom information to this._layers
  */
  _addLayer: function(layer) {
    var minzoom = 15;
    if (layer.options.minzoom) {
      minzoom = layer.options.minzoom;
    }
    this._layers[layer._leaflet_id] = minzoom;
    this._updateBox(null);
  },

  /**
  * removes a layer from this._layers
  */
  _removeLayer: function(layer) {
    this._layers[layer._leaflet_id] = null;
    this._updateBox(null);
  },

  _getMinZoomLevel: function() {
    var minZoomlevel=-1;
    for(var key in this._layers) {
      if ((this._layers[key] != null)&&(this._layers[key] > minZoomlevel)) {
        minZoomlevel = this._layers[key];
      }
    }
    return minZoomlevel;
  },

  onAdd: function (map) {
    this._map = map;
    map.zoomIndicator = this;

    var className = this.className;
    var container = this._container = L.DomUtil.create('div', className);
    map.on('moveend', this._updateBox, this);
    this._updateBox(null);

    //        L.DomEvent.disableClickPropagation(container);
    return container;
  },

  onRemove: function(map) {
    L.Control.prototype.onRemove.call(this, map);
    map.off({
      'moveend': this._updateBox
    }, this);

    this._map = null;
  },

  _updateBox: function (event) {
    //console.log("map moved -> update Container...");
    if (event != null) {
      L.DomEvent.preventDefault(event);
    }
    var minzoomlevel = this._getMinZoomLevel();
    if (minzoomlevel == -1) {
      this._container.innerHTML = this.options.minZoomMessageNoLayer;
    }else{
      this._container.innerHTML = this.options.minZoomMessage
          .replace(/CURRENTZOOM/, this._map.getZoom())
          .replace(/MINZOOMLEVEL/, minzoomlevel);
    }

    if (this._map.getZoom() >= minzoomlevel) {
      this._container.style.display = 'none';
    }else{
      this._container.style.display = 'block';
    }
  },

  className : 'leaflet-control-minZoomIndicator'
});

L.LatLngBounds.prototype.toOverpassBBoxString = function (){
  var a = this._southWest,
  b = this._northEast;
  return [a.lat, a.lng, b.lat, b.lng].join(",");
}

L.OverPassLayer = L.FeatureGroup.extend({
  options: {
    debug: false,
    minzoom: 15,
    endpoint: "http://overpass-api.de/api/",
    query: "(node(BBOX)[organic];node(BBOX)[second_hand];);out qt;",
    callback: function(data) {
      for(var i = 0; i < data.elements.length; i++) {
        var e = data.elements[i];

        if (e.id in this.instance._ids) return;
        this.instance._ids[e.id] = true;
        var pos;
        if (e.type == "node") {
          pos = new L.LatLng(e.lat, e.lon);
        } else {
          pos = new L.LatLng(e.center.lat, e.center.lon);
        }
        var popup = this.instance._poiInfo(e.tags,e.id);
        var circle = L.circle(pos, 50, {
          color: 'green',
          fillColor: '#3f0',
          fillOpacity: 0.5
        })
        .bindPopup(popup);
        this.instance.addLayer(circle);
      }
    },
    beforeRequest: function() {
      if (this.options.debug) {
        console.debug('about to query the OverPassAPI');
      }
    },
    afterRequest: function() {
      if (this.options.debug) {
        console.debug('all queries have finished!');
      }
    },
    minZoomIndicatorOptions: {
      position: 'bottomleft',
      minZoomMessageNoLayer: "no layer assigned",
      minZoomMessage: "current Zoom-Level: CURRENTZOOM all data at Level: MINZOOMLEVEL"
    },
  },

  initialize: function (options) {
    L.Util.setOptions(this, options);
    this._layers = {};
    // save position of the layer or any options from the constructor
    this._ids = {};
    this._requested = {};
  },

  _poiInfo: function(tags,id) {
    var link = document.createElement("a");
    link.href = "http://www.openstreetmap.org/edit?editor=id&node=" + id;
    link.appendChild(document.createTextNode("Edit this entry in iD"));
    var table = document.createElement('table');
    for (var key in tags){
      var row = table.insertRow(0);
      row.insertCell(0).appendChild(document.createTextNode(key));
      row.insertCell(1).appendChild(document.createTextNode(tags[key]));
    }
    var div = document.createElement("div")
    div.appendChild(link);
    div.appendChild(table);
    return div;
  },

  /**
  * splits the current view in uniform bboxes to allow caching
  */
  long2tile: function (lon,zoom) { return (Math.floor((lon+180)/360*Math.pow(2,zoom))); },
  lat2tile: function (lat,zoom)  {
    return (Math.floor((1-Math.log(Math.tan(lat*Math.PI/180) + 1/Math.cos(lat*Math.PI/180))/Math.PI)/2 *Math.pow(2,zoom)));
  },
  tile2long: function (x,z) {
    return (x/Math.pow(2,z)*360-180);
  },
  tile2lat: function (y,z) {
    var n=Math.PI-2*Math.PI*y/Math.pow(2,z);
    return (180/Math.PI*Math.atan(0.5*(Math.exp(n)-Math.exp(-n))));
  },
  _view2BBoxes: function(l,b,r,t) {
    //console.log(l+"\t"+b+"\t"+r+"\t"+t);
    //this.addBBox(l,b,r,t);
    //console.log("calc bboxes");
    var requestZoomLevel= 14;
    //get left tile index
    var lidx = this.long2tile(l,requestZoomLevel);
    var ridx = this.long2tile(r,requestZoomLevel);
    var tidx = this.lat2tile(t,requestZoomLevel);
    var bidx = this.lat2tile(b,requestZoomLevel);

    //var result;
    var result = new Array();
    for (var x=lidx; x<=ridx; x++) {
      for (var y=tidx; y<=bidx; y++) {//in tiles tidx<=bidx
        var left = Math.round(this.tile2long(x,requestZoomLevel)*1000000)/1000000;
        var right = Math.round(this.tile2long(x+1,requestZoomLevel)*1000000)/1000000;
        var top = Math.round(this.tile2lat(y,requestZoomLevel)*1000000)/1000000;
        var bottom = Math.round(this.tile2lat(y+1,requestZoomLevel)*1000000)/1000000;
        //console.log(left+"\t"+bottom+"\t"+right+"\t"+top);
        //this.addBBox(left,bottom,right,top);
        //console.log("http://osm.org?bbox="+left+","+bottom+","+right+","+top);
        result.push( new L.LatLngBounds(new L.LatLng(bottom, left),new L.LatLng(top, right)));
      }
    }
    //console.log(result);
    return result;
  },

  addBBox: function (l,b,r,t) {
    var polygon = L.polygon([
      [t, l],
      [b, l],
      [b, r],
      [t, r]
    ]).addTo(this._map);
  },

  onMoveEnd: function () {
    if (this.options.debug) {
      console.debug("load Pois");
    }
    //console.log(this._map.getBounds());
    if (this._map.getZoom() >= this.options.minzoom) {
      //var bboxList = new Array(this._map.getBounds());
      var bboxList = this._view2BBoxes(
        this._map.getBounds()._southWest.lng,
        this._map.getBounds()._southWest.lat,
        this._map.getBounds()._northEast.lng,
        this._map.getBounds()._northEast.lat);

        // controls the after/before (Request) callbacks
        var finishedCount = 0;
        var queryCount = bboxList.length;
        var beforeRequest = true;

        for (var i = 0; i < bboxList.length; i++) {
          var bbox = bboxList[i];
          var x = bbox._southWest.lng;
          var y = bbox._northEast.lat;
          if ((x in this._requested) && (y in this._requested[x]) && (this._requested[x][y] == true)) {
            queryCount--;
            continue;
          }
          if (!(x in this._requested)) {
            this._requested[x] = {};
          }
          this._requested[x][y] = true;


          var queryWithMapCoordinates = this.options.query.replace(/(BBOX)/g, bbox.toOverpassBBoxString());
          var url =  this.options.endpoint + "interpreter?data=[out:json];" + queryWithMapCoordinates;

          if (beforeRequest) {
              this.options.beforeRequest.call(this);
              beforeRequest = false;
          }

          var self = this;
          var request = new XMLHttpRequest();
          request.open("GET", url, true);

          request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
              var reference = {instance: self};
              self.options.callback.call(reference, JSON.parse(this.response));
              if (self.options.debug) {
                console.debug('queryCount: ' + queryCount + ' - finishedCount: ' + finishedCount);
              }
              if (++finishedCount == queryCount) {
                  self.options.afterRequest.call(self);
              }
            }
          };

          request.send();


        }
    }
  },

  onAdd: function (map) {
    this._map = map;
    if (map.zoomIndicator) {
      this._zoomControl = map.zoomIndicator;
      this._zoomControl._addLayer(this);
    }else{
      this._zoomControl = new L.Control.MinZoomIndicator(this.options.minZoomIndicatorOptions);
      map.addControl(this._zoomControl);
      this._zoomControl._addLayer(this);
    }

    this.onMoveEnd();
    if (this.options.query.indexOf("(BBOX)") != -1) {
      map.on('moveend', this.onMoveEnd, this);
    }
    if (this.options.debug) {
      console.debug("add layer");
    }
  },

  onRemove: function (map) {
    if (this.options.debug) {
      console.debug("remove layer");
    }
    L.LayerGroup.prototype.onRemove.call(this, map);
    this._ids = {};
    this._requested = {};
    this._zoomControl._removeLayer(this);

    map.off({
      'moveend': this.onMoveEnd
    }, this);

    this._map = null;
  },

  getData: function () {
    if (this.options.debug) {
      console.debug(this._data);
    }
    return this._data;
  }

});

//FIXME no idea why the browser crashes with this code
//L.OverPassLayer = function (options) {
//  return new L.OverPassLayer(options);
//};
</script>


<script>
    // map = new OpenLayers.Map("demoMap");
    // map.addLayer(new OpenLayers.Layer.OSM());
    // map.zoomToMaxExtent();

    var lat,lon;
lat = <?php echo $lat; ?>;
lon = <?php echo $lon; ?>;
    var mymap = L.map('mapid').setView([lat, lon], 13);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYWxlY3NhMDkiLCJhIjoiY2p2cnFpN2ZyMDhwOTQzbWs0ZnkybTk4ZiJ9.-ntXjzjOa3rTf5zuaHWeRA'
}).addTo(mymap);

var marker = L.marker([lat, lon]).addTo(mymap);

//OverPassAPI overlay
var opl = new L.OverPassLayer({
        query: "node(BBOX)['amenity'='post_box'];out;",
        });

    mymap.addLayer(opl);


    function myFunction(){
        if(document.getElementById("content-right").style.width == "100%"){
            document.getElementById("content-right").style.width = "50%";
        }else{
            document.getElementById("content-right").style.width = "100%";
        }

    }

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
    


    function layer(){
        var attr_osm = 'Map data &copy; <a href="http://openstreetmap.org/">OpenStreetMap</a> contributors',
        attr_overpass = 'POI via <a href="http://www.overpass-api.de/">Overpass API</a>';

        var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {opacity: 0.7, attribution: [attr_osm, attr_overpass].join(', ')});

        var map = new L.Map('mapid').addLayer(osm).setView(new L.LatLng(52.265, 10.524), 14);

        //OverPassAPI overlay
        var opl = new L.OverPassLayer({
        query: "node(BBOX)['amenity'='restaurant'];out;",
        });

        map.addLayer(opl);
    }
</script>
</body>

</html>
