<script type="text/javascript" src="/highcharts/code/jquery.min.js"></script>
<script src="/highcharts/code/highcharts.js"></script>
<script src="/highcharts/code/modules/offline-exporting.js"></script>

<div id="weekly_sentinel_ili_sari" style="height:350px; margin: auto auto"></div>
<?php		
	include($_SERVER["DOCUMENT_ROOT"]."/ILISARI/config/db_config.php");	
	$cntr=0;
	$week=$year=$wk_yr=$ili=$sari=array();
	if(date("W")==1){
		$yearNow=date("Y")-1;
		$totweek = new DateTime;
		$totweek->setISODate($yearNow, 53);
		if($totweek->format("W") === "53"){
			$wk=53;
			}
		else{
			$wk=52;
			}
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
	
	// Build category XML
	for($i=0;$i<count($revweek);$i++){
		$wk_yr[] = $revweek[$i]."/".substr($revyear[$i],-2);
	}
	$data_wk_yr = json_encode($wk_yr);
	
	// SQL query for ILI cases	
	for($i=0;$i<count($revweek);$i++){		
		$ilisq=mysql_query("SELECT SUM(ili1)+ SUM(ili2)+SUM(ili3)+SUM(ili4)+SUM(ili5)+SUM(ili6) as ili FROM weekly_ili_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]' GROUP BY report_week,report_year");
		$ili[] = mysql_fetch_row($ilisq);
	}	
	$data_ili = json_encode($ili,JSON_NUMERIC_CHECK);
	
	// SQL query for SARI cases
	for($i=0;$i<count($revweek);$i++){	
		$sarisq = mysql_query("SELECT SUM(sari1)+SUM(sari2)+SUM(sari3)+SUM(sari4)+SUM(sari5)+SUM(sari6) FROM weekly_sari_case_table WHERE report_week='$revweek[$i]' AND report_year='$revyear[$i]'");
		$sari[] = mysql_fetch_row($sarisq);
	} 
	$data_sari = json_encode($sari,JSON_NUMERIC_CHECK);
	?>
	
	
	
	
<script type="text/javascript">

$(function () {
// Highcharts supports line, spline, area, areaspline, column, bar, pie, scatter, angular gauges, arearange, areasplinerange, columnrange and polar chart
    var data_ili = <?php echo $data_ili; ?>;
    var data_sari = <?php echo $data_sari; ?>;
    var data_wk_yr = <?php echo $data_wk_yr; ?>;

	Highcharts.chart('weekly_sentinel_ili_sari', {
		chart: {
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
			text: 'Weekly Sentinel ILI & SARI Surveillance',
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
			labels: {
				format: '{value}',
				style: {
					color: Highcharts.getOptions().colors[0]
				}
			},
			title: {
				text: 'No. of ILI Cases',
				style: {
					color: Highcharts.getOptions().colors[0],
					fontSize: '10px'
				}
			},
		}, 
		{ // Secondary yAxis
			gridLineWidth: 0,
			title: {
				text: 'No. of SARI Cases',
				style: {
					color: Highcharts.getOptions().colors[1],
					fontSize: '10px'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: Highcharts.getOptions().colors[1]
				}
			},
			opposite: true
		}],
		tooltip: {
			shared: true,
			valueSuffix: ' Cases',
			style: {
				fontSize: '9px'
			}
		},
		legend: {
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)',
			fontSize: '10px'
		},
		series: [{
			name: 'ILI',
			type: 'column',
			yAxis: 0,
			data: data_ili
		}, {
			name: 'SARI',
			type: 'spline',
			yAxis: 1,
			data: data_sari,
		}]
	});
});


</script>