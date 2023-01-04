<?php
session_start();

ob_start() #serve para limpar o buffer e não causar erro.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos empresa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8" />

    <style>
        body {
            margin: 0;
            font-weight: 400;
            background-color: #357236;
        }

        header {
            height: 60px;
            background-color: #9A9A9A;
            color: #fff;

            display: flex;
            flex-wrap: nowrap;
            justify-content: end;
            align-items: center;

        }

        .linkUser {
            text-decoration: none;
            color: #fff;
        }

        .linkUser svg {
            color: rgb(0, 0, 0);
            border-radius: 50%;
            background-color: #fff;
            padding: 5px;
            margin: 5px;
        }

        .divContent {
            background-color: #fff;

            margin: 20px;

            border-style: solid;
            border-color: rgb(167, 167, 167);
            border-width: 1px;
        }

        .divMenor {

            background-color: #fff;

            margin: 20px;

            border-style: solid;
            border-color: rgb(167, 167, 167);
            border-width: 1px;
        }

        #divTabela {
            width: 53rem;
        }

        .formBuscar {
            width: 100%;
        }



        .colunaTabela * {
            margin: 10px;
        }

        @media only screen and (max-width: 1240px) {
            #divsMenores {
                width: 40rem;
            }
        }

        @media only screen and (min-width: 1240px) {
            #divsMenores {
                width: 20rem;
            }
        }
    </style>

</head>

<body>

    <!-- <header>

        <div class="m-2">

            <a class="linkUser nav-link" href="#">
                <span>Dra. Ana Júlia</span>

                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-person"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg>
            </a>

        </div>

    </header> -->

    <nav class="ps-5 pe-5 pt-2 pb-2 shadow d-flex flex-row align-items-center justify-content-between text-bg-success">

        <div>
            <a style="text-decoration: none; font-size: 30px; color: #fff" href="../index.php">Empresa</a>
        </div>

        <div class=" d-flex flex-row align-items-center">

           <!--  <a class="link-light text-decoration-none me-3" href="../index.php">Início</a> -->

            <?php


            $_SESSION['nome'] = "Fulano";


            if (isset($_SESSION['nome'])) {
                echo " 
                        
                        <div class='flex-shrink-0 dropdown'>
                            <a href='#' class='d-block link-light  text-decoration-none dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                <span>" . $_SESSION['nome'] . "</span> <img src='../images/new/profile-pic.png' alt='mdo' width='40' height='40' class='rounded-circle'>
                            </a>
                            <ul class='dropdown-menu text-small shadow'>
                                <li><a class='dropdown-item'  href='../perfilConta/perfil.php'>Perfil</a></li>
                                <li><a class='dropdown-item'  href='../AgendamentoCliente/agendamentos_do_cliente.php'>Agendamentos</a></li>
                                <li><a class='dropdown-item' href='#'>Configurações</a></li>
                                <li><a class='dropdown-item' href='#'>Suporte</a></li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a class='dropdown-item' href='../login/sair.php'>Sair</a></li>
                            </ul>
                        </div>";
            } else {
                header("location: ../login/login.php");
            }
            ?>

    </nav>

    <main>


        <div class="container-xxl d-flex flex-wrap-reverse justify-content-start">

            <div id="divTabela" class="divContent shadow-lg m-4 rounded">

                <div class="p-4">
                    <h2>05 de março 2022</h2>
                    <h5>Quarta feira</h5>
                </div>

                <div class="m-3 d-flex flex-wrap justify-content-start"">

                    <form action="" class=" formBuscar" method="get">

                    <div class="input-group rounded-0">

                        <span class="input-group-text rounded-0 btn-light" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </span>

                        <input type="text" class="form-control rounded-0" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon1">

                        <button class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                            </svg>
                        </button>

                    </div>

                    </form>





                </div>

                <!--Tabela agendamentos-->
                <table class="table">

                    <tr>
                        <td class="d-flex  justify-content-between">
                            <div class="colunaTabela">
                                <input type="checkbox">

                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="green" />
                                </svg>

                                <span>8:00</span>

                                <span>Maria Pereira de Sousa</span>
                            </div>

                            <div>

                                <button class="btn btn-warning">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>

                                <button class="btn btn-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="d-flex  justify-content-between">
                            <div class="colunaTabela">
                                <input type="checkbox">

                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#0080FF" />
                                </svg>

                                <span>8:00</span>

                                <span>Maria Pereira de Sousa</span>
                            </div>

                            <div>


                                <button class="btn btn-warning">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>

                                <button class="btn btn-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="d-flex  justify-content-between">
                            <div class="colunaTabela">
                                <input type="checkbox">

                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="red" />
                                </svg>

                                <span>8:00</span>

                                <span>Maria Pereira de Sousa</span>
                            </div>

                            <div>

                                <button class="btn btn-warning">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>

                                <button class="btn btn-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td class="d-flex  justify-content-between">
                            <div class="colunaTabela">
                                <input type="checkbox">

                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#7B7B7B" />
                                </svg>

                                <span>8:00</span>

                                <span>Maria Pereira de Sousa</span>
                            </div>

                            <div>

                                <button class="btn btn-warning">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>

                                <button class="btn btn-danger">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tr>

                </table>

            </div>


            <!--Tabela Dados da semana-->
            <div id="divsMenores" class="d-flex flex-wrap flex-row ">
                <div class="divMenor flex-grow-1 shadow-lg m-4 rounded">

                    <h5 class="m-2">Dados da semana</h5>
                    <hr>

                    <table class="table table-borderless">
                        <tr>

                            <td class="colunaTabela">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="green" />
                                </svg>

                                <span>Presente</span>
                            </td>

                            <td class="colunaTabela">
                                13
                            </td>

                        </tr>

                        <tr>

                            <td class="colunaTabela">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#0080FF" />
                                </svg>

                                <span>Confirmado</span>
                            </td>

                            <td class="colunaTabela">
                                09
                            </td>
                        </tr>


                        <tr>

                            <td class="colunaTabela">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="red" />
                                </svg>

                                <span>Faltou</span>
                            </td>

                            <td class="colunaTabela">
                                02
                            </td>

                        </tr>

                        <tr>
                            <td class="colunaTabela">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#7B7B7B" />
                                </svg>

                                <span>Desmarcado</span>
                            </td>

                            <td class="colunaTabela">
                                03
                            </td>
                        </tr>

                    </table>

                </div>

                <div class="divMenor flex-grow-1 shadow-lg m-4 rounded">

                    <h5 class="m-2">Buscar por data</h5>
                    <hr>

                    <form action="" method="get" class="m-4 d-flex flex-wrap flex-column">

                        <div class="input-group flex-nowrap mb-3 rounded-0">
                            <span class="input-group-text rounded-0">Data: </span>
                            <input type="date" class="form-control rounded-0">
                        </div>

                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>

                </div>


            </div>
        </div>

    </main>

    <footer>

    </footer>

    <script src="../popper.min.js"></script>

</body>

</html>