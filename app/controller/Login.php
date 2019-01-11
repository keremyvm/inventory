<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\LoginModel as LoginModel;
class Login
{
    private $view;
    private $login;
    //-------------------------------------------------------------
    public function __construct()
    {
       $this->view = new View();
       $this->login = new LoginModel();
    }
    //--------------------------------------------------------------
    public function index()
    {
        // $array=array( "nombre" => "keremy","edad"=>20);
        // $this->view->set_param($array);
        $this->view->view("login");
    }
    //---------------------------------------------------------------
    public function iniciar()
    {
        $user=$_POST["txt_usuario"];
        $password=$_POST["txt_password"];
        $encriptado=crypt($password,'$2a$07$usesomesillystringforsalt$');
        $signo='=';
        $log='and';
        $table='usuarios';
        $errors=array();
        //---
        if (empty($user)) 
        {
            $errors['txt_usuario']  ='No puede estar vacio el campo usuario';        
        }
        if (empty($password)) 
        {
            $errors['txt_password'] ='No puede estar vacio el campo password';           
        }
        //---
        if (count($errors)>0) 
        {
            echo json_encode(array('status'=>3,'msj'=>$errors));
            exit();
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $user) || 
            !preg_match('/^[a-zA-Z0-9]+$/',$password))
        {
            echo json_encode(array('status'=>4,'msj'=>'No se permiten caracteres especiales'));
            exit();
        }
        //---
        $select=array(
                //  name        as      alias            
                    'id'        =>  'id',
                    'nombre'    =>  'nombre',
                    'usuario'   =>  'usuario',
                    'password'  =>  'password',
                    'perfil'    =>  'perfil',
                    'foto'      =>  'foto',
                    'estado'    =>  'estado'
                 );

        $where=array(
                    "usuario"   =>  $user,
                    "password"  =>  $encriptado,
                    "estado"    =>  1
                );
        //---
       $rs=$this->login->db_login($table,$select,$where,$signo,$log);
        if ($rs) 
        {
            $_SESSION['id']=$rs->id;
            $_SESSION['nombre']=$rs->nombre;
            $_SESSION['usuario']=$rs->usuario;
            $_SESSION['password']=$rs->password;
            $_SESSION['foto']=$rs->foto;
            $fecha=date('Y-m-d');
            $hora=date('H:i:s');
            $fecha_logeo=$fecha.' '.$hora;
            $data=array(
                        "ultimo_login"=>$fecha_logeo
                   );
            $where=array(
                        "id"    => $rs->id
                     );
            $this->login->db_ultimo_login($table,$data,$where);
            echo json_encode(array('status'=>1,'msj'=>BASE_URL));
            exit();         
        }
        else
        {
            echo json_encode(array('status'=>2, 'msj'=>'usuario o contraseña son incorrectos'));
            exit();
        }
    }
    //------------------------------------------------------------------------------------------------
    public function salir()
    {
        unset($_SESSION["nombre"]);
        header("Location: ".BASE_URL."login");
    }
    //-----------------------------------   
}