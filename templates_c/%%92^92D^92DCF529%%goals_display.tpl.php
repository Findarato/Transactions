<?php /* Smarty version 2.6.18, created on 2010-03-08 07:09:43
         compiled from goals_display.tpl */ ?>
	<div class="GoalCont GoalWidth" >
	<?php $_from = $this->_tpl_vars['goal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['g']):
?>
    	<div>
        	<div style="width:85px;float:left"><?php echo $this->_tpl_vars['g']['goalname']; ?>
</div>
            <div style="float:right; padding-left:5px"><?php echo $this->_tpl_vars['g']['perdisplay']; ?>
%</div>
            <div id="<?php echo $this->_tpl_vars['g']['goalid']; ?>
" class="GoalWidth" style="clear:both"></div>
		</div>
        <div style="clear:both;height:5px"></div>
		<!--<div class="goal"><img class="goalImage" src="<?php echo $this->_tpl_vars['path']; ?>
ajax/progress.php?w=400&h=15&border=1&per=<?php echo $this->_tpl_vars['g']['per']; ?>
&draw_per&label=<?php echo $this->_tpl_vars['g']['goalname']; ?>
" alt="graph"></div> old image based code-->
<?php endforeach; endif; unset($_from); ?>
	</div> <div style="clear:both"></div>

<?php echo '
<script>
jQuery(document).ready(function(){
	$(function() {
//<!--'; ?>
<?php $_from = $this->_tpl_vars['goal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['g']):
?><?php echo ' //-->
		$("#'; ?>
<?php echo $this->_tpl_vars['g']['goalid']; ?>
<?php echo '").progressbar({
			value: '; ?>
<?php echo $this->_tpl_vars['g']['perdisplay']; ?>
<?php echo ', 
			lable:true
		}); 
//<!--'; ?>
<?php endforeach; endif; unset($_from); ?><?php echo ' //-->
	});
});								
</script>
'; ?>