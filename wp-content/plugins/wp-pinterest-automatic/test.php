<?php 

$pin_image = "https://localhost/wordpress/wp-content/uploads/2019/04/56173335_2332485606802342_6501383908255334400_n.png-120x100.jpg";

if(  preg_match( '{-(\d*)x(\d*)\.[a-z]*$}', $pin_image,$matches )){

	$notSmallPin_image = preg_replace('{-\d*x\d*(\.[a-z]*$)}', "$1", $notSmallPin_image) ;
	
	print_r($matches);
	exit;
	
	if(isset($matches[1]) && is_numeric($matches[1])){
		$smallImageWidth = $matches[1];
		
	}
	
	$wasSmallImage = true;
}

exit;

//wp-load
require_once('../../../wp-load.php');

$media = get_attached_media( 'image' , 47813 );

if(count($media) > 0){

	foreach($media as $smedia){
		
		print_r($media);
		exit;
		
		echo  '<img src="' . $smedia->guid . '" />' ;
	}
	
}



?>