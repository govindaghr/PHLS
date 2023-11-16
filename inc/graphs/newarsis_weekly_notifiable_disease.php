<script type="text/javascript" src="../../../../../../FusionCharts/Charts/FusionCharts.js"></script>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");	
	$cntr=0;
	$year=array();$week=array();$revweek=array();$revyear=array();
	for($i=date("W")-1;$i>=1;$i--){
		$week[]=$i;
		$year[]=date("Y");
		$cntr++;
	}
	if($cntr<53){
		$pyear=date("Y")-1;					
		$totwk = new DateTime;
		$totwk->setISODate($pyear, 53);
		if($totwk->format("W") === "53"){$lastwk=53;}
		else{$lastwk=52;}
		for($i=$lastwk;$i>=1;$i--){
			if($cntr==53){break;}
			$week[]=$i;
			$year[]=$pyear;
			$cntr++;	
		}	
	}
	$revweek=array_reverse($week);
	$revyear=array_reverse($year);
	function buildCategoriesND($category){
		$strXML = "";  
		$strXML = "<categories><category label='".$category."' /> </categories>";
		return $strXML;
	}

	function buildDatasetsND($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."'>";}
		$strXML .= "<set value='".$result."'/>";
		if($chk==52){$strXML .= "</dataset>";}
		return $strXML;
	}
	
	//$strXML will be used to store the entire XML document generated
	//Generate the chart element
	$strXML = "<chart caption='Weekly Notifiable Diseases' xAxisName='Week/Year' yAxisName='Cases' showValues='0' formatNumberScale='0' rotateValues='1' animation='1'>";
	
	// Build category XML
	for($i=0;$i<count($revweek);$i++){	
		$strXML.=buildCategoriesND($revweek[$i]."/".substr($revyear[$i],-2));
	}
	
	// SQL query for Mumps
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='11'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"MUM",$i);
	}
	// SQL query for AFP
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='5'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"AFP",$i);
	}	
	// SQL query for Bacterial Meningitis
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='9'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"BMG",$i);
	}	
	// SQL query for Dengue Fever
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='10'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"DGF",$i);
	}	
	// SQL query for Diphtheria
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='12'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"DPT",$i);
	}	
	// SQL query for Malaria
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='15'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"MAL",$i);
	}
	// SQL query for Pertussis
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='16'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"PTS",$i);
	}	
	// SQL query for Rabies (Human)
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='17'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"RBH",$i);
	}		
	// SQL query for Multi-drug Resistance TB
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='19'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"MRT",$i);
	}	
	// SQL query for Tetanus
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='20'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"TTN",$i);
	}	
	// SQL query for Anthrax
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='1'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsND($cs,"ANT",$i);
	}	
	//Finally, close <chart> element
	$strXML .= "</chart>";

	//Create the Line chart from strXML
	echo renderChart("../../../../../../FusionCharts/Charts/StackedColumn2D.swf", "", $strXML, "ND", "100%",350, 0, 1);
?>	