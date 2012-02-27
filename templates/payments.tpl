<h1>Current Payment Accounts</h1>
<table cellpadding="0" cellspacing="0" border="0" style="width:90%">
    <tr>
        <td>Account Name</td>
        <td>Account Type</td>
        <td>Interest</td>
        <td>Category Linked</td>
        <td>Balance</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>d
	{foreach from=$acctCate item=acc}
	{if ($acc.credit-$acc.debit) eq 0} {assign var="color" value="#000000"}
    {else} {assign var="color" value="#FFFFFF"}
    {/if}
    <tr style="color:{$color}; background:{cycle values=','}">
        <td>{$acc.acct_name}</td>
        <td>{$acc.acct_type}</td>
        <td>{$acc.interest}%</td>
        <td>{$acc.cate_name}</td>
        <td>{$acc.credit-$acc.debit}</td>
        <td>{if ($acc.credit-$acc.debit) lt 0}<a href="{$path}#pay/{$acc.id}" title="Pay {$acc.acct_name}"><img src="../images/Icons/money_delete.png"></a>{/if}</td>
        <td><a href="{$path}#delete/{$acc.id}" title="Delete {$acc.acct_name}"><img src="../images/Icons/delete.png"></a></td>
    </tr>
	{/foreach}
        <tr>
        <td colspan="3">Total Value of All accounts:</td>
        <td>&nbsp;</td>
        <td>{$acctTotal}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="4"><h2><a href="{$path}payments/new" title="Add a new Payment Account">New Payment Account</a></h2></td>
    </tr>
</table>
<div>
	<div id="payNew" style="display:none">{include file="payments_new.tpl"}</div>
   	<div id="paySuccess" style="display:none">{include file="payments_success.tpl"}</div>
</div>