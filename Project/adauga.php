<?php

include 'connection.php';

$nume=$_POST['nume'];
$pret=$_POST['pret'];
$categorie=$_POST['categorie'];

$nume_safe = mysqli_escape_string($db,$nume); //,;\'"
$pret_safe =  mysqli_escape_string($db,$pret);
$categorie_safe =  mysqli_escape_string($db,$categorie);

$query = mysqli_query($db,"INSERT INTO produse(nume,pret,categorie) VALUES('$nume_safe','$pret_safe','$categorie_safe')");

if(mysqli_insert_id($db)){
    echo "Am adaugat produsul cu numele: " .$nume . "</br>";
    echo "Pretul produsului este: " . $pret . "</br>";
    echo "Face parte din categoria: " . $categorie . "</br>";
}else {
    echo mysqli_error($db);
}












?>