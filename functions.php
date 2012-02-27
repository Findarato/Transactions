<?Php
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
		$result.="<span style=\"color:'$color'\">".$graph."</span>";
	}
	if($fill=="1")
	{
		for($b=$a++;$b<=$total;$b++)
		{
			$result.="<span style=\"color:'$fillcolor'\">".$graph."</span>";
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

function GetTotalTree($id) {
//Get the Total value of the Current node and 
//all Children nodes
	//2006-10-26 00:11:56
	$db = db::getInstance();
	$total = 0;
	$sdt = date("Y-m-d h:m:s",mktime(0,0,0,1,1,date("Y")));
	$sql = "SELECT SUM(l.debit) AS debit,SUM(l.credit) AS credit FROM ".$db->Prefix."ledger AS l JOIN 
	".$db->Prefix."categories AS c ON(l.category = c.id) WHERE YEAR(l.dt)>".(date("Y")-1)." AND c.parent=".$id." GROUP BY c.parent;";
	$db->Query($sql);
	$values = $db->Format("assoc");
	if(isset($values)){ @$total = ( @$values['credit'] - @$values['debit'] );	}

	return $total;

}

function GetChild($id) {
//Pass parent ID, return child id.
//if more than one child then returns array of children.
	$db = db::getInstance();
	$sql = "SELECT id FROM ".$db->Prefix."categories WHERE parent=".$id.";";
	$db->Query($sql);
	$res = $db->Format("row_array");
	if(empty($res)){return $id;}
	return $res;
}
function GetStartEnd($start=0,$end=0){
//I find my self using this more often, so its a good function
	if($start==0){//there is no start date assume one year, and that it is current year.
		$sdt = date("Y-m-d",mktime(0,0,0,1,1,date("Y")));}
	else { $sdt = date("Y-m-d",strtotime($start)); }
	if($end==0){//there is no start date
		$edt = date("Y-m-d",mktime(0,0,0,12,31,date("Y")));}
	else { $edt = date("Y-m-d",strtotime($end)); }
	$return[0]=$sdt;
	$return[1]=$edt;
	return $return;
	
}
function GetTotal($id,$start="",$end="",$acct=0){//start and end are both timestamps
//this is the new way to get the category totals.
//Started Nov 26, 2008
	$db = db::getInstance();
//	list($sdt,$edt) = GetStartEnd($start,$end);
	$children = GetChild($id);
//	print_r($children);
	if(is_array($children)){//there are children
		$sql = "SELECT 
		SUM(l.credit) -	SUM(l.debit) AS total 
		FROM ".$db->Prefix."ledger AS l 
		WHERE (l.category=".$id." OR l.category IN(".join(',',$children).") )";
		if($start>0 && $end>0){ //date_format(timestamp,'%m/%d/%Y')
			$sql.=" AND l.dt BETWEEN DATE('".date("Y-m-d",strtotime($start))."') AND DATE('".date("Y-m-d",strtotime($end))."')";
		}else {	$sql.="AND YEAR(l.dt)=".date("Y");}//fallback to get just the year
		if($acct>0){$sql.="AND acct_id=".$acct;}
		$sql.=" ;"	;	
	}else {//there are either no children or this is a parent
		$sql = "SELECT 
		SUM(l.credit) -	SUM(l.debit) AS total
		FROM ".$db->Prefix."ledger AS l 
		WHERE l.category=".$id;
		if($start>0 && $end>0){
			$sql.=" AND l.dt BETWEEN DATE('".date("Y-m-d",strtotime($start))."') AND DATE('".date("Y-m-d",strtotime($end))."')";
		}else {	$sql.="AND YEAR(l.dt)=".date("Y");}//fallback to get just the year
		if($acct>0){$sql.="AND acct_id=".$acct;}
		$sql.=" ;";
		//echo $sql."|\n";
	}
	$db->Query($sql);
	$row = $db->Format("row");
	//return $sql;
	return abs($row);

}
function GetChildTotal($id,$start=0,$end=0){
	$db = db::getInstance();
	list($sdt,$edt) = GetStartEnd($start,$end);

	$sql = "SELECT SUM(l.debit) AS Debit,SUM(l.credit) AS credit FROM ".$db->Prefix."ledger AS l JOIN 
	".$db->Prefix."categories AS c ON(l.category = c.id) WHERE parent=".$id." and l.dt BETWEEN ".$sdt." AND ".$edt." GROUP BY parent;";
	$db->Query($sql);
	$finished = array();
	$total = 0;
	$row = $db->Format("row");
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
