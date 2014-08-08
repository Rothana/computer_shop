<?php require_once('../lib/class.database.php'); require_once('../lib/class.category.php'); $obj_category = new Category();require_once('templates/header.php'); require_once('templates/left.php'); ?> 
<script language="JavaScript">  
function checkAll(field)
{
	for (var i = 0; i < field.length ; i++)
 	if(document.frmcategory.chkAll.checked == true){
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
<script type="text/javascript" src="js/menu_validate.js"></script>
        <div id="content">
        	<div class='content-body'>

                <?php
					if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
						$name = $_POST['name'];
						$url = $_POST['url'];
                        $parent = $_POST['parent'];

						$obj_category->set(null,$name,$url,$parent);
                        echo $obj_category->create();
					endif;
				?>
                
                <?php if(@$_GET['p']=='new'): ?>
            	<h1>Add New Category</h1>
                <form action='category.php?p=new' method="post" name='category' id='category'>
                
                <table>
                	<tr>
                    	<td>Name</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="name" id='name' class="medium" /></td>
                    </tr>
                    <tr>
                    	<td>URL</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="url" id='url' class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Parent</td>
                        <td>&nbsp;</td>
                        <td><?php echo $obj_category->parent(null); ?></td>
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
						$name = $_POST['name'];
						$url = $_POST['url'];
                        $parent = $_POST['parent'];

						$obj_category->set($id,$name,$url,$parent);
                        echo $obj_category->update();
					endif;
				?>
                
                <?php if(isset($_GET['edit'])): ?>
                <h1>Upate Category</h1>
                <form action='category.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='categories' id='categories'>
                <?php 
					$rs = $obj_category->_current($_GET['edit']);
					$row = mysql_fetch_array($rs);
				 ?>
                <table>
                	<tr>
                    	<td>Name</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="name" id='name' class="medium" value="<?php echo $row['category_name']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td>URL</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="url" id='url' class="medium" value="<?php echo $row['category_url']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Parent</td>
                        <td>&nbsp;</td>
                        <td><?php echo $obj_category->parent($row['category_parent']); ?></td>
                    </tr>
                    <tr>
                		<td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /><a href='category.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <!-- Show All Menu Types-->
                
                <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Categories</h1>';
					$obj_category->record();
				endif;
				?>
                <!-- End Show All Menu Types -->
                
                <?php
				if(isset($_POST['btnDelete']))
				{
					if(isset($_POST['chkDel'])):
					$del = $_POST['chkDel'];
					$obj_category->delete($del);
					header("location:category.php?p=show");	
					endif;
				}
				
				?>
               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>