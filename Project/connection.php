<?php


$db = mysqli_connect("localhost","root","","proiect");

if($db){
    //echo "Connected";
}else{
    echo mysqli_error($db);
}












?>