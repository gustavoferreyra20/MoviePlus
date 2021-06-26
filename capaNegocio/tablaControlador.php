<?php

require_once("../capaDatos/claseConexion.php");
class Tabla{

    private $baseDeDatos;
    private $tabla;
    private $cantFilas;
    private $csql; 

    public function __construct($tabla){
        $this ->tabla = $tabla;
        $this ->csql = "SELECT * FROM $this->tabla";
        $this ->baseDeDatos = new Conexion();
    }
    
    private function setCantFilas(){
        $this ->cantFilas = mysqli_num_rows($this->baseDeDatos->Consulta($this->csql));
    }

    public function getCantFilas(){
        return $this ->cantFilas;
    }

    public function limitarTabla($cantidad, $desde){
        $this->setCantFilas();
        $this->csql = $this->csql." LIMIT $cantidad OFFSET $desde";
    }

    public function mostrarBusqueda($dato, $filtro){

        if($filtro == "genero_id"){
            $dato = $this->buscarGenero($dato);
        }elseif($filtro == "plan_id"){
            $dato = $this->buscarPlan($dato);
        }     

        if (is_null($dato)){
            $dato = 0;
        }
        $this->csql = $this->csql." WHERE $filtro LIKE '%$dato%'";
    }

    public function ordenar($filtro, $orientacion){
        $this->csql = $this->csql." ORDER BY $filtro $orientacion";
    }

    public function buscarGenero($dato){
        $csql = "SELECT id FROM generos WHERE genero='$dato'";
        $generos = $this->baseDeDatos->Consulta($csql);
        $genero = mysqli_fetch_array($generos);
        $dato = $genero["id"];
        return $dato;
    }

    public function buscarPlan($dato){
        $csql = "SELECT id FROM planes WHERE plan='$dato'";
            $planes = $this->baseDeDatos->Consulta($csql);
            $plan = mysqli_fetch_array($planes);
            $dato = $plan["id"];
        return $dato;
    }

    public function mostrarPlan($idp){
        $csql = "SELECT plan FROM planes WHERE id='$idp'";
        $planes = $this->baseDeDatos->Consulta($csql);
        $plan = mysqli_fetch_array($planes);
        return $plan["plan"];
    }

    public function mostrarGenero($idg){
        $csql = "SELECT genero FROM generos WHERE id='$idg'";
        $generos = $this->baseDeDatos->Consulta($csql);
        $genero = mysqli_fetch_array($generos);
        return $genero["genero"];
    }

    public function cambiarPagina($pag, $num){
        return $pag+$num;
    }

    public function buscarEnTabla($id){
        $csql = "SELECT * FROM $this->tabla WHERE id='$id'";
        $fila = $this->baseDeDatos->Consulta($csql);
        return mysqli_fetch_array($fila);
    }

    public function devolverTabla(){
        return $this->baseDeDatos->Consulta($this->csql);
    }



}