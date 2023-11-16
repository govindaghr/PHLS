<script type="text/javascript" src="../../../../../../FusionCharts/Charts/FusionCharts.js"></script>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");	
	$yrno=date("Y");
	function buildCategoriesIM($category){
		$strXML = "";  
		$strXML = "<categories><category label='".$category."' /> </categories>";
		return $strXML;
	}

	function buildDatasetsIM($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==1) {$strXML .="<dataset seriesName='".$seriesName."'>";}
		$strXML .= "<set value='".$result."' />";
		if($chk==12){$strXML .= "</dataset>";}
		return $strXML;
	}

	//$strXML will be used to store the entire XML document generated
	//Generate the chart element
	$strXML = "<chart caption='Immediately Reportable Syndromes/Diseases for $yrno' xAxisName='Month' yAxisName='Cases' showValues='0' formatNumberScale='0' rotateValues='1' animation='1'>";

	// Build category XML
	for($i=1;$i<=12;$i++){	
		$monthName=date('M',mktime(0,0,0,$i,10));
		$strXML.=buildCategoriesIM($monthName);
	}					 
	 // SQL query for Anthrax(Suspected)
	 for($i=1;$i<=12;$i++){
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='100'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"ANT",$i);
	 }
	 
	 // SQL query for Acute Flaccid Paralysis (Suspected Poliomyelitis)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='101'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"AFP",$i);
	 }
	 
	 // SQL query for Acute Haemorrhagic Fever Syndrome(Suspected)
	 for($i=1;$i<=12;$i++){
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='102'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"AHF",$i);
	 }
	 
	 // SQL query for Avian Influenza (Suspected)
	 for($i=1;$i<=12;$i++){
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";		
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='103'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"AIF",$i);
	 }
	 
	// SQL query for Bacterial Meningitis (Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='104'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"BMG",$i);
	 }
	
	 // SQL query for Cholera (Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='105'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"CHL",$i);
	 }
	
	// SQL query for Malaria(Microscopy/RDT Confirmed)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='106'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"MAL",$i);
	}
	
	// SQL query for Measles (Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='107'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"MSL",$i);
	}
	
	// SQL query for Pertussis (Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='108'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"PTS",$i);
	}
	
	// SQL query for Pneumonia Plaque(Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='109'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"PPQ",$i);
	}
	
	// SQL query for Rabies(Human)(Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='110'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"RBH",$i);
	}
	
	// SQL query for Rubella(Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='111'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"RUB",$i);
	}
	
	// SQL query for Neonatal Tetanus(Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='112'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"NTN",$i);
	}
	
	// SQL query for Acute Encephalitis Syndrome(Suspected)
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='114'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"AES",$i);
	}
	
	// SQL query for Zika Virus
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='115'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"ZKV",$i);
	}
	 
	// SQL query for Unusual Death/s
	 for($i=1;$i<=12;$i++){	
		$sdate=$yrno."-".$i."-1";
		$edate=$yrno."-".$i."-31";	
		list($cs)=mysql_fetch_row(mysql_query("SELECT SUM(g1c)+SUM(g2c)+SUM(g3c)+SUM(g4c)+SUM(g5c)+SUM(g6c)+SUM(g7c)+SUM(g8c)+SUM(g9c)+SUM(g10c)+SUM(g11c) FROM nd_immediate_report_table1 irt1,nd_immediate_report_table2 irt2 WHERE irt1.record_id=irt2.irt1_record_id AND irt1.case_date>='$sdate' AND irt1.case_date<='$edate' AND irt2.disease_id='113'"));
		if($cs==""){$cs=0;}
		 // Build datasets XML
		$strXML .= buildDatasetsIM($cs,"UDE",$i);
	} 
	//Finally, close <chart> element
	$strXML .= "</chart>";

	//Create the Line chart from strXML
   echo renderChart("../../../../../../FusionCharts/Charts/StackedColumn2D.swf", "", $strXML, "IM","100%",350,0,1);
?>