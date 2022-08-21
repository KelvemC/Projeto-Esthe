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

    function exibirData(){
        $sqlIDagn = $this->Conectar()->prepare("SELECT idagendamento FROM agendamento");
        $sqlIDagn->execute();
        foreach($sqlIDagn as $idAgenda){
            $sqlData = $this->Conectar()->prepare("SELECT DATE_FORMAT (`horario`, '%d/%m/%Y') AS 'data' FROM agendamento WHERE idagendamento = :id");
            $sqlData->bindValue(':id',$idAgenda['idagendamento']);
            $sqlData->execute();
            $dataAgenda = $sqlData->fetch(PDO::FETCH_ASSOC);
            echo "<div>";
            echo "<img src='../images/ícones/ICONE1/calendar3.svg' alt=''>";
            echo "<span class='m-2'>";
            echo $dataAgenda['data'];
            echo "</span>";
            echo "</div>";
        }
    }
}
?>