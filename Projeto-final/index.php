<?php
session_start();
include_once './login/conexao.php';
ob_start()#serve para limpar o buffer e não causar erro.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Meu Projeto Final</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8" />
</head>

<body>
    <section class="main">
        <div class="center">
            <div class="menu">
                <div class="logo-menu">
                    <a href="/"><img src="images/logo.svg" /></a>
                </div>
                <div class="items-menu">
                    <a href="#">Início</a>
                    <a href="estabelecimentos/searchEstabelecimento.html">Estabelecimentos</a>
                    
                    <?php
                        if(isset($_SESSION['nome'])){
                            if(isset($_SESSION['logado'])){
                                echo $_SESSION['logado'];
                                unset($_SESSION['logado']);
                            }
                            echo "<a style='color:midnightblue'>";
                            echo "<a href = './perfilConta/perfil.php'>";
                            echo $_SESSION['nome'];
                            echo "</a>";
                            echo "</a>";
                            echo "<a class='contact-btn' href='login/dashboard.php'>Agendar</a>";
                            echo "<a class='contact-btn' href='./login/sair.php'>Sair</a>";
                        }else{
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            echo "<a class='contact-btn' href='./criarConta/contaNormalouProfissional.html'>Cadastro</a>";
                            echo "<a href='./login/login.php'>Login</a>";
                        }
                    ?>
                </div>
                <div class =  "items-menu-mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <div class = "menu-mobile">
                        <a href="#">Início</a>
                        <a href="#">Por que nós?</a>
                        <a href="#">Depoimento</a>
                    </div>
                </div>
            </div>
            <!--menu-->
            <div class="mockup">
                <h1>Promova experiências aos seus clientes</h1>
                <br />
                <p>E veja resultados expressivos dia após dia</p>
                <br />
                <div class = "mockup-foto">
                    <img src="images/macbook mockup.svg">
                </div>

                <div class = "backgroundIMG"></div>
            </div>
            <!--mockup-->
        </div>
        <!--center-->
    </section>
    <!--main-->

    <section class="marcas">
        <div class="center">
            <img src="images/logos/LOGO1/LOGO1.png" />
            <img src="images/logos/Natura.jpg"/>
            <img src="images/logos/LOGO3/LOGO3.png" />
            <img src="images/logos/LOGO4/LOGO4.png" />
            <img src="images/logos/LOGO5/LOGO5.png" />
        </div>
    </section>
    <!--marcas-->

    <section class="porque-nos">
        <div class="center">
            <h2>Por que nós?</h2>
            <p>Uma experiência incrível para seus clientes, resultados espetaculares para seu negócio.</p>
            <div class="diferenciais">
                <div class="box-diferenciais">
                    <img src="images/ícones/ICONE1/ICONE1.png" />
                    <h3>Planejamento impecável</h3>
                    <p>Conte com a Agência esthe como sua parceira no planejamento de horários e estratégias.</p>
                </div>
                <div class="box-diferenciais">
                    <img src="images/ícones/ICONE2/ICONE2.png" />
                    <h3>Melhor organização</h3>
                    <p>Aqui você organiza seus agendamentos de acordo com o seu gosto. Não deixe a oportunidade de
                        ter melhores resultados para amanhã. Entre em contato e vamos conversar sobre sua necessidade.
                    </p>
                </div>
                <div class="box-diferenciais">
                    <img src="images/ícones/ICONE3/ICONE3.png" />
                    <h3>Suporte e acompanhamento</h3>
                    <p>Com nossa equipe será possível tirar suas dúvidas em relação ao uso da plataforma.</p>

                </div>

            </div>
            <!--diferenciais-->
        </div>

    </section>
    <!--porque nós-->

    <section class="cta">

        <h2>Vamos começar o seu agendamento?</h2>
        <h4>Entre em contato para tirar suas dúvidas</h4>
        <?php
        if(isset($_SESSION['nome'])){
            echo "<a href='login/dashboard.php'>Agendar</a>";
        }else{
            echo "<a href='login/login.php'>Agendar</a>";
        }
        
        ?>


    </section>
    <!--cta-->

    <section class="beneficios">
        <div class="center">
            <div style="max-width: 1280px;" class="lista-beneficios">
                <h1>Benefícios para você</h1>
                <br />
                <p><img src="images/checklist.svg" /><span>Garantia de resultados, você terá um grande crescimento no seu negócio e melhor organização.</span></p>
                <p><img src="images/checklist.svg" /><span>Agendamentos fácil de realizar, você não terá muita dificuldade em organizar horários.</span></p>
                <p><img src="images/checklist.svg" /><span>Suporte, nossa equipe oferece profissionais que dão suporte para tirar qualquer dúvida.</span></p>
                
            </div>

            <div class="img-beneficios">
                <img src="images/IMAGEM1/calendar.jpg" />
            </div>
        </div>
    </section>
    <!--beneficios-->

    <section class="depoimentos">
        <h1>Depoimentos</h1>
        <div style="display: block;" class = "center">
            <br>
            <div class="container-slider">
                <div class="container-slider-single">
                    <h3>Miriam Souza</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>

                <div class="container-slider-single">
                    <h3>Beatriz Silva</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>

                <div class="container-slider-single">
                    <h3>Vitor rodrigues</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>

                <div class="container-slider-single">
                    <h3>Raquel</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>

                <div class="container-slider-single">
                    <h3>Águida</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>

                <div class="container-slider-single">
                    <h3>Ana vitória</h3>
                    <img src ="images/DEPOIMENTO1/DEPOIMENTO1.png"/>
                    <p>O trabalho da Agência esthe foi fundamental para o nosso posicionamento e nossas estratégias de
                        2022. Juntos tivemos excelentes resultados e nossos clientes ficaram surpresos com a qualidade.
                        .</p>
                    <img src = "images/RATE/RATE.png"/>                        
                </div>
            </div>

        </div>
    </section>

    <section class = "contato">
        <h1>Entre em contato</h1>
        <div style = "max-width: 900px;"class = "center">
            
            <form method="post">
                <input type = "text" placeholder="Seu nome..."/>
                <input type="email" placeholder="Seu e-mail..."/>
                <textarea placeholder="Sua Mensagem..."></textarea>
                <input type = "submit" placeholder="Enviar"/>
            </form>
        </div>
    </section>

    <footer>
        <div style="max-width: 1280px;" class = "center">
            <div class = "text-footer">
                <p>Todos os direitos reservados ao Grupo Great Makers</p>
            </div>
            <div class="items-menu">
                <a href="#">Início</a>
                <a href="#">Por que nós?</a>
                <a href="#">Depoimento</a>
                <a class="contact-btn" href="">Entre em contato</a>
            </div>
        </div>
    </footer>

    <script src="jquery.js"></script>
    <script src="slick.min.js"></script>
    <script>
        $('.container-slider').slick({
            dots: true,
            arrows: false,
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 3000,
            pauseOnHover: false,
            responsive: [
                            {
                              breakpoint: 768,
                              settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                              }
                            }],
        })
    </script>
    <script>
        /*
        $('.items-menu-mobile i').click(function(){
            $('.menu-mobile').fadeIn();
        })
        */
        var menuBtn = document.querySelector('.items-menu-mobile i');
        menuBtn.addEventListener('click',()=>{
            let itemsMenu= document.querySelector('.menu-mobile');
            if(itemsMenu.classList.contains('show')){
                itemsMenu.classList.remove('show');
                itemsMenu.classList.add('hide');
            }else{
                itemsMenu.classList.remove('hide');
                itemsMenu.classList.add('show');
            }
            

        });
    </script>
</body>

</html>