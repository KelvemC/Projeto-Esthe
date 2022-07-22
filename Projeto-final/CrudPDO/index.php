<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>READ</title>
</head>

<?php
/*
$host = "localhost";
$user = "root";
$pass = "";
$bdname = "usuarios";
$port = "3306";

try{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $bdname, $user, $pass);
    //echo "Conexão com o banco de dados realizado com sucesso!\n";
}catch(PDOException $err){
    //echo "Não conseguiu realizar conexão com o banco de dados!\n" . $err->getMessage();
}

$lista = [];
//Recebendo os valores do banco de dados
$sql = $conn->query("SELECT * FROM users");
//Se tiver usuário
if($sql->rowCount()>0){
    //tudo que tiver dentro do meu banco vai se passado como um tipo de dado vetor
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
*/
include 'Crud.php';
$dados = new Usuario();
$lista = $dados->pesquisa();
?>
<body>
   
    <h1>Listagem de usuários</h1>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
            </tr>
            
            <?php foreach($lista as $usuarios): ?>
                <tr>
                    <td><?= $usuarios['id']?></td>
                    <td><?= $usuarios['nome']?></td>
                    <td><?= $usuarios['email']?></td>
                    <td>
                        <a href="editar.php?id=<?=$usuarios['id']?>">UPDATE</a>
                        <a href="excluir.php?id=<?=$usuarios['id']?>">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </thead>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<a class = "btn btn-primary" href="../criarConta/cadastroConta.html">Cadastrar Usuário</a>
<a href="../index.php" class="btn btn-primary">Sair</a>
</body>

</html>