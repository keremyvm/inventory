<?php 
namespace app\controller;
use \config\helper\View as View;
use \app\model\AdministrarVentaModel as AdministrarVentaModel;
use \app\model\ClienteModel as ClienteModel;
use \app\model\UsuarioModel as UsuarioModel;
use \app\model\ProductoModel as ProductoModel;
class AdministrarVenta
{
	private $view;
    private $adm_venta;
    private $cliente;
    private $usuario;
    private $producto;
	//--------------------------
    public function __construct()
    {
        $this->view = new View();
        $this->adm_venta = new AdministrarVentaModel();
        $this->cliente = new ClienteModel();
        $this->usuario = new UsuarioModel();
        $this->producto = new ProductoModel();
    }
    public function index()
    {
        $this->view->view('head','default');
        $this->view->view('header','default');
        $this->view->view('menu','default');
        $this->view->view('administrar_venta');
        $this->view->view('footer','default');
    }
    //----------------------------------
    public function index_venta()
    {
        $this->view->view('head','default');
        $this->view->view('header','default');
        $this->view->view('menu','default');
        $this->view->view('administrar_venta');
        $this->view->view('footer','default');
    }
     //---------------------------------
     public function mostrar_venta()
    {
        $table_venta='ventas';
        // $table_producto='productos';
        // $data_producto=$this->producto->db_get_all($table_producto);
        $data_venta=$this->adm_venta->db_get_all($table_venta);
        echo json_encode(array('status'=>1,'msj'=>$data_venta));
    }
    //---------------------------------
    // public function mostrar_editar_cliente()
    // {
    //     $id=$_POST['id'];
    //     $table='ventas';
    //     $signo='=';
    //     $data=array(
    //                     'id'                =>  'id',
    //                     'codigo'            =>  'codigo',
    //                     'id_cliente'        =>  'id_cliente',
    //                     'id_vendedor'       =>  'id_vendedor',
    //                     'productos'         =>  'productos',
    //                     'impuesto'          =>  'impuesto',
    //                     'neto'              =>  'neto',
    //                     'total'             =>  'total',
    //                     'metodo_pago'       =>  'metodo_pago',
    //                     'fecha'             =>  'fecha'

    //     );
    //     $where=array(
    //                     'id'        =>      $id      
    //     );
    //     $datos=$this->cliente->db_get_row($table,$data,$where,$signo);
    //     echo json_encode(array('status'=>1,'msj'=>$datos));
    //}
    //------------------------------------------------------
    public function reporte_venta()
    {

        if (isset($_POST['id_venta'])) 
        {
        $id_venta=$_POST['id_venta'];
        $table_venta='ventas';
        $signo='=';
        $data_venta=array(
                        'codigo'    =>  'codigo',
                        'productos' =>  'productos',
                        'neto'      =>  'neto',
                        'impuesto'  =>  'impuesto',
                        'total'     =>  'total'
        );
        $where_venta=array(
                        'id'        =>      $id_venta     
        );
        $datos_venta=$this->adm_venta->db_get_row($table_venta,$data_venta,$where_venta,$signo);
        $post_id_venta = $datos_venta->codigo;
        $post_productos_venta = $datos_venta->productos;
        $post_neto_venta = $datos_venta->neto;
        $post_impuesto_venta = $datos_venta->impuesto;
        $post_total_venta = $datos_venta->total;
        $neto_formato = number_format($post_neto_venta,2);
        $impuesto_formato = number_format($post_impuesto_venta,2);
        $total_formato_venta = number_format($post_total_venta,2);
        $productos=json_decode($post_productos_venta,true);
        // echo "<pre>";
        // var_dump($productos);exit();
        }
        //----------------------------------
        if (isset($_POST['id_cliente'])) 
        {
        $id_cliente=$_POST['id_cliente'];
        $table_cliente='clientes';
        $data_cliente=array(
                        'nombre'   =>  'nombre',
                        'fecha'    =>   'fecha'
        );
        $where_cliente=array(
                        'id'        =>    $id_cliente
        );
        $datos_cliente=$this->cliente->db_get_row($table_cliente,$data_cliente,$where_cliente,$signo);
        $post_nombre_cliente = $datos_cliente->nombre;
        $post_fecha_cliente = $datos_cliente->fecha;
        }
        //----------------------------------------
        if (isset($_POST['id_vendedor'])) 
        {
        $id_vendedor=$_POST['id_vendedor'];
        $table_vendedor='usuarios';
        $data_vendedor=array(
                        'nombre'   =>  'nombre'
        );
        $where_vendedor=array(
                        'id'        =>    $id_vendedor
        );
        $datos_vendedor=$this->usuario->db_get_row($table_vendedor,$data_vendedor,$where_vendedor,$signo);
        $post_nombre_vendedor = $datos_vendedor->nombre;
        }
        //---------------------------------------------------------------------
        define('DS', DIRECTORY_SEPARATOR);
        $fichero = dirname(dirname(dirname(__FILE__))).DS."lib".DS."TCPDF-master".DS."tcpdf.php";
        // $fichero = dirname(dirname(dirname(__FILE__)))."/lib/TCPDF-master/examples/tcpdf_include.php";
        if(!file_exists($fichero)){
            die("Error clase no encontrada para el reporte");
        }
        require_once($fichero);
        if(class_exists("TCPDF")){
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->startPageGroup();
            $pdf->addPage();
        $bloque1=<<<EOF
            <br><br>
            <table>
                <tr>
                    <td style="width:30%;">
                        <img src="app/media/img/plantilla/logo-negro-bloque.png" style="width:140px;">
                    </td>
                    <td style="width:30%;font-size:8px;">
                        NIT: 12.123.123.544.1<br>
                        Direccion: MZ j1 lt 29 - Mi Perú - Callao
                    </td>
                     <td style="width:25%;font-size:8px;">
                       Telefono 300 123 456 345
                       ventas@inventorysystem.com
                    </td>
                     <td style="width:15%;color:red">
                        &nbsp;FACTURA 
                       <span style="text-align:center;">N° $post_id_venta</span>
                    </td>
                </tr>
            </table>
EOF;
            $pdf->writeHTML($bloque1,false,false,false,false,'');            
        $bloque2=<<<EOF
            <br><br>
            <table border="1" style="border-collapse: separate;padding:5px;">
                <tr>
                    <td>Cliente: $post_nombre_cliente</td>
                    <td style="text-align:right;">Fecha: $post_fecha_cliente</td>
                </tr>
                 <tr>
                    <td colspan="2">Vendedor: $post_nombre_vendedor</td>
                </tr>
            </table>
EOF;
            $pdf->writeHTML($bloque2,false,false,false,false,'');

        $bloque3='<br><br><table border="1" style="border-collapse: separate;padding:5px;text-align:center;">
                    <thead>
                        <tr>
                        <td>Producto</td>
                        <td>Cantidad</td>
                        <td>Precio uni.</td>
                        <td>Precio Total</td>
                        </tr>
                    </thead>
                    <tbody>';
                    
            foreach ($productos as $k => $v) 
            {
                $table_prod='productos';
                $key='id';
                $val=$v['id'];
                $datos_prod=$this->producto->db_get_row_producto2($table_prod,$key,$val);
                $precio=$datos_prod[0]->precio_venta;
                $precio_formato=number_format($precio,2);
                $total=$v['total'];
                $total_formato=number_format($total,2);
                //---
                $bloque3 .= <<<EOF
                        <tr style="font-size:9px;">
                        <td>$v[descripcion]</td>
                        <td>$v[cantidad]</td>
                        <td>$precio_formato</td>
                        <td>$total_formato</td>
                        </tr>
EOF;
            }
            $bloque3.='</tbody></table>';
            $pdf->writeHTML($bloque3,false,false,false,false,'');

        $bloque4=<<<EOF
            <br><br><table style="border-collapse: separate;font-size:9px;padding:5px;">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border:1px solid #000;text-align:center;"><strong>Neto:</strong></td>
                    <td style="border:1px solid #000;text-align:center;">$neto_formato</td>
                </tr>
                 <tr>
                    <td></td>
                    <td></td>
                    <td style="border:1px solid #000;text-align:center;"><strong>Impuesto:</strong></td>
                    <td style="border:1px solid #000;text-align:center;">$impuesto_formato</td>
                </tr>
                 <tr>
                    <td></td>
                    <td></td>
                    <td style="border:1px solid #000;text-align:center;"><strong>Total:</strong></td>
                    <td style="border:1px solid #000;text-align:center;">$total_formato_venta</td>
                </tr>
            </tbody>
            </table>
EOF;
            $pdf->writeHTML($bloque4,false,false,false,false,'');

        $pdf->Output('factura.pdf');
        }

    }
}
