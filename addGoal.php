<?
require("config.php");
require("database.inc");



?>
<form action="" method="get" name="goal">
  <p>Add a new Goal</p>
  <p>Goal Amount: $ 
    <input name="textfield" type="text" size="7" maxlength="7">
    <br>
    Goal Reason: 
    <input name="Reason" type="text" id="Reason" value="Does not currently work" disabled>
    <br>
    <input name="submit" type="submit" id="submit" value="Add Goal">
  </p>
</form>
