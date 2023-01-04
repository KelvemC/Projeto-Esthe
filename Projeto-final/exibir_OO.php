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
        $sql = $this->Conectar()->prepare("SELECT COUNT(idagendamento) AS contagem FROM agendamento");
        $sql->execute();
        foreach($sql as $cont){
            array_push($Array, $cont['contagem']);
        }
        return $Array;
    }

    function id_user(){
        $Array = array();
        $sql = $this->Conectar()->prepare("SELECT usuario_id FROM agendamento");
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
    

    function servicosEspecifico($id){
        $Array = array();
        $sql = $this->Conectar()->prepare("SELECT servicos FROM agendamento WHERE usuario_id = $id");
        $sql->execute();
        foreach($sql as $nome){
            array_push($Array, $nome['servicos']);
        }
        return $Array;
    }
}
?>