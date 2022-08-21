<?php
include './editCadastroPro.php';
class Usuario
{
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estado;

    //GET:

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    //Função para conectar com banco de dados:

    public function Conectar()
    {

        //--------------------------------------------------
        #conectando com o banco de dados:

        $host = "localhost";
        $user = "root";
        $pass = "";
        $bdname = "agencia_esthe";
        $port = "3307";

        try {
            $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $bdname, $user, $pass);
            //echo "Conexão com o banco de dados realizado com sucesso!\n";
            return $conn;
        } catch (PDOException $err) {
            //echo "Não conseguiu realizar conexão com o banco de dados!\n" . $err->getMessage();
        }

        //--------------------------------------------------
    }
    //Área das funções do CRUD:

    //CREATE
    function cadastrarUser()
    {
        //Pegandos as informação do form
        $this->nome = filter_input(INPUT_POST, 'nome');
        $this->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $this->senha = password_hash((filter_input(INPUT_POST, 'senha')), PASSWORD_DEFAULT);
        $this->telefone = filter_input(INPUT_POST, 'telefone');
        $this->endereco = filter_input(INPUT_POST, 'endereço');
        $this->cidade = filter_input(INPUT_POST, 'cidade');
        $this->estado = filter_input(INPUT_POST, 'estado');


        //inserindo os dados do post no banco de dados e fazendo validação.
        //se tiver nome e email:
        if ($this->nome && $this->email) {
            //Esse comando serve para fazer com que não aconteça duplicação de email.
            $sql = $this->Conectar()->prepare("SELECT * FROM usuario WHERE email = :email");
            $sql->bindValue(':email', $this->getEmail());
            $sql->execute();

            //se não tiver nenhum email cadastrado
            if ($sql->rowCount() === 0) {

                $sql = $this->Conectar()->prepare("INSERT INTO usuario (nome, email, senha, telefone, endereco, cidade, estado) VALUES (:nome, :email, :senha, :telefone, :endereco, :cidade, :estado)");
                $sql->bindValue(':nome', $this->getNome());
                $sql->bindValue(':email', $this->getEmail());
                $sql->bindValue(':senha', $this->getSenha());
                $sql->bindValue(':telefone', $this->getTelefone());
                $sql->bindValue(':endereco', $this->getEndereco());
                $sql->bindValue(':cidade', $this->getCidade());
                $sql->bindValue(':estado', $this->getEstado());
                $sql->execute();
                session_start();
                $_SESSION['msg'] = '<script>alert("Cadastro foi um sucesso!");</script>';
                header('Location: ../index.php');
                exit;
            } else {
                header('Location: Cadastro.php');
                exit;
            }
        } else {
            header('Location:Cadastro.php');
            exit;
        }

        //quando ele salvar, podemos pedir para retornar a página index.
        //header("Location: index.php");
    }
    //Cadastrar conta profissional
    function cadastroPro()
    {
        $this->nome = filter_input(INPUT_POST, 'nome');
        $this->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $this->senha = password_hash((filter_input(INPUT_POST, 'senha')), PASSWORD_DEFAULT);
        $this->telefone = filter_input(INPUT_POST, 'telefone');
        $celular = filter_input(INPUT_POST, 'celular');
        $servico = filter_input(INPUT_POST, 'servico');
        $rua = filter_input(INPUT_POST, 'rua');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $numero = filter_input(INPUT_POST, 'numero');
        $this->cidade = filter_input(INPUT_POST, 'cidade');
        $cep = filter_input(INPUT_POST, 'cep');
        $this->estado = $_POST['estados'];

        //inserindo os dados do post no banco de dados e fazendo validação.
        //se tiver nome e email:
        if ($this->nome && $this->email) {
            //Esse comando serve para fazer com que não aconteça duplicação de email.
            $sql = $this->Conectar()->prepare("SELECT * FROM usuario WHERE email = :email");
            $sql->bindValue(':email', $this->getEmail());
            $sql->execute();

            //se não tiver nenhum email cadastrado
            if ($sql->rowCount() === 0) {

                $sql = $this->Conectar()->prepare("INSERT INTO estabelecimento (nome, email, senha, telefone, celular, servico, rua, bairro, numero, cidade, cep, estado) VALUES (:nome, :email, :senha, :telefone, :celular, :servico, :rua, :bairro, :numero, :cidade, :cep, :estado)");
                $sql->bindValue(':nome', $this->getNome());
                $sql->bindValue(':email', $this->getEmail());
                $sql->bindValue(':senha', $this->getSenha());
                $sql->bindValue(':telefone', $this->getTelefone());
                $sql->bindValue(':celular', $celular);
                $sql->bindValue(':servico', $servico);
                $sql->bindValue(':rua', $rua);
                $sql->bindValue(':bairro', $bairro);
                $sql->bindValue(':numero', $numero);
                $sql->bindValue(':cidade', $this->getCidade());
                $sql->bindValue(':cep', $cep);
                $sql->bindValue(':estado', $this->getEstado());
                $sql->execute();
                session_start();
                $_SESSION['msg'] = '<script>alert("O cadastro profissional foi um sucesso!");</script>';
                header('Location: ../index.php');
                exit;
            } else {
                header('Location:Cadastro.php');
                exit;
            }
        } else {
            header('Location:Cadastro.php');
            exit;
        }
    }
    //Pegar as informações que deseja atualizar
    function PegaInfo()
    {
        $usuario = [];
        //pega a informação do id na url
        $id = filter_input(INPUT_GET, 'id');
        //se tiver um id
        if ($id) {
            //query para pegar a informação do user de acordo com o id
            $sql = $this->Conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
            // O valor do id da url é passado como parâmetro 
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                //Pegando as informações do id no banco com a formatação
                $usuario = $sql->fetch(PDO::FETCH_ASSOC);
                return $usuario;
            } else {
                header('Location:index.php');
                exit;
            }
        } else {
            header('Location:index.php');
            exit;
        }
    }

    //READ
    public function pesquisa()
    {
        $lista = [];
        //Recebendo os valores do banco de dados
        $sql = $this->Conectar()->query("SELECT * FROM usuario");
        //Se tiver usuário
        if ($sql->rowCount() > 0) {
            //tudo que tiver dentro do meu banco vai se passado como um tipo de dado vetor
            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        }
    }

    function cadastroEdit()
    {
        $id = filter_input(INPUT_POST, 'id');
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone');
        $endereco = filter_input(INPUT_POST, 'endereco');

        if ($id && $nome && $email) {
            $sql = $this->Conectar()->prepare("UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco WHERE id = :id");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':endereco', $endereco);
            $sql->execute();
            if (!$sql->execute()) {
                return "./editCadastroPro.php";
            }
            session_start();
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['telefone'] = $telefone;
            $_SESSION['endereco'] = $endereco;
            header('Location:index.php');
            exit;
        } else {
            header('Location:index.php');
            exit;
        }
    }
    //DELETE
    function excluirUser()
    {
        $id = filter_input(INPUT_GET, 'id');

        if ($id) {
            $sql = $this->Conectar()->prepare("DELETE FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        header('Location:index.php');
        exit;
    }

    function obertIdEstabelecimento($nomeEstabelecimento){
        $sql = $this->Conectar()->prepare("SELECT id FROM estabelecimento WHERE nome = :nome");
        $sql->bindValue(':nome', $nomeEstabelecimento);
        $sql->execute();
    }

    function Agendar()
    {
        $hora = date("h:i:sa");
        $user_id = $_SESSION['id'];
        $servico = filter_input(INPUT_POST, 'servico');
        $funcionario = filter_input(INPUT_POST, 'funcionario');
        $data = filter_input(INPUT_POST, 'data');
        $horario = date("$data H:i:s");
        $id_tb = 1;

        if ($servico && $funcionario && $horario) {
            $sql = $this->Conectar()->prepare("SELECT * FROM agendamento WHERE horario = :horario");
            $sql->bindValue(':horario', $this->getEmail());
            $sql->execute();

            if ($sql->rowCount() === 0) {

                $sql = $this->Conectar()->prepare("INSERT INTO agendamento (horario, servico, usuario_id, estabelecimento_id) VALUES (:horario, :servico, :usuario_id, :estabelecimento_id)");
                $sql->bindValue(':usuario_id', $user_id);
                $sql->bindValue(':estabelecimento_id', $id_tb);
                $sql->bindValue(':servico', $servico);
                $sql->bindValue(':horario', $horario);
                $sql->execute();
                session_start();

                header('Location: ../index.php');
                exit;
            }
            
        }
    }

}
#estanciando a classe Usuario:
$usuario = new Usuario();
if (isset($_POST["OP"])) {
    $escolha = $_POST["OP"];

    switch ($escolha) {
        case 'cadastrar':
            //código a ser executado se a expressão for igual ao valor1
            $usuario->cadastrarUser();
            break;

        case 'editarCadastro':

            //código a ser executado se a expressão for igual ao valor2
            $usuario->cadastroEdit();
            break;
        case 'cadastroPRO':
            $usuario->cadastroPro();
            break;
        
        case 'Agendar':
            $usuario->Agendar();
    }
}
/*
#selecionando todos os dados da tabela user
        $sql = $conexaoBanco->query('SELECT * FROM users');
        #armazenando todos os dados do banco de dados dentro de minha variável 'dados'
        $dados = $sql->fetchAll(pdo::FETCH_ASSOC);
        echo "<pre>";
        print_r($dados);
*/
