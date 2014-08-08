<?php
class Image
{
	private $m_id = '';
	private $m_img1 = '';
	private $m_img2 = '';
	private $m_img3 = '';
	private $m_img4 = '';
	private $m_img5 = '';

	
	public function __construct(){
		$this->m_img1 = '';
		$this->m_img2 = '';
		$this->m_img3 = '';
		$this->m_img4 = '';
		$this->m_img5 = '';

	}
	
	public function last()
	{
		$db = new Database();	
		$db->connect();
		$order = "img_id DESC";
		$rs = $db -> select('rln_image','*',null,$order);
		$row = mysql_fetch_array($rs);
		return $row['img_id'];
	}
	
	public function update($img_id,$img_file,$img_field)
	{
		$db = new Database();	
		$db->connect();
		$db->update('rln_image',array($img_field=>$img_file),array('img_id',$img_id));
	}
	
	public function create($img1,$img2,$img3,$img4,$img5)
	{
		$db = new Database();
		$db->connect();
		if($db -> insert('rln_image',array($img1,$img2,$img3,$img4,$img5),'img_image1,img_image2,img_image3,img_image4,img_image5'))
		{
			$db->disconnect();
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	public function uploadImage($file_id)
	{
		
	if($_FILES[$file_id]["name"]):
			if((($_FILES[$file_id]["type"]=="image/jpeg") || 
			($_FILES[$file_id]["type"]=="image/pjpeg")||
			($_FILES[$file_id]["type"]=="image/png") ||
			($_FILES[$file_id]["type"]=="image/gif")) &&
				($_FILES[$file_id]["size"]<= 5242880)) 
			 {
				if($_FILES[$file_id]["error"] > 0)  // for get the error number of file while uploaded
				{
					echo "Error Number : ".$_FILES[$file_id]["error"]."<br />";
				}
				else
				{
					$img['name'] = $_FILES[$file_id]["name"];	 // for get the name of file
					$img['size'] = $_FILES[$file_id]["size"] / 1024;	 // for get the size of file
					$img['type'] = $_FILES[$file_id]["type"];	 // for get the type of file
					$img['temp'] = $_FILES[$file_id]["tmp_name"];	 // for get the path of temporary file								

					// Generate img name
					
					$add = mt_rand() . ".";
					$img_name = str_replace(".",$add, $img['name']);
					
						if(move_uploaded_file($img['temp'],"../media/posts/". $img_name)){
							$this->createThumbs("../media/posts/","../media/posts/thumbs/",180,125,$img_name);
							return $img_name;
						}
						else
							die ("Failed, while uploading file<br />");
					
					}
					
				}
			else 
				return("Invalid");				
		endif; 
	}
	
	public function uploadThumb($file_id)
	{
		
	if($_FILES[$file_id]["name"]):
			if((($_FILES[$file_id]["type"]=="image/jpeg") || 
			($_FILES[$file_id]["type"]=="image/pjpeg")||
			($_FILES[$file_id]["type"]=="image/png") ||
			($_FILES[$file_id]["type"]=="image/gif")) &&
				($_FILES[$file_id]["size"]<= 5242880)) 
			 {
				if($_FILES[$file_id]["error"] > 0)  // for get the error number of file while uploaded
				{
					echo "Error Number : ".$_FILES[$file_id]["error"]."<br />";
				}
				else
				{
					$img['name'] = $_FILES[$file_id]["name"];	 // for get the name of file
					$img['size'] = $_FILES[$file_id]["size"] / 1024;	 // for get the size of file
					$img['type'] = $_FILES[$file_id]["type"];	 // for get the type of file
					$img['temp'] = $_FILES[$file_id]["tmp_name"];	 // for get the path of temporary file								

					// Generate img name
					
					$add = mt_rand() . ".";
					$img_name = str_replace(".",$add, $img['name']);
					
						if(move_uploaded_file($img['temp'],"../media/posts/". $img_name)){
							$this->createThumbs("../media/posts/","../media/posts/thumbs/",215,150,$img_name);
							return $img_name;
						}
						else
							echo "Failed, while uploading file<br />";
					
					}
					
				}
			else 
				return("Invalid");				
		endif; 
	}
		
	public function delete($img)
	{
		
		$db = new Database();	
		$db->connect();

		$where = "img_id=".$img;
		$rs = $db -> select('rln_image','*',null);
		$row = mysql_fetch_array($rs);



		$path = "../media/posts/". $row['img_image1'];
		if(file_exists($path))
		unlink($path);

		
		$path_thumb = "../media/posts/thumbs/". $row['img_image1'];
		if(file_exists($path_thumb))
		unlink($path_thumb);

		

		$path = "../media/posts/". $row['img_image2'];
		if(file_exists($path))
		unlink($path);
		$path_thumb = "../media/posts/thumbs/". $row['img_image2'];
		unlink($path_thumb);



		$path = "../media/posts/". $row['img_image3'];
		if(file_exists($path))
		unlink($path);
		$path_thumb = "../media/posts/thumbs/". $row['img_image3'];
		if(file_exists($path_thumb))
		unlink($path_thumb);



		$path = "../media/posts/". $row['img_image4'];
		if(file_exists($path))
		unlink($path);
		$path_thumb ="../media/posts/thumbs/". $row['img_image4'];
		if(file_exists($path_thumb))
		unlink($path_thumb);


		$path = "../media/posts/". $row['img_image4'];
		if(file_exists($path))
		unlink($path);
		$path_thumb = "../media/posts/thumbs/". $row['img_image4'];
		if(file_exists($path_thumb))
		unlink($path_thumb);



		$path = "../media/posts/". $row['img_image5'];
		if(file_exists($path))
		unlink($path);
		$path_thumb =  "../media/posts/thumbs/". $row['img_image5'];
		if(file_exists($path_thumb))
		unlink($path_thumb);



		$db->delete("rln_image",$where);

	}


	public function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth,$thumbHeight,$fname)
	{

      // load image and get image size
      //$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
	  $source = $pathToImages . $fname;
	  $stype = explode(".", $source);
	  $stype = $stype[count($stype)-1];
	  
	  switch($stype) {
    	case 'gif':
    	$img = imagecreatefromgif ("{$pathToImages}{$fname}");
    	break;
    	case 'jpg':
    	$img = imagecreatefromjpeg("{$pathToImages}{$fname}");
    	break;
    	case 'png':
    	$img = imagecreatefrompng("{$pathToImages}{$fname}");
    	break;

       case 'GIF':
    	$img = imagecreatefromgif ("{$pathToImages}{$fname}");
    	break;
    	case 'JPG':
    	$img = imagecreatefromjpeg("{$pathToImages}{$fname}");
    	break;
		
		case 'JPEG':
    	$img = imagecreatefromjpeg("{$pathToImages}{$fname}");
    	break;
		
    	case 'PNG':
    	$img = imagecreatefrompng("{$pathToImages}{$fname}");
    	break;
    }
	  

	 
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = $thumbHeight;

      // create a new temporary image

      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
	}

	public function slider($id,$name)
	{ // Upload image from front page
		
	if($_FILES[$id]["name"]):
			if((($_FILES[$id]["type"]=="image/jpeg") || 
			($_FILES[$id]["type"]=="image/pjpeg")||
			($_FILES[$id]["type"]=="image/png") ||
			($_FILES[$id]["type"]=="image/gif")) &&
				($_FILES[$id]["size"]<= 5242880)) 
			 {
				if($_FILES[$id]["error"] > 0)  // for get the error number of file while uploaded
				{
					echo "Error Number : ".$_FILES[$id]["error"]."<br />";
				}
				else
				{
					$img['name'] = $_FILES[$id]["name"];	 // for get the name of file
					$img['size'] = $_FILES[$id]["size"] / 1024;	 // for get the size of file
					$img['type'] = $_FILES[$id]["type"];	 // for get the type of file
					$img['temp'] = $_FILES[$id]["tmp_name"];	 // for get the path of temporary file								

					// Generate img name
					
					$img_name = $name;
					
						if(move_uploaded_file($img['temp'],"../img/". $img_name)){
							return $img_name;
						}
						else
							die ("Failed, while uploading file<br />");
					
					}
					
				}
			else 
				return("Invalid");				
		endif; 
	}

	
	
}
?>