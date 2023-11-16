<script type="text/javascript" src="../FusionCharts/Charts/FusionCharts.js"></script>
<?php		
	include($_SERVER["DOCUMENT_ROOT"]."/ILISARI/config/db_config.php");	
	require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");
	$cntr=0;
	$week=$year=$ilicase=$sarcase=array();
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
	function buildCategories($category){
		$strXML = "";  
		$strXML = "<categories><category label='".$category."' /> </categories>";
		return $strXML;
	}
	function buildDatasets($result,$seriesName,$chk){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."' parentYAxis='P'>";}
		$strXML .= "<set value='".$result."'/>";
		if($chk==52){$strXML .= "</dataset>";}
		return $strXML;
	}
	
	for($i=0;$i<count($revweek);$i++){
		list($ifluah1)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result='Flu A/H1' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));
		$ilifluah1[]=$ifluah1;
		list($ifluah3)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result='Flu A/H3' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));
		$ilifluah3[]=$ifluah3;
		list($ifluapdm)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND 
		ilrt.final_result='Flu A/Pdm09' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));	
		$ilifluapdm[]=$ifluapdm;
		list($ifluah5n1)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result='Flu A/H5N1' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));	
		$ilifluah5n1[]=$ifluah5n1;
		list($ifluah7n9)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result='Flu A/H7N9' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));
		$ilifluah7n9[]=$ifluah7n9;
		list($ifluaunsub)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result='Flu A/Unsubtypable' AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));	
		$ilifluaunsub[]=$ifluaunsub;
		list($iflub)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result IN ('Flu B','Flu B/Yamagata','Flu B/Victoria','Flu B/Lineage Not Determined') AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));
		$iliflub[]=$iflub;	
		list($ifluneg)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM ili_lab_result_table ilrt,ili_specimen_info_table isit,weekly_ili_case_table wict WHERE ilrt.specimen_id=isit.specimen_id AND isit.ws_record_id=wict.record_id AND ilrt.final_result IN ('Negative') AND wict.report_week='$revweek[$i]' AND wict.report_year='$revyear[$i]'"));
		$ilifluneg[]=$ifluneg;	
		
		list($sfluah1)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H1' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarfluah1[]=$sfluah1;	
		list($sfluah3)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H3' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));	
		$sarfluah3[]=$sfluah3;
		list($sfluapdm)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/Pdm09' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));	
		$sarfluapdm[]=$sfluapdm;
		list($sfluah5n1)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H5N1' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarfluah5n1[]=$sfluah5n1;
		list($sfluah7n9)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H7N9' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarfluah7n9[]=$sfluah7n9;
		list($sfluaunsub)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/Unsubtypable' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarfluaunsub[]=$sfluaunsub;
		list($sflub)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result IN ('Flu B','Flu B/Yamagata','Flu B/Victoria','Flu B/Lineage Not Determined') AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarflub[]=$sflub;
		list($srsv)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='RSV' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarrsv[]=$srsv;
		list($shmpv)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='hMPV' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));	
		$sarhmpv[]=$shmpv;	
		list($sfluneg)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result IN ('Negative') AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
		$sarfluneg[]=$sfluneg;
		
		list($ili)=mysql_fetch_row(mysql_query("SELECT SUM(ili1)+ SUM(ili2)+SUM(ili3)+SUM(ili4)+SUM(ili5)+SUM(ili6) FROM weekly_ili_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]'"));
		$ilicase[]=$ili;
		list($sar)=mysql_fetch_row(mysql_query("SELECT SUM(sari1)+SUM(sari2)+SUM(sari3)+SUM(sari4)+SUM(sari5)+SUM(sari6),SUM(total_ipd) FROM weekly_sari_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]'"));
		$sarcase[]=$sar;
	}
	
	$strXML = "<chart caption='Number of ILI & SARI specimen tested and Number of ILI & ARI cases reported' xaxisname='Week' PYaxisname='Number of ILI & SARI specimen tested' SYAxisName='Number of ILI & SARI Cases' decimals='0' showValues='0' setAdaptiveSYMin='1' showPlotBorder='1' palette='2' exportEnabled='1' exportAction='Download' exportAtClient='0' exportHandler='../../FusionCharts/ExportHandlers/PHP/FCExporter.php' exportFileName='Weekly ILI/SARI Case/Subtype'>";
					
	for($i=0;$i<count($revweek);$i++){	$strXML.=buildCategories($revweek[$i]."/".substr($revyear[$i],-2)); }
	$strXML .= "<dataSet>";
	for($i=0;$i<count($revweek);$i++){	
		$tot=$ilifluah1[$i]+$sarfluah1[$i];
		$strXML .= buildDatasets($tot, "Flu A/H1",$i);
	}
	for($i=0;$i<count($revweek);$i++){ 
		$tot=$ilifluah3[$i]+$sarfluah3[$i];
		$strXML .= buildDatasets($tot, "Flu A/H3",$i);
	}
	for($i=0;$i<count($revweek);$i++){ 
		$tot=$ilifluapdm[$i]+$sarfluapdm[$i];
		$strXML .= buildDatasets($tot, "Flu A/Pdm09",$i);
	}
	for($i=0;$i<count($revweek);$i++){ 
		$tot=$ilifluah5n1[$i]+$sarfluah5n1[$i];
		$strXML .= buildDatasets($tot, "Flu A/H5N1",$i);
	}
	for($i=0;$i<count($revweek);$i++){ 
		$tot=$ilifluah7n9[$i]+$sarfluah7n9[$i];
		$strXML .= buildDatasets($tot, "Flu A/H7N9",$i);
	}
	for($i=0;$i<count($revweek);$i++){ 
		$tot=$ilifluaunsub[$i]+$sarfluaunsub[$i];
		$strXML .= buildDatasets($tot, "Flu A/Unsub",$i);
	}
	for($i=0;$i<count($revweek);$i++){
		$tot=$iliflub[$i]+$sarflub[$i];
		$strXML .= buildDatasets($tot, "Flu B",$i);
	}
	for($i=0;$i<count($revweek);$i++){
		$strXML .= buildDatasets($sarrsv[$i],"RSV",$i);
	}
	for($i=0;$i<count($revweek);$i++){
		$strXML .= buildDatasets($sarhmpv[$i],"hMPV",$i);
	} 
	for($i=0;$i<count($revweek);$i++){	
		$tot=$ilifluneg[$i]+$sarfluneg[$i];
		$strXML .= buildDatasets($tot, "Negative",$i);
	}
	$strXML .= "</dataSet>";
	
	$strXML .= "<lineSet seriesname='ILI/SARI Cases'>";
	for($i=0;$i<count($revweek);$i++){	
		$tot=$ilicase[$i]+$sarcase[$i];
		$strXML .= "<set value='$tot' />";
	}
	$strXML .= "</lineSet>";
	$strXML .= "</chart>";
	echo renderChart("../../FusionCharts/Charts/MSStackedColumn2DLineDY.swf", "", $strXML, "graph7",'100%', 350, 0, 1);
 ?>