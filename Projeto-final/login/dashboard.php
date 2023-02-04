<?php
session_start();
include "../exibir_OO.php";
ob_start(); #serve para limpar o buffer e não causar erro.
$dados = new Exibir();
$lista = $dados->exibirEstabelecimento();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Agendamento</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../login/style_dashboard.css">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
<div style="width: 100%; padding: 30px 30px 0px;">
        <a href="/"><img src="../images/Nova.svg" width="100" style="background-color: #618862;"></a>
    </div>

  <div class="wrapper">
    <div class="profile-card js-profile-card">

      <div class="profile-card__cnt js-profile-cnt">
        <div class="profile-card__name" style="text-transform: uppercase;">
        <h1>Faça seu agendamento</h1>
        </div>

        <div class="profile-card__txt">

        <?php
        echo "<div class='backgroundIMG'>
                <form action='../CrudPDO/Crud.php' method='POST''>

                    <p>Por favor, selecione o serviço:</p>

                    <div class='form-group col-md-8 m-3'>
                        <label>Estabelecimentos:</label>";
        echo "<br> <select id='inputEstab' class='form-control card-input__input -select' name = 'estabelecimentos'>";
        echo "<option disabled='disabled' selected></option>";
        foreach ($lista as $estabelecimentos):
            echo "<option>";
            echo $estabelecimentos["nome"];
            echo "</option>";
        endforeach;
        echo "</select>
                    </div>

                    <div class='form-group col-md-8 m-3'>
                        <label>Serviço:</label>
                        <br>
                        <select id='inputEstado' class='form-control card-input__input -select' name = 'servico'>
                        <option disabled='disabled' selected></option>
                        <option>Pedicuri</option>
                        <option>Cabelereiro</option>
                        <option>Barbearia</option>
                        <option>Massagem</option>
                        </select>
                    </div>

                    <div class='form-group col-md-8 m-3 form' name = 'data-hora' style='flex-direction: auto'>
                        <label>Data:</label>
                        <input type='date' style='
                        height: 50px;
                        transition: all 0.3s ease-in-out;
                        padding: 5px 15px;
                        color: #1a3b5d;
                        margin-bottom: 15px;
                        text-align: center;
                        margin-block-start: 5px;
                        background-color: #eee;
                        border: none;
                        border-radius: 10px;
                        ' name='data' id='data'>
                        <label>Hora:</label>
                        <input type='time' style='
                        height: 50px;
                        transition: all 0.3s ease-in-out;
                        padding: 5px 15px;
                        color: #1a3b5d;
                        margin-bottom: 15px;
                        text-align: center;
                        margin-block-start: 5px;
                        background-color: #eee;
                        border: none;
                        border-radius: 10px;
                        ' name='hora' id='hora'>
                    </div>
                    <input type='hidden' name='OP' value='Agendar'>
                    <button type='submit' class='profile-card__button button--orange'>Agendar</button>
                </form>
        </div>";
        ?>
        </div>
      </div>
  </div>
  

  <script src="./js/script.js"></script>

</body>
</html>