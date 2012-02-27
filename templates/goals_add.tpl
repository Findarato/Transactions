<div id="newGoaldialog">
	<div class="border-all-B-1 color-D-1" style="padding:5px;">
		<form id="newGoalForm" action="" method="post">
			<table width="50%" cellpadding="0" cellspacing="0">
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name" />
				</tr>
				<tr>
					<td>Amount:</td>
					<td><input type="text" name="amount" />
				</tr>	
				<tr>
					<td>Frequency:</td>
					<td><select name="frequency"><option value="30">Month</option><option value="360">Year</option></select></td>
				</tr>
				<tr>
					<td>Category:</td>
					<td><select name="category">
					{foreach from=$childCate key="childParent" item="mainSet"}
						<optgroup label="{$mainCate[$childParent]}">
						<option value="{$childParent}">{$mainCate[$childParent]}</option>
						{foreach from=$mainSet key="childParent" item="child"}
							<option value="{$child.id}">{$child.name}</option>
						{/foreach}
						</optgroup>
					{/foreach}
					</select>
					</td>
				</tr>
				<tr>
					<td>Account:</td>
					<td>{html_options name=account options=$accnt}</td>
				</tr>
			</table>
		</form>
		<div class="table textLeft" style="width:100px">
			<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton Cancel" id="addTransactionCancelBtn">Cancel</a></div>
			<div class="td"><a class="option-theme fg-button ui-corner-all white lapcatButton" id="addGoalBtn">Add</a></div>
		</div>
	</div>
</div>