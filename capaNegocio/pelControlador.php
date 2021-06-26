<?php
include_once("../capaDatos/claseConexion.php");

class Pelicula{

    private $baseDeDatos; 

    private $titulo;
    private $genero_id;
    private $director;
    private $anio_estreno;
    private $plan_id;

    public function __construct($titulo, $anio_estreno){
        $this ->titulo = $titulo;
        $this ->anio_estreno = $anio_estreno;
        $this ->baseDeDatos = new Conexion();
    }

    public function setGeneroDirectorPlan($genero_id, $director, $plan_id){
        $this ->genero_id = $genero_id;
        $this ->director = $director;
        $this ->plan_id = $plan_id;
    }

    public function editPelicula($id){
        $csql = "SELECT * FROM peliculas where titulo = '$this->titulo' and anio_estreno != '$this->anio_estreno' and id != '$id'";
        $pelicula = mysqli_fetch_array($this->baseDeDatos->Consulta($csql));
            if($pelicula){
                    header("Location: ../capaPresentacion/index.php?seccion=editarPel&pelicula=$id&estado=pelicula_existente");
                die();
            }else{
                $csql = "UPDATE peliculas SET titulo = '$this->titulo', genero_id = '$this->genero_id', director = '$this->director', anio_estreno = '$this->anio_estreno', plan_id = '$this->plan_id' where id = '$id'";
                $pelicula = mysqli_fetch_array($this->baseDeDatos->Consulta($csql));
                if (!$this->baseDeDatos->Consulta($csql)){
                    //header("Location: ../capaPresentacion/index.php?seccion=editarPel&pelicula=$id&estado=error_al_conectar");

                    echo var_dump($this);
                    die();
                }
            }
    }

    public function eliminarPelicula($id){
        $csql = "DELETE FROM peliculas WHERE id='$id'";
        $this->baseDeDatos->Consulta($csql);
        if (!$this->baseDeDatos->Consulta($csql)){
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=error_al_conectar");
            die();
        }
    }

    public function registrarPelicula(){
        $titulo = $this->titulo;
        $anio_estreno = $this->anio_estreno;
        $csql = "SELECT * FROM peliculas where titulo = '$titulo' and anio_estreno = '$anio_estreno'";
        $existe = $this->baseDeDatos->Consulta($csql);

        if(mysqli_fetch_row($existe)):
            header("Location: ../capaPresentacion/index.php?seccion=agregarPel&estado=pelicula_existente");
            die();
        endif;

        $csql = "INSERT INTO peliculas (titulo, genero_id, director, anio_estreno, plan_id) values ('$titulo', '$this->genero_id', '$this->director','$anio_estreno', '$this->plan_id')";

        if (!$this->baseDeDatos->Consulta($csql)){
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=error_al_conectar");
            die();
        }


    }

}

?>