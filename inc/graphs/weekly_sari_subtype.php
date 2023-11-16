<?php		
					//$strXML will be used to store the entire XML document generated
					//Generate the chart element
					$strXML = "<chart caption='Number of SARI specimen positive for influenza virus by subtype' subcaption='for past 1 year'  xaxisname='Week/Year' PYaxisname='No of positive specimen' SYAxisName='% positive' decimals='0' showValues='0' setAdaptiveSYMin='1' showPlotBorder='1' palette='2' exportEnabled='1' exportAction='Download' exportAtClient='0' exportHandler='../FusionCharts/ExportHandlers/PHP/FCExporter.php' exportFileName='Weekly SARI Subtype Graph'>";
					
					// Build category XML
					for($i=0;$i<count($revweek);$i++){	
						$strXML.=buildCategories($revweek[$i]."/".substr($revyear[$i],-2));
					}
					// Build datasets XML
					$strXML .= "<dataSet>";
						for($i=0;$i<count($revweek);$i++){
							list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H1' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));				
							$strXML .= buildDatasets($cnt, "Flu A/H1",$i);
						}
						for($i=0;$i<count($revweek);$i++){
							list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H3' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));				
							$strXML .= buildDatasets($cnt, "Flu A/H3",$i);
						}
						for($i=0;$i<count($revweek);$i++){
							list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/Pdm09' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));	
							$strXML .= buildDatasets($cnt, "Flu A/Pdm09",$i);
						}
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H5N1' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "Flu A/H5N1",$i);
					}
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/H7N9' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "Flu A/H7N9",$i);
					}
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='Flu A/Unsubtypable' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "Flu A/Unsubtypable",$i);
					}
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result IN ('Flu B','Flu B/Yamagata','Flu B/Victoria','Flu B/Lineage Not Determined') AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "Flu B",$i);
					}
					
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='RSV' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "RSV",$i);
					}
					for($i=0;$i<count($revweek);$i++){
						list($cnt)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result='hMPV' AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));		
						// Build datasets XML
						$strXML .= buildDatasets($cnt, "hMPV",$i);
					}	 
					$strXML .= "</dataSet>";
					// Build lineset XML for % positive
					$strXML .= "<lineSet seriesname='% positive'>";
						for($i=0;$i<count($revweek);$i++){
							list($totsample)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE ssit.ws_record_id=wsct.record_id AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));
							list($totpos)=mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sari_lab_result_table slrt,sari_specimen_info_table ssit,weekly_sari_case_table wsct WHERE slrt.specimen_id=ssit.specimen_id AND ssit.ws_record_id=wsct.record_id AND slrt.final_result NOT IN ('Negative','Adeno Virus','Pending') AND wsct.report_week='$revweek[$i]' AND wsct.report_year='$revyear[$i]'"));	
							if($totsample!=0){$percentpos=($totpos/$totsample)*100;} else{$percentpos=0;}	
							$strXML .= "<set value='$percentpos' />";
						}
					$strXML .= "</lineSet>";
					//Finally, close <chart> element
					$strXML .= "</chart>";
					
					//Create the Line chart from strXML
					echo renderChart("../FusionCharts/Charts/MSStackedColumn2DLineDY.swf", "", $strXML, "SARI", "100%",350,0,1);
				 ?>