<?php
require_once("../capaDatos/claseConexion.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class Usuario{

    private $baseDeDatos; 

    protected $permisos;
    private $email;
    private $nombre;
    private $plan;
    private $password;

    public function __construct($email, $password){
        $this ->email = $email;
        $this ->password = $password;
        $this ->permisos="usuario";
        $this ->baseDeDatos = new Conexion();
    }

    function registrarUsuario(){

        $this ->checkEmail();
        $this ->checkPassword();
        $this ->guardarUsuario();
    }

    function iniciarSesion(){
        $email = $this ->email;
        $password = $this ->password;


        $csql = "SELECT * FROM usuarios where email = '$email' ";
        $usuario = mysqli_fetch_array($this->baseDeDatos->Consulta($csql));

        if(!$this->baseDeDatos->Consulta($csql)):
            header("Location: ../capaPresentacion/index.php?seccion=login&estado=usuario_inexistente");
            die();
        endif;

        if(!password_verify($password, $usuario['pswd'])):
            header("Location: ../capaPresentacion/index.php?seccion=login&estado=contraseña_incorrecta");
            die();
        endif;

        $_SESSION["usuario"] = [
            "id" => $usuario['id'],
            "nombre" => $usuario['nombre'],
            "permisos" => $usuario['permisos'],
            "email" => $usuario['email']
        ];

        header("Location: ../capaPresentacion/index.php?");
        
    }

    private function checkEmail(){
        $email = $this->email;
        $csql = "SELECT * FROM usuarios where email = '$email' ";
        $existe = $this->baseDeDatos->Consulta($csql);

        if(mysqli_fetch_row($existe)):
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=usuario_existente");
            die();
        endif;
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE):
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=correo_invalido");
            die();
        endif;
    }

    private function checkPassword(){

        $password = $this ->password;

        if(strlen($password) <=8):
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=password_invalido");
            die();
        endif;
    }

    public function setNombrePlan($nombre, $plan){
        $this ->nombre = $nombre;
        $this ->plan = $plan;
    }
    
    private function guardarUsuario(){
        $email = $this ->email;
        $nombre = $this ->nombre;
        $plan = $this ->plan;
        $permisos = $this ->permisos;
        $password = $this ->password;
        $password = password_hash($password, PASSWORD_DEFAULT);

        $csql = "INSERT INTO usuarios (nombre, email, plan_id, pswd, permisos, vencimiento_subscripcion) values ('$nombre', '$email', '$plan', '$password', '$permisos', DATE_ADD(CURRENT_DATE(), INTERVAL 1 MONTH))";

        if (!$this->baseDeDatos->Consulta($csql)){
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=error_al_conectar");
            die();
        }
            
    }

    public function editUsuario($nombre, $email, $password, $password2, $plan, $id){

        $this->editEmail($email, $id);

        $csql = "SELECT * FROM usuarios where email = '$email' and id = '$id'";
        $usuario = mysqli_fetch_array($this->baseDeDatos->Consulta($csql));

        if(!empty($password)||!empty($password2)){
            $contraseñaguardada = $usuario['pswd'];
            $this->editContraseña($password, $password2, $contraseñaguardada, $id);
        }

        $this->editNombrePlan($nombre, $plan, $id);

        $_SESSION["usuario"]["nombre"] = $nombre;
        $_SESSION["usuario"]["email"] = $email;
    }

    private function editNombrePlan($nombre, $plan, $id){
        $csql = "UPDATE usuarios SET nombre = '$nombre', plan_id = '$plan' where id = '$id'";
        $this->baseDeDatos->Consulta($csql);
    }
    
    private function editEmail($email, $id){

        $csql = "SELECT * FROM usuarios where email = '$email' and id != '$id'";
        $usuario = mysqli_fetch_array($this->baseDeDatos->Consulta($csql));
            if($usuario){
                    header("Location: ../capaPresentacion/index.php?seccion=editarUsuario&usuario=$id&registrarse=true&estado=usuario_existente");
                die();
            }else{
                    $this ->email = $email;
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE):
                        header("Location: ../capaPresentacion/index.php?seccion=editarUsuario&usuario=$id&registrarse=true&estado=correo_invalido");
                        die();
                    endif;
                    $csql = "UPDATE usuarios SET email = '$email' where id = '$id'";
                    $this->baseDeDatos->Consulta($csql);
                }
            
    }

    private function editContraseña($password1, $password2, $contraseñaguardada, $id){

        if(!empty($password)||!empty($password2)){

        if(!password_verify($password1, $contraseñaguardada)):
            header("Location: ../capaPresentacion/index.php?seccion=editarUsuario&usuario=$id&estado=contraseña_incorrecta");
            die();
        endif;

        if(strlen($password1) <8):
            header("Location: ../capaPresentacion/index.php?seccion=editarUsuario&usuario=$id&estado=password_invalido");
            die();
        endif;

        $password2 = password_hash($password2, PASSWORD_DEFAULT);

        $csql = "UPDATE usuarios SET pswd = '$password2' where id = '$id'";
        $this->baseDeDatos->Consulta($csql);
        }
    }

    public function editAdmin($nombre, $email, $plan, $permisos, $id){
        $this->editEmail($email, $id);
        $this->editNombrePlan($nombre, $plan, $id);
        $csql = "UPDATE usuarios SET permisos = '$permisos' where id = '$id'";
        $this->baseDeDatos->Consulta($csql);
        if($id == $_SESSION["usuario"]["id"]){
            $_SESSION["usuario"] = [
                "id" => $id,
                "nombre" => $nombre,
                "permisos" => $permisos,
                "email" => $email
            ];
        }
    }

    public function cerrarSesion(){
        session_destroy();
        header("Location: ../capaPresentacion/index.php");
    }

    public function eliminarUsuario($id){
        $csql = "DELETE FROM usuarios WHERE id='$id'";
        $this->baseDeDatos->Consulta($csql);
        if (!$this->baseDeDatos->Consulta($csql)){
            header("Location: ../capaPresentacion/index.php?seccion=login&registrarse=true&estado=error_al_conectar");
            die();
        }
        if($_SESSION["usuario"]["email"] == $this->email){
            $this->cerrarSesion();
        }
    }

    }


?>
