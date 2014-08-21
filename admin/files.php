<?php require_once('../lib/class.database.php'); require_once('../lib/class.file.php'); 
require_once('../lib/upload.php');
$obj_file = new File();require_once('templates/header.php'); require_once('templates/left.php'); ?> 
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

        if (!empty($_FILES['file_src'])) {
          $description = $_POST['description'];

          $upload = Upload::factory('../media/files');
          $upload->file($_FILES['file_src']);

          $file = $upload->upload();

    			$name = $_POST['name'];

    			$obj_file->set(null,$name,$description,$file["filename"]);
          echo $obj_file->create();
        }

  		endif;
		?>
                
    <?php if(@$_GET['p']=='new'): ?>
  	<h1>Add New File</h1>
      <form action='files.php?p=new' method="post" name='file' id='file' enctype='multipart/form-data'>
      <table>
      	<tr>
        	<td>Name</td>
          <td>&nbsp;</td>
          <td><input type="text" name="name" id='name' class="medium" /></td>
        </tr>
        <tr>
          <td>Content</td>
          <td>&nbsp;</td>
          <td><textarea name='description' id='description' style="width:500px;height:150px;"></textarea></td>
        </tr>
        <tr>
          <td>File</td>
          <td>&nbsp;</td>
          <td><input type='file' name='file_src' /></td>
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
            $img = $obj_file->upload('img'); 
            $obj_file->update_image($id,$img);
          }

					$obj_file->set($id,$name,$order, null);
          echo $obj_file->update();
				endif;
			?>
                
      <?php if(isset($_GET['edit'])): ?>
      <h1>Upate File</h1>
      <form action='brands.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='brand' id='brand' enctype='multipart/form-data'>
        <?php 
  				$rs = $obj_file->_current($_GET['edit']);
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
					echo '<h1>All Files</h1>';
					$obj_file->record();
				endif;
			?>

      <!-- End Show All Menu Types -->
      <?php
  			if(isset($_POST['btnDelete']))
  			{
  				if(isset($_POST['chkDel'])):
  				$del = $_POST['chkDel'];
  				$obj_file->delete($del);
  				header("location:brands.php?p=show");	
  				endif;
  			}
			?>
               
      </div>
    </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>