<?php 
namespace app\model;
use config\database\Database as Database;
use config\database\Query as Query;
use PDO;
class LoginModel
{
	private $db;
    private $query;
    //-------------------------------------
    public function __construct()
    {
    	$start = new Database();
    	$this->db=$start->conexion();
        $this->query = new Query();
    }
    //---------------------------------------------------------
    public function db_login($table,$select,$where,$signo,$log)
    {
        return $this->query->select_table($table,$select)
                    ->where($where,$signo,$log)
                    ->fetch_row();
    }
    //-------------------------------------------
    public function db_ultimo_login($table,$data,$where)
    {
        return $this->query->update($table,$data,$where);
    }
}
