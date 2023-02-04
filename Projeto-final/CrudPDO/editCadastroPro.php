<?php
session_start();
include_once '../login/conexao.php';
ob_start() #serve para limpar o buffer e não causar erro.
?>

<?php

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$rua = filter_input(INPUT_POST,'endereco');
$numero = filter_input(INPUT_POST,'numero');
$bairro = filter_input(INPUT_POST,'bairro');
$telefone = filter_input(INPUT_POST, 'telefone');

if ($id && $nome && $email) {
    $sql = $conn->prepare("UPDATE estabelecimento SET nome = :nome, email = :email, rua = :rua, numero = :numero, bairro = :bairro, telefone = :telefone WHERE id = :id");
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':rua', $rua);
    $sql->bindValue(':numero', $numero);
    $sql->bindValue(':bairro', $bairro);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':telefone', $telefone);
    $sql->execute();    
    $_SESSION['nome'] = $nome;

    echo "<script>window.location=' ../index.php';</script>";
} else {
    echo "<script>window.location='../index.php';</script>";
}

?>