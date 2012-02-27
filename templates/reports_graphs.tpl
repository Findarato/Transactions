<div id="ledgertabs">
	<ul>
		<li><a href="#ledgergraph-1">{$smarty.now|date_format:"%B %Y"} Balance Sheet</a></li>
		<li><a href="#ledgergraph-2">{$smarty.now|date_format:"%Y"} Balance Sheet</a></li>
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
                	<td style="border-top:#FFF thin solid;"><div style="float:right; width:25%; font-weight:bold;" id="idMcredittotal">${$m_creditTotal}</div>                    </td>
                    <td style="border-top:#FFF thin solid;"><div style="float:right; width:25%; font-weight:bold;" id="idMdebittotal" >${$m_debitTotal}</div></td>
                </tr>
            </table>
			<div style="width:100%; padding-top:2px"><div style="float:right;"> Savings</div><div style="float:right;" id="idMsavings">${$m_Savings}</div></div>
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
		<div style="width:100%; padding-top:2px"><div style="float:right;"> Savings</div><div style="float:right;"  id="idYsavings">${$y_Savings}</div></div>
	</div>
</div>