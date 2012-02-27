var Params = {
	"lastArea" :"",
	"content":"",
	"ContentArea":{},
	"bodyClass" : "ledger font-X border-all-B-1",
	"headerClass" : "ledger_top color-D-2 font-X"
};
function isArray(obj) {
	   if (obj.constructor.toString().indexOf("Array") == -1){
		   return false;
	   }else{
	      return true;		   
	   }
	}
//be sure to fix this very soon,
/**
 * 
 * o_data accepts compled objects as well as very basic ones
 * Basic:{0:["1","2","3","4","5","6","7"],1:["1","2","3","4","5","6","7"]};
 * Complex:
 */
function buildTable(o_data,o_target){
	table = $("<div/>",{css:{"display":"table","width":"100%"}}).addClass("generated");
	lables = {};
	$.each(o_data,function(key,tableRowdata){
		table
			.append(
				$("<div/>",{css:{"display":"table-row","width":"100%","box-sizing":"border-box","-moz-box-sizing":"border-box","-webkit-box-sizing":"border-box"}})
					.bind("build_row",{"tableDef":tableRowdata},function(event){
						var o_table = event.data.tableDef;
						for (var v_key in o_table){
							if(!o_table[v_key].o_jQ){//this should be for a simple display
								alert(v_key);
								$(this)
									.append(
										$("<div/>")
											.css({"display":"table-cell","box-sizing":"border-box","-moz-box-sizing":"border-box","-webkit-box-sizing":"border-box"})
											.html(o_table[v_key])
									);
							}else{//Complex display
								$(this)
									.append(
										$("<div/>",o_table[v_key].o_jQ)
											.css({"display":"table-cell","box-sizing":"border-box","-moz-box-sizing":"border-box","-webkit-box-sizing":"border-box"})
											
									);
							}
						}
					}).trigger("build_row")
					
			);
	});
	o_target.append(table);
}
function buildGraph(v_percent,v_class,vertical){
	if(v_percent<0){
		v_class +=" color-R-1";
		v_percent = v_percent * -1;
	}
	v_percentDisplay = v_percent;
	if (v_percent == 0) {
		v_percent = "0px";
	}
		else {v_percent += "%";}
	if (!vertical) {

		var progress = 
			$("<div/>", {css: {"display": "table","width": "100%","height": "100%"}})
				.append(
					$("<div/>", {"class": v_class,	css: {"text-align": "right","display": "table-cell","width": v_percent}})
						.html(v_percentDisplay + "%")
						.fadeIn("slow")
				)
				.append(
					$("<div/>", {css: {"display": "table-cell","width": "auto","height": "auto"}})
				);
	}else{
		
	}
	return progress;
}
function displayChild(id){
var cnt = 0;
var subcat=document.getElementById("subCategory");
subcat.options.length = 0;
$.post("/ajax/child_cate.php",{
		id: id
	}, function(xml) {
		if($("status",xml).text() == "2") return;
		$("child",xml).each(function(id) {
			cnt++
			child = $("child",xml).get(id);
			subcat.options[cnt]=new Option($("name",child).text(),$("id",child).text());
		 }) 
	 });  
}
function addMessages(xml) { 
 error = $("error",xml).text();
 if($("status",xml).text() == "2"){alert(error); return};
 timestamp = $("time",xml).text();
}
function newLoadPayments(){
	
}
function loadCategories(cateId,parentId){
	if(Params.lastArea != "categories"){
		Params.lastArea = "categories";
		Params.content.html($("#genericTpl").html());
		Params.content.find("#genericTitle").html("Categories")		
	}
	//Params.content.html("");
	if (cateId == 0 || cateId < 0 || cateId === undefined) {//This is get all of the categories
		var display = "";
		//Params.content.html($("<div/>",{css:{"background-color":"#FFF","width":"100%"}}));
		$.getJSON("/ajax/display_cate", {
			"f": "json"
		}, function(json){
			$.each(json.result, function(i, item){
				Params.content
					.find("#contentArea")
						.append(
							$("<div/>", {id: "cate" + item.id,"class": "border-all-B-1",css: {"width": "100%","display": "table"}})
								.html(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"},	html: "+",	click: function(){	loadCategories(item.id);}})
								)
								.append(
									$("<div/>", {"class": "font-X",css: {"display": "table-cell"	},html: $("<img/>").attr("src", item.icon)})
										.append(item.cate_name)
								)
								.append(
									$("<div/>", {"class": "font-X",	css: {"display": "table-cell","width": "30px"},	html: "debit"})
								)
								.append(
									$("<div/>", {"class": "font-X",	css: {"display": "table-cell","width": "30px"},	html: "credit"})
								)
								.append(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"}})
										.html(
											$("<img/>")
												.attr({	src: "../images/Icons/delete.png",id: "del" + item.id})
										)
								)
								.append(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"}})
										.html(
											$("<img/>")
												.attr({	src: "../images/Icons/chart_bar_link.png",id: "Graph" + item.id	})
										)
								)
						);
			});
		});
	}
	else {
		if (content.find("#subCate")) {
			content.find("#subCate").replaceWith();
		}else {
			content = $("#cate" + cateId);
			$.getJSON("/ajax/display_cate", {"f": "json","sub": "","id": cateId	}, function(json){
				$.each(json.result, function(i, item){
					content
						.append(
							$("<div/>", {id: "subCate" + item.id,"class": "border-all-B-1 subCate",css: {"width": "100%","display": "table-row"}})
								.html(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"},	html: "-"})
								)
								.append(
									$("<div/>", {"class": "font-X",css: {"display": "table-cell"},html: $("<img/>").attr("src", item.icon)})
										.append(item.cate_name)
								)
								.append(
									$("<div/>", {"class": "font-X",css: {"display": "table-cell","width": "30px"},html: "debit"})
								)
								.append(
									$("<div/>", {"class": "font-X",css: {"display": "table-cell","width": "30px"},html: "credit"})
								)
								.append(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"}})
										.html(
											$("<img/>")
												.attr({src: "../images/Icons/delete.png",id: "del" + item.id})
										)
								)
								.append(
									$("<div/>", {"class": "font-X fakelink",css: {"display": "table-cell","width": "16px"}})
										.html(
											$("<img/>")
												.attr({src: "../images/Icons/chart_bar_link.png",id: "Graph" + item.id})
										)
								)
						);
				});
				
			});
		}
	}
	//Params.content.html(html);
}
function loadPayments(){
	if(Params.lastArea != "payments"){
		Params.lastArea = "payments";
		Params.content.html($("#genericTpl").html());
	}
	$.getJSON("/ajax/payments.php",{format: "json"},
	function(json){
		bodyClass = "ledger font-X";
		headerClass = "ledger_top color-D-2 font-X";
		var o_tableData = {
			0:{
				0:{"o_jQ":{css:{"width":"auto","margin":"2px"},"class":headerClass,html:"Name"}},
				1:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":headerClass,html:"Type"}},
				2:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":headerClass,html:"Interest"}},
				3:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":headerClass,html:"Balance"}},
				4:{"o_jQ":{css:{"width":"50px","margin":"2px"},"class":headerClass,html:"&nbsp;"}},
				5:{"o_jQ":{css:{"width":"18px","margin": "2px"},"class": headerClass,html:"&nbsp;"}},
				6:{"o_jQ":{css:{"width":"18px","margin":"2px"},"class":headerClass,html:"&nbsp;"}}
			}
		};
		
		$.each(json.accounts,function(i,item){
			var total = (item.total);
			o_tableData[item.id] = {
			                         0:{"o_jQ":{css:{"margin":"2px"},html:item.acct_name,"class":bodyClass}},
			                         1:{"o_jQ":{css:{"margin":"2px"},html:item.acct_type,"class":bodyClass}},
			                         2:{"o_jQ":{css:{"margin":"2px"},html:item.interest,"class":bodyClass}},
			                         3:{"o_jQ":{css:{"margin":"2px"},html:"$"+total.toLocaleString(),"class":bodyClass}},
			                         4:{"o_jQ":{css:{"margin":"2px"},html:$("<input/>").attr({type:"text",id:item.id,name:item.id}).css({"width":"50px","text-align":"right"}).val("0").addClass("payform"),"class":bodyClass}},
			                         5:{"o_jQ":{css:{"margin":"2px"},html:$("<img/>").attr({src:"../images/Icons/delete.png",id:item.id}).addClass("fakelinkPay"),"class":bodyClass}},
									 6:{"o_jQ":{css:{"margin":"2px"},html:$("<img/>").attr({src:"../images/Icons/chart_bar_link.png",id:item.id}).addClass("fakelinkPay"),"class":bodyClass}}
									};
			});
			//Add on the footer of the table
			o_tableData[10000] = {
								     0:{"o_jQ":{css:{"margin":"2px"},html:
									 $("<a/>",{"class":"button fakelink color-B-2",css:{"margin-left":"3px","text-decoration":"none","line-height":"20px","height":"20px","font-size":"10px","width":"100px"},html:"Add new account",
										 click:function(){
										 	//do some stuff
											return false;
										 }
									  })
									 }},
			                         1:{"o_jQ":{css:{"margin":"2px"},html:"&nbsp;"}},
									 2:{"o_jQ":{css:{"margin":"2px"},html:"&nbsp;"}},
									 3:{"o_jQ":{css:{"margin":"2px",borderTop:"thin solid"},html:"&#36;"+json.totals.toLocaleString()}},
									 4:{"o_jQ":{css:{"margin":"2px"},html:$("<a/>",{"class":"button fakelink color-B-2",css:{"text-decoration":"none","line-height":"20px","height":"20px","font-size":"10px"},html:"Pay all",
										 click:function(){
										 	$.getJSON("/ajax/add_transaction.php?payment=true&"+$.param($(".payform")),function(json){
												loadPayments();
											});
											return false;
										 }
									  })
									 }},
			                         5:{"o_jQ":{css:{"margin":"2px"},html:"&nbsp;"}},
									 6:{"o_jQ":{css:{"margin":"2px"},html:"&nbsp;"}},
									 7:{"o_jQ":{css:{"margin":"2px"},html:"&nbsp;"}},
			}

		buildTable(o_tableData,$("#contentArea").empty());
/*
			$(".fakelinkPay").click(function(){
				$("#payheader").text($(this).attr("alt"));
				$("#paymentNew").dialog({title:"New Payment", modal: true, overlay: { opacity: 0.5, background: "black" },buttons: {'Post Payment': function() {$.post("/ajax/payments.php",{cate_id: $("#payform>#cate_id").val(), ammount: tbh, id: $("#payform>#paymentid").val()},function(xml){});$(this).dialog('destroy'); },Cancel: function() {$(this).dialog('destroy');}}});
				$("#payform>#paymentid").attr({value: $(this).attr("id")});
				$("#payform>#cate_id").attr({value: $(this).parent().parent().find("input").attr("value")});
				$("input:text#payammount").attr({value:""})
			});
			*/
	});
	
}
function loadLedger(acct_id,search){
	if(Params.lastArea != "ledger"){
		Params.lastArea = "ledger";
		Params.content.html($("#genericTpl").html());
		Params.ContentArea = Params.content.find("#contentArea");
	}
	if(acct_id===null || acct_id=="" || acct_id==undefined){acct_id=0;} // some simple error checking
	urlToload = 'http://transactions.findarato.org/ajax/display_ledger.php'; 
	var params = {"acct":acct_id,"format":"json","page":1,"sidx":"","sord":"asc","rows":15};
	$.getJSON(urlToload,params,function(json){
		if(json.accTitle === null){$("#genericTitle").text("Ledger for: All accounts");
		}else{$("#genericTitle").text("Ledger for: "+json.accTitle+" ($"+json.balance+")");}
		var o_tableData = {
			0:{
				0:{"o_jQ":{css:{"width":"30px","margin":"2px"},"class":Params.headerClass,html:"Acct"}},
				1:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":Params.headerClass,html:"Date"}},
				2:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":Params.headerClass,html:"Credit"}},
				3:{"o_jQ":{css:{"width":"100px","margin":"2px"},"class":Params.headerClass,html:"Debit"}},
				4:{"o_jQ":{css:{"width":"200px","margin":"2px"},"class":Params.headerClass,html:"Category"}},
				5:{"o_jQ":{css:{"width":"auto","margin":"2px","overflow":"hidden"},"class":Params.headerClass,html:"Note"},"text":"Note"},
				6:{"o_jQ":{css:{"width":"20px","margin":"2px"},"class":Params.headerClass,html:"Edit"}}
			}
		};
		
		$.each(json.items,function(t,trans){
			o_tableData[trans.id] = {
			                         0:{"o_jQ":{css:{"margin":"2px"},html:trans.acct_id,"class":Params.bodyClass}},
			                         1:{"o_jQ":{css:{"margin":"2px"},html:trans.dt,"class":Params.bodyClass}},
			                         2:{"o_jQ":{css:{"margin":"2px"},html:trans.credit,"class":Params.bodyClass}},
			                         3:{"o_jQ":{css:{"margin":"2px"},html:trans.debit,"class":Params.bodyClass}},
			                         4:{"o_jQ":{css:{"margin":"2px"},html:trans.cate_name,"class":Params.bodyClass}},
			                         5:{"o_jQ":{css:{"margin":"2px"},html:trans.note,"class":Params.bodyClass}},
			                         6:{"o_jQ":{css:{"margin":"2px"},html:$("<a/>").html("Edit"),"class":Params.bodyClass}}
									};
			});
		buildTable(o_tableData,Params.ContentArea.empty());
		
		Params.ContentArea
			.append(
				$("<canvas width='775px' height='200px' id='Graph_1' />")
			).append(
				$("<canvas width='775px' height='200px' id='Graph_2' />")
			);
	});
	$.getJSON("ajax/display_balance",{"start":"2009-1-1","end":"2010-12-31","account":acct_id,"rt":"1"},function(json){
		var data = [];
		var lables = [];
		$.each(json.items,function(i,item){
			data.push(parseInt(item.total));
			lables.push(json.lables[item.month-1]);
		});
        //var data = [280,45,133,166,84,259,266,960,219,311];
        var bar = new RGraph.Bar('Graph_1', data);
        bar.Set('chart.labels', lables);
        bar.Set('chart.ylabels.count', 3);
		bar.Set('chart.gutter',65);
        bar.Set('chart.background.barcolor1', 'rgba(255,255,255,1)');
        bar.Set('chart.background.barcolor2', 'rgba(255,255,255,1)');
        bar.Set('chart.background.grid', true);
        bar.Set('chart.colors', ['rgba(0,0,0,.60)']);
        bar.Draw();
	
		var data = [];
		$.each(json.items,function(i,item){
			data.push(parseInt(Math.abs(item.RunningTotal)));
		});
        //var data = [280,45,133,166,84,259,266,960,219,311];
        var line = new RGraph.Line('Graph_2', data);
        line.Set('chart.labels', lables);
        line.Set('chart.gutter',45);
        line.Set('chart.background.barcolor1', 'rgba(255,255,255,1)');
        line.Set('chart.background.barcolor2', 'rgba(255,255,255,1)');
		line.Set('chart.linewidth', 2);
		line.Set('chart.ylabels.count', 3);
        line.Set('chart.filled', true);
        line.Set('chart.background.grid', true);
        line.Set('chart.colors', ['rgba(0,0,0,.60)']);
        line.Draw();
		
		
	});
	
	
}
function loadGoals(){//Lets load us some goals
    if(Params.lastArea != "Goals"){
		Params.lastArea = "Goals";
		Params.content.html($("#genericTpl").html());
		Params.content.find("#genericTitle").html("Goals");
		Params.ContentArea = Params.content.find("#contentArea");
	}
	$.getJSON("/ajax/display_goals.php",{"f": "json"},function(json){
		var o_tableData = {
			0:{
				0:{"o_jQ":{css:{"width":"30px","margin":"2px"},"class":Params.headerClass,html:"Budget"}},
				1:{"o_jQ":{css:{"width":"30px","margin":"2px"},"class":Params.headerClass,html:"Days"}},
				2:{"o_jQ":{css:{"width":"75px","margin":"2px"},"class":Params.headerClass,html:"Ammount"}},
				3:{"o_jQ":{css:{"width":"auto","margin":"2px"},"class":Params.headerClass,html:"Progress"}},
				4:{"o_jQ":{css:{"width":"10px","margin":"2px"},"class":Params.headerClass,html:"Edit"}},
				5:{"o_jQ":{css:{"width":"10px","margin":"2px"},"class":Params.headerClass,html:"Delete"}}
			}
		};
		$.each(json.goals,function(g,goal){
			o_tableData[goal.goalid] = {
				0:{"o_jQ":{css:{"width":"30px","margin":"2px"},"class":Params.bodyClass,html:goal.goalname}},
				1:{"o_jQ":{css:{"width":"30px","margin":"2px"},"class":Params.bodyClass,html:goal.frequency}},
				2:{"o_jQ":{css:{"width":"75px","margin":"2px"},"class":Params.bodyClass,html:goal.goalamount}},
				3:{"o_jQ":{css:{"width":"auto","margin":"2px"},"class":Params.bodyClass,html:buildGraph(goal.perdisplay,"gradient-1-both corners-top-2 corners-bottom-2 font-Y border-all-B-1 color-D-1")}},
				4:{"o_jQ":{css:{"width":"10px","margin":"2px"},"class":Params.bodyClass,html:"Edit"}},
				5:{"o_jQ":{css:{"width":"10px","margin":"2px"},"class":Params.bodyClass,html:"Delete"}}
			};
		});
		buildTable(o_tableData,Params.ContentArea.empty());

		Params.ContentArea.append(
			$("<div/>",{id: "newBudgetLink","class": "fakelink",html: "Add new Budget Item",})
				.colorbox({
					iframe: false,
					transition: "none",
					open: false,
					inline: true,
					href: "#newGoaldialog",
					title: "<font class=\"white\">New Budget</font>"
				},
				function () {$(".transactionForm").val("");})
		);
		
	});
	
}

function loadCalendar(){
	$("#content").empty();
	$("#buildarea").empty();
}
function loadReports(month){//Lets load us some goals
	if(Params.lastArea != "reports"){
		Params.lastArea = "reports";
		Params.content.html($("#genericTpl").html());
		Params.content.find("#genericTitle").html("Reports")		
	}
//	this.buildReportsTable("month");
	//Params.content.html($("#reportsTemplate").html());
	$.getJSON("/ajax/display_reports.php",{format: "json","month":month},function(data){
		CA = Params.content.find("#contentArea").empty();
		//Display the Month data
		CA.append($("<div/>",{id:"monthTable1",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#monthTable1").html("Total Savings: $"+data.m_savings+"");
		$("#monthTable1").append($("<div/>",{id:"monthTable",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#monthTable1").append($("<div/>",{id:"monthTableFooter",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#monthTable")
			.html($("<div/>",{"class":"border-all-B-1",id:"monthCredit",css:{"padding-right":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Credit"})}))
			.append($("<div/>",{"class":"border-all-B-1",id:"monthDebit",css:{"padding-left":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Debit"})}));
		$("#monthTableFooter")
			.html($("<div/>",{"class":"",id:"monthCreditFooter",css:{"padding-right":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Credit"})}))
			.append($("<div/>",{"class":"",id:"monthDebitFooter",css:{"padding-left":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Debit"})}));
		$.each(data.am_credit, function(i,item){
			$("#monthCredit").append(
				$("<div/>",{css:{"width":"100%","display":"table"}})
					.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html(item.parent_name+">"+item.cate_name))
					.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+Math.abs(item.credit).toFixed(2)))
			);
		});
		$.each(data.am_debit, function(i,item){
			$("#monthDebit").append(
				$("<div/>",{css:{"width":"100%","display":"table"}})
					.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html(item.parent_name+">"+item.cate_name))
					.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+Math.abs(item.debit).toFixed(2)))
			);
		});
		$("#monthDebitFooter").html(
			$("<div/>",{css:{"width":"100%","display":"table"}})
				.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html("Total:"))
				.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+data.m_debitTotal.toFixed(2)))
		);
		$("#monthCreditFooter").html(
			$("<div/>",{css:{"width":"100%","display":"table"}})
				.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html("Total:"))
				.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+data.m_creditTotal.toFixed(2)))
		);
		//Display the year data. 
		CA.append($("<div/>",{id:"yearTable1",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#yearTable1").html("Total Year Savings: $"+data.y_savings+"");
		$("#yearTable1").append($("<div/>",{id:"yearTable",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#yearTable1").append($("<div/>",{id:"yearTableFooter",css:{"display":"table","width":"100%"},"class":"border-all-B-1"}));
		$("#yearTable")
			.html($("<div/>",{"class":"border-all-B-1",id:"yearCredit",css:{"padding-right":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Credit"})}))
			.append($("<div/>",{"class":"border-all-B-1",id:"yearDebit",css:{"padding-left":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Debit"})}));
		$("#yearTableFooter")
			.html($("<div/>",{"class":"",id:"yearCreditFooter",css:{"padding-right":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Credit"})}))
			.append($("<div/>",{"class":"",id:"yearDebitFooter",css:{"padding-left":"2px","display":"table-cell","width":"50%"},html:$("<div/>",{css:{"display":"block"},html:"Debit"})}));
		$.each(data.ay_credit, function(i,item){
			$("#yearCredit").append(
				$("<div/>",{css:{"width":"100%","display":"table"}})
					.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html(item.parent_name+">"+item.cate_name))
					.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+Math.abs(item.credit).toFixed(2)))
			);
		});
		$.each(data.ay_debit, function(i,item){
			$("#yearDebit").append(
				$("<div/>",{css:{"width":"100%","display":"table"}})
					.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html(item.parent_name+">"+item.cate_name))
					.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+Math.abs(item.debit).toFixed(2)))
			);
		});
		$("#yearDebitFooter").html(
			$("<div/>",{css:{"width":"100%","display":"table"}})
				.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html("Total:"))
				.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+data.y_debitTotal.toFixed(2)))
		);
		$("#yearCreditFooter").html(
			$("<div/>",{css:{"width":"100%","display":"table"}})
				.append($("<div/>",{"class":"",css:{"display":"table-cell","width":"50%"}}).html("Total:"))
				.append($("<div/>",{"class":"",css: {"display": "table-cell","text-align":"right","width":"50%"}}).html("$"+data.y_creditTotal.toFixed(2)))
		);		
	/*	
		Params.content.find("#idYsavings").html("$"+data.y_savings+" ");
		Params.content.find("#idYcredittotal").html("$"+data.y_creditTotal+" ");
		Params.content.find("#idYdebittotal").html("$"+data.y_debitTotal+" ");
		
		$.each(data.ay_credit, function(i,item){
			Params.content.find("#yCredit").append($("<div/>").html(item.parent_name+"."+item.cate_name).addClass("t-reportsleft"));
			Params.content.find("#yCredit").append($("<div/>").html("$"+Math.abs(item.credit-+item.debit).toFixed(2)).addClass("t-reportsright"));
		});
		$.each(data.ay_debit, function(i,item){
			Params.content.find("#yDebit").append($("<div/>").html(item.parent_name+"."+item.cate_name).addClass("t-reportsleft"));
			Params.content.find("#yDebit").append($("<div/>").html("$"+Math.abs(item.credit-+item.debit).toFixed(2)).addClass("t-reportsright"));
		});

*/
	});
}
function resize(){
	var position = $("#topper_search").position();
	var bodHeight = $("#bod").height();
	$("#poper_search").css({position:'absolute',top: position.top+20,left: position.left});
	//$("#footer").css({poistion:'absolute',top:bodHeight-20,left:0}).hide();
	
}
function checkHash(){
	var hash = jQuery.makeArray(window.location.hash.split("\/")); //a sloppy way to do it
	if ($("#topper_name").text() != "Anonymous") {
		if (window.location.hash.length > 1) {
			//This checks for a url passed hash, otherwise its just going to go in there.
			switch (hash[0]) {
				case "#categories":
					if(hash[1]!==null && hash[1]>0){ //this is a sub category request
						loadCategories(hash[1]);
					}else{
						loadCategories();
					} 
				break;
				case "#payments":loadPayments();break;
				case "#goals":loadGoals();break;
				case "#calendar":loadCalendar();break;
				case "#reports":loadReports();break;
				case "#ledger":default:loadLedger(0, "");break;
			}
		}else {
			loadLedger(0, "");
		}
	}
}
$(document).ready(function(){ 
	Params.content = $("#content");
	$("#cboxTitle").addClass("color-E-1 border-all-B-1");
	$("#cboxClose").addClass("ticket_sprite bug");	
	

	
	$("#mnuAddFuel").colorbox({
			iframe: false,
			transition: "none",
			open: false,
			inline: true,
			href: "#newFuelEntrydialog",
			title: "<font class=\"white\">New Fuel</font>"
		}, function () {$(".transactionForm").val("");}); 


	$("#mnuAdd").colorbox({
			iframe: false,
			transition: "none",
			open: false,
			inline: true,
			href: "#newEntrydialog",
			title: "<font class=\"white\">New Transaction</font>"
		}, function () {$(".transactionForm").val("");});
	
	$("#addTransactionBtn").click(function () {
		jQuery.getJSON(uri + "ajax/add_transaction.php", $("#newTransaction").serialize(), function (data) {
			loadLedger($("#transAccount").val());
			$("#frontSavingsByMonth").attr("src","/graph/savingsbymonth.php");	
		});
		$.fn.colorbox.close();
	});
	$("#addGoalBtn")
		.click(function () {
			jQuery.getJSON(uri + "ajax/add_goal.php", $("#newGoalForm").serialize(), function (data) {loadGoals();});
			$.fn.colorbox.close();
		});
	$("#addFuelBtn").click(function () {
		jQuery.getJSON(uri + "ajax/fuel/fuel.php", $("#transactionsFuel").serialize(), function (data) {
			//loadLedger($("#transAccount").val());
			//$("#frontSavingsByMonth").attr("src","/graph/savingsbymonth.php");	
		});
		$.fn.colorbox.close();
	});
	
	
	$("#account_dd").change( function() { 
		loadLedger($(this).val(),"");
	});
	checkHash();


	function pickdates(id){ jQuery("#"+id+"_dt","#acctList").datepicker({dateFormat:"yy-mm-dd"}); } 
	$("#quickAdd").click(function(){$("#qAdd").dialog({ modal: true, overlay: { opacity: 0.5, background: "black" } });	})

	$("#topper_search").toggle(function(){
		var position = $("#topper_search").position();
		$("#popper_search_button").val="";
		$("#poper_search").css({position:'absolute',top: position.top+20,left: position.left});
		$("#poper_search").toggle("blind");
	},function(){$("#poper_search").toggle("blind");});

	$("#popper_search_button").click(function(){ 
		var dtSearch = $("#popper_search_text").val();
		var cateSearch = $("#popper_search_cate").val();
		var urlTopass = "http://transactions.findarato.org/ajax/display_ledger.php?acct=0&format=ajax2";
		if(dtSearch!="" && dtSearch!=null){urlTopass = urlTopass+ "&dtsearch="+dtSearch;}
		if(cateSearch!="ALL"){urlTopass = urlTopass+ "&catesearch="+cateSearch;}
		jQuery("#acctList").setGridParam({url:urlTopass}).trigger("reloadGrid")
		jQuery("#pager").trigger("reloadPager")
		//loadLedger(" http://transactions.findarato.org/ajax/display_ledger.php?acct=0&format=ajax2&dtsearch="+$("#popper_search_text").text()+" ");	
		$("#poper_search").toggle("blind"); })

	
	$("#topper_calculator").toggle(function(){
		var position = $("#topper_calculator").position();
		//$("#popper_search_button").val="";
		$("#popper_calculator").css({position:'absolute',top: position.top+20,left: position.left});
		$("#popper_calculator").toggle("blind");
	},function(){$("#popper_calculator").toggle("blind");});

	$("#popper_search_text").datepicker({dateFormat:"yy-mm-dd"});
	$("#poper_search").hide()
	$("#reportsLoading").hide();
	$("#addtabs").tabs()
	$('ul#icons li').hover(function() { $(this).addClass('ui-state-hover'); },function() { $(this).removeClass('ui-state-hover');});
	/**
 * Live functions
 */

	$(":text").live("click", function () {
		$(this).select();
		$(this).focus();
	});
	$(".Cancel").live("click", function () {
		$.fn.colorbox.close();
	});
	$(".transaction_link,.nolink").live("click", function () {
		setHash($(this).attr("href"));
		checkHash(); //this should load the correct ticket
		return false; //to make sure the a isnt clicked
	});
});