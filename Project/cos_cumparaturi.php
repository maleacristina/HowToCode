<?php

include 'connection.php';
session_start();

// isset verif daca variabila din paranteza exista sau a fost trimisa
if(isset($_SESSION['username'])){

}else{
    header("Location: login.php");
}
$comandaPlasata= 0;
if(isset($_GET['cumpara'])){
    //Stergem din baza de date
   $query= mysqli_query($db,"DELETE FROM cos_cumparaturi WHERE user_id = '" . $_SESSION['id'] . "'");
    //Verificam daca s-a sters
   if(mysqli_affected_rows($db)){
       $comandaPlasata = 1;
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cos cumpraturi</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>


<body>
<div class="container">
        <div class="col-12">
            <?php
            if($comandaPlasata == 1){
                echo "<h1>Comanda plasata cu succes</h1>";
            }
            ?>
            <table class="table">
            <thead>
               <th>Nume</th>
               <th>Pret</th>
               <th>Categorie</th>
            </thead>
            <tbody>
              <?php
                 $sumaTotala=0;
                 $query=mysqli_query($db,"SELECT * FROM cos_cumparaturi WHERE user_id=' " . $_SESSION['id'] . " ' ");

                 while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
                     $id_produs = $row['produs_id'];
                     $query2 = mysqli_query($db, "SELECT * FROM produse WHERE id = '" . $id_produs . " ' ");

                     while($row2 = mysqli_fetch_array($query2, MYSQLI_BOTH)){
                     $nume_produs = $row2['nume'];
                     $pret_produs = $row2['pret'];
                     $categorie_produs = $row2['categorie'];
                   
                     $sumaTotala = $sumaTotala + $pret_produs;
                 ?>
                 <tr>
                    <td><?php echo $nume_produs; ?></td>
                    <td><?php echo $pret_produs; ?></td>
                    <td><?php echo $categorie_produs; ?></td>
                 </tr>
                 <?php 
                }}
                 ?>
            </tbody>
            </table>
            <h1> Suma totala este: <?php echo $sumaTotala;?> lei</h1>
            <a href="cos_cumparaturi.php?cumpara=1" class="btn btn-danger">Plaseaza comanda</a>
           

            
            <!-- <a href="cos_cumparaturi.php" class="btn btn-primary">Cos cumparaturi(<?php echo $numarProduse; ?>)</a>
        </div> -->
    </div>





  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>