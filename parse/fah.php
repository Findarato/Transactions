<?Php
/*
Current Work Unit
-----------------
Name: p3615_Seq25_Amber03_Native
Download time: February 5 05:22:39
Due time: May 11 05:22:39
Progress: 77%  [|||||||___]

/* do NOT run this script through a web browser */

if (!isset($_SERVER["argv"][0]) || isset($_SERVER['REQUEST_METHOD'])  || isset($_SERVER['REMOTE_ADDR'])) {
   die("<br><strong>This script is only meant to run at the command line.</strong>");
}

$no_http_headers = true;
$source = "http://".$_SERVER["argv"][1]."/~jharry/folding/2/";
$file = "unitinfo.txt";
$input = file($source.$file);
$pre = split(" ",$input[5]);
echo str_replace("%","",$pre[1]);



?>