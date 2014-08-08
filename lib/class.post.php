<?php
class Post
{
	private $id;
	private $title;
	private $price;
	private $description;
	private $category;
	private $_date;
	private $user;
	private $image;
	private $status;
	private $_new;
	private $feature;
	
	public function __construct()
	{

	}
	
	public function site_path()
	{
		return "http://localhost/itonecomputer/";
	}

	public function image($post)
	{
		$db = new Database();	
		$db->connect();
		$where = "post_id=".$post;
		$rs = $db -> select('rln_post','*',$where);
		$row = mysql_fetch_array($rs);
		return $row['post_image'];
	}
	
	public function set($id,$title,$price,$description,$category,$user,$image,$status,$new,$feature)
	{
		$this->id = $id;
		$this->title = $title;
		$this->price = $price;
		$this->description = $description;	
		$this->category = $category;
		$this->user = $user;
		$this->image = $image;
		$this->status = $status;
		$this->_new = $new;
		$this->feature = $feature;
		$this->_date = date('Y-m-d H:i:s');
	}
	public function create()
	{
		$db = new Database();
		$db->connect();
		
		if($db -> insert('rln_post',array($this->title,$this->price,$this->description,$this->_date,$this->category,$this->user,$this->image,$this->status,$this->_new,$this->feature),'post_title,post_price,post_description,post_date,post_category,post_user,post_image,post_status,post_new,post_feature'))
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
		
		$sql = "UPDATE rln_post SET post_view=post_view+1 WHERE post_id=". $id;
		@mysql_query($sql);
	}

	
	public function display($category)
	{
		$db = new Database();	
		$conn = $db->connect();

		$obj_category = new Category();
		$id = $obj_category->get_id($category);

		if($id):


		$where = "post_status=1 and post_category=".$id;
		$result = "SELECT * from rln_post WHERE ".$where. " ORDER BY post_id DESC";

		
		$url = $category;
		$pager = new PS_Paginations($conn, $result, 9, 8,$url,$this->site_path());
	
		/*
		 * Enable debugging if you want o view query errors
		*/
		$pager->setDebug(true);
		
		/*
		 * The paginate() function returns a mysql result set
		 * or false if no rows are returned by the query
		*/
		$result = $pager->paginate();

		if(!$result) return "<div class='list'><h2>".$obj_category->get_name($id)."</h2><div class='message'>There is no content.</div></div>";

		$pr ="<div class='list'>";

		$pr .="<h2>".$obj_category->get_name($id)."</h2>";
		while ($row = @mysql_fetch_array($result)):

			$img_w = "img_id=" . $row['post_image'];
			$img_result = $db -> select('rln_image','*',$img_w);
			$img_r = mysql_fetch_array($img_result);	

			$pr .="<div class='product'>";
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><h4>'.$row['post_title'];
				if($row["post_new"]==1)
				$pr .='<img align="right" src="img/new_icon.gif" style="width:28px;height:11px;margin-top:-5px;"/>';
				$pr .='</h4></a>';
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><img src="'.$this->site_path().'media/posts/thumbs/'.$img_r['img_image1'].'" /></a>';
				$pr .='<span>'.$row['post_price'].' $</span>';
				$pr .='<a class="detail" href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'">Details >></a>';
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

		endif;
		
	}


	public function related($category,$cur)
	{
		$db = new Database();	
		$conn = $db->connect();

		$obj_category = new Category();
		$id = $obj_category->get_id($category);

		if($id):


		$where = "post_id!=".$cur." and post_status=1 and post_category=".$id;
		$result = "SELECT * from rln_post WHERE ".$where. " ORDER BY post_id DESC";

		
		$url = $category;
		$pager = new PS_Paginations($conn, $result, 6, 8,$url,$this->site_path());
	
		/*
		 * Enable debugging if you want o view query errors
		*/
		$pager->setDebug(true);
		
		/*
		 * The paginate() function returns a mysql result set
		 * or false if no rows are returned by the query
		*/
		$result = $pager->paginate();

		if(!$result) return "";

		$pr ="<div class='list' style='margin-bottom:20px;margin-top:10px;'>";

		$pr .="<h2> Related Products...</h2>";
		while ($row = @mysql_fetch_array($result)):

			$img_w = "img_id=" . $row['post_image'];
			$img_result = $db -> select('rln_image','*',$img_w);
			$img_r = mysql_fetch_array($img_result);	

			$pr .="<div class='product'>";
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><h4>'.$row['post_title'];
				if($row["post_new"]==1)
				$pr .='<img align="right" src="img/new_icon.gif" style="width:28px;height:11px;margin-top:-5px;"/>';
				$pr .='</h4></a>';
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><img src="'.$this->site_path().'media/posts/thumbs/'.$img_r['img_image1'].'" /></a>';
				$pr .='<span>'.$row['post_price'].' $</span>';
				$pr .='<a class="detail" href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'">Details >></a>';
			$pr .='</div>';
		endwhile;
		$pr .='<div class="clear"></div>';
		$pr .="</div>";
		$pr .='<div class="clear"></div>';

		
		$db->disconnect();
		return $pr;

		endif;
		
	}

	public function single($post)
	{
		$db = new Database();	
		$conn = $db->connect();

		$this->count_view($post);

		$obj_category = new Category();
		$obj_user = new User();

		$where = "post_id=".$post ." and post_status=1";
		$result = $db -> select('rln_post','*',$where);

		if($result):
		$row = mysql_fetch_array($result);
				$pr ="<div class='single'>";
            	$pr .="<h2>".$row['post_title']."</h2>";
				$pr .="<div class='info'><span>Posted : ".date('l, F d, Y',strtotime($row['post_date']))." By ".$obj_user->get_name($row['post_user'])." in <a href='".$this->site_path().$obj_category->get_url($row['post_category'])."'>".$obj_category->get_name($row['post_category'])."</a> View: ".$row['post_view']."</div>";

					// Load Image
					$img_w = "img_id=" . $row['post_image'];
					$img_result = $db -> select('rln_image','*',$img_w);
					$img_r = mysql_fetch_array($img_result);	
					
					$img = "<div class='image'>";
					$img .="<a href='".$this->site_path()."media/posts/".$img_r['img_image1']."' rel='lightbox[plants]'><img style='width:225px;height:150px;' src='".$this->site_path()."media/posts/".$img_r['img_image1']."' width='' /></a>";
					if($img_r['img_image2']!="noimage.jpg")
					$img .="<a href='".$this->site_path()."media/posts/".$img_r['img_image2']."' rel='lightbox[plants]'><img src='".$this->site_path()."media/posts/".$img_r['img_image2']."' style='width:110px;height:75px;' /></a>";
					$img .="<span style='width:5px;height:10px;float:left;'></span>";
					if($img_r['img_image3']!="noimage.jpg")
					$img .="<a href='".$this->site_path()."media/posts/".$img_r['img_image3']."' rel='lightbox[plants]'><img src='".$this->site_path()."media/posts/".$img_r['img_image3']."' style='width:110px;height:75px;' /></a>";

					if($img_r['img_image4']!="noimage.jpg")
					$img .="<a href='".$this->site_path()."media/posts/".$img_r['img_image4']."' rel='lightbox[plants]'><img src='".$this->site_path()."media/posts/".$img_r['img_image4']."' style='width:110px;height:75px;' /></a>";
					$img .="<span style='width:5px;height:10px;float:left;'></span>";
					if($img_r['img_image5']!="noimage.jpg")
					$img .="<a href='".$this->site_path()."media/posts/".$img_r['img_image5']."' rel='lightbox[plants]'><img src='".$this->site_path()."media/posts/".$img_r['img_image5']."' style='width:110px;height:75px;' /></a>";
					$img .="</div>";
					$pr .= $img;
					
					// Load Information	
					$pr .= "<div class='detail'>";
						$pr .="<h4>Price: <span>".$row["post_price"]."  $</span></h4>";
						$pr .=htmlspecialchars_decode($row['post_description']);		
					$pr .="</div>";
					$pr .="<div class='clear'></div>";

					$pr .= "<br />";
					$pr .= '<div class="fb-like" data-send="true" data-width="450" data-show-faces="false" data-href="'.$this->site_path().substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI'])).'"></div>';
					$pr .= "<br style='margin-top:10px;display:block;' />";
					$pr .= "<div class='fb-comments' data-href='".$this->site_path().substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI']))."' data-width='580' data-num-posts='2'></div>";

				$pr .="</div>";

				return $pr;
		endif;
	}

	public function latest($category,$title)
	{
		$db = new Database();	
		$conn = $db->connect();

		$obj_category = new Category();

		$where = "post_feature=1 and post_status=1 and post_category=category_id and category_parent=".$category;
		$result = "SELECT * from rln_post,rln_category WHERE ".$where. " ORDER BY post_date DESC";

		
		$url = "";
		$pager = new PS_Paginations($conn, $result, 6, 8,$url,$this->site_path());
	
		/*
		 * Enable debugging if you want o view query errors
		*/
		$pager->setDebug(true);
		
		/*
		 * The paginate() function returns a mysql result set
		 * or false if no rows are returned by the query
		*/
		$result = $pager->paginate();

		//if(!$result) return "<div class='message'>There is no content.</div>";

		$pr ="<div class='list' style='margin-bottom:15px;'>";

		$pr .="<h2 style='margin-top:5px;'>".$title."</h2>";
		while ($row = @mysql_fetch_array($result)):

			$img_w = "img_id=" . $row['post_image'];
			$img_result = $db -> select('rln_image','*',$img_w);
			$img_r = mysql_fetch_array($img_result);	

			$pr .="<div class='product'>";
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><h4>'.$row['post_title'];
				if($row["post_new"]==1)
				$pr .='<img align="right" src="img/new_icon.gif" style="width:28px;height:11px;margin-top:-5px;"/>';
				$pr .='</h4></a>';
				$pr .='<a href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'"><img src="'.$this->site_path().'media/posts/thumbs/'.$img_r['img_image1'].'" /></a>';
				$pr .='<span>'.$row['post_price'].' $</span>';
				$pr .='<a class="detail" href="'.$this->site_path().$obj_category->get_url($row['post_category']).'/'.$row['post_id'].'">Details >></a>';
			$pr .='</div>';
		endwhile;
		$pr .='<div class="clear"></div>';
		$pr .="</div>";
		$pr .='<div class="clear"></div>';

		/*
		$pr .= "<div class='pagination'>";
		  $pr .= "<div align='center'>";
				$pr .= $pager->renderFirst();
				$pr .= $pager->renderPrev();
				$pr .= $pager->renderNav('<span>','</span>') ;
				$pr .= $pager->renderNext();
				$pr .= $pager->renderLast();
		  $pr .= "</div>";
		$pr .= "</div>";
		*/
		
		$db->disconnect();
		return $pr;
		
	}

	public function search($song)
	{
		$db = new Database();	
		$db->connect();

		
		$obj_album = new Album();		
		
		$where = "en_sn_name LIKE '%".$song."%' or km_sn_name LIKE '%".$song."%'";
		$sql = "select * from kp_songs WHERE ".$where ." LIMIT 20";		
		
		$rs = @mysql_query($sql);

		$pr="$(document).ready(function(){";;
		$pr.= 'new jPlayerPlaylist({';
		$pr.= 'jPlayer: "#jquery_jplayer_1",';
		$pr.= 'cssSelectorAncestor: "#jp_container_1"';
		$pr.= '}, [';
		while (@$row = @mysql_fetch_array($rs)):
			$sql_sname="select sg.sg_id,sg.km_sg_name,sg.en_sg_name from kp_singers sg,kp_songsinger ss where sg.sg_id=ss.sg_id and sn_id=".$row['sn_id'];
			$rs_sname = @mysql_query($sql_sname);
			$singername = "";
			while ($row_sname = @mysql_fetch_array($rs_sname)){
				 $singername .= "<a href='".$this->site_path()."singers/".$row_sname['sg_id']."'>".$row_sname['en_sg_name'] ."</a>, ";
			}
			$str = strrpos($singername,',');
			$singername = substr($singername,0,$str);
			$song = "<a href='".$this->site_path()."song_".$row['sn_id']."'>".$row['km_sn_name']."</a>";
			$pr.= '{';
			$pr.= 'title:"'.$song.'",';
			$pr.= 'mp3:"'.$row['sn_link'].'",';

			$pr.= 'singer:"'.$singername.'",';

			$album = "<a href='".$this->site_path()."albums/id=".$row['sa_id']."'>".$obj_album->name($row['sa_id'])."</a>";
			$pr.= 'album:"'.$album.'",';

			if(isset($_SESSION['rln'])):
				$edit = "<a target='_blank' href='".$this->site_path()."songs.php?edit=".$row['sn_id']."'>Edit</a>";
			else:$edit="";
			endif;
			$pr.= 'edit:"'.$edit.'",';
			$pr .='},';

		endwhile;
		$pr .='	], {';
		$pr .='swfPath: "js",';
		$pr .='supplied: "mp3",';
		$pr .='wmode: "window",';
		$pr .='smoothPlayBar: true,';
		$pr .='keyEnabled: true';
		$pr .='});';
		$pr .='});';
		
		echo $pr;
		
	}


	public function _current($id)
	{
		$db = new Database();	
		$db->connect();
		$where = "post_id=".$id;
		return $db -> select('rln_post','*',$where);
	}
	
	public function update()
	{
		$db = new Database();	
		$db->connect();
		$rs = $db->update('rln_post',array('post_title'=>$this->title,'post_price'=>$this->price,'post_status'=>$this->status,'post_new'=>$this->_new,'post_feature'=>$this->feature,'post_category'=>$this->category,'post_description'=>$this->description,'post_user'=>$this->user),array('post_id',$this->id));
		
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
	
	public function record($q)
	{
		$db = new Database();	
		
		$obj_category = new Category();

		$conn = $db->connect();
		if($q==null)
			$where ="";
		else $where = " where post_title LIKE '%".$q."%'";

		$result = "SELECT * FROM rln_post".$where;
		$pager = new PS_Pagination($conn, $result, 25, 8,'p=show');
		
		$pager->setDebug(true);
		
		$rs = $pager->paginate();
		
		$pr = "";

		$pr .= '<form action="posts.php?p=show" method="post" name="tools" style="position:absolute;margin-left:80px;">'; 
		$pr .= '<input style="margin-left:100px;height:16px;margin-right:5px;" type="text" value="'.@$_POST['txtSearch'].'" class="small" placeholder="Type Here" name="txtSearch"/><input style="margin-bottom:5px;" type="submit" name="btnSearch" value="Search" />';
		$pr .='</form>';
		
		$pr .= '<form action="" method="post" name="frmpost" onSubmit="return onDelete();">'; 
		$pr .= '<input type="submit" name="btnDelete" value="Delete"​ style="margin-bottom:5px;" />';
		
		 $pr .='<div class="list">';
             $pr .= '<table>';
			 $pr .= '<tr >';
			 $pr .= "<th style='width:30px;'><input type='checkbox' id='chkAll' onClick='checkAll(document.frmpost.chkDel);'  name='chkAll' /></th>";
			 $pr .= "<th style='width:50px;'>ID</th>";
			 $pr .= "<th style='width:320px;'>Title</th>";
			 $pr .= "<th style='width:80px;'>Price</th>";
			 $pr .= "<th style='width:150px;'>Category</th>";
			 $pr .= "<th style='width:50px;'>Status</th>";
			 $pr .= "<th style='width:50px;'>New</th>";
			 $pr .= "<th style='width:50px;'>Feature</th>";
			 $pr .="</tr>";
		
		while($row = @mysql_fetch_array($rs)) {
			$pr .="<tr><td align='center'><input id='chkDel' name='chkDel[]' type='checkbox' value='". @$row['post_id'] . "' /></td>";
			$pr .="<td align='center'>".@$row['post_id']."</td>";
			$pr .="<td align='left'><a href='posts.php?edit=".@$row['post_id']."'>".@$row['post_title']."</a></td>";
			$pr .="<td align='center'>".@$row['post_price']."</td>";
			$pr .="<td align='center'>".$obj_category->get_name(@$row['post_category'])."</td>";

			if($row['post_status']==1) $img= "<img src='images/publish.png' />";
			else $img= "<img src='images/unpublish.png' />";

			$pr .="<td align='center'>".$img."</td>";

			if($row['post_new']==1) $new= "New !";
			else $new= "";

			$pr .="<td align='center'>".$new."</td>";

			if($row['post_feature']==1) $img= "<img src='images/feature.png' />";
			else $img= "<img src='images/unfeature.png' />";

			$pr .="<td align='center'>".$img."</td>";
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

		$obj_img = new Image();

		if (count($id) > 0)
		  {
			 foreach ($del as $id_d)
			 {
				// Delete ads record
				$db = new Database();
				$db->connect();
				$where = "post_id=".$id_d;
				
				$obj_img->delete($this->image($id_d));
				$db->delete("rln_post",$where);
			}
		}	
	}
	
	

	
}
?>