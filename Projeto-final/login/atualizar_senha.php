<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css?key=<?php $key = uniqid(md5(rand()));
                                                    echo $key ?>">
    <title>Atualizar senha</title>
    <style type="text/css">
        .logo-menu a {
            padding-left: 130px;
        }
    </style>

</head>

<body>

    <?php
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
    if (!empty($chave)) {
        $query_usuario = "SELECT id
                        FROM usuario
                        WHERE recuperar_senha =:recuperar_senha
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($dados['SendEnviarSenha'])) {
                $senha_usuario = password_hash($dados['senha'], PASSWORD_DEFAULT);
                $recuperar_senha = "NULL";

                $query_up_usuario = "UPDATE usuario SET senha =:senha, recuperar_senha =:recuperar_senha WHERE id =:id LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha_usuario, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);
                if ($result_up_usuario->execute()) {
                } else {
                    echo "<p style = 'color: #ff0000> Erro: Tente Novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg'] = '<script>alert("Senha atualizada com sucesso!")</script>';
            header("Location: login.php");
        }
    } else {
        $_SESSION['msg'] = "<p style = 'color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
    }
    ?>
    <div class="logo-menu">
        <a href="/"><img src="../images/logo.svg" /></a>
    </div>
    <div align="center" class="login-page">
        <div class="form">
            <h1>Atualizar senha</h1>
            <form action="" class="login-form" method="POST">
                <?php
                $usuario = "";
                if (isset($dados['senha'])) {
                    $usuario = $dados['senha'];
                }
                ?>
                <input type="password" name="senha" placeholder="Digite a nova senha" value="<?php echo $usuario; ?>"><br><br>
                <button type="submit" name="SendEnviarSenha" value="Logar">Atualizar</button>
                <p class="message">Lembrou a senha? <a href="login.php">Clique aqui para logar</a></p>
            </form>
        </div>
    </div>
</body>

</html>