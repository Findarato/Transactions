<?
/*
1024bytes=1KB
1048576=1MB
1073741824=GB
1099511627776=TB
1125899906842624=PB
*/

function fixfilesize($filesize)
{
	if($filesize<=1048576)
			//This is a KB
			$perdysize=floor($filesize/1024);

	if($filesize<=1073741824)
			//This is a MB
			$perdysize=floor($filesize/1048576);

	if($filesize<=1099511627776)
			//This is a GB
			$perdysize=floor($filesize/1073741824);

	if($filesize<=1125899906842624)
			//This is a TB
			$perdysize=floor($filesize/1099511627776);

	return $perdysize;
}

function count_dir($dirname)
{
	$count==0;
	$handle=opendir($dirname);
	while ($file = readdir($handle))
	{
		if($file!='.'||$file!='..')
		{
			if(is_dir($dirname.$file)|| $file=='index.php')
			{
					//its a direcotry so skip it and do nothing
			}else{
				$count++;
			}
		}
	}
	closedir($handle);
	return $count;
}

function get_filenames($dirname)
{
	$Filecount==0;
	$handle=opendir($dirname);
    while ($file = readdir($handle))
    {
    	if($file!='.'||$file!='..'||$file!='*.php')
      {
  	   	if(is_dir($dirname.$file))
  	      {
        	//its a direcotry so skip it and do nothing
         }else{
         	$files[$filecount]=$file;
            $filecount++;
         }
      }
    }
    closedir($handle);
    return $files;
}

function formatTime($timestamp)
{
	//example time 20010627110324
	$year=substr($timestamp, 0, 4);
	$month=substr($timestamp, 4, 2);
	$day=substr($timestamp, 6,2);
	$hour=substr($timestamp, 8, 2);
	$minute=substr($timestamp, 10,2);
	$second=substr($timestamp, 12,2);

	return mktime($hour, $minute, $second, $month, $day, $year);
}

function ArrayQuery($array,$column,$type="or")
{
    if(is_array($array))
    {
		$string=$column;
		if($type=="or")
			$string.=" in ";
		$string.="('". join($array,"','") ."')";
    }
	return $string;
}

function textbar ($percent,$color,$total="10",$graph="-",$fill="0",$fillcolor="grey",$showpercent="0")
{
	$base = round(($percent*$total));
	$result = "";
	for($a=1;$a<=$base;$a++)
	{
		$result.="<font color='$color'>".$graph."</font>";
	}
	if($fill=="1")
	{
		for($b=$a++;$b<=$total;$b++)
		{
			$result.="<font color='$fillcolor'>".$graph."</font>";
		}
	}
	if($showpercent=="1")
	{
		$result.="&nbsp;".round((100*($percent)),'2')."%";	
	}
return $result;
}


function incdisplay($total,$inc,$var,$page)
{
        for($count;($inc*$count)<=$total;$count++)
        {
            echo "<a href='".$page."?".$var."=".($inc*$count)."'>".$count."</a>";
    	    if($total<$inc);
	        echo "|";
        }
}

function csv($table,$user,$account,$br=1)
{
	$sql="SELECT * FROM $table WHERE user='$user' AND account='$account'";
	$result=mysql_query($sql);
	while($line=mysql_fetch_array($result))
	{
		if($output!="")
		{
			if($br==1)
			{
				$output=$output."$line[id],$line[credit],$line[debit],$line[date],$line[catagory],$line[note],$line[user],$line[account]<br>\n";
			}
			else
			{
				$output=$output."$line[id],$line[credit],$line[debit],$line[date],$line[catagory],$line[note],$line[user],$line[account]\n";
			}
		}	
		else
		{
			if($br==1)
			{
				$output="$line[id],$line[credit],$line[debit],$line[date],$line[catagory],$line[note],$line[user],$line[account]<br>\n";
			}
			else
			{
				$output="$line[id],$line[credit],$line[debit],$line[date],$line[catagory],$line[note],$line[user],$line[account]\n";
			}

		}
	}
return $output;
}

function catnumber($catagory)
{


}

function compress($srcName, $dstName)
{

//$fp = fopen($srcName, "r");
// $data = fread ($fp, filesize($srcName));
// fclose($fp);

 $zp = gzopen($dstName, "w9");
// gzwrite($zp, $data);
 gzwrite($zp, $srcName);
 gzclose($zp);
}

function closebooks($table,$user,$account)
{
	return $result;
}

function array_average($array)
{
	$total=0;
	$denom=count($array);
	for($b=0;$b<$denom;$b++)
	{
		$total=$array[$b]+$total;
	}
	$average=($total/$denom);
	return $average;
}

function fill_array_incra($start=0,$end=10)
{
	$count=$start;

	for($a=0;$a<=($end-$start);$a++)
	{
		$finished[$a]=$count++;
		
	}
	//print_r($finished);
	return $finished;
}
function shorten($string,$length=5)
{
	$short = substr($string,0,$length);
	$short.= "..."; 

	return $short;
}

function slope($x1,$x2=0,$y1,$y2=0)
{
	$num=$x1-$x2;
	$denom=$y1-$y2;
	if($denom==0)
		$denom=1;
	//echo "Denom:$denom<br>";
	$finished=($num/$denom);
	return $finished;	
}

function lobf($x,$y)
{
	//$x and $y are arrays of the values
	$y[-1]=0;
	
	$count=count($y);	

	if(!(is_array($x)));
		$x=fill_array_incra('0',$count);

	for($d=0;$d<=$count;$d++)
	{
		//echo "|$y[$d]|";
		if(($d-1)<0)
			$d=0;
		//echo $y[$d-1];
		$arrslope[]=slope($x[$d],$x[$d-1],$y[$d],$y[$d-1]);	
	}
	$avgslope=array_average($arrslope);
	$avgx=array_average($x);
	$avgy=array_average($y);
	$b=$avgy-($avgslope*$avgx);	

	//echo $b;
	//echo $avgslope;

	for($c=0;$c<=$count;$c++)
	{
		$ydata[]=(($avgslope*$c)+$b);
		
	}

	return $ydata;
}

function GetTotalTree($id,$table,$childTable) {
//Get the Total value of the Current node and 
//all Children nodes
	//2006-10-26 00:11:56
	$total = 0;
	$children = 0;
	$children = GetChild($id,$childTable);
	$sdt = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
	$sql = "SELECT SUM(debit),SUM(credit) FROM $table WHERE category in ('". join($children,"','") ."')";;
	//echo $sql;
	$result = mysql_query ($sql);
	$row = mysql_fetch_row ($result);
	$total+=( $row[1] - $row[0] );
	return $total;
//	return $sql;
}


function GetChild($id,$table) {
//Pass parent ID, return child id.
//if more than one child then returns array of children.
	$child = array();
	$sql = "SELECT * FROM $table WHERE parent='$id'";
	$result = mysql_query($sql);
	while($line = mysql_fetch_row($result))
	{
		$child[]=$line[0];
	}
	return $child;

	//return $sql;
}
function GetChildTotal($id,$table)
{
	$sdt = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));	
	$sql = "SELECT SUM(debit),SUM(credit) FROM $table WHERE category='$id'";
	$result = mysql_query($sql);
	$finished = array();
	$total = 0;
	$row = mysql_fetch_row($result);
	$total = $row[1]-$row[0];
	return $total;
}

function XMLtable($sql,$title="XML",$children="child",$timeFormat=24) {
//A database connection must already be made for this function to 
//work correctly.
	$XML = "";

	$XML = "<".$title.">";
	$result = mysql_query($sql);
	while($line = mysql_fetch_assoc($result))	{
		$columns = array_keys($line);
		$values = array_values($line);
		$XML .= "<".$children.">";
		for($a=0;$a<count($values);$a++) {

		if (mysql_field_type($result,$a) == "time")
		{
			if($timeFormat==12)
				$values[$a] = date("g:i A",strtotime($values[$a]));
			elseif($timeFormat==24)
				$values[$a] = date("G:i",strtotime($values[$a]));
			else
				$values[$a] = "you are the suck @ php";
		}		
			$XML .= "<".$columns[$a].">";		
			$XML .= $values[$a];		
			$XML .= "</".$columns[$a].">";		
		}
		$XML .= "</".$children.">";
	}
	$XML .= "</".$title.">";
	return $XML;
}


function makeCateStr($cateId,$cateTable){
//requires SQL connection be estabilished and the link remain open

	$sql = "SELECT * FROM $cateTable WHERE id = '".$cateId."'";
	$result = mysql_query( $sql ) or die($sql);
	$line = mysql_fetch_assoc($result);

	$sql2 = "SELECT * FROM $cateTable WHERE id = '".$line["parent"]."'";
	$result2 = mysql_query( $sql2 ) or die($sql2);
	$line2 = mysql_fetch_assoc($result2);

	$output = $line2["cata_name"].".".$line["cata_name"];

	return $output;
}
?>
