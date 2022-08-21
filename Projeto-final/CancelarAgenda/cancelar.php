<?php
include_once "./Projeto-final/login/conexao.php";

$sql = $conn->prepare("INSERT INTO cancelamento WHERE idagendamento = :id");

?>