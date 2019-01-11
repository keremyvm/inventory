<?php 
namespace app\model;
use config\database\Database as Database;
use config\database\Query as Query;
class CategoriaModel
{
	private $db;
	private $query;
    //----------------------------
    public function __construct()
    {
        $start = new Database();
        $this->db=$start->conexion();
        $this->query = new Query();
    }
    //----------------------------
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
    //----------------------------------------
}