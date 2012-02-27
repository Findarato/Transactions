<?php
header("Content-type: image/png");
header("Expires: ".gmdate("D, d M Y H:i:s", (time()+900000)) . " GMT"); 
/********************************************************************
* Started November 30, 2006											*
* This will generate a progressbar of a selected color with 		*
* the background also selectable.  Goal will allow for selecting	*
* or passing a tile image to be used as the progress color			*
********************************************************************/
function __autoload($class_name) {
    require_once "../classes/".$class_name . '.class.php';
}
if(!isset($_SESSION['user']));
	session_start();

$user = unserialize($_SESSION['user']);

$font = $_SERVER['DOCUMENT_ROOT']."/fonts/arial.ttf";
//Get and set the percentage
if( isset($_GET["per"]) )
	$per = $_GET["per"];
else
	$per = 20;
if( isset($_GET["border"]) )
	$border = $_GET["border"];
else
	$border = 0;


//Get ans set the Height
if( isset($_GET["h"]) )
	$height = $_GET["h"];
else
	$height = 20;

//Get ans set the Width
if( isset($_GET["w"]) )
	$width = $_GET["w"];
else
	$width = 100;
function ImageColorAllocateFromHex ($img, $hexstr) {
  $int = hexdec($hexstr);

  return imagecolorallocate ($img,
         0xFF & ($int >> 0x10),
         0xFF & ($int >> 0x8),
         0xFF & $int );
}
$graphval = ($width * $per);
if($graphval > $width) {if($per > 1) { $graphval = $width;}}

//Create the triangle
$new = $height;
$triangle = array(0,0,$height,$height,0,$height,0,$height/2,0,0);

switch($per){

	case ($per<=1) && ($per > .75):
		$color = $user->Config['progfill2'];
	break;
	case ($per>1) :
		$color = $user->Config['progfill3'];
	break;
	default:
		$color = $user->Config['progfill'];
	break;
}
$im = imagecreate($width, $height)
   or die("Cannot Initialize new GD image stream");	   

$im2 = @imagecreate($new,$new)
   or die("Cannot Initialize new GD image stream");
	//$test = HexSplit($color);
//	$fc = imagecolorexactalpha($im2,"0x".$test[0],"0x".$test[1],"0x".$test[2],0 );
	$fc = ImageColorAllocateFromHex($im2, $color);
	$bg= ImageColorAllocateFromHex($im2,$user->Config['progbgc'] ); 

if($per<1){
 imagefilledpolygon($im2,$triangle,4,$fc); }
imagefilledrectangle($im2,0,0,$new,$new,$fc);


$background_color = ImageColorAllocateFromHex($im, $user->Config['progbgc']);
$fill_color = ImageColorAllocateFromHex($im, $color);
$black = imagecolorallocate($im, 0, 0, 0);
$shadow = imagecolorallocatealpha($im, 0, 0, 0,50);

imagefilledrectangle ($im,0,0,$graphval,$height,$fill_color);
imagecopy($im,$im2,$graphval-$height+1,0,0,0,$new,$new);

if($border>0) {
	imageline ($im,0,0,0,$height-1,$black);  //Left Side
	imageline ($im,0,$height-1,$width,$height-1,$black); //Bottom
	imageline ($im,$width-1,0,$width-1,$height,$black);  //Right Side
	imageline ($im,0,0,$width,0,$black); //Top
}
if(isset($_GET['draw_color'])){//sets the color of the text
	$text_color = ImageColorAllocateFromHex($im,$_GET['draw_per_color']);
}else{
	$text_color = imagecolorallocate( $im,255,255,255); //white	0 transparency
}
if(isset($_GET['draw_per'])){//draw the percentage on the graph
	$per = round($per,4)*100;
	$loc = strlen($per)+1;
	imagettftext($im,10,0,$width-$loc*10,12,$text_color,$font,$per."%");
}	
if(isset($_GET['label'])){//stick on the label
	imagettftext($im,10,0,11,13,$shadow,$font,$_GET['label']); //shadow
	imagettftext($im,10,0,10,12,$text_color,$font,$_GET['label']);

}



imagepng($im);
imagedestroy($im);
imagedestroy($im2);
?>
