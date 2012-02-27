<?php /* Smarty version 2.6.18, created on 2008-09-16 14:03:03
         compiled from calendar:month */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'calendar:month', 9, false),)), $this); ?>
<table class="calendar" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <th class="month" colspan="7">
      <?php echo $this->_tpl_vars['month_name']; ?>
&nbsp;<?php echo $this->_tpl_vars['year']; ?>

    </th>
  </tr>
  <tr>
    <td class="prev-month" colspan="3">
      <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['prev_month_end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['url_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['url_format'])); ?>
">
        <?php echo $this->_tpl_vars['prev_month_abbrev']; ?>

      </a>
    </td>
    <td></td>
    <td class="next-month" colspan="3">
      <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['next_month_begin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['url_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['url_format'])); ?>
">
        <?php echo $this->_tpl_vars['next_month_abbrev']; ?>

      </a>
    </td>
  </tr>
  <tr>
  <?php unset($this->_sections['day_of_week']);
$this->_sections['day_of_week']['name'] = 'day_of_week';
$this->_sections['day_of_week']['loop'] = is_array($_loop=$this->_tpl_vars['day_of_week_abbrevs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['day_of_week']['show'] = true;
$this->_sections['day_of_week']['max'] = $this->_sections['day_of_week']['loop'];
$this->_sections['day_of_week']['step'] = 1;
$this->_sections['day_of_week']['start'] = $this->_sections['day_of_week']['step'] > 0 ? 0 : $this->_sections['day_of_week']['loop']-1;
if ($this->_sections['day_of_week']['show']) {
    $this->_sections['day_of_week']['total'] = $this->_sections['day_of_week']['loop'];
    if ($this->_sections['day_of_week']['total'] == 0)
        $this->_sections['day_of_week']['show'] = false;
} else
    $this->_sections['day_of_week']['total'] = 0;
if ($this->_sections['day_of_week']['show']):

            for ($this->_sections['day_of_week']['index'] = $this->_sections['day_of_week']['start'], $this->_sections['day_of_week']['iteration'] = 1;
                 $this->_sections['day_of_week']['iteration'] <= $this->_sections['day_of_week']['total'];
                 $this->_sections['day_of_week']['index'] += $this->_sections['day_of_week']['step'], $this->_sections['day_of_week']['iteration']++):
$this->_sections['day_of_week']['rownum'] = $this->_sections['day_of_week']['iteration'];
$this->_sections['day_of_week']['index_prev'] = $this->_sections['day_of_week']['index'] - $this->_sections['day_of_week']['step'];
$this->_sections['day_of_week']['index_next'] = $this->_sections['day_of_week']['index'] + $this->_sections['day_of_week']['step'];
$this->_sections['day_of_week']['first']      = ($this->_sections['day_of_week']['iteration'] == 1);
$this->_sections['day_of_week']['last']       = ($this->_sections['day_of_week']['iteration'] == $this->_sections['day_of_week']['total']);
?>
    <th class="day-of-week"><?php echo $this->_tpl_vars['day_of_week_abbrevs'][$this->_sections['day_of_week']['index']]; ?>
</th>
  <?php endfor; endif; ?>
  </tr>
  <?php unset($this->_sections['row']);
$this->_sections['row']['name'] = 'row';
$this->_sections['row']['loop'] = is_array($_loop=$this->_tpl_vars['calendar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['row']['show'] = true;
$this->_sections['row']['max'] = $this->_sections['row']['loop'];
$this->_sections['row']['step'] = 1;
$this->_sections['row']['start'] = $this->_sections['row']['step'] > 0 ? 0 : $this->_sections['row']['loop']-1;
if ($this->_sections['row']['show']) {
    $this->_sections['row']['total'] = $this->_sections['row']['loop'];
    if ($this->_sections['row']['total'] == 0)
        $this->_sections['row']['show'] = false;
} else
    $this->_sections['row']['total'] = 0;
if ($this->_sections['row']['show']):

            for ($this->_sections['row']['index'] = $this->_sections['row']['start'], $this->_sections['row']['iteration'] = 1;
                 $this->_sections['row']['iteration'] <= $this->_sections['row']['total'];
                 $this->_sections['row']['index'] += $this->_sections['row']['step'], $this->_sections['row']['iteration']++):
$this->_sections['row']['rownum'] = $this->_sections['row']['iteration'];
$this->_sections['row']['index_prev'] = $this->_sections['row']['index'] - $this->_sections['row']['step'];
$this->_sections['row']['index_next'] = $this->_sections['row']['index'] + $this->_sections['row']['step'];
$this->_sections['row']['first']      = ($this->_sections['row']['iteration'] == 1);
$this->_sections['row']['last']       = ($this->_sections['row']['iteration'] == $this->_sections['row']['total']);
?>
    <tr>
      <?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['calendar'][$this->_sections['row']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
        <?php $this->assign('date', $this->_tpl_vars['calendar'][$this->_sections['row']['index']][$this->_sections['col']['index']]); ?>
        <?php if ($this->_tpl_vars['date'] == $this->_tpl_vars['selected_date']): ?>
          <td class="selected-day"><?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e") : smarty_modifier_date_format($_tmp, "%e")); ?>
</td>
        <?php elseif (((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m") : smarty_modifier_date_format($_tmp, "%m")) == $this->_tpl_vars['month']): ?>
          <td class="day">
            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['url_format']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['url_format'])); ?>
">
              <?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%e") : smarty_modifier_date_format($_tmp, "%e")); ?>

            </a>
          </td>
        <?php else: ?>
          <td class="day"></td>
        <?php endif; ?>
      <?php endfor; endif; ?>
    </tr>
  <?php endfor; endif; ?>
  <tr>
    <td class="today" colspan="7">
      <?php if ($this->_tpl_vars['today_url'] != ""): ?>
        <a href="<?php echo $this->_tpl_vars['today_url']; ?>
">Today</a>
      <?php else: ?>
        Today
      <?php endif; ?>
    </td>
  </tr>
</table>