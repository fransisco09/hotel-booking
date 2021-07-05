<?php

 require_once 'user.php';

 //membuat sambungan
 $conn =  new Mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD, DB_NAME);

 //cek sambungan 
 if ($conn->connect_error){
     die("Connection failed:". $conn->connect_error);
 }
 
?>