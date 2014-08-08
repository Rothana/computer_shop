<?php require_once('../lib/class.database.php');require_once('../lib/class.page.php'); $obj_page = new Page(); require_once('../lib/class.image.php'); $obj_img = new Image(); require_once('templates/header.php'); require_once('templates/left.php'); ?> 

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
 	if(document.frmpage.chkAll.checked == true){
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
<script type="text/javascript" src="js/page_validate.js"></script>
        <div id="content">
        	<div class='content-body'>
            	<?php
					if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
						$title = $_POST['title'];
						$url = $_POST['url'];
						$description = htmlspecialchars($_POST['description']);
                        $status = $_POST['status'];


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

						$obj_page->set(null,$title,$url,$description,$status,$image);
                        echo $obj_page->create();
					endif;
				?>
                
                <?php if(@$_GET['p']=='new'): ?>
            	<h1>Add New Page</h1>
                <form action='pages.php?p=new' method="post" name='pages' id='pages' enctype='multipart/form-data'>
                
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" /></td>
                    </tr>
                    <tr>
                    	<td>URL</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="url" id='url' class="medium" /></td>
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
                		<td valign="top">Content</td>
                        <td></td>
                        <td><textarea name='description' id='description' style="width:500px;height:150px;"></textarea></td>
                	</tr>

                    <tr>
                        <td>Image 1</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img1' /> (Recommend: Width: 590px)</td>
                    </tr>
                    
                    <tr>
                        <td>Image 2</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img2' /> </td>
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
						$url = $_POST['url'];
                        $status = $_POST['status'];
						$description = htmlspecialchars($_POST['description']);

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

						$obj_page->set($id,$title,$url,$description,$status,null);
                        echo $obj_page->update();
					endif;
				?>
                
                 <?php if(isset($_GET['edit'])): ?>
            	<h1>Upate Page</h1>
                <form action='pages.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='pages' id='pages' enctype='multipart/form-data'>
                <?php 
					$rs = $obj_page->_current($_GET['edit']);
					$row = mysql_fetch_array($rs);
				 ?>
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" value="<?php echo $row['page_title']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td>URL</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="url" id='url' class="medium" value="<?php echo $row['page_url']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;</td>
                        <td>
                            <?php
                                if($row['page_status']==1) $publish = "selected='selected'";
                                else $publish = "";
                                if($row['page_status']==0) $unpublish = "selected='selected'";
                                else $unpublish = "";
                            ?>
                            <select name="status" id="status" class="small">
                                <option value="1" <?php echo $publish ?>>Published</option>
                                <option value="0" <?php echo $unpublish ?>>Unpublished</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                		<td valign="top">Description</td>
                        <td></td>
                        <td><textarea name='description' id='description' style="width:500px;height:150px;"><?php echo $row['page_description']; ?></textarea></td>
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
                		<td valign="top">&nbsp; <input type="hidden" name="imgid" value="<?php echo $row['page_image']; ?>" /></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /><a href='pages.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <!-- Show All Menu Types-->
                
                <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Pages</h1>';
					$obj_page->record();
				endif;
				?>
                <!-- End Show All Menu Types -->
                
                <?php
				if(isset($_POST['btnDelete']))
				{
					if(isset($_POST['chkDel'])):
					$del = $_POST['chkDel'];
					$obj_page->delete($del);
					header("location:pages.php?p=show");	
					endif;
				}
				
				?>
               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>