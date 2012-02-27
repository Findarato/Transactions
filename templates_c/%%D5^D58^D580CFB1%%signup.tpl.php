<?php /* Smarty version 2.6.18, created on 2010-06-13 04:46:11
         compiled from signup.tpl */ ?>
<h1>New user Signup</h1>
<h2>Please fill out form to make a new account</h2>
<form action="" method="post">
<div style="background-color:#CCCCCC; color:#FF0000; text-align:center"><?php echo $this->_tpl_vars['message']; ?>
</div>
	<table with="50%" cellpadding="0" cellspacing="0">
		<tr>
			<td>First Name</td>
			<td><input type="text" name="fName" autocomplete="off"></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="lName" autocomplete="off"></td>
		</tr>	
		<tr>
			<td>User Name</td>
			<td><input type="text" name="uName" autocomplete="off"></td>
		</tr>	
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass1" autocomplete="off"></td>
		</tr>
		<tr>
			<td>Retype Password</td>
			<td><input type="password" name="pass2" autocomplete="off"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" autocomplete="off"></td>
		</tr>
		<tr>
			<td>Secret Question</td>
			<td><select name="question">
				<option>Mother's Maiden Name</option>
				<option>Favorite Pet</option>
				<option>Where you were born</option>
				<option>What is Pie are Squared</option>			
			</select>
			</td>
		</tr>
		<tr>
			<td>Secret Answer</td>
			<td><input type="text" name="answer" autocomplete="off"></td>
		</tr>
		<tr>
			<td>Starting Value$</td>
			<td><input type="text" name="starting" autocomplete="off"></td>
		</tr>
        <tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Signup" value="Signup"></td>
		</tr>		
	</table>

</form>