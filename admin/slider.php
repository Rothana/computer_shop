<?php 
 require_once('../lib/class.image.php'); $obj_img = new Image(); require_once('templates/header.php'); require_once('templates/left.php'); ?> 
<style type="text/css">
table tr td{
	padding:5px;	
}
</style>
<script type="text/javascript" src="js/advertise_validate.js"></script>
        <div id="content">
        	<div class='content-body'>
                
                
                <?php
                	if(isset($_POST['btnSave'])):
					
						
						if($_FILES['img1']["name"]){
							$img = $obj_img->slider('img1','banner01.jpg');	
						}

                        if($_FILES['img2']["name"]){
                            $img = $obj_img->slider('img2','banner02.jpg'); 
                        }

                        if($_FILES['img3']["name"]){
                            $img = $obj_img->slider('img3','banner03.jpg'); 
                        }

                        if($_FILES['img4']["name"]){
                            $img = $obj_img->slider('img4','banner04.jpg'); 
                        }

                        if($_FILES['img5']["name"]){
                            $img = $obj_img->slider('img5','banner05.jpg'); 
                        }						
							
					endif;
				?>
                
            	<h1>Slide Banners</h1>
                <form action='slider.php' method="post" name='slider' id='slider' enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Slide 1:</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img1' /> (900px x 220px)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><img width="600px" src="../img/banner01.jpg" /></td>
                    </tr>
                   
                   <tr>
                    	<td>Slide 2:</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img2' /> (900px x 220px)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><img width="600px" src="../img/banner02.jpg" /></td>
                    </tr>

                    <tr>
                        <td>Slide 3:</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img3' /> (900px x 220px)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><img width="600px" src="../img/banner03.jpg" /></td>
                    </tr>

                    <tr>
                        <td>Slide 4:</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img4' /> (900px x 220px)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><img width="600px" src="../img/banner04.jpg" /></td>
                    </tr>

                    <tr>
                        <td>Slide 5:</td>
                        <td>&nbsp;</td>
                        <td><input type='file' name='img5' /> (900px x 220px)</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><img width="600px" src="../img/banner05.jpg" /></td>
                    </tr>

                    <tr>
                		<td valign="top">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="btnSave" value="Update Now" /></td>
                	</tr>
                </table>
                </form>

               
            </div>
        </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>