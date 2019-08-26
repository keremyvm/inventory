<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\ClienteModel as ClienteModel;
class Cliente
{
	private $view;
	private $cliente;
	//--------------------------
	public function __construct()
	{
		$this->view = new View();
		$this->cliente = new ClienteModel();
	}
	//---------------------------
	public function index()
	{
		$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('cliente');
    	$this->view->view('menu','default');
    	$this->view->view('footer','default');
	}
	public function guardar_cliente()
	{
		$nombre=$_POST['txt_nuevo_nombre'];
		$documento=$_POST['txt_nuevo_documento'];
		$email=$_POST['txt_nuevo_email'];
		$telefono=$_POST['txt_nuevo_telefono'];
		$direccion=$_POST['txt_nuevo_direccion'];
		$nacimiento=$_POST['txt_nuevo_fecha_nacimiento'];
		$errors=array();
		$table='clientes';
		if (empty($nombre)) {
			$errors['txt_nuevo_nombre']='No puede estar vacio el campo nombre';
		}
		if (empty($documento)) {
			$errors['txt_nuevo_documento']='No puede estar vacio el campo documento';
		}
		if (empty($email)) {
			$errors['txt_nuevo_email']='No puede estar vacio el campo email';
		}
		if (empty($telefono)) {
			$errors['txt_nuevo_telefono']='No puede estar vacio el campo telefono';
		}
		if (empty($direccion)) {
			$errors['txt_nuevo_direccion']='No puede estar vacio el campo direccion';
		}
		if (empty($nacimiento)) {
			$errors['txt_nuevo_fecha_nacimiento']='No puede estar vacio el campo fecha de nacimiento';
		}
		if (count($errors)>0) {
			echo json_encode(array('status'=>2,'msj'=>$errors));exit();
		}
		if (!preg_match('/^[a-zA-Z ]+$/', $nombre))
			// !preg_match('/^[0-9]+$/', $documento) ||
			// !preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email) ||
			// !preg_match('/^[0-9\-]+$/', $telefono) ||
			# !preg_match('/^[#\.\-a-zA-Z0-9 ]$/', $direccion))
			//!preg_match('/^[0-9]+$/', $nacimiento) 
		{
			echo json_encode(array('status'=>3,'msj'=>'No se permiten caracteres especiales'));exit();
		}
		// else
		// {
			$data=array(
							'nombre'			=>	$nombre,
							'documento'			=>	$documento,
							'email'				=>	$email,
							'telefono'			=>	$telefono,
							'direccion'			=>	$direccion,
							'fecha_nacimiento'	=>	$nacimiento
					   );
			$this->cliente->db_insert($table,$data);
			echo json_encode(array('status'=>1,'msj'=>'El cliente se guardo correctamente'));exit();
		// }
	}
	//-------------------------------
	public function mostrar_cliente()
	{
		$table='clientes';
        $data=$this->cliente->db_get_all($table);
        echo json_encode(array('status'=>1,'msj'=>$data));
	}
	//-------------------------------
	public function mostrar_editar_cliente()
	{
		$id=$_POST['idCliente'];
        $table='clientes';
        $signo='=';
        $data=array(
                        'id'            	=>  'id',
                        'nombre'        	=>  'nombre',
                        'documento'     	=>  'documento',
                        'email'      		=>  'email',
                        'telefono'      	=>  'telefono',
                        'direccion'     	=>  'direccion',
                        'fecha_nacimiento'  =>  'fecha_nacimiento',
                        'compras'  			=>  'compras',
                        'fecha'				=>	'fecha'

        );
        $where=array(
                        'id'        =>      $id      
        );
        $datos=$this->cliente->db_get_row($table,$data,$where,$signo);
        echo json_encode(array('status'=>1,'msj'=>$datos));
	}
	//------------------------------------------------------
	public function editar_cliente()
	{
		$table='clientes';
        $id=$_POST['txt_editar_id'];
        $nombre=$_POST['txt_editar_nombre'];
		$documento=$_POST['txt_editar_documento'];
		$email=$_POST['txt_editar_email'];
		$telefono=$_POST['txt_editar_telefono'];
		$direccion=$_POST['txt_editar_direccion'];
		$nacimiento=$_POST['txt_editar_fecha_nacimiento'];
        $data=array(
							'nombre'			=>	$nombre,
							'documento'			=>	$documento,
							'email'				=>	$email,
							'telefono'			=>	$telefono,
							'direccion'			=>	$direccion,
							'fecha_nacimiento'	=>	$nacimiento
					   );
        $where=array(
                        'id'    =>  $id
                    );
        $this->cliente->db_update($table,$data,$where);
        echo json_encode(array('status'=>1,'msj'=>'El cliente se ha actualizado correctamente'));
	}
	//------------------------------------------------------
	public function eliminar_cliente()
    {
        $table='clientes';
        $id=$_POST['txt_eliminar_id'];
        $where=array(
                        'id'    =>  $id
                    );
        $this->cliente->db_delete($table,$where);
        echo json_encode(array('status'=>1,'msj'=>$id));
    }
}
