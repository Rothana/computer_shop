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
				if(isset($_GET['p'])=="logout")
					$obj_user->Logout();
				header("location:login.php");	
			
			?>

            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>