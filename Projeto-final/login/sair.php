<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);
$_SESSION['msg'] = '<script>alert("Deslogado com sucesso!");</script>';

header("Location: ./login.php");
?>