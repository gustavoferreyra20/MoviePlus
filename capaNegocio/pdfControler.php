<?php
require("../capaNegocio/fpdf/fpdf.php");


class PDF extends FPDF{
    private $data;
    private $header; 
    private $parametros;

    public function __construct($tabla, $data){
        parent::__construct();
        $this ->setHeaderParametros($tabla);
        $this ->setData($data);
    }

    private function setHeaderParametros($tabla){
        if ($tabla == "peliculas") {
            $this ->header = array('Titulo', 'Genero', 'Director', 'Fecha de estreno', 'Plan');
            $this ->parametros = array('titulo', 'genero_id', 'director','anio_estreno', 'plan_id');
        }else{
            $this ->header = array('Nombre', 'Email', 'Plan', 'Permisos');
            $this ->parametros = array('nombre', 'email', 'plan_id', 'permisos');
        }
    }

    private function setData($resultado){
        $tabla = new Tabla("peliculas");
        $this->data = array();
        while($line = mysqli_fetch_array($resultado)){
            foreach($this ->parametros as $parametro)
            {
                if ($parametro == 'genero_id') {
                    $this->data[] = $tabla->mostrarGenero($line[$parametro]);
                }else if ($parametro == 'plan_id'){
                    $this->data[] = $tabla->mostrarPlan($line[$parametro]);
                }else{
                $this->data[] = $line[$parametro];
                }
            }
        }
        return $this->data;
    }

    public function generarTabla(){
        $count = 0;
        // Cabecera
        foreach($this ->header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Datos
        foreach($this->data as $row)
        {
            $this->Cell(40,6,$row,1);
            $count++;
            if ($count == 5) {
                $this->Ln();
                $count = 0;
            }
        }

    }

}
