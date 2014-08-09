<?php include('../lib/class.database.php'); require_once('../lib/class.pagination.php');
 require_once('../lib/class.advertise.php'); $obj_adv = new Advertise(); require_once('templates/header.php'); require_once('templates/left.php'); ?> 
<script language="JavaScript">  
function checkAll(field)
{
	for (var i = 0; i < field.length ; i++)
 	if(document.frmadvertise.chkAll.checked == true){
		field[i].checked = true ;
	}
	else{
		field[i].checked = false ;
	}	
}
function onDelete()  
{  
	if(confirm('Do you want to delete ?')==true)  
		return true;  
	else  
		return false;  
}  
</script>
<style type="text/css">
table tr td{
	padding:5px;	
}
</style>
<script type="text/javascript" src="js/advertise_validate.js"></script>
<div id="content">
  <div class='content-body'>
    <?php
		if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
			$title = $_POST['title'];
			$status = $_POST['status'];
			$order = $_POST['order'];
			$link = $_POST['link'];
      $position = $_POST['position'];
				
			if($_FILES['img']["name"]){
					$img = $obj_adv->upload('img');	
			}
			else $img ="noimage";
			
			$obj_adv->set(null,$title,$link,$status,$position,$order,$img);
      echo $obj_adv->create();
		endif;
	  ?>
                
             <?php if(@$_GET['p']=='new'): ?>
            	<h1>Add New Advertise</h1>
                <form action='advertise.php?p=new' method="post" name='advertises' id='advertises' enctype="multipart/form-data">
                
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" /></td>
                    </tr>
                     <tr>
                    	<td>Link</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="link" id='link' class="medium" /></td>
                    </tr>
                     <tr>
                    	<td>Order</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="order" id='order' class="small" /></td>
                    </tr>
                    <tr>
                      <td>Position</td>
                        <td>&nbsp;</td>
                        <td>
                          <select name="position" id="position" class="small">
                              <option value="sidebar">Sidebar (270px 240px)</option>
                              <option value="outer_left">Outer Left (150px 400px)</option>
                              <option value="outer_right">Outer Right (150px 400px)</option>
                          </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Status</td>
                        <td>&nbsp;</td>
                        <td>
                        	<select name="status" id="status" class="small">
                            	<option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Image</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img' /></td>
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
						$status = $_POST['status'];
						$order = $_POST['order'];
						$link = $_POST['link'];
            $position = $_POST['position'];
						
						if($_FILES['img']["name"]){
							$img = $obj_adv->upload('img');	
							$obj_adv->update_image($id,$img);
						}
						
							
						$obj_adv->set($id,$title,$link,$status,$position,$order,null);
            echo $obj_adv->update();
					endif;
				?>
                
                 <?php if(isset($_GET['edit'])): ?>
            	<h1>Upate Advertise</h1>
                <form action='advertise.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='advertises' id='advertises' enctype="multipart/form-data">
                <?php 
					$rs = $obj_adv->_current($_GET['edit']);
					$row = @mysql_fetch_array($rs);
				 ?>
                <table>
                	<tr>
                    	<td>Title</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="title" id='title' class="medium" value="<?php echo $row['adv_title']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td>Link</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="link" id='link' class="medium" value="<?php echo $row['adv_link']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td>Order</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="order" id='order' class="small" value="<?php echo $row['adv_order']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Position</td>
                        <td>&nbsp;</td>
                        <td>
                        <?php
                          if($row['adv_position']=='sidebar') $sidebar = "selected='selected'";
                          else $sidebar = "";
                          if($row['adv_position']=='outer_left') $outer_left = "selected='selected'";
                          else $outer_left = "";
                          if($row['adv_position']=='outer_right') $outer_right = "selected='selected'";
                          else $outer_right = "";

                        ?>
                          <select name="position" id="position" class="small">
                              <option value="sidebar" <?php echo $sidebar ?>>Sidebar (270px 240px)</option>
                              <option value="outer_left" <?php echo $outer_left ?>>Outer Left (150px 400px)</option>
                              <option value="outer_right" <?php echo $outer_right ?>>Outer Right (150px 400px)</option>
                          </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>Status</td>
                        <td>&nbsp;</td>
                        <td>
                        <?php
          								if($row['adv_status']==1) $publish = "selected='selected'";
          								else $publish = "";
          								if($row['adv_status']==0) $unpublish = "selected='selected'";
          								else $unpublish = "";
							          ?>
                        	<select name="status" id="status" class="small">
                            	<option value="1" <?php echo $publish ?>>Published</option>
                                <option value="0" <?php echo $unpublish ?>>Unpublished</option>
                            </select>
                        </td>
                    </tr>
                  
                   <tr>
                    	<td>Image</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img' /></td>
                    </tr>
                    <tr>
                		<td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /><a href='advertise.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <!-- Show All Menu Types-->
                
                <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Advertise</h1>';
					$obj_adv->record();
				endif;
				?>
                <!-- End Show All Menu Types -->
                
                <?php
				if(isset($_POST['btnDelete']))
				{
					if(isset($_POST['chkDel'])):
					$del = $_POST['chkDel'];
					$obj_adv->delete($del);
					header("location:advertise.php?p=show");	
					endif;
				}
				
				?>
               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>