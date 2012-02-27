{foreach from=$reminder item=r}
	<div id="div-{$r.id}">
        <img src="images/Icons/exclamation.png" onclick="checkBox({$r.id})" id="{$r.id}" alt="check box" />{$r.title}
        <input type="hidden" id="{$r.id}" value="false" />{$r.dt|date_format:'%m.%d.%y'} <span class="fakelink" onclick="toggleDiv('div-{$r.id}')">+</span>{$r.status}<br />    
   	</div>
{/foreach}