<?php
class News
{
	private $id;
	private $content;
	private $order;
	
	public function __construct()
	{

	}
	
	public function set($id,$content,$order)
	{
		$this->id = $id;
		$this->content = $content;
		$this->order = $order;	

	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_news',array($this->content,$this->order),'ns_content,ns_order')):
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
		$where = "ns_id=".$id;
		return $db -> select('rln_news','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_news',array('ns_content'=>$this->content,'ns_order'=>$this->order),array('ns_id',$this->id));
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
		$result = "SELECT * FROM rln_news";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs) {echo "There is no content."; die(mysql_error());}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmnews" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmnews.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Name</th>";
			 $pr .= "<th style='width:50px;'>Order</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['ns_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['ns_id']."</td>";
			$pr .="<td><a href='news.php?edit=".$row['ns_id']."'>".htmlspecialchars_decode($row['ns_content'])."</a></td>";
			$pr .="<td align='center'>".$row['ns_order']."</td>";
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
		$rs = $db -> select('rln_news','*');

		if(!$rs) return;

		$pr ="<div><ul id='ticker01'>";
		while($row = @mysql_fetch_array($rs)):
			$pr .="<li>". htmlspecialchars_decode($row["ns_content"]) ."</li>";
		endwhile;
		$pr .="</ul></div>";

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
				$where = "ns_id=".$id_d;
				$db->delete("rln_news",$where);
			}
		}	
	}

	
}
?>