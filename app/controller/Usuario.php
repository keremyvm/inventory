<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\UsuarioModel as UsuarioModel;
class Usuario
{
	private $view;
	private $usuario;
	//---------------------------
    public function __construct()
    {
        $this->view = new View();
        $this->usuario = new UsuarioModel();
    }
    //---------------------------
    public function index()
    {
    	$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('usuario');
    	$this->view->view('menu','default');
    	$this->view->view('footer','default');
    }
    //---------------------------
    public function guardar_usuario()
    {
        //     if ($_SERVER['REQUEST_METHOD']=='POST') 
        // {
            $name=$_POST['txt_nuevo_nombre'];
            $user=$_POST['txt_nuevo_usuario'];
            $password=$_POST['txt_nuevo_password'];
            $encriptado=crypt($password,'$2a$07$usesomesillystringforsalt$');
            $perfil=$_POST['cbo_nuevo_perfil'];
            $file=$_FILES['file_nuevo_foto'];
            $errors=array();
            $table='usuarios';
            $dir='app/media/img/usuarios/'.$user;
            if (empty($name)) {
                $errors['txt_nuevo_nombre']='No puede estar vacio el campo nombre';
            }
            if (empty($user)) {
                $errors['txt_nuevo_usuario']='No puede estar vacio el campo usuario';
            }
            if (empty($password)) {
                $errors['txt_nuevo_password']='No puede estar vacio el campo password';
            }
            if (empty($perfil)) {
                $errors['cbo_nuevo_perfil']='No puede estar vacio el campo perfil';   
            }
            if (empty($file)) {
                $errors['txt_file_nuevo_foto']='No puede estar vacio el campo foto';      
            }
            if (count($errors)>0) {
                echo json_encode(array('status'=>3,'msj'=>$errors));
                exit();
            }
            if (!preg_match('/^[a-zA-Z-0-9 ]+$/', $name) ||
                !preg_match('/^[a-zA-Z-0-9 ]+$/', $user) ||
                !preg_match('/^[a-zA-Z-0-9 ]+$/', $password)) 
            { 
                echo json_encode(array('status'=>4,'msj'=>'No se permiten caracteres especiales'));
                exit();
            }
            if (isset($file) && !is_dir($dir)) 
            {    
                switch ($_FILES['file_nuevo_foto']['type']) 
                {
                    case 'image/jpeg':
                        mkdir($dir,0755,true);
                        $nombre_img=$_FILES['file_nuevo_foto']['name'];
                        $ubicacion_img=$_FILES['file_nuevo_foto']['tmp_name'];
                        list($ancho,$alto)=getimagesize($ubicacion_img);
                        $new_ancho=500;
                        $new_alto=500;
                        // $aleatorio=mt_rand(100,999);
                        $ruta_img='app/media/img/usuarios/'.$user.'/'.$nombre_img;
                        $origen_img=imagecreatefromjpeg($_FILES["file_nuevo_foto"]["tmp_name"]);
                        $destino_img=imagecreatetruecolor($new_ancho, $new_alto);
                        imagecopyresized($destino_img, $origen_img, 0, 0, 0, 0, $new_ancho, $new_alto, $ancho, $alto);
                        imagejpeg($destino_img,$ruta_img);
                    break;
                    case 'image/png':
                        mkdir($dir,0755,true);
                        $nombre_img=$_FILES['file_nuevo_foto']['name'];
                        $ubicacion_img=$_FILES['file_nuevo_foto']['tmp_name'];
                        list($ancho,$alto)=getimagesize($ubicacion_img);
                        $new_ancho=500;
                        $new_alto=500;
                        // $aleatorio=mt_rand(100,999);
                        $ruta_img='app/media/img/usuarios/'.$user.'/'.$nombre_img;
                        $origen_img=imagecreatefrompng($_FILES["file_nuevo_foto"]["tmp_name"]);
                        $destino_img=imagecreatetruecolor($new_ancho, $new_alto);
                        imagecopyresized($destino_img, $origen_img, 0, 0, 0, 0, $new_ancho, $new_alto, $ancho, $alto);
                        imagepng($destino_img,$ruta_img);
                    break;
                    default:
                        echo json_encode(array('status'=>5,'msj'=>'Solo se pueden guardar imagenes'));exit();
                    break;
                }
            //---        
            }  
            else
            {
                $msj='No se pueden crear dos nombres iguales de directorios';
                echo json_encode(array('status'=>2,'msj'=>$msj));
                exit();
            }
            //---
                $datos=array(

                                'nombre'    =>  $name,
                                'usuario'   =>  $user,
                                'password'  =>  $encriptado,
                                'perfil'    =>  $perfil,
                                'foto'      =>  $ruta_img
                            );
            
            $this->usuario->db_insert($table,$datos);
            echo json_encode(array('status'=>1,'msj'=>'El usuario ha sido guardado satisfactoriamente'));
            exit();
        // }
        // else
        // {
        //     echo json_encode(array('status'=>0,'msj'=>'No existe post'));
        //     exit();
        // }
    }
    //---------------------------
    public function mostrar_usuario()
    {
        $table='usuarios';
        $data=$this->usuario->db_get_all($table);
        echo json_encode(array('status'=>1,'msj'=>$data,'user'=>$_SESSION['usuario']));
    }
    //---------------------------
    public function mostrar_editar_usuario()
    {
        $id=$_POST['idUsuario'];
        $table='usuarios';
        $signo='=';
        $data=array(
                        'id'            =>  'id',
                        'nombre'        =>  'nombre',
                        'usuario'       =>  'usuario',
                        'password'      =>  'password',
                        'perfil'        =>  'perfil',
                        'foto'          =>  'foto',
                        'estado'        =>  'estado',
                        'ultimo_login'  =>  'ultimo_login'

        );
        $where=array(
                        'id'        =>      $id      
        );
        $datos=$this->usuario->db_get_row($table,$data,$where,$signo);
        echo json_encode(array('status'=>1,'msj'=>$datos));
    }
    //---------------------------
    public function editar_usuario()
    {
        $table='usuarios';
        $id=$_POST['txt_editar_id'];
        $name=$_POST['txt_editar_nombre'];
        $user=$_POST['txt_editar_usuario'];
        $password=$_POST['txt_editar_password'];
        $perfil=$_POST['cbo_editar_perfil'];


        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $name)) {
            $ruta_img=$_POST['txt_foto_actual'];

            if (isset($_FILES['file_editar_foto']['tmp_name']) && !empty($_FILES['file_editar_foto']['tmp_name'])) {
                $dir='app/media/img/usuarios/'.$user;
                if (!empty($_POST['txt_foto_actual'])) {
                    unlink($_POST['txt_foto_actual']);
                }
                else
                {
                    mkdir($dir,0755,true);
                    $msj='Se creo un new directorio';
                }
                switch ($_FILES['file_editar_foto']['type']) {
                    case 'image/jpeg':
                        $nombre_img=$_FILES['file_editar_foto']['name'];
                        list($ancho,$alto)=getimagesize($_FILES['file_editar_foto']['tmp_name']);
                        $new_ancho=500;
                        $new_alto=500;
                        $ruta_img='app/media/img/usuarios/'.$user.'/'.$nombre_img;
                        $origen=imagecreatefromjpeg($_FILES['file_editar_foto']['tmp_name']);
                        $destino=imagecreatetruecolor($new_ancho, $new_alto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $new_ancho, $new_alto, $ancho, $alto);
                        imagejpeg($destino,$ruta_img);
                        break;
                    case 'image/png':
                        $nombre_img=$_FILES['file_editar_foto']['name'];
                        list($ancho,$alto)=getimagesize($_FILES['file_editar_foto']['tmp_name']);
                        $new_ancho=500;
                        $new_alto=500;
                        $ruta_img='app/media/img/usuarios/'.$user.'/'.$nombre_img;
                        $origen=imagecreatefrompng($_FILES['file_editar_foto']['tmp_name']);
                        $destino=imagecreatetruecolor($new_ancho, $new_alto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $new_ancho, $new_alto, $ancho, $alto);
                        imagepng($destino,$ruta_img);
                        break;
                    default:
                        echo json_encode(array("status"=>4,"msj"=>"SOLO SE PUEDE ACTUALIZAR IMÁGENES"));exit();
                        break;
                }
            }
        }
        else{
            echo json_encode(array("status"=>3, "msj"=>"No se pueden permitir caracteres especiales"));
            exit();
        }
        if ($password=='') 
        {  
            $encriptar=$_POST["txt_password_actual"];  
        }
        else
        {
            if (preg_match('/^[a-zA-Z0-9 ]+$/',$password)) 
            {
                $encriptar=crypt($password,'$2a$07$usesomesillystringforsalt$');
            }
            else
            {
                echo json_encode(array("status"=>2, "msj"=>"No se pueden permitir caracteres especiales"));
                exit();
            }
        }
        $_SESSION['foto']=$ruta_img;

        $data=array(
                        'nombre'    =>  $name,
                        'usuario'   =>  $user,
                        'password'  =>  $encriptar,
                        'perfil'    =>  $perfil,
                        'foto'      =>  $ruta_img
                    );
        $where=array(
                        'id'        =>  $id
                    );
        $this->usuario->db_update($table,$data,$where);
        // $_SESSION['nombre']=$name;
        echo json_encode(array('status'=>1,'msj'=>"El usuario ".$user." ha sido actualizado correctamente"));
    }
    //---------------------------
    public function activacion_usuario()
    {
        $table="usuarios";
        $id=$_POST["activar_id"];
        $estado=$_POST["activar_estado"];
        $data=array(
                        'estado'    =>  $estado
                    );
        $where=array(
                        'id'    =>  $id
        );
        $this->usuario->db_update($table,$data,$where);
        echo json_encode(array('status'=>1,'msj'=>$id));
    }
    //---------------------------
    public function validar_repetir_usuario()
    {
        $table='usuarios';
        $signo='=';
        $usuario=$_POST['txt_nuevo_usuario'];
        $data=array(
                        'usuario'   =>  $usuario
                    );
        $where=array(
                        'usuario'   =>  $usuario
                    );
        $usu=$this->usuario->db_get_row($table,$data,$where,$signo);
        if ($usu) {
            echo json_encode(array('status'=>1,'msj'=>'El usuario '.$usuario.' ya existe'));    
        }
        else
        {
            echo json_encode(array('status'=>2,'msj'=>'disabled'));    
        }
        
    }
    //---------------------------
    public function eliminar_usuario()
    {
        $table='usuarios';
        $id=$_POST['txt_eliminar_id'];
        $usuario=$_POST['txt_eliminar_usuario'];
        $foto=$_POST['txt_eliminar_foto'];
        if (!empty($foto)) {
            unlink($foto);
            rmdir('app/media/img/usuarios/'.$usuario);
        }
        $where=array(
                        'id'    =>  $id
                    );
        
        $this->usuario->db_delete($table,$where);
        echo json_encode(array('status'=>1,'msj'=>$id));
    }
    //---------------------------
}