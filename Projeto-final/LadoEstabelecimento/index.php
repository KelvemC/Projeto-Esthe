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
  <title>Agendamentos</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <img src="./imagens/caupe-logo.png" height="70" width="70" style="border-radius: 50%; padding: 5px;"/>
        <p class="app-name">Caupé Agendamentos</p>
        <div class="search-wrapper">
          <input class="search-input" type="text" placeholder="Buscar">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search"
            viewBox="0 0 24 24">
            <defs></defs>
            <circle cx="11" cy="11" r="8"></circle>
            <path d="M21 21l-4.35-4.35"></path>
          </svg>
        </div>
      </div>
      <div class="app-header-right">
        <button class="mode-switch" title="Switch Theme">
          <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" width="16" height="16" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
          </svg>
        </button>

        <a href="index.html" class="app-sidebar-link active">
          <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-plus">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>
        </a>

        <a href="dashboard.html" class="app-sidebar-link">
          <svg class="link-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21.21 15.89A10 10 0 118 2.83M22 12A10 10 0 0012 2v10z"></path>
          </svg>
        </a>

        <button class="profile-btn">
          <img src="./imagens/user.png" />
          <span>Usuário</span>
        </button>
      </div>

      <button class="messages-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="feather feather-calendar">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
          <line x1="16" y1="2" x2="16" y2="6" />
          <line x1="8" y1="2" x2="8" y2="6" />
          <line x1="3" y1="10" x2="21" y2="10" />
        </svg>
      </button>

    </div>
    <div class="app-content">
      <div class="projects-section">
        <div class="projects-section-header">
          <p>Agendamentos</p>
          <h1 id="currentDate"></h1>
        </div>
        <div class="projects-section-line">
          <div class="projects-status">
            <div class="item-status">
              <span class="status-number" style="color: #df3670;">5</span>
              <span class="status-type" style="color: #df3670;">Pendentes</span>
            </div>
            <div class="item-status">
              <span class="status-number" style="color: #34c471;">3</span>
              <span class="status-type" style="color: #34c471;">Concluídos</span>
            </div>
            <div class="item-status">
              <span class="status-number" style="color: #4067f9;"">8</span>
              <span class=" status-type" style="color: #4067f9;"">Total de agendamentos</span>
            </div>
          </div>
          <div class=" view-actions">
                <button class="view-btn list-view" title="List View">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-list">
                    <line x1="8" y1="6" x2="21" y2="6" />
                    <line x1="8" y1="12" x2="21" y2="12" />
                    <line x1="8" y1="18" x2="21" y2="18" />
                    <line x1="3" y1="6" x2="3.01" y2="6" />
                    <line x1="3" y1="12" x2="3.01" y2="12" />
                    <line x1="3" y1="18" x2="3.01" y2="18" />
                  </svg>
                </button>
                <button class="view-btn grid-view active" title="Grid View">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-grid">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                  </svg>
                </button>
            </div>
          </div>
          <div class="project-boxes jsGridView">
          <?php
         
          for($i = 0; $i<($contar[0]); $i++){

            echo " 
              <div class='project-box-wrapper'>
                  <div class='project-box' style='background-color: #ffd3e2;'>
                    <div class='project-box-header'>
                      <span></span>
                      <div class='more-wrapper'>
                        <button class='project-btn-more'>
                          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'
                            stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'
                            class='feather feather-more-vertical'>
                            <circle cx='12' cy='12' r='1' />
                            <circle cx='12' cy='5' r='1' />
                            <circle cx='12' cy='19' r='1' />
                          </svg>
                        </button>
                      </div>
                    </div>
                    <div class='project-box-content-header'>
                      <p class='box-content-header'>",$dados->servicosEspecifico($id[$i])[$i] ,"</p>
                      <p class='box-content-subheader'>Pendente</p>
                    </div>
                    <div class='box-progress-wrapper'>
                      <p class='box-progress-header'>Cliente:<span class='box-content-subheader'>&nbsp",$dados->exibirNomeUser($id[$i]),"</span>
                      </p>
                    </div>
                    <div class='project-box-footer'>
                      <div class='days-left' style='color: #df3670;'>
                        Horário do atendimento: XX:XX
                      </div>
                    </div>
                  </div>
                </div>";
          }
          ?>
          
          
          </div>
        </div>

        <div class="messages-section">
          <button class="messages-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-x-circle">
              <circle cx="12" cy="12" r="10" />
              <line x1="15" y1="9" x2="9" y2="15" />
              <line x1="9" y1="9" x2="15" y2="15" />
            </svg>
          </button>
          <div class="projects-section-header">
            <p>Calendário</p>
          </div>
          <div class="messages">
            <div class="c">
              <div class="body calendar">
                <div class="container calendar">
                  <div class="calendar-assets">
                    <div class="field">
                      <label for="date">Pesquisa por data</label>
                      <form class="form-input" id="date-search" onsubmit="return setDate(this)">
                        <input type="date" class="text-field" name="date" id="date" required>
                        <button type="submit" class="btn btn-small" title="Pesquisar"><i
                            class="fas fa-search"></i></button>
                      </form>
                    </div>
                    <div class="day-assets">
                      <button class="btn" onclick="prevDay()" title="Dia anterior"><i class="fas fa-chevron-left"></i>
                      </button>
                      <button class="btn" onclick="resetDate()" title="Dia atual"><i class="fas fa-calendar-day"></i>
                        Hoje</button>
                      <button class="btn" onclick="nextDay()" title="Próximo dia"><i class="fas fa-chevron-right"></i>
                      </button>
                    </div>
                  </div>
                  <div class="calendar" id="table">
                    <div class="headers">
                      <div class="month" id="month-header">
                      </div>
                      <div class="buttons">
                        <button class="icon" onclick="prevMonth()" title="Mês anterior"><i
                            class="fas fa-chevron-left"></i></button>
                        <button class="icon" onclick="nextMonth()" title="Próximo mês"><i
                            class="fas fa-chevron-right "></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="./js/script.js"></script>
    <script src="https://kit.fontawesome.com/812e771e48.js" crossorigin="anonymous"></script>

</body>

</html>