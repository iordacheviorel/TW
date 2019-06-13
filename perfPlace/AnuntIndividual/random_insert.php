<?php


    $user = 'root';
    $pass = '';
    $db = 'perf_place';



    $conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect!");
    mysqli_query($conn, "SET NAMES utf8");

    // $prenume = array('Alexandra','Ioana','Mihai','Razvan','Teodor');
    // $nume = array('Birzu','Popescu','Matei','Chirila','Albu');

    // for($i=0; $i<100; $i++){
    //     $p = $prenume[rand(0,4)];
    //     $n = $nume[rand(0,4)];

    //     $email = $p.".".$n."@gmail.com";
    //     $parola = "parola123";
    //     $hash = 1234987;
    //     $activ = 1;

    //     $sql = "INSERT INTO utilizator(nume,prenume,email,parola,hash,active) values('$n','$p','$email','$parola','$hash','$activ')";

    //     if ($conn->query($sql) === TRUE) {
    //         echo "New record created successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }

    // }
    // $cartiere = array('Alexandru cel Bun', 'Bucium', 'Bucșinescu', 'Canta', 'Cantemir', 'Centru', 'Centrul Civic', 'Copou', 'Crucea Roșie', 'C.U.G.', 'Dacia', 'Frumoasa', 'Galata', 'Gară', 
    // 'Mircea cel Bătrân', 'Moara de Foc', 'Moara de Vânt', 'Nicolina', 'Păcurari', 'Podu Roș', 'Sărărie', 'Socola', 'Târgu Cucu','Tătărași', 'Tudor Vladimirescu', 'Țicău');
    // $descriere = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    // $word = array('ideal','nou','finalizat','central','lux','oferta','promotional');
    // $compartim = array('Comandat','Decomandat','Necomandat');
    // $tip = array('Apartament','Casa');
    // $tara = 'Romania';
    // $oras = 'Iasi';
    // for($i=0; $i<1000; $i++){
    //     $cartier = $cartiere[rand(0,25)];
    //     $id = rand(1,99);
    //     $vanzare = rand(0,1);
    //     if($vanzare == 1){
    //         $pret = rand(20.000,100.000);
    //     }else{
    //         $pret = rand(100,2000);
    //     }
    //     $suprafata = rand(40,200);
    
    //     $comp = $compartim[rand(0,2)];
    //     $nrBai = rand(1,3);
    //     $nrCamere = rand(1,5);
    //     $an = rand(2000,2018);
    //     $t = $tip[rand(0,1)];
    //     $titlu =  $t . " in zona " . $cartier . " cu " . $nrCamere . " camere " .$word[rand(0,6)];
    //     $poza = "ap1.jpg;background.jpg;balloon-sq1.jpg";

    //     $sql = "INSERT INTO anunt(id_proprietar, pret, tara, oras, cartier, vanzare, suprafata, nrCamere, nrBai, compartimentare, anConstructie, titlu, descriere, tip, poze) 
    //                         values('$id','$pret','$tara','$oras','$cartier','$vanzare','$suprafata','$nrCamere','$nrBai','$comp','$an','$titlu','$descriere', '$t','$poza')";

    //     if ($conn->query($sql) === TRUE) {
    //         echo "New record created successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }
    // }

     $conn->close();

?>
