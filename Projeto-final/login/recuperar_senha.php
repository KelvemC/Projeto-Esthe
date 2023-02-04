<?php
session_start();
ob_start();
include_once 'conexao.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_recuperar_senha.css?key=<?php $key = uniqid(md5(rand()));
    echo $key ?>">
    <title>Agência Esthe - Recuperar Senha</title>
    <style type="text/css">
        img.Logo {
            height: 60%;
            width: 40%;
            position: absolute;
            left: 35.1mm;
            bottom: 76.40%;
            margin: -9.6%;


        }
    </style>
</head>

<body>
    <!--<h1>Recuperar Senha</h1>-->
    <div style="width: 100%; padding: 30px 30px 0px;">
        <a href="/"><img src="../images/Nova.svg" width="100" style="background-color: #618862;"></a>
    </div>
    <?php
    #recebendo todos os campos de uma vez só como string
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    echo "<br>";

    if (!empty($dados['SendRecup'])) {
        //var_dump($dados);
    
        $query_usuario = "SELECT id, nome, email, senha 
                        FROM usuario
                        WHERE email =:email
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email']);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
            $query_up_usuario = "UPDATE usuario SET recuperar_senha =:recuperar_senha WHERE id =:id LIMIT 1";
            $result_up_usuario = $conn->prepare($query_up_usuario);
            $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

            if ($result_up_usuario->execute()) {
                $link = "chave=$chave_recuperar_senha";
                try {
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP(); //Send using SMTP
                    $mail->Host = 'smtp.mailtrap.io'; //Set the SMTP server to send through
                    $mail->SMTPAuth = true; //Enable SMTP authentication
                    $mail->Username = 'ec33d3eb375f96'; //SMTP username
                    $mail->Password = '6cb66409100d42'; //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
                    $mail->Port = 2525;

                    $mail->setFrom('agenciaesthe@gmail.com', 'AtendimentoEsthe');
                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']); //Add a recipient
    
                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = 'Recuperar a senha';
                    $mail->Body = 'Prezado(a) ' . $row_usuario['nome'] . ".Você solicitou a alteração da senha<br><br>Para continuar
                    no processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br>" . $link .
                        "<br><br>Se você não solicitou a alteração de senha nenhuma ação é necessária.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] . "\n\nVocê solicitou a alteração da senha. Para continuar no processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link .
                        "\n\nSe você não solicitou a alteração de senha nenhuma ação é necessária.\n\n";

                    $mail->send();

                    $_SESSION['msg'] = '<script>alert("Enviado com sucesso!")</script>';
                    header('Location: atualizar_senha.php?' . $link);

                    exit;
                } catch (Exception $e) {
                    echo '<script>alert("Erro: Email não enviado com sucesso. Error:{$mail->ErrorInfo}")</script>';
                }
            } else {
                $_SESSION['msg'] = "<p style = 'color: #ff0000> Erro: Tente Novamente!</p>";
            }
        } else {
            $_SESSION['msg'] = '<script>alert("Erro: Usuário não encontrado!")</script>';
            header('Location:recuperar_senha.php');
        }
    }
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>


    <div align="center" class="login-page">
        <div class="form">
            <h1>Recuperar Senha</h1>
            <form action="" class="login-form" method="POST">
                <input type="email" name="email" placeholder="email do usuário"><br><br>
                <button type="submit" name="SendRecup" value="Senha Recup">Recuperar Senha</button>
                <p class="message">Lembrou? <a href="login.php">Clique aqui para logar</a></p>

            </form>
        </div>
    </div>

</body>

</html>