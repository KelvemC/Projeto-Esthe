<?php
include 'Crud.php';
$dados = new Usuario();
$usuario = $dados->PegaInfo();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title> Projeto Maker!</title>
  </head>
  <body>
    <div class = "container">
        <div class = "row">
            <div class= "col">
                <h1 style="text-align: center">UPDATE</h1>
                <form action="Crud.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" name  = "nome" class="form-control" placeholder="Digite seu nome" value = "<?=$usuario['nome'];?>" require>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" name = "email" class="form-control" placeholder="exemplo: fulano@gmail.com" value = "<?=$usuario['email']?>"require>
                    </div>
                    <br/>

                    <div class ="form-group">
                    <input type = "hidden" name = "id" value="<?=$usuario['id'];?>">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class = "btn btn-primary"value="Atualizar">
                        <input type="hidden" name="OP" value="editarCadastro">
                    </div>
                    <br/>
                    <a  class = "btn btn-primary" href="index.php">voltar para início</a>
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