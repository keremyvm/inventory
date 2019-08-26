<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\CategoriaModel as CategoriaModel;
class Categoria
{
    private $view;
    private $categoria;
    //-----------------------
    public function __construct()
    {
        $this->view=new View();
        $this->categoria = new CategoriaModel();
    }
    public function index()
    {
    	$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('categoria');
    	$this->view->view('menu','default');
    	$this->view->view('footer','default');
    }
    //----------------------------------------
    public function guardar_categoria()
    {

        $table='categorias';
        $categoria=$_POST['txt_nuevo_categoria'];
        $error=array();
        if (empty($categoria)) {
            $error['txt_nuevo_categoria']='No puede estar vacio el campo categoria';
        }
        if (count($error)>0) {
            echo json_encode(array('status'=>2,'msj'=>$error));exit();
        }
        if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $categoria)) {
             echo json_encode(array('status'=>3,'msj'=>'No se permiten caracteres especiales'));exit();     
        }
        else
        {
            $data=array(
                            'categoria' =>  $categoria
                        );
             $this->categoria->db_insert($table,$data);
            echo json_encode(array('status'=>1,'msj'=>'La categoria se guardo satisfactoriamente'));        
        }
        
    }
    //-------------------------------------------------
     public function mostrar_categoria()
    {
        $table='categorias';
        $data=$this->categoria->db_get_all($table);
        echo json_encode(array('status'=>1,'msj'=>$data));
    }
    //-------------------------------------------------
    public function mostrar_editar_categoria()
    {
        $id=$_POST['id'];
        $table='categorias';
        $signo='=';
        $data=array(
                        'id'        =>  'id',
                        'categoria' =>  'categoria'
                    );
        $where=array(
                        'id'    =>  $id
                    );
        $datos=$this->categoria->db_get_row($table,$data,$where,$signo);
        echo json_encode(array('status'=>1,'msj'=>$datos));
    }
    //-------------------------------------------------------
    public function editar_categoria()
    {
        $table='categorias';
        $id=$_POST['id'];
        $categoria=$_POST['txt_editar_categoria'];
        $data=array(
                        'categoria' =>  $categoria
                    );
        $where=array(
                        'id'    =>  $id
                    );
        $this->categoria->db_update($table,$data,$where);
        echo json_encode(array('status'=>1,'msj'=>'La categoria se ha actualizado correctamente'));
    }
    //-----------------------------------------------------------
    public function eliminar_categoria()
    {
        $table='categorias';
        $id=$_POST['txt_eliminar_id'];
        $where=array(
                        'id'    =>  $id
                    );
        $this->categoria->db_delete($table,$where);
        echo json_encode(array('status'=>1,'msj'=>$id));
    }
    //-----------------------------------------------------------
}
