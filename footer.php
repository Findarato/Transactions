<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="?print=1" target="_blank">Printer Friendly</a></td>
  </tr>
  <tr>
    <td><?
$tim2 = array_sum(explode(' ',microtime())); 

$total_time = $tim2 - $tim1;
$total_time = sprintf('%6f', $total_time); 
echo 'Total execution time: ' . $total_time . ' sec'; 
?></td>
  </tr>
</table>
<center>
<br />
</center>
