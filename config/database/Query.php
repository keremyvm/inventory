<?php 
namespace config\database;
use \config\database\Database as Database;
use PDO;
class Query
{
    private $db;
    private $sql;
    private $select;
    private $table;
    private $cols;
    private $where;
    private $val_wheres;
    private $key_wheres;
    private $signo;
    private $where_array;
    public function __construct()
    {
        //initialize
        $this->select='';
        $this->sql='';
        $this->db='';
        $this->table='';
        $this->cols='';
        $this->where=array();
        $this->val_wheres='';
        $this->key_wheres='';
        $this->signo='';
        $this->where_array='';
        //conection
        $start = new Database();
        $this->db = $start->conexion();

    }
    //---------------------------
    public function insert($table,$data=array())
    {
    	$this->sql='';
    	$this->sql .='INSERT INTO '.$table.'(';

    	$k1=array_keys($data);
    	$k2=array_keys($data);
        $v=array_values($data);
        $k2[0] = ":".$k2[0];
    	$key1=(is_array($k1)) ? implode(',',$k1) : '';
    	$key2=(is_array($k2)) ? implode(',:',$k2) : '';

    	$this->sql .=$key1.')';
    	$this->sql .=' values (';
    	$this->sql .=$key2.')';
        
        $arr_key2 = explode(',', $key2);
        foreach ($v as $k => $value) 
        {
            $tmp_sql[$arr_key2[$k]]=$value;
        }
        try{
        $rs=$this->db->prepare($this->sql);
        $rs->execute($tmp_sql);  
        return true;
        }
        catch (Exception $e) {
        return false;
        }

    
      
    } 
    //----------------------------------------------------
     public function update($table,$data,$where)
    {
        $this->sql='';
        $this->sql.='UPDATE '.$table.' SET ';
        $ult=end($data);
        reset($data);
        foreach ($data as $k => $v) 
        {
            if ($v!==$ult)     
                $this->sql.=$k.'=:'.$k.',';
            else
            $this->sql.=$k.'=:'.$k;    
        }
        $this->sql.=' WHERE ';
        $where_ult=end($where);
        reset($where);
        foreach ($where as $k => $v) {
            if ($where_ult!=$v) {
                $this->sql.=$k.'=:'.$k.' and ';
            }
            else
            {
                $this->sql.=$k.'=:'.$k;
            }
            $data[$k]=$v;
        }
        $rs=$this->db->prepare($this->sql);
        $rs->execute($data);
    }
    //----------------------------------------------------
    public function delete($table,$where)
    {
        $this->sql='';
        $this->sql.='DELETE FROM '.$table;
        $this->sql.=' WHERE ';
         $where_ult=end($where);
        reset($where);
        foreach ($where as $k => $v) {
            if ($where_ult!=$v) {
                $this->sql.=$k.'=:'.$k.' and ';
            }
            else
            {
                $this->sql.=$k.'=:'.$k;
            }
            $where[$k]=$v;
        }
        $rs=$this->db->prepare($this->sql);
        $rs->execute($where);
        // $this->ejecutar($this->sql,$where);
    }
    //----------------------------------------------------
    public function ejecutar($string,$data=array())
    {
        $this->rs=$this->db->prepare($string);
        $this->rs->execute($data);
        return $this->rs;
    }
    //----------------------------------------------------
    public function select_table($table,$count='*')
    {
        if (is_array($table)) 
        {
            foreach ($table as $k => $v) 
            {
                $this->cols=$k;
                $data[$this->cols]=$v;
                $this->table=$v.' '.$this->cols;
            }
        }
        //-------
        else if(is_string($table))
        {
                $this->cols=$table;
                $this->table=$this->cols;
        } 
        if ($count=='*') 
            {
                $this->select.='* ';
            }
        else if(is_array($count))
        {
            $ult=end($count);
            reset($count);
            if (array_key_exists(0, $count)) 
            {
                foreach ($count as $k => $v) 
                {
                    if ($v==$ult) 
                        $this->select.=$v;    
                    else
                        $this->select.=$v.', ';
                }    
            }
            else
            {
                foreach ($count as $k => $v) 
                {
                    if ($v==$ult) 
                        $this->select.=$this->cols.'.'.$k.' AS '.$v;    
                    else
                        $this->select.=$this->cols.'.'.$k.' AS '.$v.',';
                }
            }
        }
        return $this;    
    }
    //---------------------------------------------------
     public function where($array,$signo,$log='')
     {
        $this->where_array='';
        $ult=end($array);
        reset($array);
        foreach ($array as $k => $v) 
        {
            $this->key_wheres=$k;
            $this->val_wheres=$v;
            $this->signo=$signo;
            if ($log=='and') 
            {
                if ($v!=$ult) 
                {
                    $this->where_array.=$this->key_wheres.$this->signo.':'.$this->key_wheres.' and ';
                }
                else
                {
                 $this->where_array.=$this->key_wheres.$this->signo.':'.$this->key_wheres;   
                }
            }
            else if ($log=='or') 
            {
                if ($v!=$ult) 
                {
                    $this->where_array.=$this->key_wheres.$this->signo.':'.$this->key_wheres.' or ';    
                }
                else
                {
                    $this->where_array.=$this->key_wheres.$this->signo.':'.$this->key_wheres;   
                }
            }
            else
            {
                $this->where_array.=$this->key_wheres.$this->signo.':'.$this->key_wheres;
            }
            $data[$this->key_wheres]=$this->val_wheres;
            $this->where=$data;
        } 
        return $this;
     }
    //-------------------------------------------------
    public function fetch_all()
    {
        $this->sql='SELECT '.$this->select.' FROM '.$this->table;
        $rs=$this->ejecutar($this->sql);
        $data=$rs->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    //-------------------------------------------------
    public function fetch_row()
    {
        $this->sql='SELECT '.$this->select.' FROM '.$this->table.' WHERE '.$this->where_array;
        $rs=$this->ejecutar($this->sql,$this->where);
        $data=$rs->fetch(PDO::FETCH_OBJ);
        return $data;
        // return $this->sql;exit();
    }
    //--------------------------------------------------
}
