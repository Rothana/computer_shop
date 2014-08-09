<?php
class Advertise
{
	private $id;
	private $title;
	private $link;
	private $status;
	private $image;
	private $order;
	private $position;
	
	public function __construct()
	{

	}
	
	public function set($id,$title,$link,$status,$position,$order,$image)
	{
		$this->id = $id;
		$this->title = $title;
		$this->link = $link;
		$this->order = $order;	
		$this->image = $image;
		$this->status = $status;
		$this->position = $position;

	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_advertise',array($this->title,$this->link,$this->status,$this->position,$this->order,$this->image),'adv_title,adv_link,adv_status,adv_position,adv_order,adv_img')):
			$db->disconnect();
			return "<div class='message'>Your record is inserted !</div>";	
		else:
			return "Can't insert new record." .mysql_error();	
		endif;		
	}
	
	public function display()
	{
		$db = new Database();	
		$db->connect();

		$obj_post = new Post();
		
		$where = "adv_status=1";
		$rs = $db -> select('rln_advertise','*',$where,"adv_order ASC");
		
		while ($row = mysql_fetch_array($rs)):
			echo "<div class='ads'>";
				echo "<a href='".$row['adv_link']."' target='_blank'><img src='".$obj_post->site_path()."media/banners/".$row['adv_img']."' /></a>";
			echo "</div>";
		endwhile;
	}


	public function _current($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "adv_id=".$id;
		return $db -> select('rln_advertise','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_advertise',array('adv_title'=>$this->title,'adv_link'=>$this->link,'adv_status'=>$this->status,'adv_position'=>$this->position,'adv_order'=>$this->order),array('adv_id',$this->id));
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
		$result = "SELECT * FROM rln_advertise";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs) {echo "There is no content."; die(mysql_error());}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmadvertise" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmadvertise.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Title</th>";
			 $pr .= "<th style='width:300px;'>Link</th>";
			 $pr .= "<th style='width:50px;'>Order</th>";
			 $pr .= "<th style='width:50px;'>Status</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['adv_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['adv_id']."</td>";
			$pr .="<td><a href='advertise.php?edit=".$row['adv_id']."'>".$row['adv_title']."</a></td>";
			$pr .="<td align='center'>".$row['adv_link']."</td>";
			$pr .="<td align='center'>".$row['adv_order']."</td>";
			$pr .="<td align='center'>".$row['adv_status']."</td>";
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
				$where = "adv_id=".$id_d;
				$db->delete("rln_advertise",$where);
			}
		}	
	}

	public function update_image($id,$img)
	{
		$db = new Database();	
		$db->connect();
		$db->update('rln_advertise',array('adv_img'=>$img),array('adv_id',$id));
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
					
						if(move_uploaded_file($img['temp'],"../media/banners/". $img_name)){
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