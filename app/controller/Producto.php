<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\ProductoModel as ProductoModel;
use \app\model\CategoriaModel as CategoriaModel;
class Producto
{
	private $view;
    private $producto;
    private $categoria;
	//--------------------------
    public function __construct()
    {
        $this->view = new View();
        $this->producto = new ProductoModel();
        $this->categoria = new CategoriaModel();
    }
    //--------------------------
    public function index()
    {
    	$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('menu','default');
    	$this->view->view('producto');
    	$this->view->view('footer','default');
    }
    //--------------------------
    public function mostrar_producto()
    {
        
        $table='productos';
        $table_cat='categorias';
        $data=$this->producto->db_get_all($table);
        $data_cat=$this->categoria->db_get_all($table_cat);
        echo json_encode(array('status'=>1, 'msj'=>$data,'msj_cat'=>$data_cat));
    }
    //--------------------------
    public function generar_codigo_producto()
    {
        $table='productos';
        $key='id_categoria';
        $val=$_POST['id_categoria'];
        $data=$this->producto->db_get_row_producto($table,$key,$val);
        echo json_encode(array('status'=>1,'msj'=>$data));
    }
    //--------------------------
    public function guardar_producto(){
        $table='productos';
        $nuevo_categoria=$_POST['cbo_nuevo_categoria'];
        $nuevo_codigo=$_POST['txt_nuevo_codigo'];
        $nuevo_descripcion=$_POST['txt_nuevo_descripcion'];
        $nuevo_stock=$_POST['txt_nuevo_stock'];
        $nuevo_precio_compra=$_POST['txt_nuevo_precio-compra'];
        $nuevo_precio_venta=$_POST['txt_nuevo_precio-venta'];
        $file=$_FILES['file_nuevo_foto'];
        $errors=array();
        $dir='app/media/img/productos/'.$nuevo_descripcion;
       
        if (empty($nuevo_categoria)) {
            $errors['cbo_nuevo_categoria']='No puede estar vacio el campo categoria';
        }
        if (empty($nuevo_codigo)) {
            $errors['txt_nuevo_codigo']='No puede estar vacio el campo codigo';   
        }
        if (empty($nuevo_descripcion)) {
            $errors['txt_nuevo_descripcion']='No puede estar vacio el campo descripcion';
        }
        if (empty($nuevo_stock)) {
            $errors['txt_nuevo_stock']='No puede estar vacio el campo stock';
        }
        if (empty($nuevo_precio_compra)) {
            $errors['txt_nuevo_precio-compra']='No puede estar vacio el campo precio de compra';
        }
        if (empty($nuevo_precio_venta)) {
            $errors['txt_nuevo_precio-venta']='No puede estar vacio el campo precio de venta';
        }
        if (empty($file)) {
            $errors['txt_file_nuevo_foto']='No puede estar vacío el campo foto';
        }
        if (count($errors)>0) {
            echo json_encode(array('status'=>2,'msj'=>$errors));
            exit();
        }
        if (!preg_match('/^[a-zA-Z ]+$/', $nuevo_descripcion) ||
            !preg_match('/^[0-9]+$/', $nuevo_stock) ||
            !preg_match('/^[0-9.]+$/', $nuevo_precio_compra) ||
            !preg_match('/^[0-9.]+$/', $nuevo_precio_venta)) {
            echo json_encode(array('status'=>3,'msj'=>'No se permiten caracteres especiales'));
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
                        $ruta_img='app/media/img/productos/'.$nuevo_descripcion.'/'.$nombre_img;
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
                        $ruta_img='app/media/img/productos/'.$nuevo_descripcion.'/'.$nombre_img;
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
             $data=array(
                        'id_categoria'  =>  $nuevo_categoria,
                        'codigo'        =>  $nuevo_codigo,
                        'descripcion'   =>  $nuevo_descripcion,
                        'imagen'        =>  $ruta_img,
                        'stock'         =>  $nuevo_stock,
                        'precio_compra' =>  $nuevo_precio_compra,
                        'precio_venta'  =>  $nuevo_precio_venta
                   );
        $this->producto->db_insert($table,$data);
        echo json_encode(array('status'=>1,'msj'=>'El producto ha sido guardado satisfactoriamente'));
    }
    //--------------------------
    public function mostrar_editar_producto(){
        $id=$_POST['id_producto'];
        $table='productos';
        $signo='=';
        $data=array(
                        'id'            =>  'id',            
                        'id_categoria'  =>  'id_categoria',
                        'codigo'        =>  'codigo',        
                        'descripcion'   =>  'descripcion',   
                        'imagen'        =>  'imagen',        
                        'stock'         =>  'stock',        
                        'precio_compra' =>  'precio_compra', 
                        'precio_venta'  =>  'precio_venta'  
                   );
        $where=array(
                        'id'    =>  $id
                    );
        $datos=$this->producto->db_get_row($table,$data,$where,$signo);
        echo json_encode(array('status'=>1,'msj'=>$datos));
    }
    //--------------------------------------
    public function editar_producto(){
        $table='productos';
        $id=$_POST['txt_editar_id'];
        $categoria=$_POST['cbo_editar_categoria'];
        $codigo=$_POST['txt_editar_codigo'];
        $descripcion=$_POST['txt_editar_descripcion'];
        $stock=$_POST['txt_editar_stock'];
        $precio_compra=$_POST['txt_editar_precio-compra'];
        $precio_venta=$_POST['txt_editar_precio-venta'];

        if (preg_match('/^[a-zA-Z ]+$/', $descripcion)) {
            $ruta_img=$_POST['txt_foto_actual'];

            if (isset($_FILES['file_editar_foto']['tmp_name']) && !empty($_FILES['file_editar_foto']['tmp_name'])) {
                $dir='app/media/img/productos/'.$descripcion;
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
                        $ruta_img='app/media/img/productos/'.$descripcion.'/'.$nombre_img;
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
                        $ruta_img='app/media/img/productos/'.$descripcion.'/'.$nombre_img;
                        $origen=imagecreatefrompng($_FILES['file_editar_foto']['tmp_name']);
                        $destino=imagecreatetruecolor($new_ancho, $new_alto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $new_ancho, $new_alto, $ancho, $alto);
                        imagepng($destino,$ruta_img);
                        break;
                    default:
                        echo json_encode(array("status"=>3,"msj"=>"SOLO SE PUEDE ACTUALIZAR IMÁGENES"));exit();
                        break;
                }
            }
        }
        else{
            echo json_encode(array("status"=>2, "msj"=>"No se pueden permitir caracteres especiales"));
            exit();
        }
        // $_SESSION['foto']=$ruta_img;

        $data=array(
                        'id_categoria'    =>  $categoria,
                        'codigo'          =>  $codigo,
                        'descripcion'     =>  $descripcion,
                        'imagen'          =>  $ruta_img,
                        'stock'           =>  $stock,
                        'precio_compra'   =>  $precio_compra,
                        'precio_venta'   =>   $precio_venta,
                    );
        $where=array(
                        'id'        =>  $id
                    );
        $this->producto->db_update($table,$data,$where);
        // $_SESSION['nombre']=$name;
        echo json_encode(array('status'=>1,'msj'=>'El producto se ha actualizado correctamente'));
    }
    //-------------------------------------
    public function eliminar_producto(){
        $table='productos';
        $id=$_POST['txt_eliminar_id'];
        $descripcion=$_POST['txt_eliminar_descripcion'];
        $foto=$_POST['txt_eliminar_foto'];
        if (!empty($foto)) {
            unlink($foto);
            rmdir('app/media/img/productos/'.$descripcion);
        }
        $where=array(
                        'id'    =>  $id
                    );
        
        $this->producto->db_delete($table,$where);
        echo json_encode(array('status'=>1,'msj'=>$descripcion));
    }
    //--------------------------
    // public function datatable_producto()
    // {

    //   echo '
    // {
    //     "data": 
    //     [
    //     [
    //         "1",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy",
    //         "keremy"
    //     ]
    //     ]
    // }';
    // }
    //--------------------------
}
