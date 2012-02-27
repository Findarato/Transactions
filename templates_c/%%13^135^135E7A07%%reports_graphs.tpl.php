<?php /* Smarty version 2.6.18, created on 2010-02-19 12:51:34
         compiled from reports_graphs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reports_graphs.tpl', 3, false),)), $this); ?>
<div id="ledgertabs">
	<ul>
		<li><a href="#ledgergraph-1"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %Y") : smarty_modifier_date_format($_tmp, "%B %Y")); ?>
 Balance Sheet</a></li>
		<li><a href="#ledgergraph-2"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Balance Sheet</a></li>
	</ul>
	<div id="ledgergraph-1">
		<div style="width:550px">
			<table style="width:100%; border:solid #FFF thin">
            	<tr>
                	<td style="border-bottom:#FFF thin solid; text-align:center; width:50%">Credit</td>
                    <td style="border-bottom:#FFF thin solid; text-align:center; width:50%">Debit</td>
                </tr>
                <tr>
                	<td style="vertical-align:top; border-right:#FFF thin solid;" rowspan="1">
						<div style="width:100%" id="mCredit"></div>
                    </td>
                    <td style="vertical-align:top;">
						<div style="width:100%" id="mDebit"></div>
                    </td>
                </tr>
            	<tr>
                	<td style="border-top:#FFF thin solid;"><div style="float:right; width:25%; font-weight:bold;" id="idMcredittotal">$<?php echo $this->_tpl_vars['m_creditTotal']; ?>
</div>                    </td>
                    <td style="border-top:#FFF thin solid;"><div style="float:right; width:25%; font-weight:bold;" id="idMdebittotal" >$<?php echo $this->_tpl_vars['m_debitTotal']; ?>
</div></td>
                </tr>
            </table>
			<div style="width:100%; padding-top:2px"><div style="float:right;"> Savings</div><div style="float:right;" id="idMsavings">$<?php echo $this->_tpl_vars['m_Savings']; ?>
</div></div>
        </div>
	</div>
	<div id="ledgergraph-2">
		<div style="width:550px">
			<table style="width:100%; border:solid #FFF thin">
            	<tr>
                	<td style="border-bottom:#FFF thin solid; text-align:center; width:50%">Credit</td>
                    <td style="border-bottom:#FFF thin solid; text-align:center; width:50%">Debit</td>
                </tr>
                <tr>
                	<td style="vertical-align:top; border-right:#FFF thin solid;">
                  		<div style="width:100%" id="yCredit"></div>
                    </td>
                    <td style="vertical-align:top;">
						<div style="width:100%" id="yDebit"></div>
                    </td>
                </tr>
            	<tr>
                	<td style="border-top:#FFF thin solid; "><div style="float:right; width:25%; font-weight:bold;" id="idYcredittotal">$</div></td>
                    <td style="border-top:#FFF thin solid; "><div style="float:right; width:25%; font-weight:bold;" id="idYdebittotal">$</div></td>
                </tr>
            </table>
        </div>
		<div style="width:100%; padding-top:2px"><div style="float:right;"> Savings</div><div style="float:right;"  id="idYsavings">$<?php echo $this->_tpl_vars['y_Savings']; ?>
</div></div>
	</div>
</div>