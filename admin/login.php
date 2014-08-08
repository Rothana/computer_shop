<?php ob_start(); session_start(); require_once('../lib/class.database.php'); require_once('../lib/class.user.php'); $obj_user = new User(); ?>
<!DOCTYPE html>
<html>
<head><title>ITOne Computer Administrator</title>
<link rel="stylesheet" type="text/css" href="css/template.css">
<link rel="stylesheet" href="css/dropdown.css" media="screen">
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<div id='wrapper'>
    <div id='nav'>
        
        <div class="seperate"><img src='images/styles/seperate.png' /> </div>
        <div id='pjlogo-container'> 	
        </div>
        
    </div><!--end of nav-->    
        <div id="content">
        	<div class='content-body' style="width:400px;margin:0px auto;margin-top:100px;">
            <?php 
				 if(isset($_POST['btnLogin'])):
					  if($_POST['username']&& $_POST['password']):
					 
					 	$username = trim($_POST['username']);
					 	$password = trim($_POST['password']);
						
						$username = stripslashes($username);
						$password = stripslashes($password);
						
						//$username = mysql_real_escape_string($username);
						//$password = mysql_real_escape_string($password);
						$found = $obj_user->find($username,$password);
						if($found){
							$obj_user->Login($username,$password);
							header("location:index.php");	
						}	
						else echo "Incorrect !";	
					  endif;
				 endif;
			
			
			?>
            
            	<h1>ITOne Computer Administrator</h1>
            	<form action="login.php" method="post" name="login">
                	<table>
                		<tr>
                        	<td>Username</td>
                            <td>:</td>
                            <td><input type="text" class="small" name="username" />
                        </tr>
                		<tr>
                        	<td>Password</td>
                            <td>:</td>
                            <td><input type="password" class="small" name="password" />
                        </tr>
                        <tr>
                        	<td></td>
                            <td></td>
                            <td><input type="submit" name="btnLogin" value="Login" /></td>
                        </tr>
                	</table>
                </form>
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>