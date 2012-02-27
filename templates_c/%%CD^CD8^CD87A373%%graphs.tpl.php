<?php /* Smarty version 2.6.18, created on 2010-02-19 12:51:34
         compiled from fuel/graphs.tpl */ ?>
<div id="graphtabs">
	<ul>
		<li><a href="#fuelgraph-1">Miles per Month</a></li>
		<li><a href="#fuelgraph-2">MpG per Month</a></li>
   		<li><a href="#fuelgraph-3">Price per Unit</a></li>
   		<li><a href="#fuelgraph-4">Total Spent</a></li>
   		<li><a href="#fuelgraph-5">Price per Min/Max</a></li>

	</ul>
	<div id="fuelgraph-1">
    <span id="mpm1y">1 Year</span><span id="mpm2y">2 Year</span>
		<img src="../graph/gas_mpm.php" alt="Miles per Month">
	</div>
	<div id="fuelgraph-2">
		<img src="../graph/gas_mpgpm.php" alt="Miles per Unit per Month">
	</div>
	<div id="fuelgraph-3">
		<img src="../graph/gas_ppgpm.php" alt="Price per Unit per Month">
	</div>
	<div id="fuelgraph-4">
		<img src="../graph/gas_spentpm.php" alt="Total spent per Month">
	</div>
	<div id="fuelgraph-5">
		<img src="../graph/gas_ppgpm2.php" alt="Price per Unit per min/max">
	</div>    
</div>