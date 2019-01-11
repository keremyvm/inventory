<?php 
namespace app\controller;
use config\helper\View as View;
class Producto
{
	private $view;
	//--------------------------
    public function __construct()
    {
        $this->view = new View();
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
    //--------------------------
}
