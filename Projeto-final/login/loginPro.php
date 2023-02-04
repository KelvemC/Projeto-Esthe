<?php
include_once './conexao.php';
ob_start() #serve para limpar o buffer e não causar erro.

?>

<?php
    #recebendo todos os campos de uma vez só como string
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    #somente quando eu clicar no botão os dados serão exibidos
    if (!empty($dados['SendLogin'])) {
        //var_dump($dados);
        $query_usuario = "SELECT id, nome, email, senha, telefone, celular, servico, rua, bairro, numero, cidade, cep, estado
                        FROM estabelecimento
                        WHERE email =:email
                        LIMIT 1";
        #preparando os dados para serem executados
        $result_usuario = $conn->prepare($query_usuario);
        #vinculando um parametro a uma variável específica.
        $result_usuario->bindParam(':email', $dados['email']);
        #executando.
        $result_usuario->execute();
        
        #se a quantidade de usuário for diferente de 0, ele acessa
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            #verificando se a senha é correta.
            if (password_verify($dados['senha'], $row_usuario['senha'])) {
                //nome, email, senha, telefone, celular, servico, rua, bairro, numero, cidade, cep, estado
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['contaP'] = "profissional";
                

                //Ativando o usuário após o login usando a sessão id.
                $query_ativo = $conn->prepare("UPDATE estabelecimento SET ativo ='1' WHERE  id= :id");
                $query_ativo->bindValue("id", $_SESSION['id']);
                $query_ativo->execute();
                $_SESSION['logado'] = '<script>alert("Logado com sucesso!")</script>';
                header('Location:../index.php');
            } else {
                $_SESSION['msg'] = '<script>alert("Usuário ou senha inválido")</script>';
            }
        } else {
            $_SESSION['msg'] = '<script>alert("Erro: Usuário não encontrado ou senha inválida")</script>';
        }

        //'".$dados['usuario']."'
    }

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>