<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'perf_place';

$mysqli = new mysqli($host, $user, $password, $database) or die("Unable to connect!");


$username = $_GET['username'];
$startFrom = $_GET['startFrom'];

$username = trim(htmlspecialchars($username));
$startFrom = filter_var($startFrom, FILTER_VALIDATE_INT);

// make username search friendly
$like = '%' . strtolower($username) . '%';


// open new mysqli prepared statement
$statement = $mysqli -> prepare("
	SELECT id, tip, vanzare, tara, oras, cartier, pret 
	FROM anunt 
	WHERE lower(oras) LIKE ? or lower(tara) LIKE ? or lower(cartier) LIKE ? order by id limit 15 offset ?  
	 "
);

if (
    $statement &&
  
	$statement -> bind_param('sssi', $like,$like,$like, $startFrom) &&
	$statement -> execute() &&
	$statement -> store_result() &&
    $statement -> bind_result($id, $tip, $mod, $tara, $oras, $cartier, $pret)
    
    
) {
    
    $array = array();
    $i = 0;
	while ($statement -> fetch()) {
       
            array_push($array, array(
                "id" => $id,
                "tip" => $tip,
                "mod" => $mod,
                "tara" => $tara,
                "oras" => $oras,
                "cartier" => $cartier,
                "pret" => $pret
                )
            );
            
    }
    // print_r($array);
    $array = convert_from_latin1_to_utf8_recursively($array);
	echo json_encode($array);
	exit();
}



function convert_from_latin1_to_utf8_recursively($dat)
{
   if (is_string($dat)) {
      return utf8_encode($dat);
   } elseif (is_array($dat)) {
      $ret = [];
      foreach ($dat as $i => $d) $ret[ $i ] =convert_from_latin1_to_utf8_recursively($d);

      return $ret;
   } elseif (is_object($dat)) {
      foreach ($dat as $i => $d) $dat->$i = convert_from_latin1_to_utf8_recursively($d);

      return $dat;
   } else {
      return $dat;
   }
}