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
}
?>