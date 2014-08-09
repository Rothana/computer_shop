<?php
class Page
{
	private $id;
	private $title;
	private $url;
	private $description;
	private $status;
	private $image;

	
	public function __construct()
	{

	}

	public function image($page)
	{
		$db = new Database();	
		$db->connect();
		$where = "page_id=".$page;
		$rs = $db -> select('rln_page','*',$where);
		$row = mysql_fetch_array($rs);
		return $row['page_image'];
	}
	
	public function set($id,$title,$url,$description,$status,$image)
	{
		$this->id = $id;
		$this->title = $title;
		$this->url = $url;
		$this->description = $description;	
		$this->status = $status;
		$this->image = $image;
	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		
		if($db -> insert('rln_page',array($this->title,$this->url,$this->description,$this->status,$this->image),'page_title,page_url,page_description,page_status,page_image'))
		{
			$db->disconnect();
			return "<div class='message'> Save successfully ! !</div>";	
		}
		else
		{
			return "Can't insert new record." .mysql_error();	
		}
		
	}

	public function count_view($id){
		$db = new Database();	
		$db->connect();
		
		$sql = "UPDATE rln_page SET page_view=page_view+1 WHERE page_id=". $id;
		@mysql_query($sql);
	}

	public function single($page)
	{
		$db = new Database();	
		$conn = $db->connect();

		$this->count_view($page);

		$obj_category = new Category();
		$obj_post = new Post();

		$where = "page_url='".$page ."' and page_status=1";
		$result = $db -> select('rln_page','*',$where);

		if($result):
		$row = mysql_fetch_array($result);
				$pr ="<div class='single'>";
            	$pr .="<h2>".$row['page_title']."</h2>";
            	$pr .="<div style='padding-left:5px;margin-top:8px;margin-bottom:10px;line-height:18px;'>";
					// Load Image
					$img_w = "img_id=" . $row['page_image'];
					$img_result = $db -> select('rln_image','*',$img_w);
					$img_r = mysql_fetch_array($img_result);	
		
					$pr .="<img align='left' style='margin-right:10px;margin-bottom:10px;' src='".$obj_post->site_path()."media/posts/".$img_r['img_image1']."' />";

					$pr .=htmlspecialchars_decode($row['page_description']);		

					if($img_r['img_image2']!="noimage.jpg")
					$pr .="<img align='left' style='margin-right:10px;margin-bottom:10px;' src='".$obj_post->site_path()."media/posts/".$img_r['img_image2']."' />";
					if($img_r['img_image3']!="noimage.jpg")
					$pr .="<img align='left' style='margin-right:10px;margin-bottom:10px;' src='".$obj_post->site_path()."media/posts/".$img_r['img_image3']."' />";
					if($img_r['img_image4']!="noimage.jpg")
					$pr .="<img align='left' style='margin-right:10px;margin-bottom:10px;' src='".$obj_post->site_path()."media/posts/".$img_r['img_image4']."' />";
					if($img_r['img_image5']!="noimage.jpg")
					$pr .="<img align='left' style='margin-right:10px;margin-bottom:10px;' src='".$obj_post->site_path()."media/posts/".$img_r['img_image5']."' />";
					$pr .="</div>";
				$pr .="</div>";

			return $pr;
		endif;
	}


	public function _current($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "page_id=".$id;
		return $db -> select('rln_page','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_page',array('page_title'=>$this->title,'page_url'=>$this->url,'page_status'=>$this->status,'page_description'=>$this->description),array('page_id',$this->id));
		
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

		$result = "SELECT * FROM rln_page";
		$pager = new PS_Pagination($conn, $result, 20, 5,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		
		$pr = "";

		
		
		$pr .= '<form action="" method="post" name="frmpage" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmpage.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Title</th>";
			 $pr .= "<th style='width:160px;'>URL</th>";
			 $pr .= "<th style='width:80px;'>Status</th>";

			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". @$row['page_id'] . "' /></td>";
			$pr .="<td align='center'>".@$row['page_id']."</td>";
			$pr .="<td align='left'><a href='pages.php?edit=".@$row['page_id']."'>".@$row['page_title']."</a></td>";
			$pr .="<td align='center'>".@$row['page_url']."</td>";
			$pr .="<td align='center'>".@$row['page_status']."</td>";

		}
		$pr .="</table></form></div>"; 
		
		/*$pr.= "<div class='pagination' style='margin-top:20px;'>";
			$pr.= "<div align='center'>";
				  $pr.= $pager->renderFirst();
				  $pr.= $pager->renderPrev();
				  $pr.= $pager->renderNav('<span>','</span>') ;
				  $pr.= $pager->renderNext();
				  $pr.= $pager->renderLast();
			$pr.= "</div>";
		$pr.= "</div>";*/
		
		echo $pr;
		
	}
	
	public function display(){
		$db = new Database();	
		$db->connect();
		$rs = $db -> select('rln_page','*','page_status=1');

		$obj_post = new Post();
		if(isset($_GET['page'])):
			$url = $_GET['page'];
			$home = "";
		else:
			$url = "";
			$home ="class='selected'";
		endif;

		if(isset($_GET['category'])=='products'):
			$product_class="class='selected'";
			$home = "";
		else: 
			$product_class ="";
		endif;

		$pr ="<ul>";
		$pr .="<li><a ".$home." href='".$obj_post->site_path()."'>Home</a></li>";
		$pr .="<li><a ".$product_class."href='".$obj_post->site_path()."products'>Products</a></li>";
		while($row = @mysql_fetch_array($rs)):
			if(@$url==$row['page_url'])
			$pr .="<li><a  class='selected' href='".$obj_post->site_path()."pg_".$row['page_url']."'>".$row['page_title']."</a>";
			else $pr .="<li><a href='".$obj_post->site_path()."pg_".$row['page_url']."'>".$row['page_title']."</a>";
		endwhile;
		$pr .="</ul>";

		return $pr;
	}
	
	
	public function delete($del)
	{
		$id = count($del);

		$obj_img = new Image();

		if (count($id) > 0)
		  {
			 foreach ($del as $id_d)
			 {
				// Delete ads record
				$db = new Database();
				$db->connect();
				$where = "page_id=".$id_d;
				

				$db->delete("rln_page",$where);
			}
		}	
	}
	
	

	
}
?>