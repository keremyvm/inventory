<?php 
// namespace app\controller;
// use \app\model\ProductoModel as ProductoModel;
// use \app\model\UsuarioModel as UsuarioModel;


class Prueba
{
    public $producto;

    public function __construct()
    {
        
    }
    //---------------------------
    public function datatable_producto()
    {
            
        
            $acciones="<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";
            $imagen="<img src='app/media/img/usuarios/keremy/linux.png' width='30'>";
        	echo '
            {
                "data": 
                [
                    [
                        "1",
                        "'.$imagen.'",
                        "keremy",
                        "keremy",
                        "keremy",
                        "keremy",
                        "keremy",
                        "keremy",
                        "keremy",
                        "'.$acciones.'"
                    ]
                ]
            }';
    }
}
$prueba = new Prueba();
$prueba->datatable_producto();