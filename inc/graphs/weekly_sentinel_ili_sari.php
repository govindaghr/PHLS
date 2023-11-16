<script type="text/javascript" src="../../../../../../FusionCharts/Charts/FusionCharts.js"></script>	
<?php
	include($_SERVER["DOCUMENT_ROOT"]."/ILISARI/config/db_config.php");	
	require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");	
	$cntr=0;
	$year=array();$week=array();$revweek=array();$revyear=array();
	// $p1wk = date("W",strtotime(date('Y'). 'W'.str_pad(date("W"), 2, 0, STR_PAD_LEFT). ' -1 week'));
	if(date("W")==1){
		$yearNow=date("Y")-1;
		$totweek = new DateTime;
		$totweek->setISODate($yearNow, 53);
		if($totweek->format("W") === "53"){$wk=53;}
		else{$wk=52;}
		$yearLast=date("Y")-2;
	}
	else{
		$wk=$i=date("W")-1;
		$yearNow=date("Y");
		$yearLast=date("Y")-1;
	}
	for($i=$wk;$i>=1;$i--){
		$week[]=$i;
		$year[]=$yearNow;
		$cntr++;
	}
	
	// for($i=$p1wk;$i>=1;$i--){ //date("W")-1
		// $week[]=$i;
		// $year[]=date("Y");
		// $cntr++;
	// }
	
	if($cntr<53){
		$pyear=$yearLast;					
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
	function buildCategoriesIS($category){
		$strXML = "";  
		$strXML = "<categories><category label='".$category."' /> </categories>";
		return $strXML;
	}
	function buildDatasetsILI($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."' parentYAxis='P' renderAs='Line'>";}
		$strXML .= "<set value='".$result."'/>";
		if($chk==52){$strXML .= "</dataset>";}
		return $strXML;
	}
	function buildDatasetsSARI($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."' parentYAxis='S'>";}
		$strXML .= "<set value='".$result."' />";
		if($chk==52){$strXML .= "</dataset>";}
		return $strXML;
	}
	
	$strXML = "<chart caption='ILI & SARI Cases Reported from Sentinel Sites' xAxisName='Week/Year' PYAxisName='Number of ILI Cases' SYAxisName='Number of SARI Cases' showValues='0' formatNumberScale='0' rotateValues='1' animation='1'>";
	
	for($i=0;$i<count($revweek);$i++){	
		$strXML.=buildCategoriesIS($revweek[$i]."/".substr($revyear[$i],-2));
	}
	for($i=0;$i<count($revweek);$i++){	
		list($cnt)=mysql_fetch_row(mysql_query("SELECT SUM(ili1)+ SUM(ili2)+SUM(ili3)+SUM(ili4)+SUM(ili5)+SUM(ili6) FROM weekly_ili_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]'"));
		$strXML .= buildDatasetsILI($cnt, "ILI",$i);
	}	
	for($i=0;$i<count($revweek);$i++){	
		list($cnt)=mysql_fetch_row(mysql_query("SELECT SUM(sari1)+SUM(sari2)+SUM(sari3)+SUM(sari4)+SUM(sari5)+SUM(sari6) FROM weekly_sari_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]'"));			
		$strXML .= buildDatasetsSARI($cnt,"SARI",$i);
	} 
	$strXML .= "</chart>";
	echo renderChart("../../../../../../FusionCharts/Charts/MSCombiDY2D.swf", "", $strXML, "ILISARI","100%",350,0,1);
?>
	
