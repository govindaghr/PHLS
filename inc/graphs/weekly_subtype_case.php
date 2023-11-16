<script type="text/javascript" src="/highcharts/code/jquery.min.js"></script>
<script src="/highcharts/code/highcharts.js"></script>
<script src="/highcharts/code/modules/offline-exporting.js"></script>

<div id="weekly_subtype_case" style="height:350px; margin: auto auto"></div>
<?php		
	include($_SERVER["DOCUMENT_ROOT"]."/ILISARI/config/db_config.php");	
	//require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");
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
	
	$fluA_H1=$fluA_H3=$fluA_Pdm09=$fluA_H5N1=$fluA_H7N9=$fluA_Unsub=$fluB=$sarrsv=$sarhmpv=$negative=$ili_sar_tot=array();
	
	// Build category XML
	for($i=0;$i<count($revweek);$i++){
		$wk_yr[] = $revweek[$i]."/".substr($revyear[$i],-2);
	}
	$data_wk_yr = json_encode($wk_yr);
	
	for($i=0;$i<count($revweek);$i++){	
		$fluA_H1[]=$ilifluah1[$i]+$sarfluah1[$i];
	}
	$fluA_H1 = json_encode($fluA_H1,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){ 
		$fluA_H3[]=$ilifluah3[$i]+$sarfluah3[$i];
	}
	$fluA_H3 = json_encode($fluA_H3,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){ 
		$fluA_Pdm09[]=$ilifluapdm[$i]+$sarfluapdm[$i];
	}
	$fluA_Pdm09 = json_encode($fluA_Pdm09,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){ 
		$fluA_H5N1[]=$ilifluah5n1[$i]+$sarfluah5n1[$i];
	}
	$fluA_H5N1 = json_encode($fluA_H5N1,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){ 
		$fluA_H7N9[]=$ilifluah7n9[$i]+$sarfluah7n9[$i];
	}
	$fluA_H7N9 = json_encode($fluA_H7N9,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){ 
		$fluA_Unsub[]=$ilifluaunsub[$i]+$sarfluaunsub[$i];
	}
	$fluA_Unsub = json_encode($fluA_Unsub,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){
		$fluB[]=$iliflub[$i]+$sarflub[$i];
	}
	$fluB = json_encode($fluB,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){
		$sarrsv[]=$sarrsv[$i];
	}
	$sarrsv = json_encode($sarrsv,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){
		$sarhmpv[]=$sarhmpv[$i];
	}
	$sarhmpv = json_encode($sarhmpv,JSON_NUMERIC_CHECK);
	
	for($i=0;$i<count($revweek);$i++){	
		$negative[]=$ilifluneg[$i]+$sarfluneg[$i];
	}
	$negative = json_encode($negative,JSON_NUMERIC_CHECK);
	
	// $strXML .= "<lineSet seriesname='ILI/SARI Cases'>";
	for($i=0;$i<count($revweek);$i++){	
		$ili_sar_tot[]=$ilicase[$i]+$sarcase[$i];
	}
	$ili_sar_tot = json_encode($ili_sar_tot,JSON_NUMERIC_CHECK);
 ?>
 
 <script type="text/javascript">

$(function () {
// Highcharts supports line, spline, area, areaspline, column, bar, pie, scatter, angular gauges, arearange, areasplinerange, columnrange and polar chart
    var data_wk_yr = <?php echo $data_wk_yr; ?>;
    var fluA_H1 = <?php echo $fluA_H1; ?>;
    var fluA_H3 = <?php echo $fluA_H3; ?>;
    var fluA_Pdm09 = <?php echo $fluA_Pdm09; ?>;
    var fluA_H5N1 = <?php echo $fluA_H5N1; ?>;
    var fluA_H7N9 = <?php echo $fluA_H7N9; ?>;
    var fluA_Unsub = <?php echo $fluA_Unsub; ?>;
    var fluB = <?php echo $fluB; ?>;
    var sarrsv = <?php echo $sarrsv; ?>;
    var sarhmpv = <?php echo $sarhmpv; ?>;
    var negative = <?php echo $negative; ?>;
    var ili_sar_tot = <?php echo $ili_sar_tot; ?>;

	Highcharts.chart('weekly_subtype_case', {
		chart: {
			type: 'column',
			zoomType: 'xy'
		},
		credits: {
			enabled: false
		},
		exporting:{
			chartOptions:{
				plotOptions:{
					series:{
						dataLabels:{
							enabled:false,
						}
					}
				}
			},
			scale:3,
			fallbackToExportServer: false
		},
		title: {
			text: 'Number of ILI & SARI Specimen Tested and Number of ILI & ARI Cases Reported',
			style: {
				// color: '#FF00FF',
				fontSize: '14px',
				fontWeight: 'bold'
			}
		},
		xAxis: [{
			categories: data_wk_yr,
			crosshair: true,
			title: {
				text: 'Week/Year',
				fontSize: '10px'
				}
		}],
		yAxis: [{ // Primary yAxis
			min: 0,
			legend: {
				reversed: true
			},
			labels: {
				format: '{value}',
				style: {
					color: Highcharts.getOptions().colors[1]
				}
			},
			title: {
				text: 'No. of ILI & SARI Specimen Tested',
				style: {
					color: Highcharts.getOptions().colors[1],
					fontSize: '10px',
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: Highcharts.getOptions().colors[1],
					fontSize: '10px'
				}
			},
		}, 
		{ // Secondary yAxis
			gridLineWidth: 0,
			min: 0,
			title: {
				text: 'No. of ILI & SARI Cases',
				style: {
					color: Highcharts.getOptions().colors[0],
					fontSize: '10px'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: Highcharts.getOptions().colors[0]
				}
			},
			opposite: true
		}],
		
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		tooltip: {
			shared: true,
			valueSuffix: ' Cases',
			style: {
				fontSize: '9px'
			}
		},
		legend: {
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)',
			itemStyle: {
				// color: '#000000',
				// fontWeight: 'bold',
				fontSize: '10px'
			}
		},
		series: [{
			name: 'Total ILI & SARI Cases',
			type: 'spline',
			yAxis: 1,
			data: ili_sar_tot,
		},{
			name: 'Flu A/H1',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_H1
		},{
			name: 'Flu A/H3',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_H3
		},{
			name: 'Flu A/Pdm09',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_Pdm09
		},{
			name: 'Flu A/H5N1',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_H5N1
		},{
			name: 'Flu A/H7N9',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_H7N9
		},{
			name: 'Flu A/Unsub',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluA_Unsub
		},{
			name: 'Flu B',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: fluB
		},{
			name: 'RSV',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: sarrsv
		},{
			name: 'HMPV',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: sarhmpv
		},{
			name: 'ILI/SARI Negative',
			// type: 'column',
			// stack: 'ghimry',
			yAxis: 0,
			data: negative
		}]
	});
});

</script>