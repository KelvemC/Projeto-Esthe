<?php
session_start();
include_once '../login/conexao.php';
ob_start()#serve para limpar o buffer e não causar erro.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="./css/style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <div class="container">
        <div class="profile-box">
            <img src="../images/new/menu.png" class="menu-icon">
            <img src="../images/new/setting.png" class="setting-icon">
            <img src="../images/new/profile-pic.png" class="profile-pic">
            <?php
            if(isset($_SESSION['nome'])){
                echo "<h3>";
                echo $_SESSION["nome"];
                echo "</h3>";
                if(isset($_SESSION['telefone'])){
                    echo "<p>Telefone: ";
                    echo $_SESSION["telefone"];
                    echo "</p>";
                }
                }if(isset($_SESSION['endereco'])){
                    echo "<p>Endereço: ";
                    echo $_SESSION["endereco"];
                    echo "</p>";
                }if(isset($_SESSION['cidade'])){
                    echo "<p>Cidade: ";
                    echo $_SESSION["cidade"];
                    echo "</p>";
                }if(isset($_SESSION['estado'])){
                    echo "<p>Estado: ";
                    echo $_SESSION["estado"];
                    echo "</p>";
             }
            
            ?>
            <div class="social-media">
                <img src="../images/new/instagram.png">
                <img src="../images/new/telegram.png">
                <img src="../images/new/dribble.png">
            </div>
            <form action="../CrudPDO/editar.php" method="GET">
                <a href = "../perfilConta/editar_perfil.php" type="submit">Editar</a>
            </form>
            <div class="profile-bottom">
                <p>Caso queira deletar sua conta..</p>
                <a href="../CrudPDO/excluir.php?id=<?=$_SESSION['id']?>"><img src="../images/new/arrow.png" ></a>
            </div>
        </div>

    </div>
</body>
</html>