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
	function buildCategoriesNS($category){
		$strXML = "";  
		$strXML = "<categories><category label='".$category."' /> </categories>";
		return $strXML;
	}

	function buildDatasetsNS($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."'>";}
		$strXML .= "<set value='".$result."'/>";
		if($chk==52){$strXML .= "</dataset>";}
		return $strXML;
	}
	
	//$strXML will be used to store the entire XML document generated
	//Generate the chart element
	$strXML = "<chart caption='Weekly Notifiable Syndromes' xAxisName='Week/Year' yAxisName='Cases' showValues='0' formatNumberScale='0' rotateValues='1' animation='1'>";
	
	// Build category XML
	for($i=0;$i<count($revweek);$i++){	
		$strXML.=buildCategoriesNS($revweek[$i]."/".substr($revyear[$i],-2));
	}
	
	// SQL query for ARI
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='8'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"ARI",$i);
	}
	// SQL query for SARI
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='23'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"SARI",$i);
	}	
	// SQL query for AWD
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='3'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"AWD",$i);
	}	
	// SQL query for ABD
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='2'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"ABD",$i);
	}
	// SQL query for AES
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='4'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"AES",$i);
	}	
	// SQL query for AHFS
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='6'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"AHFS",$i);
	}	
	// SQL query for AJS
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='7'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"AJS",$i);
	}
	// SQL query for FWR
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='13'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"FWR",$i);
	}	
	// SQL query for Food Poisoning
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='14'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"AFP",$i);
	}	
	// SQL query for Congenital Rubella Syndrome
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='18'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"CRS",$i);
	}	
	// SQL query for Typhoid /Paratyphoid Fever
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='21'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"TPF",$i);
	}	
	// SQL query for Rickettsioses
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='24'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"RKS",$i);
	}	
	// SQL query for Unusual Disease(s), Death(s) OR Event(s)
	for($i=0;$i<count($revweek);$i++){	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_weekly_report_table1 wrt1, nd_weekly_report_table2 wrt2 WHERE wrt1.record_id=wrt2.wrt1_record_id AND wrt1.report_week='$revweek[$i]' AND wrt1.report_year='$revyear[$i]' AND wrt2.disease_id='22'"));
		if($cs==""){$cs=0;}
		// Build datasets XML
		$strXML .= buildDatasetsNS($cs,"UDE",$i);
	}	
	//Finally, close <chart> element
	$strXML .= "</chart>";

	//Create the Line chart from strXML
	echo renderChart("../../../../../../FusionCharts/Charts/StackedColumn2D.swf", "", $strXML, "NS", "100%",350, 0, 1);
?>	