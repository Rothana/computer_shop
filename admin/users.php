<?php require_once('../lib/class.database.php'); require_once('../lib/class.user.php'); $obj_user = new User();require_once('templates/header.php'); require_once('templates/left.php'); ?> 
<script language="JavaScript">  
function checkAll(field)
{
	for (var i = 0; i < field.length ; i++)
 	if(document.frmuser.chkAll.checked == true){
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
<script type="text/javascript" src="js/user_validate.js"></script>
        <div id="content">
        	<div class='content-body'>

                <?php
					if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
						$name = $_POST['name'];
						$username = $_POST['username'];
                        $password = $_POST['password'];

						$obj_user->set(null,$name,$username,$password,'author');
                        echo $obj_user->create();
					endif;
				?>
                
                <?php if(@$_GET['p']=='new'): ?>
            	<h1>Add New User</h1>
                <form action='users.php?p=new' method="post" name='user' id='user'>
                
                <table>
                	<tr>
                    	<td>Name</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="name" id='name' class="medium" /></td>
                    </tr>
                    <tr>
                    	<td>Username</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="username" id='username' class="medium" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="password" id='password' class="medium" /></td>
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
						$username = $_POST['username'];
                        $password = $_POST['password'];

						$obj_user->set($id,$name,$username,$password,'author');
                        echo $obj_user->update();
					endif;
				?>
                
                <?php if(isset($_GET['edit'])): ?>
                <h1>Upate User</h1>
                <form action='users.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='user' id='user'>
                <?php 
					$rs = $obj_user->_current($_GET['edit']);
					$row = mysql_fetch_array($rs);
				 ?>
                <table>
                	<tr>
                    	<td>Name</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="name" id='name' class="medium" value="<?php echo $row['user_name']; ?>" /></td>
                    </tr>
                    <tr>
                    	<td>Username</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="username" id='username' class="medium" value="<?php echo $row['user_username']; ?>" /></td>
                    </tr>

                    <tr>
                        <td>Password</td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="password" id='password' class="medium" value="<?php echo $row['user_password']; ?>" /></td>
                    </tr>
                    
                    <tr>
                		<td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /><a href='users.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
                	</tr>
                </table>
                </form>
                <?php endif; ?>
                
                <!-- Show All Menu Types-->
                
                <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Users</h1>';
					$obj_user->record();
				endif;
				?>
                <!-- End Show All Menu Types -->
                
                <?php
				if(isset($_POST['btnDelete']))
				{
					if(isset($_POST['chkDel'])):
					$del = $_POST['chkDel'];
					$obj_user->delete($del);
					header("location:users.php?p=show");	
					endif;
				}
				
				?>
               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>