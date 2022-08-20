<?php
session_start();
include_once '../login/conexao.php';
ob_start() #serve para limpar o buffer e não causar erro.
?>

<?php

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefone');

if ($id && $nome && $email) {
    $sql = $conn->prepare("UPDATE estabelecimento SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':telefone', $telefone);
    $sql->execute();    
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['telefone'] = $telefone;
    echo "<script>window.location=' ../index.php';</script>";
} else {
    echo "<script>window.location='./index.php';</script>";
}

?>