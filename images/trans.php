<?php
$size=10;
$color="000000";
$size=$_GET["s"];
$color=$_GET["color"];

function ImageColorAllocateFromHexA ($img, $hexstr,$alpha) {
	$int = hexdec($hexstr);
	return imagecolorallocatealpha ($img,
	 0xFF & ($int >> 0x10),
	 0xFF & ($int >> 0x8),
	 0xFF & $int,$alpha );
}
$image=imagecreatetruecolor($size, $size);
$back = imagecolorallocatealpha($image, 255, 255, 255,0);
imagefilledrectangle($image, 0, 0, $size, $size, $back);
//imagecolortransparent($image,imagecolorallocate($image,255,255,255));
$half = $size/2;
$full = $size-2;
//$black = ImageColorAllocateFromHexA($image,$color, 60);
$black = imagecolorallocatealpha($image,0,0,0,50); 
imagefilledellipse($image, $half, $half, $full, $full, $black);
//	imagefilledellipse($image, 0, 0, $radius, $radius, $black);
imagealphablending($image, true); // setting alpha blending on
imagesavealpha($image, true); // save alphablending setting (important)
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

?>