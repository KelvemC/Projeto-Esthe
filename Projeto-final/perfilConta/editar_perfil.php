<?php
session_start();
include_once "../login/conexao.php";
require "../exibir_OO.php";
$dados = new Exibir();
ob_start();
#serve para limpar o buffer e não causar erro.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar perfil</title>
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./css/style_editar_perfil.css">
</head>

<body>
  <div style="width: 100%; padding: 30px 30px 0px;">
    <a href="/"><img src="../images/Nova.svg" width="100" style="background-color: #618862;"></a>
  </div>

  <div class="wrapper">
    <div class="profile-card js-profile-card">

      <div class="profile-card__cnt js-profile-cnt">
        <div class="profile-card__name" style="text-transform: uppercase;">
          <h1>Editar Perfil</h1>
        </div>

        <div class="profile-card__txt">

          <form action="../CrudPDO/Crud.php" method="POST">
            <div class="form-group">
              <label for="nome">Nome:</label>
              <br>
              <input type="text" name="nome" class="form-control" placeholder="Exemplo: Fulano da Silva"
                value="<?= $_SESSION['nome']; ?>" require>
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <br>
              <input type="email" name="email" class="form-control" placeholder="Exemplo: fulano@gmail.com"
                value="<?= $dados->editarPerfil()[0]; ?>" require>
            </div>

            <div class="form-group">
              <?php
                if(isset($_SESSION['contaS'])){
                  echo "<label for='endereço'>Endereço:</label>";
                }else if (isset($_SESSION['contaP'])){
                  echo "<label for='endereço'>Rua:</label>";
                }
              ?>
              
              <br>
              <input type="text" name="endereco" class="form-control" placeholder="Exemplo: Rua 01, N° 01"
                value="<?= $dados->editarPerfil()[1]; ?>" require>
            </div>
            <?php
            if(isset($_SESSION['contaP'])){
                echo "<div class='form-group'>
                        <label for='numero'>Numero:</label>
                        <br>
                        <input type='text' name='numero' class='form-control' placeholder='Exemplo: Rua 01, N° 01'
                        value=".$dados->pegaInfoPro()[0]." require>
                    </div>";

                
                echo "<div class='form-group'>
                        <label for='bairro'>Bairro:</label>
                        <br>
                        <input type='text' name='bairro' class='form-control' placeholder='Exemplo: Rua 01, N° 01'
                        value=".$dados->pegaInfoPro()[1]." require>
                      </div>";

            } 
            ?>
            <div class="form-group">
              <label for="telefone">Telefone:</label>
              <br>
              <input type="text" name="telefone" class="form-control" placeholder="Exemplo: (00) 91234-1234"
                value="<?= $dados->editarPerfil()[2] ?>" require>
            </div>
            <br />

            <div class="form-group">
              <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
            </div>
            <div class="profile-card-ctr">
              <a class="profile-card__button button--blue" href="../index.php">Voltar ao início</a>
              <div class="form-group">
                <input type="submit" class="profile-card__button button--orange" value="Atualizar dados">
                <input type="hidden" name="OP" value="editarCadastro">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="./js/script.js"></script>

</body>

</html>