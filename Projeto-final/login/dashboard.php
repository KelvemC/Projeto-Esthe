<?php
session_start();
include '../exibir_OO.php';
ob_start(); #serve para limpar o buffer e não causar erro.

$dados = new Exibir();
$lista = $dados->exibirEstabelecimento();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../login/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: rgb(240, 226, 226);
        }

        .titulo01 {
            margin: 20px;
            font-size: 1.5em;
            text-align: center;
        }

        .titulo02 {
            text-align: center;
        }

        .content {
            width: 500px;
            min-width: 560px;
            margin: 0px auto;
            position: relative;
        }

        .agendamento {
            grid-area: "agendamento";
            background-color: white;
            width: 530px;
            height: 380px;
            display: block;
            padding: 30px;
            margin: 30px;

        }

        .cen {
            text-align: center;
        }

        .butao {
            text-align: center;
        }

        .btn-primary {
            color: #fff;
            background-color: #618862;
            border-color: rgb(245, 240, 240);
        }

        div {
            margin: 15px;
        }

        label {
            position: relative;
        }
    </style>
</head>

<body>
   <?php
   echo "<div class='backgroundIMG'>
            <h4>Agende Seu Serviço</h4>
            <h2>Faça Seu Agendamento</h3>
       
                <form action='../CrudPDO/Crud.php' method='POST''>

                    <p>Por favor, selecione o serviço:</p>

                    <div class='form-group col-md-8 m-3'>
                        <label>Estabelecimentos:</label>";
                        echo "<select id='inputEstab' class='form-control rounded-1' name = 'estabelecimentos'>";
                            foreach ($lista as $estabelecimentos):
                                echo "<option selected>";
                                echo $estabelecimentos['nome'];
                                echo "</option>";
                            endforeach;
                        echo "</select>
                    </div>

                    <div class='form-group col-md-8 m-3'>
                        <label>Serviço:</label>
               
                        <select id='inputEstado' class='form-control rounded-1' name = 'servico'>
                        <option selected>Pedicuri</option>
                        <option selected>Cabelereiro</option>
                        <option selected>Barbearia</option>
                        <option selected>Massagem</option>
                        <option>...</option>
                        </select>
                    </div>

                    <div class='form-group col-md-8 m-3' name = 'data-hora'>
                        <label>Data</label>
                        <input type='date' class='rounded-1' name='data' id='data'>
                        <input type='time' class='rounded-1' name='hora' id='hora'>
                    </div>
                    <input type='hidden' name='OP' value='Agendar'>
                    <button type='submit' class='btn btn-success'>Agendar</button>
                </form>
        </div>";
   ?>
</body>
        
</html>
