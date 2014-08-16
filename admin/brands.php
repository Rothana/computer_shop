<?php require_once('../lib/class.database.php'); require_once('../lib/class.brand.php'); $obj_brand = new Brand();require_once('templates/header.php'); require_once('templates/left.php'); ?> 
<script language="JavaScript">  
function checkAll(field){
	for (var i = 0; i < field.length ; i++)
 	if(document.frmbrand.chkAll.checked == true)
		field[i].checked = true ;
	else
		field[i].checked = false ;
	
}
function onDelete(){  
	if(confirm('Do you want to delete ?')==true)  
		return true;  
	else  
		return false;  
}  
</script>
<script type="text/javascript" src="js/user_validate.js"></script>
  <div id="content">
  	<div class='content-body'>

    <?php
  		if(isset($_POST['btnSave']) and @$_GET['p']=='new'):
  			$name = $_POST['name'];
  			$order = $_POST['order'];

        if($_FILES['img']["name"])
          $img = $obj_brand->upload('img'); 
        else $img ="noimage";

  			$obj_brand->set(null,$name,$order,$img);
        echo $obj_brand->create();
  		endif;
		?>
                
    <?php if(@$_GET['p']=='new'): ?>
  	<h1>Add New Brand</h1>
      <form action='brands.php?p=new' method="post" name='brand' id='brand' enctype='multipart/form-data'>
      <table>
      	<tr>
        	<td>Name</td>
          <td>&nbsp;</td>
          <td><input type="text" name="name" id='name' class="medium" /></td>
        </tr>
        <tr>
        	<td>Order</td>
          <td>&nbsp;</td>
          <td><input type="text" name="order" id='order' class="medium" /></td>
        </tr>

        <tr>
          <td>Logo ( height: 80px)</td>
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
					$name = $_POST['name'];
					$order = $_POST['order'];

          if($_FILES['img']["name"]){
            $img = $obj_brand->upload('img'); 
            $obj_brand->update_image($id,$img);
          }

					$obj_brand->set($id,$name,$order, null);
          echo $obj_brand->update();
				endif;
			?>
                
      <?php if(isset($_GET['edit'])): ?>
      <h1>Upate Brand</h1>
      <form action='brands.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='brand' id='brand' enctype='multipart/form-data'>
        <?php 
  				$rs = $obj_brand->_current($_GET['edit']);
  				$row = mysql_fetch_array($rs);
  			?>
        <table>
        	<tr>
          	<td>Name</td>
            <td>&nbsp;</td>
            <td><input type="text" name="name" id='name' class="medium" value="<?php echo $row['br_name']; ?>" /></td>
            </tr>
            <tr>
            	<td>Order</td>
              <td>&nbsp;</td>
              <td><input type="text" name="order" id='order' class="medium" value="<?php echo $row['br_order']; ?>" /></td>
            </tr>
           <tr>
              <td>Logo</td>
              <td>&nbsp;</td>
              <td><input type='file' name='img' /></td>
            </tr>
            
            <tr>
        		<td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnSave" value="Update Now" /><a href='brands.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
        	</tr>
        </table>
      </form>
      <?php endif; ?>
                
      <!-- Show All Menu Types-->
      <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All Brands</h1>';
					$obj_brand->record();
				endif;
			?>

      <!-- End Show All Menu Types -->
      <?php
  			if(isset($_POST['btnDelete']))
  			{
  				if(isset($_POST['chkDel'])):
  				$del = $_POST['chkDel'];
  				$obj_brand->delete($del);
  				header("location:brands.php?p=show");	
  				endif;
  			}
			?>
               
      </div>
    </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>