<form name="form1" method="post" action="">
Total Owed:<input type="text" name="P" id="P"><br>
Interest Rate:<input type="text" name="R" id="R"><br>
Interval:<input type="text" name="N" id="N">number of times the interest is compounded per year<br>
Payment:<input type="text" name="payment" id="payment"><br>
<input type="submit" name="button" id="button" value="Submit">
</form>

<?
if(isset($_POST["P"]) && isset($_POST["R"]) && isset($_POST["N"])){
//A = P ( 1 + r/n )^(nt)
	$startValue = $_POST["P"];
	$c=0;
	$totalPayments = 0;
	while($startValue>0){
		$curValue = $startValue*(1+($_POST["R"]/$_POST["N"]));
		$exp = $_POST["N"]*(1/12);
		$curValue = pow($curValue,$exp);
		$startValue = $curValue - $_POST["payment"];
		$totalPayments += $_POST["payment"];
		$c++;
		echo $c.":".round($startValue,2)." -- ".$totalPayments."<br>";
	}
}
?>
