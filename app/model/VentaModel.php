<?php 
namespace app\model;
use config\database\Database as Database;
use config\database\Query as Query;
use PDO;
class VentaModel
{
    private $db;
	private $query;
	//---------------------------
    public function __construct()
    {
        $start = new Database();
        $this->db=$start->conexion();
        $this->query = new Query();
    }
    //------------------------------
    public function db_insert($table,$data)
    {
	    $insert = $this->query->insert($table,$data);
        if ($insert) 
        {
            return true; 
        }
        else
        {
            return  false;    
        }
        
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
    public function db_get_row_venta($table,$key,$val)
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
    //----------------------------------------
    public function db_max_venta()
    {
        $sql="SELECT MAX(codigo) as maximo FROM VENTAS";
        $rs=$this->db->prepare($sql);
        $rs->execute();
        return $rs->fetch(PDO::FETCH_OBJ);
    }
    //----------------------------------------
}