<?php
class Exibir{

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

    function exibirEstabelecimento(){
        $sql = $this->Conectar()->prepare("SELECT nome, id FROM estabelecimento");
        $sql->execute();
        return $sql;
    }


    function id_Estb(){
        $Array = array();
        $UserID = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT estabelecimento_id FROM agendamento WHERE usuario_id = $UserID");
        $sql->execute();
        foreach($sql as $id){
            array_push($Array, $id["estabelecimento_id"]);
        }
        return $Array;
    }

    function nome($id){
        $sql = $this->Conectar()->prepare("SELECT nome FROM estabelecimento WHERE id = $id");
        $sql->execute();
        foreach ($sql as $nome) {
            echo $nome['nome'];
        }
    }

    function data(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT DATE_FORMAT (`horario`,'%d/%m/%Y') AS `data_formatada` FROM agendamento WHERE usuario_id = $id");
        $sql->execute();
        foreach($sql as $data){
            array_push($Array, $data['data_formatada']);
        }
        return $Array;

    }

    function hora(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT DATE_FORMAT (`horario`,'%Hh%i') AS `data_formatada` FROM agendamento WHERE usuario_id = $id");
        $sql->execute();
        foreach($sql as $data){
            array_push($Array, $data['data_formatada']);
        }
        return $Array;
    }

    function servicos(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT servicos FROM agendamento WHERE usuario_id = $id");
        $sql->execute();
        foreach($sql as $servico){
            array_push($Array, $servico['servicos']);
        }
        return $Array;
    }
    /*
    $dados_id = $idEs[$i];
                        
    
    */

    function servicosTodosClientes(){
        $Array = array();
        $sql = $this->Conectar()->prepare("SELECT servicos FROM agendamento");
        $sql->execute();
        foreach($sql as $servico){
            array_push($Array, $servico['servicos']);
        }
        return $Array;

    }

    function contarAg(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT COUNT(idagendamento) AS contagem FROM agendamento where estabelecimento_id = $id");
        $sql->execute();
        foreach($sql as $cont){
            array_push($Array, $cont['contagem']);
        }
        return $Array;
    }

    function id_user(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT usuario_id FROM agendamento where estabelecimento_id = $id");
        $sql->execute();
        foreach($sql as $id){
            array_push($Array, $id['usuario_id']);
        }
        return $Array;
    }

    function exibirNomeUser($id){
        $sql = $this->Conectar()->prepare("SELECT nome FROM usuario WHERE id = $id");
        $sql->execute();
        foreach ($sql as $nome) {
            echo $nome['nome'];
        }
    }
    

    function servicosEspecifico(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT servicos FROM agendamento WHERE estabelecimento_id = $id");
        $sql->execute();
        foreach($sql as $nome){
            array_push($Array, $nome['servicos']);
        }
        return $Array;
    }

    function exibirHorasESP(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT CONCAT(HOUR(horario), ':', MINUTE(horario)) as horas FROM agendamento WHERE estabelecimento_id = $id");
        $sql->execute();
        foreach($sql as $horas){
            array_push($Array, $horas['horas']);
        }
        return $Array;
    }

    function exibirDataESP(){
        $Array = array();
        $id = $_SESSION['id'];
        $sql = $this->Conectar()->prepare("SELECT DATE_FORMAT(horario, '%d/%m/%Y') AS data_formatada FROM agendamento WHERE estabelecimento_id = $id");
        $sql->execute();
        foreach($sql as $datas){
            array_push($Array, $datas['data_formatada']);
        }
        return $Array;
    }

    function exibirTelefone(){
        $Array = array();
        $id = $_SESSION['id'];

        if(isset($_SESSION['contaS'])){
            
            $sql = $this->Conectar()->prepare("SELECT telefone as tel FROM usuario WHERE id = $id");
            $sql->execute();
            foreach($sql as $telefones){
                array_push($Array, $telefones['tel']);
            }

            return $Array;
        }
        else if(isset($_SESSION['contaP'])){

            $sql = $this->Conectar()->prepare("SELECT telefone as tel FROM estabelecimento WHERE id = $id");
            $sql->execute();
            foreach($sql as $telefones){
                array_push($Array, $telefones['tel']);
            }

            return $Array;

        }
    }

    function exibirLocal(){
        $Array = array();
        $id = $_SESSION['id'];

        if(isset($_SESSION['contaS'])){
            $sql = $this->Conectar()->prepare("SELECT CONCAT(endereco, ', ', cidade, ', ', estado) AS nome_unificado
            FROM usuario WHERE id = $id");
            $sql->execute();
            foreach($sql as $local){
                array_push($Array, $local['nome_unificado']);
            }
            return $Array;

        }else if(isset($_SESSION['contaP'])){
            $sql = $this->Conectar()->prepare("SELECT CONCAT(rua, ' n° ', numero, ', ', bairro, ', ', cidade, ', ', estado) AS nome_unificado
            FROM estabelecimento WHERE id = $id");
            $sql->execute();
            foreach($sql as $local){
                array_push($Array, $local['nome_unificado']);
            }
            return $Array;
        }
    }

    function editarPerfil(){
        $Array = array();
        $id = $_SESSION['id'];

        if(isset($_SESSION['contaS'])){
            $sql = $this->Conectar()->prepare("SELECT email, endereco, telefone FROM usuario WHERE id = $id;");
            $sql->execute();
            foreach($sql as $info){
                array_push($Array, $info['email']);
                array_push($Array, $info['endereco']);
                array_push($Array, $info['telefone']);
            }
            return $Array;

        }else if(isset($_SESSION['contaP'])){
            $sql = $this->Conectar()->prepare("SELECT email, rua, numero, bairro, telefone FROM estabelecimento WHERE id = $id;");
            $sql->execute();
            foreach($sql as $info){
                array_push($Array, $info['email']);
                array_push($Array, $info['rua']);
                array_push($Array, $info['telefone']);
            }
            return $Array;
        }
    }

    function pegaInfoPro(){
        $Array = array();
        $id = $_SESSION['id'];
        if(isset($_SESSION['contaP'])){
            $sql = $this->Conectar()->prepare("SELECT numero as num_casa, bairro FROM estabelecimento WHERE id = $id;");
            $sql->execute();
            foreach($sql as $dados){
                array_push($Array, $dados['num_casa']);
                array_push($Array, $dados['bairro']);
            }
            return $Array;
        }
    }
}
?>