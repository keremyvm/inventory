<?php 
namespace app\controller;
use \config\helper\View as View;
// use \app\model\ProductoModel as ProductoModel;
// use \app\model\CategoriaModel as CategoriaModel;
class ReporteVenta
{
	private $view;
    // private $producto;
    // private $categoria;
	//--------------------------
    public function __construct()
    {
        $this->view = new View();
        // $this->producto = new ProductoModel();
        // $this->categoria = new CategoriaModel();
    }
    //--------------------------
    public function index()
    {
    	$this->view->view('head','default');
    	$this->view->view('header','default');
    	$this->view->view('menu','default');
    	$this->view->view('reporte_venta');
    	$this->view->view('footer','default');
    }
    //--------------------------
    
}