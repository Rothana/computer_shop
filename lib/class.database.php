<?php
class Database
{
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_pass = '';
	private $db_name = 'dbitonecomputer';
	private $result = array();
	
	// $db = new Database();
	// $db -> connect();
	public function connect()
	{
		if(!@$this->con)
		{
			
			$conn = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
			
			if($conn)
			{
				mysql_query("SET character_set_results=utf8", $conn);
				mysql_query("SET NAMES 'utf8'", $conn);
				$seldb = mysql_select_db($this->db_name,$conn);
				if($seldb)
				{
					$this->con = true;
					return $conn;
				}
				else
				{
					return false;	
				}
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return true;
		}
	}
	
	//$db = new Database();
	// $db -> disconnect();
	public function disconnect()
	{
		if($this->con)
		{
			if(mysql_close())
			{
				$this->con = false;
				return true;	
			}else{
				return false;	
			}
		}
	}
	
	public function table_exists($tables)
	{
		$table = mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$tables.'"');
		if($table)
		{
			if(mysql_num_rows($table) == 1)
				return true;
			else return false;	
		}
	}
	
	// $db -> select('table_name');
    // $db -> select('table_name','name,code','id=$id and name="name"','name');
	public function select($table, $rows ='*', $where = null, $order = null,$limit = null)
	{
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($where != null)
			$q .= ' WHERE '.$where;
		if($order != null)
			$q .= ' ORDER BY '.$order;
			
		if($limit != null)
			$q .= ' LIMIT '.$limit;

		if($this->table_exists($table))
		{
				$query = mysql_query($q);

				if(@mysql_num_rows($query) < 1)
					$this->result = null;
				else $this->result = $query;
				
				return $this->result;
		}
		else
		{
			return "There is not table exists.";
		}
	}
	
	// $db -> insert('table_name',array(3,"name","email@gmail.com"));
	// $db -> insert('table_name',array("name","email@gmail.com"),'name,mail');
	public function insert($table,$values,$rows = null)
	{
	   if($this->table_exists($table))
	   {
			$insert = 'INSERT INTO '.$table;
			if($rows != null
			){
				$insert .=' ('.$rows.')';   
			}
			for($i = 0; $i < count($values); $i++)
			{
				if(is_string($values[$i]))
					$values[$i] = '"'.$values[$i].'"';	
			}
			$values = implode(',',$values);
			$insert .= ' VALUES ('.$values.')';
			$ins = mysql_query($insert);

			if($ins)
			{
				return true;
			}
			else
			{
				return false;	
			}
	   }
	   else
	   {
			return "There is no table match.";   
	   }
	}
	
	// $db -> delete('table_name','id=$id');
	public function delete($table,$where = null)
	{
	   if($this->table_exists($table))
	   {
		   if($where == null)
		   {
			   $delete = "DELETE ".$table;
		   }
		   else
		   {
			   $delete = "DELETE FROM ".$table." WHERE ".$where;
		   }
		   $del = mysql_query($delete);
		   if($del)
		   		return true;
			else return false;
		   
	   }else{
			return false;   
	   }
	}
	
	// $db->update('table_name',array('name'=>'Changed!'),array('id',1));
	// $db->update('table_name',array('name'=>'Changed!'),array('id',1,'name','old_name'));
	public function update($table,$rows,$where)
	{
	   if($this->table_exists($table))
	   {
			for($i = 0; $i < count($where); $i++)
			{
				if($i%2 != 0)  
                {  
                   if(( @$where[$i+1]) != null)
				   {  
                       if(is_string($where[$i]))
					   		$where[$i] = '"'.$where[$i].'" AND '; 
					   else $where[$i] = $where[$i].' AND ';
				   }
                   else
				   { 
                      	if(is_string($where[$i]))
					   		$where[$i] = '"'.$where[$i].'"';
						else $where[$i] = $where[$i];
				   }
                }
				else
				{
					$where[$i] = $where[$i] . "=";
				}
            }  
			$where = implode('',$where);
			
			$update = 'UPDATE '.$table. ' SET ';
			$keys = array_keys($rows);
			for($i = 0; $i < count($rows); $i++)
			{
				if(is_string($rows[$keys[$i]]))
				{  
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';  
                }  
                else
				{  
                    $update .= $keys[$i].'='.$rows[$keys[$i]];  
                }  
  
                // Parse to add commas  
                if($i != count($rows)-1)  
				{  
                    $update .= ',';  
                }  
			}
			$update .= ' WHERE '.$where;  
            $query = @mysql_query($update);  
            if($query)  
            {  
                return true;  
            }  
            else  
            {  
                return false;  
            }  
			
	   }
	   else
	   {
			return false;
	   }
	}
	
	public function counter($table)
	{
		if($this->table_exists($table)):
			$query = "SELECT COUNT(*) FROM ". $table;
			return @mysql_query($query);
		else:
			return "There is no table";
		endif;
	}
}
?>