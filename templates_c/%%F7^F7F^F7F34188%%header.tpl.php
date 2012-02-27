<?php /* Smarty version 2.6.18, created on 2008-10-23 17:58:12
         compiled from header.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
  <title><?php echo $this->_tpl_vars['title']; ?>
</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
	<link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
css/Refresh.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['path']; ?>
css/global.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['path']; ?>
css/thickbox.css" /> 
<!-- JQuery and plugins -->
	<script src="<?php echo $this->_tpl_vars['path']; ?>
jquery/jquery-1.2.6.pack.js"></script>
   	<script src="<?php echo $this->_tpl_vars['path']; ?>
jquery/jquery-thickbox-3-pack.js"></script>
   	<script src="<?php echo $this->_tpl_vars['path']; ?>
jquery/jquery-progressbar.js"></script>
<!--    <script src="<?php echo $this->_tpl_vars['path']; ?>
js/json.js"></script> -->

<script>
<?php echo '
function loadLedger(account,limit){
var c=0;
$.get("/ajax/display_ledger.php",{
		acct: account,
		limit: limit,
		format:"ajax"
	}, function(xml) {
		if($("status",xml).text() == "2") return
		$("#ledgerDisplay").empty();
		$("l",xml).each(function(ledger) {
			ledger = $("l",xml).get(ledger)
			c++
			$("<tr id="+c+"></tr>").appendTo("#ledgerDisplay");			
			$("<td class=\'acct\'>"+$("acct_id",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'columnheader\'>"+$("dt",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'columnheader\'>"+$("ckno",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'columnheader\'>"+$("credit",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'columnheader\'>"+$("debit",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'columnheader\'>"+$("category",ledger).text()+"</td>").appendTo("#"+c)
			$("<td class=\'note\'>"+$("note",ledger).text()+"</td>").appendTo("#"+c)
			if(c%2==1){$("#"+c).addClass("even")}else{$("#"+c).addClass("odd")}
		 }); 
	 });
}
//load the ledger using JSON
function loadLedgerJSON(account,limit){
var c=0;
$.getJSON("/ajax/display_ledger.php",{ acct: account,limit: limit,format:"json"},
	function(data) {
		$.each(data.items, function(i,item){
		alert(item.id);
		$("#ledgerDisplay").empty();
		 });  
	 });
}
function displayChild(id){
var cnt = 0;
var subcat=document.getElementById("subCategory");
subcat.options.length = 0
$.post("/ajax/child_cate.php",{
		id: id,
	}, function(xml) {
		if($("status",xml).text() == "2") return;
		$("child",xml).each(function(id) {
			child = $("child",xml).get(id);
			subcat.options[cnt++]=new Option($("name",child).text(),$("id",child).text());
		 }); 
	 });
}
function editInline(id){//allows for inline text editing of ledger
	var obj = document.getElementById(id);
	var newTextbox = document.createElement("INPUT");	
	newTextbox.type = \'text\';
	var width = obj.innerHTML.length;
	if(width < 3) {width=5;}
	var fields = obj.id.split("|");
	if(fields[0]==\'category\'){
		alert(\'This field is broken atm\');
		var newSelectM = document.createElement("SELECT");
		var newSelectS = document.createElement("SELECT");
		
		//javascript:displayChild(this.options[this.selectedIndex].value)
		newSelectM.id="Medit|"+id;
		newSelectM.name="parentCategory";

		newSelectS.id="edit|"+id;
		newSelectS.name="subCategory";
		newSelectS.style.width = width+"em";
		obj.innerHTML ="";
		newSelectM.addEventListener("click",function () {displayChild(this.options[this.selectedIndex].value)},false);
		obj.appendChild(newSelectM);
		obj.appendChild(newSelectS);
	}else{
		newTextbox.style.width = width+"em";
		newTextbox.id="edit|"+id;
		newTextbox.value = obj.innerHTML;
		newTextbox.addEventListener("blur",function () {updateInline(id);},false);
		obj.innerHTML ="";
		obj.appendChild(newTextbox); 
		var editobj = document.getElementById("edit|"+id);
		editobj.focus(); 
	}
}
function updateInline(id){//revert to whatever is in the text box
	var obj = document.getElementById(id);
	var editobj = document.getElementById("edit|"+id);
	var fields = editobj.id.split("|"); //split the ID for easier access
	$.post("/ajax/update_ledger.php",{
		id: fields[2],
		colmn: fields[1],
		value: editobj.value,
	}, function(xml) {
		addMessages(xml);
		obj.innerHTML = editobj.value;
	 });
}

function addMessages(xml) {
 error = $("error",xml).text();
 if($("status",xml).text() == "2"){alert(error); return};
 timestamp = $("time",xml).text();
}

function toggleDiv(id){
	var start = "1.5em";
	var show = "auto";
	obj = document.getElementById(id);
	if(obj.style.height == start)
		obj.style.height = show;
	else
		obj.style.height = start;
}
'; ?>

</script>
</head>