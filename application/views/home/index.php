<div>
	<div id="home_grid_div">
		<table id="home_grid"></table>
		<div id="home_pager"></div>
	</div>
	<div id="home_form_div"></div>
</div>
<script type="text/javascript"> 
	$(document).ready(function () {
		$("#home_grid").jqGrid({
			url:"http://trirand.com/blog/phpjqgrid/examples/jsonp/getjsonp.php?callback=?&qwery=longorders", 
			mtype: "GET",
			styleUI : 'Bootstrap',
			datatype: "json",
			colModel: [
				{ label: 'OrderID', name: 'OrderID', key: true, hidden:false, width:100, jsonmap:"OrderID" },
				{ label: 'Customer ID', name: 'CustomerID', editable:true, index:"zone_name", width:200, align:"center", jsonmap:"CustomerID" },
				{ label: 'Order Date', name: 'OrderDate', editable:true, index:"category", width:200, align:"center", jsonmap:"OrderDate" },
				{ label: 'Freight', name: 'Freight', editable:true, index:"note", width:200, align:"center", jsonmap:"Freight" },
				{ label:'Ship Name', name: 'ShipName', editable:true, index:"icon_id", width:200, align:"center", jsonmap:"ShipName" }
			],
			rowNum:10,
			height: 300,
			rownumbers: true,
			autowidth: true,
			rowList:[10,20,30,50,100],
			pager: "#home_pager",
			viewrecords: true,
			multiselect: true, 
			sortorder: "desc",
			footerrow : false, 
			userDataOnFooter : false, 
			caption:"Data",
			editurl:"<?php echo site_url("home/delete"); ?>", 
			jsonReader: { repeatitems : false, id: "0" }
		});
		
		$("#home_grid").jqGrid("navGrid", "#home_pager", {add:false, edit:false, del:false, search:false}, {}, {}, {}, {multipleSearch:false})
		.navButtonAdd('#home_pager',{
			caption:"Add", 
			buttonicon:"glyphicon glyphicon-plus", 
			onClickButton: function(){ 
				alert("Adding Row");
				$("#home_grid_div").hide();
				$("#home_form_div").show();
				$("#home_form_div").load("<?php echo site_url("/home/form/"); ?>");
			}
		})
		.navButtonAdd('#home_pager',{
		   caption:"Edit", 
		   buttonicon:"glyphicon glyphicon-edit", 
		   onClickButton: function(){ 
				var gsr = jQuery("#home_grid").jqGrid("getGridParam","selarrrow");
				if(gsr.length > 0){
				if(gsr.length > 1){
					alert("Please Select Only One Row");
				}
				else{
					$("#home_form_div").show();
					$("#home_grid_div").hide();
					var edit = jQuery("#home_grid").jqGrid("getCell", gsr[0], "id");
					$("#home_form_div").load("<?php echo site_url("home/form/id"); ?>/"+edit);
				}
				} else {
					alert("Please Select Row");
				}
		   }
		});
	});

</script>