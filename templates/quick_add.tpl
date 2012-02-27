<form id="newTransaction" method="post">
	Ammount:<input class="transactionForm" type="text" name="ammount" style="width:7em; " maxlength="10"   /><br />
	{html_radios name='type' options=$dc selected=d }
    <br />
	Category:<BR />
	<select class="transactionForm" name="mainCategory" onChange="javascript:displayChild(this.options[this.selectedIndex].value)">
		<option value=""></option>{foreach from=$mainCate item=cate key=k}<option value="{$k}">{$cate}</option>{/foreach}</select>
		<br />
	SubCategory:<BR /><SELECT class="transactionForm" name="subCategory" id="subCategory" style="min-width:10em;"></SELECT><br />
	Note:<input class="transactionForm" type="text" name="note" style="width:12em;" maxlength="100"   /><br />
	Account:{html_options ID=transAccount name=account options=$accnt}
	<input type="hidden" name="add" value="yes"/><br />
</form>
{$sql}