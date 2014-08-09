<?php
class Category
{
	private $id;
	private $title;
	private $url;
	private $parent;
	
	public function __construct()
	{

	}

	public function get_id($url)
	{
		$db = new Database();	
		$db->connect();
		$where = "category_url='".$url."'";
		$rs = $db -> select('rln_category','*',$where);
		if($rs):
		$row = mysql_fetch_array($rs);
		return $row['category_id'];
		endif;
	}

	public function get_name($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "category_id=".$id;
		$rs = $db -> select('rln_category','*',$where);
		if($rs):
		$row = mysql_fetch_array($rs);
		return $row['category_name'];
		endif;
	}


	public function get_url($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "category_id=".$id;
		$rs = $db -> select('rln_category','*',$where);
		if($rs):
		$row = mysql_fetch_array($rs);
		return $row['category_url'];
		endif;
	}
	
	public function set($id,$title,$url,$parent)
	{
		$this->id = $id;
		$this->title = $title;
		$this->url = $url;
		$this->parent = $parent;	
	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_category',array($this->title,$this->url,$this->parent),'category_name,category_url,category_parent'))
		{
			$db->disconnect();
			return "<div class='message'>Your record is inserted !</div>";	
		}
		else
		{
			return "Can't insert new record." .mysql_error();	
		}
		
	}

	public function _current($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "category_id=".$id;
		return $db -> select('rln_category','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_category',array('category_name'=>$this->title,'category_url'=>$this->url,'category_parent'=>$this->parent),array('category_id',$this->id));
		if($rs)
		{
			$db->disconnect();
			return "<div class='message'>Update successful !</div>";	
		}
		else
		{
			return "Can't upldate, Please try again." .mysql_error();	
		}
	}
	
	public function record()
	{
		$db = new Database();	
		
		$conn = $db->connect();
		$result = "SELECT * FROM rln_category where category_parent=0";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		if(!$rs){ 
			echo "There is no content!";
			die(mysql_error());
		}
		
		$pr = "";
		
		$pr .= '<form action="" method="post" name="frmcategory" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmcategory.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Name</th>";
			 $pr .= "<th style='width:200px;'>URL</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $row['category_id'] . "' /></td>";
			$pr .="<td align='center'>".$row['category_id']."</td>";
			$pr .="<td><a href='category.php?edit=".$row['category_id']."'>".$row['category_name']."</a></td>";
			$pr .="<td align='center'>".$row['category_url']."</td></tr>";

			$where = "category_parent=".$row['category_id'];
			$r = $db -> select('rln_category','*',$where);
			while($record = @mysql_fetch_array($r)) {
				$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". $record['category_id'] . "' /></td>";
				$pr .="<td align='center'>".$record['category_id']."</td>";
				$pr .="<td><a href='category.php?edit=".$record['category_id']."'> -- ".$record['category_name']."</a></td>";
				$pr .="<td align='center'>".$record['category_url']."</td></tr>";
			}
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
		$rs = $db -> select('rln_category','*','category_parent=0');

		$obj_post = new Post();

		$pr ="<div id='menu'>";
		$pr .="<h2>Categories</h2>";
		$pr .='<ul class="accordion"  id="accordion-3">';
		$pr .="<li><a href='".$obj_post->site_path()."products'><img src='".$obj_post->site_path()."img/arrow.png' /> All Products</a>";
		while($row = @mysql_fetch_array($rs)):
			$pr .='<li><a><img src="'.$obj_post->site_path().'img/arrow.png" /> '.$row['category_name'].'</a>';
			$where = "category_parent=".$row['category_id'];
			$sr = $db -> select('rln_category','*',$where);
			$pr .="<ul>";
			while($r = @mysql_fetch_array($sr)):
				$pr .="<li><a href='".$obj_post->site_path().$r['category_url']."'><img src='".$obj_post->site_path()."img/dot.png' />".$r['category_name']."</a></li>";
			endwhile;
			$pr .="</ul>";
		endwhile;
		$pr .="</ul>";
		$pr .="</div>";

		return $pr;
	}
	
	public function dropdown($cur)
	{
		$db = new Database();	
		$db->connect();
		$rs = $db -> select('rln_category','*','category_parent=0');
		$pr = "<select name='category' id='category' class='small'><option value='0'>-- Category --</option>";
		
		while($rows = @mysql_fetch_array($rs)):
		$pr.= "<optgroup label='" . $rows['category_name'] . "'>";
		
			$id = $rows['category_id'];
			$where = "category_parent=".$id;
			
			$result = $db -> select('rln_category','*',$where);
			while (@$row = mysql_fetch_array($result)):
			if($cur != null){
				if($row['0']==$cur):
				$pr .= "<option selected='selected' value='" . $row[0] . "'> " . $row[1] . " - ".$row[2]." </option>";
				else:
					$pr .="<option value='" . $row[0] . "'> " . $row[1] . " - ".$row[2]." </option>";	
				endif;
			}
			else
			$pr .="<option value='" . $row[0] . "'> " . $row[1] . " - ".$row[2]." </option>";;	
			endwhile;
		$pr .="</optgroup>";
		endwhile;

		$pr .="</select>"; 
		echo $pr;
				
	}

	public function parent($cur)
	{
		$db = new Database();	
		$db->connect();
		$rs = $db -> select('rln_category','*','category_parent=0');
		$pr = "<select name='parent' id='parent' class='small'><option value='0'>-- Parent --</option>";
		
		while ($row = @mysql_fetch_array($rs)):
			if($cur != null){
				if($row['0']==$cur):
				$pr .= "<option selected='selected' value='" . $row['category_id'] . "'> " . $row['category_name'] . " </option>";
				else:
					$pr .="<option value='" . $row['category_id'] . "'> " . $row['category_name'] . " </option>";	
				endif;
			}
			else
			$pr .="<option value='" . $row['category_id'] . "'> " . $row['category_name'] . " </option>";
			endwhile;

		$pr .="</select>"; 
		echo $pr;
				
	}
	
	public function _latest()
	{
		$db = new Database();	
		
		$song = new Song();
		
		$conn = $db->connect();
		$rs = $db -> select('kp_types','*');
		$pr = "<ul>";
		while($row = @mysql_fetch_array($rs)):
            $pr .="<li><a href='".$song->site_path()."types/t=".$row['tp_id']."'>".$row['en_tp_name']."</a></li>";
		endwhile;
		$pr .="</ul>";
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
				$where = "category_id=".$id_d;
				$db->delete("rln_category",$where);
			}
		}	
	}
	

	
}
?>