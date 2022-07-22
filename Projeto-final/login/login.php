<?php
session_start();
include_once 'conexao.php';
ob_start()#serve para limpar o buffer e não causar erro.

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    #recebendo todos os campos de uma vez só como string
    $dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    #somente quando eu clicar no botão os dados serão exibidos
    if(!empty($dados['SendLogin'])){
        var_dump($dados);
        $query_usuario = "SELECT id, nome, email, senha, telefone, endereco, cidade, estado 
                        FROM usuario
                        WHERE email =:email
                        LIMIT 1";
        #preparando os dados para serem executados
        $result_usuario = $conn->prepare($query_usuario);
        #vinculando um parametro a uma variável específica.
        $result_usuario->bindParam(':email', $dados['email']);
        #executando.
        $result_usuario ->execute();
        #se a quantidade de usuário for diferente de 0, ele acessa
        if(($result_usuario) and ($result_usuario->rowCount()!=0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            #verificando se a senha é correta.
            if(password_verify($dados['senha'], $row_usuario['senha'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['email'];
                $_SESSION['telefone'] = $row_usuario['telefone'];
                $_SESSION['endereco'] = $row_usuario['endereco'];
                $_SESSION['cidade'] = $row_usuario['cidade'];
                $_SESSION['estado'] = $row_usuario['estado'];
                
                //Ativando o usuário após o login usando a sessão id.
                $query_ativo = $conn->prepare("UPDATE usuario SET ativo ='1' WHERE  id= :id");
                $query_ativo->bindValue("id", $_SESSION['id']);
                $query_ativo->execute();
                header("Location: ../index.php");
            }else{
                $_SESSION['msg'] = "Usuário ou senha inválido";
            }
        }else{
            $_SESSION['msg'] = "Erro: Usuário não encontrado ou senha inválida";
        }

        //'".$dados['usuario']."'
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div align="center" class="login-page">
        <div class="form">
            <h1>Login</h1>
          <form action = "" class="login-form" method="POST">
            <input type="email" name="email" placeholder="email do usuário"><br><br>
            <input type="password" name="senha" placeholder="senha do usuário"><br><br>
            <button type="submit" name="SendLogin" value="Logar">Logar</button>
            <p class="message">Não está cadastrado? <a href="../criarConta/cadastroConta.html">Crie uma conta</a></p>
            <p class="message">Seu estabelecimento não está cadastrado? <a href="../cadastro/cadastro.html">Crie uma conta</a></p>
            <p class="message">Esqueceu a senha? <a href="recuperar_senha.php">Clique aqui para alterar</a></p>
          </form>
        </div>
      </div>
</body>
</html>