{*{$acc.image}*}
	<select id="account_dd" style="min-width:20em;">
	{foreach from=$accinfo item=acc}
		<option value="{$acc.id}">{$acc.name} - Balance: ${$acc.balance}</option>
	{/foreach}
	</select>