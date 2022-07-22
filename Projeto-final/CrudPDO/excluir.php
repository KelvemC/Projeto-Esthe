<?php
session_start();
include 'Crud.php';
$dados = new Usuario();
$exclua = $dados->excluirUser();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'], $_SESSION['telefone'], $_SESSION['endereco'])
?>
