<?php ob_start(); session_start();
if(!isset($_SESSION['rlnid'])){header("location:login.php");	}
?>
<?php require_once('../lib/class.pagination.php'); ?>
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
            <ul class="menu">
                <li><a href=''><div id='pjlogo'><img src='images/khmerplaylitst.png' align="absmiddle" /> <span>ITOne Computer</span></div></a>
                    <ul>
                        <li><a href="posts.php?p=show">Posts</a></li>
                        <li><a href="category.php?p=show">Categories</a></li>
                        <li><a href="pages.php?p=show">Page</a></li>
                        <li><a href="logout.php?p=logout">Sign Out</a></li>
                    </ul>
                </li>
                <li><a href='posts.php?p=new'><div id='pjlogo'><img src='images/khmerplaylitst.png' align="absmiddle" /> <span>New Post</span></div></a></li>
                <li><a href='pages.php?p=new'><div id='pjlogo'><img src='images/khmerplaylitst.png' align="absmiddle" /> <span>New Page</span></div></a></li>
            </ul>
        </div>
        
    </div><!--end of nav-->