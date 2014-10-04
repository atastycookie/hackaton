<meta charset="UTF-8">
<?php

include('resize.php');

function create_thumbnail($image){
	$resizeimage= new Imagick($image);
	$resizeimage->cropThumbnailImage(100,100);
	$resizeimage->setImageCompression(imagick::COMPRESSION_JPEG); 
	$resizeimage->setImageCompressionQuality(99); 
	$resizeimage->writeImage();
}

function rand_string($length){
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen($chars);
	for( $i = 0; $i < $length; $i++ ) {
		
		@$str .= $chars[ rand( 0, $size - 1 ) ];
		
	}
	return $str;
}

if ( ( ($_FILES["image"]["size"] / 1048576)>2) ) //if larger than 2mb
  {
  echo 'Image Larger than 2Mb.';
  }
else
  {

  $the_image = $_FILES["image"]["tmp_name"];

  $fext = $_FILES["image"]["name"];
  $ext  = pathinfo($fext, PATHINFO_EXTENSION);
  if(empty($ext)) { $ext = 'jpg'; }
  
  $random_name= strtotime("now").rand_string(5);
  $file = $random_name.'.'.$ext;
  
  
    move_uploaded_file($_FILES["image"]["tmp_name"], '../guest_uploads/'.$file);
    
	// check for file size
	list($width, $height, $type, $attr) = getimagesize('../guest_uploads/'.$file);
	
	if( ($width > 150) ){
		@$orig_image = new resize('../guest_uploads/'.$file);
		@$orig_image -> resizeImage(150, '','crop');
		@$orig_image -> saveImage('../guest_uploads/'.$file, 99);
	}
	if( ($height > 75) ){
		@$orig_image = new resize('../guest_uploads/'.$file);
		@$orig_image -> resizeImage('', 75,'crop');
		@$orig_image -> saveImage('../guest_uploads/'.$file, 99);
	}
	unset($orig_image);
	unset($_FILES);
    echo 'guest_uploads/'.$file;
  }
?> 