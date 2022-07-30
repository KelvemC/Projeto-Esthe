<?php
session_start();
include_once '../login/conexao.php';
ob_start() #serve para limpar o buffer e não causar erro.
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Editar Perfil</title>
    <style type="text/css">
        body {
            background-image: url(../images/banner.svg);
            background-position: center;
            background-size: cover;
            min-height: 700px;
            padding: 20px 0 80px 0;

        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 style="text-align: center">Editar Perfil</h1>
                <form action="../CrudPDO/Crud.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" value="<?= $_SESSION['nome']; ?>" require>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control" placeholder="exemplo: fulano@gmail.com" value="<?= $_SESSION['email'] ?>" require>
                    </div>

                    <div class="form-group">
                        <label for="endereço">Endereço: </label>
                        <input type="text" name="endereco" class="form-control" placeholder="Seu endereço e n°" value="<?= $_SESSION['endereco'] ?>" require>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone </label>
                        <input type="text" name="telefone" class="form-control" placeholder="Seu endereço e n°" value="<?= $_SESSION['telefone'] ?>" require>
                    </div>
                    <br />

                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
                    </div>

                    <div style="display: inline-block;" class="form-group">
                        <input type="submit" class="btn btn-primary" value="Atualizar">
                        <input type="hidden" name="OP" value="editarCadastro">
                    </div>
                    <a class="btn btn-primary" href="../index.php">voltar para início</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>