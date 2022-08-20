<?php
session_start();
include_once 'conexao.php';
ob_start();

$query_ativo = $conn->prepare("UPDATE usuario SET ativo ='0' WHERE  id= :id");
$query_ativo->bindValue("id", $_SESSION['id']);
$query_ativo->execute();

unset($_SESSION['id'], $_SESSION['nome']);

if(isset($_SESSION['contaS'])){
    unset($_SESSION['contaS']);
}
else if(isset($_SESSION['contaP'])){
    unset($_SESSION['contaP']);
}
$_SESSION['msg'] = '<script>alert("Deslogado com sucesso!");</script>';
echo "<script>window.location='./login.php';</script>";
