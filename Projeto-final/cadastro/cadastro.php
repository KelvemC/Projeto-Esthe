<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/Estudos-de-Front-End-master/Front-End 2.0/Projeto-final/cadastro/style.css"
    type="text/css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?key=<?php $key = uniqid(md5(rand())); echo $key ?>">

  <title>Cadastro</title>
</head>

<body>
  <div class="logo-menu">
    <a href="/"><img src="../images/logo.svg" /></a>
  </div>
  <div class="form-cadastro">
    <div class="form">
      <form action="../CrudPDO/Crud.php" method="POST">
        <h1>Cadastro Estabelecimento</h1>
        <br/>
        <div class = "form-row">
         
          <input class = "input_maior" type="text" name="nome" placeholder="Insira o nome do estabelecimento"/>
          
          <input class = "input_maior"type="email" name="email" placeholder="Insira o seu email"/>
        </div>
        
        <div class = "form-row">  
          
          <input class = "input_maior"type="password" name="senha" placeholder="Insira sua senha"/>
          
          <input class = "input_maior"type="text" name="telefone" placeholder="Insira o número de telefone"/>
        </div> 
        
        <div class = "form-row">
          
          <input class = "input_maior"type="text" name="celular" placeholder="Insira o número do celular"/>
          
          <input class = "input_maior" type="text" name="servico" placeholder="Insira o nome do serviço"/>
        </div>

        <div class = "form-row">
          
          <input class = "input_maior" type="text" name="rua" placeholder="Insira o nome da rua"/>
          
         
          <input class = "input_maior" type="text" name="bairro" placeholder="Insira o nome do bairro"/>
        </div>
        
        <div class = "form-row">
          
          <input class = "input_maior" type="text" name="numero" placeholder="Insira o número"/>
          
          <input class = "input_maior" type="text" name="cidade" placeholder="Insira o nome da cidade"/>
        </div>

        <div class = "form-row">
          
          <input class = "input_maior" type="text" name="cep" placeholder="Insira o CEP"/>
          
          <label class = "form-row">Estado</label>
          <select class="form-control" id="estados" name = "estados">
            <option>Escolha</option>
            <option value="SP">SP</option>
            <option value="PE">PE</option>
            <option value="BA">BA</option>
            <option value="SC">SC</option>
            <option value="CE">CE</option>
            <option value="PR">PR</option>
          </select>  
        </div>
          <br>
          <input type="hidden" name="OP" value="cadastroPRO">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
          <p class="message">Já tem um conta? <a href="../login/login.php">Sign In</a></p>
      </form>
    </div>
  </div>

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>