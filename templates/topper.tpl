<div id="topper" class="color-B-2 background-alpha-3" style="border:none;display:table">
	<div class="font-X" id="topper_name" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;">{$firstName}</div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_calculator" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Calculator</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_settings" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Settings</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_search" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;"><span class="fakelink">Search</span></div>
    <div class="font-X" style="display:table-cell;">|</div>
    <div class="font-X" id="topper_search" style="display:table-cell; padding-left:1em; padding-right:1em; height:20px;"><select class="dropdown" id="account_dd" ><option value="0">All Accounts</option>{foreach from=$accinfo item=acc}<option value="{$acc.id}">{$acc.name}</option>{/foreach}</select></div>
    <div class="font-X" id="topper_date" style="display:table-cell;padding-left:1em; padding-right:1em; height:20px;">{$smarty.now|date_format:"%A, %B %e, %Y"}</div>
</div>