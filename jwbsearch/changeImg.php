<?php
include ('checkbox.php');
function getImgCode($ImgSrc){
	
	$ckbox = new checkbox();
	$ckbox->setImg($ImgSrc);
	$ckbox->getHec();
	$ckbox->decode();
	return $ckbox->getResult();
}
?>