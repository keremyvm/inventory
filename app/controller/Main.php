<?php
namespace app\controller;
use \config\helper\View as View;

class Main 
{
	//properties
	private $view;

    public function __construct()
    {
 		$this->view=new View();	       
    }
    //--------------------------------
    public function index()
    {
        if (isset($_SESSION["nombre"])) 
        {
        	$this->view->view('head','default');
        	$this->view->view('header','default');
        	$this->view->view('main','main');
            $this->view->view('menu','default');
            $this->view->view('footer','default');
        }
    }
}
