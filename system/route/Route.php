<?php 
namespace system\route;
use \config\helper\View as View;
class route
{
	//--------------------------------
	//properties
    //-------------------------------
	private $exp;
    private $print;
	//--------------------------------
	//method
	//--------------------------------
    public function __construct()
    {
        $this->exp='';
        $this->print='';
    }
    //--------------------------------
    public function key($key)
    {
        $server=$_SERVER["REQUEST_URI"];

        $this->exp=explode('/', $server);

        if (isset($key)) 
        {

            if (array_key_exists($key, $this->exp)) 
            {
                return $this->exp[$key];    
            }
            else
            {
                return '';
            }
            
        }
    	
    }
    //-------------------------------
    public function decode($file)
    {
        $string=explode('-', $file);

        foreach ($string as $key => $value) 
        {
            $this->print.=ucwords($value);
        }
        return $this->print;
    }
    //-------------------------------
    public function method()
    {
        return (!empty($this->key(3))) ? $this->key(3) : 'index';
    }
    //------------------------------
    public function restriccion()
    {
        if(strtoupper($_SERVER['REQUEST_METHOD']) != "POST" && !empty($this->key(3)))
        {
            echo json_encode(array("error"=>"Usted no puede acceder a esto"));
            exit();
        }
    }
    //-------------------------------
    public function url()
    {
        $view=new View();
        // $this->restriccion();
        if (!empty($this->key(2))) 
        {  

        $fichero=$this->decode($this->key(2));
        $namespaces=str_replace('/', '\\', DS.'app'.DS.'controller'.DS.$fichero);

            if (class_exists($namespaces)) 
            {
                $class=new $namespaces();

                    if (method_exists($class, $this->method())) 
                    {
                        $method=$this->method();
                        $param=$this->key(4);
                        $class->$method($param);
                    }
                    else
                    {

                        $view->view('404','default');
                    }
            }
            else
            {
                $view->view('404','default');
            }
        }
        //-----
        else
        {
        $fichero=$this->decode($this->key(2));
        $namespaces=str_replace('/', '\\', DS.'app'.DS.'controller'.DS.FILE_DEFAULT);
        
           if (class_exists($namespaces)) 
            {
                $class=new $namespaces();

                    if (method_exists($class, $this->method())) 
                    {
                        $method=$this->method();
                        $param=$this->key(4);
                        $class->$method($param);
                    }
                    else
                    {
                        $view->view('404','default');
                    }
            }
            else
            {
                $view->view('404','default');
            }
        }
        
    }
//-------------------------------
}
