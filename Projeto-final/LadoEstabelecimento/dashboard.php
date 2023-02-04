<!DOCTYPE html>
<html lang="PT">
<?php
session_start();
require "../exibir_OO.php";
include_once '../login/conexao.php';


$dados = new Exibir();
//$lista = $dados->exibirEstabelecimento();
$contar = $dados->contarAg();
$id = $dados->id_user();
ob_start() #serve para limpar o buffer e não causar erro
?>
<head>
    <title>Configurações</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./css/style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css-agendar/style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">
</head>

<body>
    <div class="app-container" style="align-items: center;">
        <div class="app-header">
            <div class="app-header-left">
            <img src="../images/Nova.svg" width="100" style="background-color: #618862;">
              <!--<p class="app-name">Caupé Agendamentos</p>-->
            </div>
            <div class="app-header-right">
              <button class="profile-btn">
                <img src="./imagens/user.png">
                <span><?php 
                    echo $_SESSION['nome'];
                ?></span>
              </button>
            </div>
          </div>
          <div class="app-header-center">
            <a href="index.php" class="app-but-left">Home</a>
            <a href="dashboard.html" class="app-but-right active">Agendamentos</a>
          </div>
        <div class="app-content3">
            <div class="projects-sectionA">
                <div class="projects-section-header" style="justify-content: center;">
                    <p>Agendamento de serviços</p>
                    <h1 id="currentDate"></h1>
                </div>
                <section class="ftco-section">
                    <div class="container">
            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content w-100">
                                    <div class="calendar-container">
                                        <div class="calendar2">
                                            <div class="year-header">
                                                <span class="left-button fa fa-chevron-left" id="prev"> </span>
                                                <span class="year" id="label"></span>
                                                <span class="right-button fa fa-chevron-right" id="next"> </span>
                                            </div>
                                            <table class="months-table w-100">
                                                <tbody>
                                                    <tr class="months-row">
                                                        <td class="month">Jan</td>
                                                        <td class="month">Fev</td>
                                                        <td class="month">Mar</td>
                                                        <td class="month">Abr</td>
                                                        <td class="month">Mai</td>
                                                        <td class="month">Jun</td>
                                                        <td class="month">Jul</td>
                                                        <td class="month">Ago</td>
                                                        <td class="month">Set</td>
                                                        <td class="month">Out</td>
                                                        <td class="month">Nov</td>
                                                        <td class="month">Dez</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="days-table w-auto">
                                                <td class="day">Dom</td>
                                                <td class="day">Seg</td>
                                                <td class="day">Ter</td>
                                                <td class="day">Qua</td>
                                                <td class="day">Qui</td>
                                                <td class="day">Sex</td>
                                                <td class="day">Sáb</td>
                                            </table>
                                            <div class="frame">
                                                <table class="dates-table w-100">
                                                    <tbody class="tbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button class="button" id="add-button">Adicionar Serviço</button>
                                        </div>
                                    </div>
                                    <div class="events-container">
                                    </div>
                                    <div class="dialog" id="dialog">
                                        <!--<h2 class="dialog-header"> Agendamento de serviços </h2>-->
                                        <form class="form" id="form" action="../CrudPDO/Crud.php" method="post">
                                            <div class="form-container" align="center">
                                                <label class="form-label" id="valueFromMyButton" for="name">Tipo de serviço</label>
                                                <div class="row-select">
                                                    <select id="name" class="centralizar" name="servico">
                                                        <option value="-- --" disabled="disabled" selected>-- --</option>
                                                        <option value="Barba">Barba</option>
                                                        <option value="Corte de Cabelo">Corte de Cabelo</option>
                                                        <option value="Corte de Cabelo + Barba">Corte de Cabelo + Barba</option>
                                                        <option value="Pintura de unha">Pintura de unha</option>
                                                        <option value="Pintura de cabelo">Pintura de cabelo</option>
                                                        <option value="Massagem">Massagem</option>
                                                        <option value="Pigmentação de sobrancelhas">Pigmentação de sobrancelhas
                                                        </option>
                                                    </select>
                                                </div>
                                                <!--<input class="input" type="text" id="name" maxlength="36">-->
                                                <label class="form-label" id="valueFromMyButton" for="count">Horario do
                                                    agendamento</label>
                                                <div class="row-select">De:&nbsp;
                                                    <select id="count" class="centralizar" name="inicio">
                                                        <option value="-- --" disabled="disabled" selected>--:--</option>
                                                        <option value="00:00">00:00</option>
                                                        <option value="01:00">01:00</option>
                                                        <option value="02:00">02:00</option>
                                                        <option value="03:00">03:00</option>
                                                        <option value="04:00">04:00</option>
                                                        <option value="05:00">05:00</option>
                                                        <option value="06:00">06:00</option>
                                                        <option value="07:00">07:00</option>
                                                        <option value="08:00">08:00</option>
                                                        <option value="09:00">09:00</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="20:00">20:00</option>
                                                        <option value="21:00">21:00</option>
                                                        <option value="22:00">22:00</option>
                                                        <option value="23:00">23:00</option>
                                                    </select>&nbsp;Até:&nbsp;
                                                    <select id="count1" class="centralizar" name="fim">
                                                        <option value="-- --" disabled="disabled" selected>--:--</option>
                                                        <option value="00:00">00:00</option>
                                                        <option value="01:00">01:00</option>
                                                        <option value="02:00">02:00</option>
                                                        <option value="03:00">03:00</option>
                                                        <option value="04:00">04:00</option>
                                                        <option value="05:00">05:00</option>
                                                        <option value="06:00">06:00</option>
                                                        <option value="07:00">07:00</option>
                                                        <option value="08:00">08:00</option>
                                                        <option value="09:00">09:00</option>
                                                        <option value="10:00">10:00</option>
                                                        <option value="11:00">11:00</option>
                                                        <option value="12:00">12:00</option>
                                                        <option value="13:00">13:00</option>
                                                        <option value="14:00">14:00</option>
                                                        <option value="15:00">15:00</option>
                                                        <option value="16:00">16:00</option>
                                                        <option value="17:00">17:00</option>
                                                        <option value="18:00">18:00</option>
                                                        <option value="19:00">19:00</option>
                                                        <option value="20:00">20:00</option>
                                                        <option value="21:00">21:00</option>
                                                        <option value="22:00">22:00</option>
                                                        <option value="23:00">23:00</option>
                                                    </select>
                                                </div>
                                                <!--<input class="input" type="time" id="count" min="0" max="1000000" maxlength="7">-->
                                                <input type="button" value="Cancelar" class="button" id="cancel-button">
                                                <input type="hidden" name="OP" value="AGservico">
                                                <button type="submit" class="button button-white" id="ok-button">Enviar</button>
                                                <!--

                                                
                                                -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>

    <script src="./js/script.js"></script>
    <script src="https://kit.fontawesome.com/812e771e48.js" crossorigin="anonymous"></script>


    <script src="js-agendar/jquery.min.js"></script>
    <script src="js-agendar/popper.js+bootstrap.min.js.pagespeed.jc.ndf8_3FdiS.js"></script>
    <script>eval(mod_pagespeed_wDxec1q6mG);</script>
    <script>eval(mod_pagespeed_amktbYOjgV);</script>
    <script src="js-agendar/main.js"></script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"75fc44e3efcd6f8c","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.10.3","si":100}'
        crossorigin="anonymous"></script>

</body>

</html>