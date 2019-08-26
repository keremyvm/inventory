<?php 
namespace app\model;
use \config\database\Database as Database;
use \config\database\Query as Query;
use PDO;
class ProductoModel
{
    private $db;
    private $query;
    //--------------------------
    public function __construct()
    {
        $start = new Database();
        $this->db=$start->conexion();
        $this->query = new Query();
    }
    //---------------------------------
     public function db_insert($table,$data)
    {
    	return $this->query->insert($table,$data);
    }
    //----------------------------------
    public function db_update($table,$data,$where)
    {
    	return $this->query->update($table,$data,$where);	
    }
    //-----------------------------------------------------
    public function db_get_all($table)
    {
    	return $this->query->select_table($table)
    					   ->fetch_all();
    }
    //----------------------------------------
    public function db_get_row($table,$data,$where,$signo)
	{
		return $this->query->select_table($table,$data)
	 					   ->where($where,$signo)
	 					   ->fetch_row();
	}
	//-----------------------------------------
	public function db_delete($table,$where)
	{
		return $this->query->delete($table,$where);
	}
    //--------------------------
    public function db_get_row_producto($table,$key,$val)
    {
        $sql="SELECT * from $table where $key=:val order by id desc";
        // $sql="SELECT * from $table";
        $rs=$this->db->prepare($sql);
        $rs->execute(
                    array(
                        ':val'  =>  $val
                         )
                    );
        return $rs->fetch(PDO::FETCH_OBJ);
    }
    //--------------------------------
    public function db_get_row_producto2($table,$key,$val)
    {
        $sql="SELECT * from $table where $key=:val";
        // $sql="SELECT * from $table";
        $rs=$this->db->prepare($sql);
        $rs->execute(
                    array(
                        ':val'  =>  $val
                         )
                    );
        return $rs->fetchAll(PDO::FETCH_OBJ);
    }
//-----------------------------------------------------------------
	// public function db_get_producto()
	// {
	// 	$sql='SELECT p.id,p.imagen,p.codigo,p.descripcion,c.categoria,p.stock,
	// 		p.precio_compra,p.precio_venta,p.fecha from productos p
	// 		INNER JOIN categorias

		
	// 	';
	// }
	//--------------
}

