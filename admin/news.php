<?php require_once('../lib/class.database.php'); require_once('../lib/class.news.php'); $obj_news = new News();require_once('templates/header.php'); require_once('templates/left.php'); ?> 

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
 	if(document.frmnews.chkAll.checked == true)
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
  			$content = htmlspecialchars($_POST['description']);
  			$order = $_POST['order'];

  			$obj_news->set(null,$content,$order);
        echo $obj_news->create();
  		endif;
		?>
                
    <?php if(@$_GET['p']=='new'): ?>
  	<h1>Add New News</h1>
      <form action='news.php?p=new' method="post" name='news' id='news'>
      <table>
      	<tr>
        	<td>Content</td>
          <td>&nbsp;</td>
          <td><textarea name='description' id='description' style="width:500px;height:150px;"></textarea></td>
        </tr>

        <tr>
        	<td>Order</td>
          <td>&nbsp;</td>
          <td><input type="text" name="order" id='order' class="medium" /></td>
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
					$content = htmlspecialchars($_POST['description']);
					$order = $_POST['order'];

					$obj_news->set($id,$content,$order);
          echo $obj_news->update();
				endif;
			?>
                
      <?php if(isset($_GET['edit'])): ?>
      <h1>Upate News</h1>
      <form action='news.php?edit=<?php echo $_GET['edit']; ?>' method="post" name='news' id='news'>
        <?php 
  				$rs = $obj_news->_current($_GET['edit']);
  				$row = mysql_fetch_array($rs);
  			?>
        <table>
        	<tr>
          	<td>Content</td>
            <td>&nbsp;</td>
            <td><textarea name='description' id='description' style="width:500px;height:150px;"><?php echo $row['ns_content']; ?></textarea></td>
            </tr>

            <tr>
            	<td>Order</td>
              <td>&nbsp;</td>
              <td><input type="text" name="order" id='order' class="medium" value="<?php echo $row['ns_order']; ?>" /></td>
            </tr>
            
            <tr>
        		<td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnSave" value="Update Now" /><a href='news.php?p=show' class="button" style="margin-left:10px;;padding:5px 10px;font-size: 12px;font-weight:bold;">Back</a></td>
        	</tr>
        </table>
      </form>
      <?php endif; ?>
                
      <!-- Show All Menu Types-->
      <?php 
				if(@$_GET['p']=='show'):
					echo '<h1>All News</h1>';
					$obj_news->record();
				endif;
			?>

      <!-- End Show All Menu Types -->
      <?php
  			if(isset($_POST['btnDelete']))
  			{
  				if(isset($_POST['chkDel'])):
  				$del = $_POST['chkDel'];
  				$obj_news->delete($del);
  				header("location:news.php?p=show");	
  				endif;
  			}
			?>
               
      </div>
    </div> <!--end of content -->
<?php require_once('templates/footer.php'); ?>