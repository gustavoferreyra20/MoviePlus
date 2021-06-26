<?php
class Conexion{
    private $server = "localhost";
    private $usr = "root";
    private $pass = "";
    private $db = "movie_plus";

    public function Consulta($csql){
        $conectar = mysqli_connect($this->server,$this->usr,$this->pass,$this->db);
        return mysqli_query($conectar,$csql);
    }
}

?>