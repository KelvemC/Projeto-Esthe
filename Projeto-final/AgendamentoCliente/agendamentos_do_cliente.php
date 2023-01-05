<?php
session_start();

include_once '../login/conexao.php';
require '../exibir_OO.php';

$dados = new Exibir();
//$lista = $dados->exibirEstabelecimento();
$idEs = $dados->id_Estb();
$dataAgenda = $dados->data();
$horaAgenda = $dados->hora();
$servico = $dados->servicos();
ob_start() #serve para limpar o buffer e não causar erro.
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8" />
    <title>Agendamentos</title>

    <style>
        body,
        html {
            margin: 0;
            height: 100%;
            width: 100%;
            background-image: url(../images/banner.svg);
            background-position: center;
            background-size: cover;
            min-height: 900px;
            
        }
        table{
            width: 100%;
            margin-bottom : .5em;
            table-layout: fixed;
            text-align: center;
  
        }   
        .LogoNova{
            height: 61.90%;
            width: 40%;
            position: absolute;
            left: 34.98mm;
            bottom: 75.62%;
            margin: -9.60%;
            
            
        }

        main.bg-light.shadow-lg.m-4.bg-body.rounded{
            position: absolute;
        }

        .main.items-menu.d-flex.flex-row.align-items-center{
            padding: 40px;
        }
        
        .items-menu{
            padding: 10px;
            
        }

        .ms-5.me-5.mb-5.mt-3.d-flex.flex-row.align-items-center.justify-content-between{
            width: 75.76%;
            padding: 7.5px;
            
        }
    </style>



<body>

    <nav class="ms-5 me-5 mb-5 mt-3 d-flex flex-row align-items-center justify-content-between">
        <div>
            <a href="../index.php"><img class = "LogoNova"src="../images/logos/NovaLogo.svg" /></a>
        </div>

        <div class="items-menu d-flex flex-row align-items-center">
            <a href="../index.php">Início</a>
            <a href="../estabelecimentos/searchEstabelecimento.html">Estabelecimentos</a>

            <?php

            
            /* $_SESSION['nome'] = "Fulano"; */
            
            
            
            if (isset($_SESSION['nome'])) {
                
                echo " 
                        <a class='contact-btn' href='../login/dashboard.php'>Agendar</a>
                        <div class='flex-shrink-0 dropdown'>
                            <a href='#' class='d-block  text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                <span>" . $_SESSION['nome'] . "</span> <img src='../images/new/profile-pic.png' alt='mdo' width='40' height='40' class='rounded-circle'>
                            </a>
                            <ul class='dropdown-menu text-small shadow'>
                                <li><a style='color: black' href='../perfilConta/perfil.php'>Perfil</a></li>
                                <li><a style='color: black' href='../AgendamentoCliente/agendamentos_do_cliente.php'>Agendamentos</a></li>
                                <li><a style='color: black' href='#'>Configurações</a></li>
                                <li><a style='color: black' href='#'>Suporte</a></li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a style='color: black' href='../login/sair.php'>Sair</a></li>
                            </ul>
                        </div>";
            } else {
                header("location: ../login/login.php");
            }
            ?>

    </nav>


    <main class="bg-light shadow-lg m-4 bg-body rounded">

        <div class="d-flex align-items-center justify-content-center flex-column p-5 m-5">

            <h1 class="mb-5">Meus Agendamentos</h1>

            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-success" for="btnradio1">Atuais</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-success" for="btnradio3">Passados</label>
            </div>

        </div>

        <hr style="border: 20px solid #000; width: 100%;">
        <table class='table' align='center'>
        <thead class='table table-hover table-dark'>
            <tr>
                <th scope='col'>Nome</th>
                <th scope='col'>Data</th>
                <th scope='col'>Hora</th>
                <th scope='col'>Serviço</th>
                <th scope='col'>Pedidos</th>
            </tr>
        </thead>
        <?php
        
        // -------------------------------------------------------------------
        
        for($i = 0; $i<count($idEs); $i++){
                    echo "<tr>";
                        echo "<td>";
                        $dados->nome($idEs[$i]);
                        echo "</td>";

                        echo "<td>";
                        echo $dataAgenda[$i];
                        echo "</td>";

                        echo "<td>";
                        echo $horaAgenda[$i];
                        echo "</td>";

                        echo "<td>";
                        echo $servico[$i];
                        echo "</td>";

                        echo "<td>";
                        echo "<button type='button' class='btn btn-danger'>Cancelar</button>";
                        echo " ";
                        echo "<button type='button' class='btn btn-success'>Editar</button>";
                        echo "</td>";

                    echo "</tr>
                ";
                
        }        
        

        ?>
        </table>


    </main>

    <script src="../popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</body>

</html>