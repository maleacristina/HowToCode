<?php

include 'connection.php';
session_start();

if(isset($_SESSION['username'])){

}else{
    header("Location: login.php");
}

$produs_cumparat = 0;
if(isset($_GET['id_produs'])){
    $id_produs = $_GET['id_produs'];
    $query = mysqli_query($db, "INSERT INTO cos_cumparaturi(produs_id, user_id) VALUES('" . $id_produs . "', '" . $_SESSION['id'] . "')");

    if(mysqli_insert_id($db)){
        $produs_cumparat = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Produse</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-12">
        <?php
          if($produs_cumparat == 1){
              echo "<h1> Ai adaugat produsul cu succes in cosul de cumparaturi</h1>";
          }
        ?>
            <table class="table">
            <thead>
               <th>Nume</th>
               <th>Pret</th>
               <th>Categorie</th>
               <th>Cumpara</th>
            </thead>
            <tbody>
              <?php
                 $query=mysqli_query($db,"SELECT * FROM produse");

                 while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){
                     $id_produs = $row['id'];
                     $nume_produs = $row['nume'];
                     $pret_produs = $row['pret'];
                     $categorie_produs = $row['categorie'];
                 
                 ?>
                 <tr>
                    <td><?php echo $nume_produs; ?></td>
                    <td><?php echo $pret_produs; ?></td>
                    <td><?php echo $categorie_produs; ?></td>
                    <td>
                    <a class="btn btn-success" href="produse.php?id_produs=<?php echo $id_produs ?>">Cumpara</a>
                    </td>
                 </tr>
                 <?php 
                }
                 ?>
            </tbody>
            </table>
            <a href="logout.php" class="btn btn-secondary">Log out</a>

            <?php 
            //$query = mysqli_query($db,"SELECT id FROM cos_cumparaturi WHERE user_id='" . $_SESSION['id'] . " '");
            //Metoda 1
          /*   $numeProduse = 0;
            while($row = msqli_fetch_array($query ,MSQLI_BOTH)){
                $numarProduse++;
            } */

            //Metoda 2
            $query = mysqli_query($db,"SELECT id FROM cos_cumparaturi WHERE user_id='" . $_SESSION['id'] . " '");
            $numarProduse = mysqli_num_rows($query);

            //Metoda 3
           /*  $query = msqli_query($db,"SELECT id FROM cos_cumparturi WHERE user_id='" . $_SESSION['id'] . " '");
            $numarProduse = msqli_fetch_array($query, MSQLI_BOTH);
            $numarProduse = $numarProduse[0]; */
            ?>
            <a href="cos_cumparaturi.php" class="btn btn-primary">Cos cumparaturi(<?php echo $numarProduse; ?>)</a>
        </div>
    </div>
    
</body>
</html>