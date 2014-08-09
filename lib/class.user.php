<?php
class User
{
	private $id;
	private $name;
	private $username;
	private $password;
	private $type;
	
	public function __construct()
	{

	}

	public function get_name($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "user_id=".$id;
		$rs = $db -> select('rln_user','*',$where);
		if($rs):
		$row = mysql_fetch_array($rs);
		return $row['user_name'];
		endif;
	}

	public function find($us,$pwd)
	{
		$db = new Database();	
		$db->connect();
		$where = "user_username='".$us."' and user_password='".$pwd."'";
		$rs = $db -> select('rln_user','*',$where);
		if(!$rs) return;
		if(mysql_num_rows($rs)==1)
			return $rs;
		else
			return false;
	}

	public function Login($username,$password)
	{
		$db = new Database();	
		$db->connect();
		$where = "user_username='".$username."' and user_password='".$password."'";
		$rs = $db -> select('rln_user','*',$where);
		if(!$rs) return;
		
		$row = mysql_fetch_array($rs);


		$_SESSION['rlnid']= $row['user_id'];
		$_SESSION['rlntype']= $row['user_type'];
	}

	public function logout()
	{
		unset($_SESSION['rlnid']);
		unset($_SESSION['rlntype']);
	}
	
	public function set($id,$name,$username,$password,$type)
	{
		$this->id = $id;
		$this->name = $name;
		$this->username = $username;
		$this->password = $password;
		$this->type = $type;
	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_user',array($this->name,$this->username,$this->password,$this->type),'user_name,user_username,user_password,user_type')):
			$db->disconnect();
			return "<div class='message'>Your record is inserted !</div>";	
		else:
			return "Can't insert new record." .mysql_error();	
		endif;		
	}

	public function _current($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "user_id=".$id;
		return $db -> select('rln_user','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_user',array('user_name'=>$this->name,'user_username'=>$this->username,'user_password'=>$this->password,'user_type'=>$this->type),array('user_id',$this->id));
		if($rs):
			$db->disconnect();
			return "<div class='message'>Update successful !</div>";	
		else:
			return "Can't upldate, Please try again." .mysql_error();	
		endif;
	}
	
	public function record()
	{
		$db = new Database();	
		
		$conn = $db->connect();
		$result = "SELECT * FROM rln_user where user_type='author'";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs){ 
			echo "There is no content!";
			die(mysql_error());
		}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmuser" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmuser.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Name</th>";
			 $pr .= "<th style='width:200px;'>Username</th>";
			 $pr .= "<th style='width:200px;'>Password</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['user_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['user_id']."</td>";
			$pr .="<td><a href='users.php?edit=".$row['user_id']."'>".$row['user_name']."</a></td>";
			$pr .="<td align='center'>".$row['user_username']."</td>";
			$pr .="<td align='center'>".$row['user_password']."</td></tr>";

		}
		$pr .="</table></form></div>"; 
		
		$pr.= "<div class='pagination' style='margin-top:20px;'>";
			$pr.= "<div align='center'>";
				  $pr.= $pager->renderFirst();
				  $pr.= $pager->renderPrev();
				  $pr.= $pager->renderNav('<span>','</span>') ;
				  $pr.= $pager->renderNext();
				  $pr.= $pager->renderLast();
			$pr.= "</div>";
		$pr.= "</div>";
		
		echo $pr;
		
	}

	
	public function delete($del)
	{
		$id = count($del);
		if (count($id) > 0)
		  {
			 foreach ($del as $id_d)
			 {
				// Delete ads record
				$db = new Database();
				$db->connect();
				$where = "user_id=".$id_d;
				$db->delete("rln_user",$where);
			}
		}	
	}
	

	
}
?>