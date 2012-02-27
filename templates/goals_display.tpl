	<div class="GoalCont GoalWidth" >
	{foreach from=$goal item=g}
    	<div>
        	<div style="width:85px;float:left">{$g.goalname}</div>
            <div style="float:right; padding-left:5px">{$g.perdisplay}%</div>
            <div id="{$g.goalid}" class="GoalWidth" style="clear:both"></div>
		</div>
        <div style="clear:both;height:5px"></div>
		<!--<div class="goal"><img class="goalImage" src="{$path}ajax/progress.php?w=400&h=15&border=1&per={$g.per}&draw_per&label={$g.goalname}" alt="graph"></div> old image based code-->
{/foreach}
	</div> <div style="clear:both"></div>

{literal}
<script>
jQuery(document).ready(function(){
	$(function() {
//<!--{/literal}{foreach from=$goal item=g}{literal} //-->
		$("#{/literal}{$g.goalid}{literal}").progressbar({
			value: {/literal}{$g.perdisplay}{literal}, 
			lable:true
		}); 
//<!--{/literal}{/foreach}{literal} //-->
	});
});								
</script>
{/literal}