<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\VentaModel as VentaModel;
// use \app\model\ClienteModel as ClienteModel;
class Venta
{
	private $view;
    private $venta;
    // private static $increment;
    // private $cliente;
    //--------------------------
    public function __construct()
    {
        $this->view = new View();
        $this->venta = new VentaModel();
        // $this->cliente = new ClienteModel();
    }
    //---------------------------
    public function index()
    {
    	$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('menu','default');
    	$this->view->view('venta');
    	$this->view->view('footer','default');
    }
    //------------------------------
    public function mostrar_id_venta()
    {
        $data=$this->venta->db_max_venta();
        echo json_encode(array('status'=>1,'msj'=>$data->maximo));
    }
    //-------------------------------
    public function mostrar_producto()
    {
        $table='productos';
        $data=$this->venta->db_get_all($table);
        echo json_encode(array('status'=>1,'msj'=>$data));
    }
    //---------------------------------
     public function mostrar_cliente()
    {
        $table='clientes';
        $data=$this->venta->db_get_all($table);
        echo json_encode(array('status'=>1,'msj'=>$data));
    }
    //----------------------------------------
    public function mostrar_id_producto()
    {
        $id=$_POST['id_productos'];
        $table='productos';
        $signo='=';
        $data=array(
                        'id'                =>  'id',
                        'imagen'            =>  'imagen',
                        'codigo'            =>  'codigo',
                        'descripcion'       =>  'descripcion',
                        'stock'             =>  'stock',
                        'precio_venta'      =>  'precio_venta'
        );
        $where=array(
                        'id'        =>      $id      
        );
        $datos=$this->venta->db_get_row($table,$data,$where,$signo);
        echo json_encode(array('status'=>1,'msj'=>$datos));
    }
    //------------------------------------------------------
    public function guardar_venta()
    {
        // $increment=$_POST['txt_increment'];
        $signo='=';
        $cliente=$_POST['cliente'];
        $productos=$_POST['productos'];
        $listar_productos=json_decode($productos,true);
        $valor_ventas=0;
        $total_productos_comprados=array();
        foreach ($listar_productos as $k => $v) 
        {
            array_push($total_productos_comprados, $v['cantidad']);
            $table = 'productos';
            $data=array(
                            'id'            =>  'id',
                            'id_categoria'  =>  'id_categoria',
                            'codigo'        =>  'codigo',
                            'descripcion'   =>  'descripcion',
                            'imagen'        =>  'imagen',
                            'stock'         =>  'stock',
                            'precio_compra' =>  'precio_compra',
                            'precio_venta'  =>  'precio_venta',
                            'fecha'         =>  'fecha',
                            'ventas'        =>  'ventas'
                        );
            $where=array(
                            'id'    =>  $v['id']
                        );
            $datos=$this->venta->db_get_row($table,$data,$where,$signo);
            //--------------
            $item_ventas='ventas';
            // $valor_ventas += (int)$v['cantidad'] + (int)$datos->ventas;
            $valor_ventas = (int)$v['cantidad'] + (int)$datos->ventas;
            $data_venta=array(
                                'ventas'    =>  $valor_ventas
                             );
            $new_venta=$this->venta->db_update($table,$data_venta,$where);
            //---------------
             $data_stock=array(
                                'stock'    =>  $v['stock']
                             );
            $new_stock=$this->venta->db_update($table,$data_stock,$where);
        }
        $table_clientes='clientes';
        $data_cliente=array(
                                'id'        =>  'id',
                                'compras'   =>  'compras'
                           );
        $where_cliente=array(
                                'id'  =>  $cliente
                            );
        $datos_cliente=$this->venta->db_get_row($table_clientes,$data_cliente,$where_cliente,$signo);
        //---
        $cliente_compras=array_sum($total_productos_comprados) + (int)$datos_cliente->compras;
        $data_compras=array(
                                'compras'   =>  $cliente_compras
                           );
        $new_cliente=$this->venta->db_update($table_clientes,$data_compras,$where_cliente);
        //------------------------------
        $table_guardar='ventas';
        $codigo=$_POST['id'];
        // $cliente=$_POST['cliente'];
        $vendedor=$_POST['vendedor'];
        // $productos=$_POST['productos'];
        $impuesto=$_POST['impuesto'];
        $neto=$_POST['neto'];
        $total=$_POST['total'];
        $metodo_pago=$_POST['metodo_pago'];
        $array_guardar=array(
                        'codigo'        =>  $codigo,
                        'id_cliente'    =>  $cliente,
                        'id_vendedor'   =>  $vendedor,
                        'productos'     =>  $productos,
                        'impuesto'      =>  $impuesto,
                        'neto'          =>  $neto,
                        'total'         =>  $total,
                        'metodo_pago'   =>  $metodo_pago
                    );
        $res=$this->venta->db_insert($table_guardar,$array_guardar);
        if($res) 
        {
            echo json_encode(array('status'=>1,'msj'=>'La venta fue guardada correctamente'));  
            // var_dump((int)$increment);
        }
        else
        {
            echo json_encode(array('status'=>2,'msj'=>'Hubo un problemas al guardar la venta'));
        }
    }
    //------------------------------------------------------
}