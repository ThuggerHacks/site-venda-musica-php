<?php

try{
    $con = new PDO("mysql:dbname=musica;host=localhost","root","");
}catch(PDOException $e){
    echo $e->getMessage();
}