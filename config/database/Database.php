<?php
namespace config\database;
class Database
{
	protected $cn;
	
    public function __construct()
    {
        $this->cn=null;
    }
    //---------------------------------
    public function conexion()
	{
		try 
		{
			require "config.php";

			$this->cn=new \PDO($config['db']['pdo']['driver'].':host='.$config['db']['pdo']['host'].';dbname='.$config['db']['pdo']['db']
			.';charset='.$config['db']['pdo']['charset'],$config['db']['pdo']['user'],$config['db']['pdo']['pass']);
			
			return $this->cn;
		} 
		catch (Exception $e)
		{
			die($e->getmessage());
		}
		
	}
}
// $cn= new Database();
// $cn->conexion();