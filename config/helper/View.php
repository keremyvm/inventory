<?php 
namespace config\helper;
// require dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'constant'.DIRECTORY_SEPARATOR.'config_system.php';
class View
{
	private $parametro=array();
	//-------------------------------------------
    public function __construct()
    {
        // $this->parametro=array();
    }
    //--------------------------------------------
   public function view($directory,$load='modules')
    {
        if (!empty($this->parametro)) 
        {
            extract($this->parametro);  
        }
        if ($load=='default') 
        {
            return require APP.DS.'app'.DS.'view'.DS.'default'.DS.$directory.'_view'.'.php';
        }
        else if($load=='main')
        {
            return require APP.DS.'app'.DS.'view'.DS.$directory.'_view'.'.php';
        }
        else if($load=='modules')
        {
            return require APP.DS.'app'.DS.'view'.DS.'modules'.DS.$directory.'_view'.'.php';
        }

        
    }
    //----------------------------
    public function set_param($parametro)
    {
        $this->parametro = $parametro;
    }
}
// $view = new View();
// $view->view("login");
