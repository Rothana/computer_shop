<?php require_once('../lib/class.database.php');require_once('../lib/class.pagination.php'); require_once('../lib/class.post.php'); $obj_post = new Post();require_once('../lib/class.category.php'); $obj_category = new Category(); require_once('../lib/class.image.php'); $obj_img = new Image(); require_once('templates/header.php'); require_once('templates/left.php'); ?> 

<script language="javascript" type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/general.js"></script>
<script language="javascript" type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			elements : "ajaxfilemanager",
			theme : "advanced",
			plugins : "advimage,advlink,media,contextmenu",
			theme_advanced_buttons1_add_before : "newdocument,separator",
			theme_advanced_buttons1_add : "fontselect,fontsizeselect",
			theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before: "cut,copy,separator,",
			theme_advanced_buttons3_add_before : "",
			theme_advanced_buttons3_add : "media",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			valid_elements : "a[name|href|target|title|onclick],img[src|href],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],body[img]",
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : true,
			apply_source_formatting : true,
			force_br_newlines : true,
			force_p_newlines : false,	
			relative_urls : true,
			apply_source_formatting : true,
remove_linebreaks: false,
verify_html:false,
closed: /^(br|hr|input|meta|img|link|param|area|param)$/,

});

		
</script>

<script language="JavaScript">  
function checkAll(field)
{
	for (var i = 0; i < field.length ; i++)
 	if(document.frmpost.chkAll.checked == true){
		field[i].checked = true ;
	}
	else{
		field[i].checked = false ;
	}	
	
}
function onDelete()  
{  
	if(confirm('Do you want to delete ?')==true)  
	{  
		return true;  
	}  
	else  
	{  
		return false;  
	} 
}  
</script>
<script type="text/javascript" src="js/post_validate.js"></script>
        <div id="content">
        	<div class='content-body'>
            	<?php
					if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
						$title = $_POST['title'];
						$description = htmlspecialchars($_POST['description']);
						$category = $_POST['category'];
                        $price = $_POST['price'];
                        $status = $_POST['status'];
                        $new = $_POST['new'];
                        $feature = $_POST['feature'];
                        $user = $_SESSION['rlnid'];

						
						
						// Update Images
						if($_FILES["img1"]["name"])
							$img1 = $obj_img->uploadThumb('img1');	
						else $img1 ="noimage.jpg";
						if($_FILES["img2"]["name"])
							$img2 = $obj_img->uploadThumb('img2');	
						else $img2 = "noimage.jpg";
						if($_FILES["img3"]["name"])
							$img3 = $obj_img->uploadThumb('img3');	
						else $img3 = "noimage.jpg";
						if($_FILES["img4"]["name"])
							$img4 = $obj_img->uploadThumb('img4');	
						else $img4 = "noimage.jpg";
						if($_FILES["img5"]["name"])
							$img5 = $obj_img->uploadThumb('img5');
						else $img5 = "noimage.jpg";	
						
						$obj_img->create($img1,$img2,$img3,$img4,$img5);	
						$image = $obj_img->last();

						$obj_post->set(null,$title,$price,$description,$category,$user,$image,$status,$new,$feature);
						echo $obj_post->create();
					endif;
				?>
                
                <?php if(@$_GET['p']=='new'): ?>
            	<h1>Add New Post</h1>
                <form action='posts.php?p=new' method="post" name='posts' id='posts' enctype='multipart/form-data'>
                
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" /></td>
                    </tr>
                    <tr>
                    	<td>Price</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="price" id='price' class="small" /> $</td>
                    </tr>
                    <tr>
                		<td valign="top">Category</td>
                        <td></td>
                        <td><?php echo $obj_category->dropdown(null); ?></textarea></td>
                	</tr>
                	<tr>
                		<td>Status</td>
                        <td>&nbsp;</td>
                        <td>
                        	<select name="status" id="status" class="small">
                            	<option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                		<td>New ?</td>
                        <td>&nbsp;</td>
                        <td>
                        	<select name="new" id="new" class="small">
                            	<option value="1">New</option>
                                <option value="0">Not New</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Feature</td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="feature" id="feature" class="small">
                                <option value="0">Unfeature</option>
                                <option value="1">Feature</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                		<td valign="top">Description</td>
                        <td></td>
                        <td><textarea name='description' id='description' style="width:500px;height:150px;"></textarea></td>
                	</tr>
                	
                    <tr>
                    	<td>Image 1</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img1' /> Recommend Size: (650px x 450px)</td>
                    </tr>
                    
                    <tr>
                    	<td>Image 2</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img2' />  Recommend Size: (650px x 450px)</td>
                    </tr>
                    
                    <tr>
                    	<td>Image 3</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img3' />  Recommend Size: (650px x 450px)</td>
                    </tr>
                    
                    <tr>
                    	<td>Image 4</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img4' />  Recommend Size: (650px x 450px)</td>
                    </tr>
                    
                    <tr>
                    	<td>Image 5</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img5' />  Recommend Size: (650px x 450px)</td>
                    </tr>
                    <tr>
                		<td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Save Now" /></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <?php
                	if(isset($_POST['btnSave']) and isset($_GET['edit'])):
						$id = $_GET['edit'];
						$title = $_POST['title'];
                        $description = htmlspecialchars($_POST['description']);
                        $category = $_POST['category'];
                        $price = $_POST['price'];
                        $status = $_POST['status'];
                        $new = $_POST['new'];
                        $feature = $_POST['feature'];
                        $user = $_SESSION['rlnid'];
						
						$imgid = $_POST['imgid'];
						
						// Update Images
						if($_FILES["img1"]["name"]){
							$img1 = $obj_img->uploadThumb('img1');	
							$obj_img->update($imgid,$img1,"img_image1");		
						}

						if($_FILES["img2"]["name"]){
							$img2 = $obj_img->uploadThumb('img2');	
							$obj_img->update($imgid,$img2,"img_image2");		
						}

						if($_FILES["img3"]["name"]){
							$img3 = $obj_img->uploadThumb('img3');	
							$obj_img->update($imgid,$img3,"img_image3");		
						}

						if($_FILES["img4"]["name"]){
							$img4 = $obj_img->uploadThumb('img4');	
							$obj_img->update($imgid,$img4,"img_image4");		
						}	

						if($_FILES["img5"]["name"]){
							$img5 = $obj_img->uploadThumb('img5');	
							$obj_img->update($imgid,$img5,"img_image5");		
						}

						$obj_post->set($id,$title,$price,$description,$category,$user,null,$status,$new,$feature);
                        echo $obj_post->update();
					endif;
				?>
                
                 <?php if(isset($_GET['edit'])): ?>
            	<h1>Upate Post</h1>
                <form action='posts.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='news' id='news' enctype='multipart/form-data'>
                <?php 
					$rs = $obj_post->_current($_GET['edit']);
					$row = mysql_fetch_array($rs);
				 ?>
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" value="<?php echo $row['post_title']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="price" id='price' class="small" value="<?php echo $row['post_price']; ?>" /> $</td>
                    </tr>
                    <tr>
                        <td valign="top">Category</td>
                        <td></td>
                        <td><?php echo $obj_category->dropdown($row['post_category']); ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>&nbsp;</td>
                        <td>
                            <?php
                                if($row['post_status']==1) $publish = "selected='selected'";
                                else $publish = "";
                                if($row['post_status']==0) $unpublish = "selected='selected'";
                                else $unpublish = "";
                            ?>
                            <select name="status" id="status" class="small">
                                <option value="1" <?php echo @$publish; ?>>Published</option>
                                <option value="0" <?php echo @$unpublish; ?>>Unpublished</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>New ?</td>
                        <td>&nbsp;</td>
                        <td>
                            <?php
                                if($row['post_new']==1) $new = "selected='selected'";
                                else $publish = "";
                                if($row['post_new']==0) $unnew = "selected='selected'";
                                else $unpublish = "";
                            ?>
                            <select name="new" id="new" class="small">
                                <option value="1" <?php echo @$new; ?>>New</option>
                                <option value="0" <?php echo @$unnew; ?>>Not New</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Feature</td>
                        <td>&nbsp;</td>
                        <td>
                            <?php
                                if($row['post_feature']==0) $unfeature = "selected='selected'";
                                else $unfeature = "";
                                if($row['post_feature']==1) $feature = "selected='selected'";
                                else $feature = "";
                            ?>
                            <select name="feature" id="feature" class="small">
                                <option value="1" <?php echo @$feature; ?>>Feature</option>
                                <option value="0" <?php echo @$unfeature; ?>>Uneature</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Description</td>
                        <td></td>
                        <td><textarea name='description' id='description' style="width:500px;height:150px;"><?php echo $row['post_description']; ?></textarea></td>
                    </tr>
                    <tr>
                    	<td>Image 1</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img1' /></td>
                    </tr>
                    
                    <tr>
                    	<td>Image 2</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img2' /></td>
                    </tr>
                    
                    <tr>
                    	<td>Image 3</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img3' /></td>
                    </tr>
                    
                    <tr>
                    	<td>Image 4</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img4' /></td>
                    </tr>
                    
                    <tr>
                    	<td>Image 5</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img5' /></td>
                    </tr>
                    <tr>
                		<td valign="top">&nbsp; <input type="hidden" name="imgid" value="<?php echo $row['post_image']; ?>" /></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /><a href='posts.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <!-- Show All Menu Types-->
                
                <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Posts</h1>';
					
					if(isset($_POST['btnSearch'])){
						$q = $_POST['txtSearch'];
						$obj_post->record($q);
					}else
					$obj_post->record(null);
				endif;
				?>
                <!-- End Show All Menu Types -->
                
                <?php
				if(isset($_POST['btnDelete']))
				{
					if(isset($_POST['chkDel'])):
					$del = $_POST['chkDel'];
					echo $obj_post->delete($del);
					header("location:posts.php?p=show");	
					endif;
				}
				
				?>
               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>