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


    function exibirEstabelecimentoAgenda(){
        $Array = array();
        $sqlESTB = $this->Conectar()->prepare("SELECT estabelecimento_id FROM agendamento");
        $sqlESTB->execute();
        foreach($sqlESTB as $id){
            $sql = $this->Conectar()->prepare("SELECT nome FROM estabelecimento WHERE id = :id");
            $sql->bindValue(':id',$id['estabelecimento_id']);
            $sql->execute();
            $nome = $sql->fetch(PDO::FETCH_ASSOC);
            array_push($Array, $nome['nome']);
    }
    return $Array;
    }

    function exibirData(){
        $Array = array();
        $sqlIDagn = $this->Conectar()->prepare("SELECT idagendamento FROM agendamento");
        $sqlIDagn->execute();
        foreach($sqlIDagn as $idAgenda){
            $sqlData = $this->Conectar()->prepare("SELECT DATE_FORMAT (`horario`, '%d/%m/%Y') AS 'data' FROM agendamento WHERE idagendamento = :id");
            $sqlData->bindValue(':id',$idAgenda['idagendamento']);
            $sqlData->execute();
            $dataAgenda = $sqlData->fetch(PDO::FETCH_ASSOC);
            array_push($Array, $dataAgenda['data']);
        }
        return $Array;
    }

    function exibirHorario(){
        $Array = array();
        $horaSql = $this->Conectar()->prepare("SELECT DATE_FORMAT (`horario`,'%Hh%i') AS `data_formatada` FROM `agendamento`");
        $horaSql->execute();
        foreach($horaSql as $hora){
            
            array_push($Array, $hora['data_formatada']);
            
        }
        return $Array;
    }

    function exibirServico(){
        $Array = array();
        $sqlService = $this->Conectar()->prepare("SELECT servico FROM agendamento");
        $sqlService->execute();
        foreach($sqlService as $service){
            
            array_push($Array, $service['servico']);
            
            
            
        }
        return $Array;
    }
}
?>