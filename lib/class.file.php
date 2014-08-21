<?php
class File
{
	private $id;
	private $name;
	private $desc;
	private $file;
	
	public function __construct()
	{

	}
	
	public function set($id,$name,$desc,$file)
	{
		$this->id = $id;
		$this->name = $name;
		$this->desc = $desc;	
		$this->file = $file;
	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_file',array($this->name,$this->desc,$this->file),'fi_name,fi_desc,fi_src')):
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
		$where = "fi_id=".$id;
		return $db -> select('rln_file','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_file',array('fi_name'=>$this->name,'fi_desc'=>$this->desc),array('fi_id',$this->id));
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
		$result = "SELECT * FROM rln_file";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs) {echo "There is no content."; die(mysql_error());}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmfile" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmfile.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Name</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['fi_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['fi_id']."</td>";
			$pr .="<td><a href='files.php?edit=".$row['fi_id']."'>".$row['fi_name']."</a></td>";
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
		$conn = $db->connect();
		$obj_post = new Post();

		$result = "SELECT * from rln_file ORDER BY fi_id DESC";

		$url = "";
		$pager = new PS_Paginations($conn, $result, 9, 8,$url,$obj_post->site_path());
	
		/*
		 * Enable debugging if you want o view query errors
		*/
		$pager->setDebug(true);
				
		/*
		 * The paginate() function returns a mysql result set
		 * or false if no rows are returned by the query
		*/
		$result = $pager->paginate();

		$pr ="<div class='list'>";
				
		while ($row = @mysql_fetch_array($result)):
			$pr .="<div class='product'>";
				$pr .='<a href=""><h4>'.$row['fi_name'];
				$pr .='</h4></a>';
				$pr .='<a href=""><img align="right" src="'.$obj_post->site_path().'images/rar.png" style="width: 120px; height: 120px; margin-right: 28px;" /></a>';
				$pr .='<a href="'.$obj_post->site_path().'media/files/'.$row['fi_src'].'"><span>Download</span></a>';
				$pr .='<a class="detail" href="'.$obj_post->site_path().'dr_'.$row['fi_id'].'">Details >></a>';
			$pr .='</div>';
		endwhile;
		$pr .='<div class="clear"></div>';
		$pr .="</div>";
		$pr .='<div class="clear"></div>';


		$pr .= "<div class='pagination'>";
		  $pr .= "<div align='center'>";
				$pr .= $pager->renderFirst();
				$pr .= $pager->renderPrev();
				$pr .= $pager->renderNav('<span>','</span>') ;
				$pr .= $pager->renderNext();
				$pr .= $pager->renderLast();
		  $pr .= "</div>";
		$pr .= "</div>";
		
		$db->disconnect();
		return $pr;
	}

	public function single($file){
		$db = new Database();	
		$conn = $db->connect();
		$obj_post = new Post();

		$where = "fi_id=".$file;
		$result = $db -> select('rln_file','*',$where);

		if($result):
		$row = mysql_fetch_array($result);
			$pr ="<div class='single'>";
      $pr .="<h2>".$row['fi_name']."</h2>";
						
			$img = "<div class='image' style='width: 180px'>";
				$img .= '<img align="right" src="'.$obj_post->site_path().'images/rar.png" style="width: 120px; height: 120px; margin-right: 28px; margin-top:20px;" />';
				$img .= '<a href="'.$obj_post->site_path().'media/files/'.$row['fi_src'].'"  style="font-size: 20px;color:#ffb900;"><h4 style="margin-left:14px;">Download</h4></a>';
			$img .="</div>";
			$pr .= $img;
							
			$pr .= "<div class='detail' style='width: 400px;'>";
				$pr .=htmlspecialchars_decode($row['fi_desc']);		
			$pr .="</div>";
			$pr .="<div class='clear'></div>";

			$pr .= "<br />";
			$pr .= '<div class="fb-like" data-send="true" data-width="450" data-show-faces="false" data-href="'.$obj_post->site_path().substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI'])).'"></div>';
			$pr .= "<br style='margin-top:20px;display:block;' />";
			$pr .= "<div class='fb-comments' data-href='".$obj_post->site_path().substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI']))."' data-width='580' data-num-posts='2'></div>";

			$pr .="</div>";

			return $pr;
		endif;

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
				$where = "fi_id=".$id_d;
				$db->delete("rln_file",$where);
			}
		}	
	}
	
	
}
?>