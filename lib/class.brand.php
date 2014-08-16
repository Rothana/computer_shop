<?php
class Brand
{
	private $id;
	private $name;
	private $order;
	private $image;
	
	public function __construct()
	{

	}
	
	public function set($id,$name,$order,$image)
	{
		$this->id = $id;
		$this->name = $name;
		$this->order = $order;	
		$this->image = $image;

	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_brand',array($this->name,$this->order,$this->image),'br_name,br_order,br_logo')):
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
		$where = "br_id=".$id;
		return $db -> select('rln_brand','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_brand',array('br_name'=>$this->name,'br_order'=>$this->order),array('br_id',$this->id));
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
		$result = "SELECT * FROM rln_brand";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs) {echo "There is no content."; die(mysql_error());}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmbrand" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmbrand.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Name</th>";
			 $pr .= "<th style='width:50px;'>Order</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['br_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['br_id']."</td>";
			$pr .="<td><a href='brands.php?edit=".$row['br_id']."'>".$row['br_name']."</a></td>";
			$pr .="<td align='center'>".$row['br_order']."</td>";
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

	public function display(){
		$db = new Database();	
		$db->connect();
		$rs = $db -> select('rln_brand','*');

		if(!$rs) return;

		$obj_post = new Post();
		
		$pr = "<div id='brand'>";
		$pr .= "<div id='mcts1'>";
		while($row = @mysql_fetch_array($rs)):
			$pr .= "<img src='".$obj_post->site_path()."media/brands/".$row["br_logo"]."' />";
		endwhile;
		$pr .="</div>";
		$pr .="</div>";

		return $pr;
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
				$where = "br_id=".$id_d;
				$db->delete("rln_brand",$where);
			}
		}	
	}

	public function update_image($id,$img)
	{
		$db = new Database();	
		$db->connect();
		$db->update('rln_brand',array('br_logo'=>$img),array('br_id',$id));
	}
	
	public function upload($file_id)
	{ // Upload image from front page
		
	if($_FILES[$file_id]["name"]):
			if((($_FILES[$file_id]["type"]=="image/jpeg") || 
			($_FILES[$file_id]["type"]=="image/pjpeg")||
			($_FILES[$file_id]["type"]=="image/png") ||
			($_FILES[$file_id]["type"]=="image/gif")) &&
				($_FILES[$file_id]["size"]<= 5242880)) 
			 {
				if($_FILES[$file_id]["error"] > 0)  // for get the error number of file while uploaded
				{
					echo "Error Number : ".$_FILES[$file_id]["error"]."<br />";
				}
				else
				{
					$img['name'] = $_FILES[$file_id]["name"];	 // for get the name of file
					$img['size'] = $_FILES[$file_id]["size"] / 1024;	 // for get the size of file
					$img['type'] = $_FILES[$file_id]["type"];	 // for get the type of file
					$img['temp'] = $_FILES[$file_id]["tmp_name"];	 // for get the path of temporary file								

					// Generate img name
					
					$add = mt_rand() . ".";
					$img_name = str_replace(".",$add, $img['name']);
					
						if(move_uploaded_file($img['temp'],"../media/brands/". $img_name)){
							return $img_name;
						}
						else
							die ("Failed, while uploading file<br />");
					}
					
				}
			else 
				return("Invalid");				
		endif; 
	}
	
}
?>