<?php
$host = "localhost";
$user = "root";
$pass = "";
$bdname = "agencia_esthe";
$port = "3307";

try{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $bdname, $user, $pass);
    //echo "Conexão com o banco de dados realizado com sucesso!";
}catch(PDOException $err){
    //echo "Não conseguiu realizar conexão com o banco de dados!" . $err->getMessage();
}
?>