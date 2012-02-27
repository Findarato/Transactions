<?Php 
header('content-type:text/css'); 
//header("Expires: ".gmdate("D, d M Y H:i:s", (time()+900000)) . " GMT"); 
$files = array(
"colorbox.css",
"reset.css",
"layout.css",
"ui.core.css",
"ui.theme.css",
"ui.accordion.css",
"ui.datepicker.css",
"ui.dialog.css",
"ui.progressbar.css",
"ui.resizable.css",
"ui.slider.css",
"ui.tabs.css",
"thickbox.css",
"global.css"
);

foreach($files as $f){echo str_replace("\r\n",'',join('',@file($f)));}?> 