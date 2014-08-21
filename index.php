<?php
require_once('lib/class.database.php');
require_once('lib/class.paginations.php');
require_once('lib/class.counter.php'); $obj_counter = new Counter();
require_once('lib/class.post.php'); $obj_post = new Post();
require_once('lib/class.category.php'); $obj_category = new Category();
require_once('lib/class.page.php'); $obj_page = new Page();
require_once('lib/class.advertise.php'); $obj_adv = new Advertise();
require_once('lib/class.user.php'); $obj_user = new User();
require_once('lib/class.news.php'); $obj_news = new News();
require_once('lib/class.brand.php'); $obj_brand = new Brand();
require_once('lib/class.file.php'); $obj_file = new File();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo $obj_post->site_path(); ?>css/lightbox.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $obj_post->site_path();?>js/jquery-1.7.2.min.js"></script>
<script src="<?php echo $obj_post->site_path();?>js/jquery.smooth-scroll.min.js"></script>
<script src="<?php echo $obj_post->site_path();?>js/lightbox.js"></script> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $obj_post->site_path(); ?>css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $obj_post->site_path(); ?>css/style.css">
<!--Menu JQuery-->
<link href="<?php echo $obj_post->site_path(); ?>css/dcaccordion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo $obj_post->site_path(); ?>js/jquery.cookie.js'></script>
<script type='text/javascript' src='<?php echo $obj_post->site_path(); ?>js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?php echo $obj_post->site_path(); ?>js/jquery.dcjqaccordion.2.7.min.js'></script>
<script type='text/javascript' src='<?php echo $obj_post->site_path(); ?>js/jquery.li-scroller.1.0.js'></script>
<script type='text/javascript' src='<?php echo $obj_post->site_path(); ?>thumbsilder/thumbnail-slider.js'></script>
<link href="<?php echo $obj_post->site_path(); ?>css/skins/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $obj_post->site_path(); ?>css/skins/graphite.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $obj_post->site_path(); ?>css/skins/grey.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $obj_post->site_path(); ?>css/li-scroller.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $obj_post->site_path(); ?>thumbsilder/generic.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $obj_post->site_path(); ?>thumbsilder/slider.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function($){

	$('#accordion-3').dcAccordion({
		eventType: 'click',
		autoClose: true,
		saveState: true,
		disableLink: false,
		showCount: false,
		speed: 'slow'
	});

	$("ul#ticker01").liScroll();

});
</script>

<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'> 
<link rel="stylesheet" href="<?php echo $obj_post->site_path(); ?>css/bjqs.css">
<link rel="stylesheet" href="<?php echo $obj_post->site_path(); ?>css/slider.css">
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?php echo $obj_post->site_path(); ?>js/bjqs-1.3.min.js"></script>

<link rel="stylesheet" href="<?php echo $obj_post->site_path();?>themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $obj_post->site_path();?>themes/pascal/pascal.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $obj_post->site_path();?>themes/orman/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $obj_post->site_path();?>themes/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $obj_post->site_path();?>themes/style.css" type="text/css" media="screen" />

<script src="<?php echo $obj_post->site_path();?>js/jquery-1.6.1.min.js"></script>

<title>
	ITOne Computer
</title>

</head>
<!-- Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=151646268376400";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<body>
	<div id="outer-wrapper">
		<div id="outer-left">
			<?php $obj_adv->display("outer_left"); ?>
		</div>
		
		<div id="wrapper">
			<div id="nav">
				<div class="left">
					<ul>
						<li><a href="">Home</a></li>
						<li><a href="">Service</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">About</a></li>
					</ul>
				</div> <!--.right-->
				<div class="right">
					<ul>
						<li><a href="https://www.facebook.com/itonecomputer">Facebook</a></li>
						<li><a href="">Twitter</a></li>
					</ul>
				</div> <!--.left-->

			</div> <!--#nav-->
			<div id="header">
				<div class="logo">
					<a href="<?php echo $obj_post->site_path(); ?>"><img src="<?php echo $obj_post->site_path(); ?>img/logo.png" /></a>
				</div><!--.logo-->
				<div class="menu">
					<?php echo $obj_page->display(); ?>

				</div> <!--.menu-->
			</div> <!--#header-->

			<!-- ticker news -->
			<?php echo $obj_news->display(); ?>
			
			<div id="banner-slider">
				<?php           
			     echo "<div class=\"slider-wrapper theme-default\">";
			      echo "<div class=\"ribbon\"></div>";
			      echo "<div id=\"slider\" class=\"nivoSlider\">";
			      echo "<img src='".$obj_post->site_path()."img/banner01.jpg' style='width:900px !important; height:220px !important;' />";
			      echo "<img src='".$obj_post->site_path()."img/banner02.jpg' style='width:900px !important; height:220px !important;' />";
			      echo "<img src='".$obj_post->site_path()."img/banner03.jpg' style='width:900px !important; height:220px !important;' />";
			      echo "<img src='".$obj_post->site_path()."img/banner04.jpg' style='width:900px !important; height:220px !important;' />";
			      echo "<img src='".$obj_post->site_path()."img/banner05.jpg' style='width:900px !important; height:220px !important;' />";
			      echo "</div>";          
			    echo "</div>";  
			  ?>
		                              
		    <script type="text/javascript" src="<?php echo $obj_post->site_path();?>js/jquery.nivo.slider.pack.js"></script>
		    <script type="text/javascript">
		        $(window).load(function() {
		        $('#slider').nivoSlider();
		        });
		    </script>
			</div>

			<div id="containter">
				<?php if(isset($_GET['category']) or isset($_GET['page']) or isset($_GET['dr']) ): ?>
					<div id="sidebar">
						<?php echo $obj_category->display(); ?>

						<?php $obj_adv->display("sidebar"); ?>

						<div style='margin-top:5px;'>
							<div class="fb-like-box" data-href="https://www.facebook.com/itonecomputer" data-width="270" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
						</div>

						<!-- <div style='margin-top:5px;'>
						<a href="http://info.flagcounter.com/ng9c"><img src="http://s11.flagcounter.com/mini/ng9c/bg_FFFFFF/txt_000000/border_CCCCCC/flags_0/" alt="Flag Counter" border="0"></a>
						</div> -->

						<div style='margin-top:5px;'>
							<?php $obj_counter->calulate(); ?>
							<?php $obj_counter->display(); ?>
						</div>
					</div><!--#sidebar-->
				<?php endif; ?>

				<?php
					if(isset($_GET['category'])):
						echo '<div id="content">';
						if(isset($_GET['post'])){
							$post = $_GET['post'];
							echo $obj_post->single($post);

							$category = $_GET['category'];
							echo $obj_post->related($category,$post);
						}
						else{
							if($_GET['category']=='driver'):
								echo $obj_file->display();
							else:
								$category = $_GET['category'];
								echo $obj_post->display($category);
							endif;
						}
						echo '</div>';
						echo '<div class="clear"></div>';

					elseif(isset($_GET['page'])):
						echo '<div id="content">';
						$page = $_GET['page'];
						echo $obj_page->single($page);
						echo '</div>';
						echo '<div class="clear"></div>';
					elseif (isset($_GET['dr'])):
						echo '<div id="content">';
						echo $obj_file->single($_GET['dr']);
						echo '</div>';
						echo '<div class="clear"></div>';
					else:
						echo '<div id="feature">';
							echo "<div class='list' style='margin-bottom:15px;'>";
								echo $obj_post->latest(9,"New Laptops");
								echo $obj_post->latest(10,"Desktop Computers");
								echo $obj_post->latest(22,"Accessies");
								echo $obj_post->latest(19,"Printers");

							  echo '<div class="clear"></div>';
							echo "</div>";
						echo '</div>';
					endif;
				?>

			</div> <!--#container-->
			<div class="clear"></div>

			<?php echo $obj_brand->display(); ?>

			<div id="info">
				<ul>
					<li><img src="<?php echo $obj_post->site_path(); ?>img/mail.png" /> info@itonecomputer.com</li>
					<li><a href=""><img src="img/twitter.png" /> @itonecomputer</a></li>
					<li style="float:right;"><img src="<?php echo $obj_post->site_path() ?>img/phone.png" /> 089 90 90 77</li>
				</ul>
			</div> <!--#info-->

			<div id="footer">
				<div class="line"></div>
				<div class="shadow"></div>

				<div class="copyright">
					ITOne Computer ©2013. All Right Reserved.
				</div><!--#copyright-->
			</div> <!--#footer-->
		</div> <!--#wrapper-->
		<div id="outer-right">
			<?php $obj_adv->display("outer_right"); ?>
		</div>
	</div>
</body>
</html>