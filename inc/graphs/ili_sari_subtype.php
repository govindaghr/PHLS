<script type="text/javascript" src="../FusionCharts/Charts/FusionCharts.js"></script>
<?php 
	include($_SERVER["DOCUMENT_ROOT"]."/ILISARI/config/db_config.php");	
	require_once($_SERVER["DOCUMENT_ROOT"]."/FusionCharts/Includes/FusionCharts.php");
	$cntr=0;
	//echo date("W")-1;
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
	function buildDatasetsProp($result,$seriesName,$chk,$type){
		$strXML = ""; 
		if($chk==0) {$strXML .="<dataset seriesName='".$seriesName."' parentYAxis='S'>";}
		$strXML .= "<set value='".$result."' />";
		if($type=="ILI"){if($chk==6){$strXML .= "</dataset>";}}
		if($type=="SARI"){if($chk==10){$strXML .= "</dataset>";}}
		return $strXML;
	}
?>