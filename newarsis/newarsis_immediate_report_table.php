<?php
/*
 Template Name: NEWARSIS Immediate Repotrs Table
*/
?> 
    <!--<link href="<?php bloginfo('template_directory');?>/datatables/css/jquery.bdt.css" type="text/css" rel="stylesheet">-->
<?php get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<div class="whead"><h3>Immediately Reported Notifiable Diseases <?php echo date("Y"); ?></h3></div>
				 <table class="table table-hover table-bordered" id="bootstrap-table">
					<thead>
						<tr>
							<th class="text-center">Disease/s Reported(Case/Death)</th>
							<th class="text-center">Case Date</th>
							<th class="text-center">Dzongkhag</th>
							<th class="text-center">Reporting Center</th>
							<th class="text-center">Recommendation</th>
							<th class="text-center">Response</th>
						</tr>
					</thead>	
					<tbody>
						<?php
								require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
								$qry=mysql_query("SELECT record_id,case_date,center_id,report_source,receive_date FROM nd_immediate_report_table1 ORDER BY case_date DESC");								
								while(list($rid,$cdt,$ctid,$sr,$rdt)=mysql_fetch_row($qry)){
									list($dzname)=mysql_fetch_row(mysql_query("SELECT mdt.dzongkhag_name FROM ms_health_center_table hct,ms_dzongkhag_table mdt WHERE hct.dzongkhag_code=mdt.dzongkhag_code AND hct.center_id='".$ctid."'"));
									list($ctname)=mysql_fetch_row(mysql_query("SELECT center_name FROM ms_health_center_table WHERE center_id='".$ctid."'"));
									
									$dqry=mysql_query("SELECT disease_id,(g1c+g2c+g3c+g4c+g5c+g6c+g7c+g8c+g9c+g10c+g11c),(g1d+g2d+g3d+g4d+g5d+g6d+g7d+g8d+g9d+g10d+g11d) FROM nd_immediate_report_table2 WHERE irt1_record_id='".$rid."'");
									$dstr="";
									while(list($did,$tc,$td)=mysql_fetch_row($dqry)){
										list($dname)=mysql_fetch_row(mysql_query("SELECT disease_syndrome FROM ms_immediate_reportable_disease_table WHERE disease_id='".$did."'"));
										$dstr.=$dname."(".$tc."/".$td.") &nbsp &nbsp";
									}
									$chkrec=mysql_num_rows(mysql_query("SELECT * FROM nd_immediate_recommendation_table WHERE immediate_id='".$rid."'"));
									list($recid,$rec)=mysql_fetch_row(mysql_query("SELECT mirt.recommendation_id,mirt.recommendation FROM ms_immediate_recommendation_table mirt, nd_immediate_recommendation_table irt WHERE mirt.recommendation_id=irt.recommendation_id AND irt.immediate_id='".$rid."'"));
									if($rec==""){$rec="Not Added";}
									$chkres=mysql_num_rows(mysql_query("SELECT * FROM nd_immediate_response_table WHERE immediate_id='".$rid."'"));
									list($response,$url)=mysql_fetch_row(mysql_query("SELECT mirt.response,irt.response_report_url FROM ms_immediate_response_type_table mirt,nd_immediate_response_table irt WHERE mirt.response_id=irt.response_id AND irt.immediate_id='".$rid."'"));
									if($response==""){$response="Not Added";}
									
									echo("<tr><td>$dstr</td><td>$cdt</td><td>$dzname</td><td>$ctname</td><td>$rec</td><td>$response</td>");
								}
							?>												
					</tbody>
				</table>		
			</div>	
		</div>
	</div>
	</section>
	<!------datatables---------->
<script src="<?php bloginfo('template_directory');?>/datatables/js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/datatables/js/vendor/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/datatables/js/vendor/jquery.sortelements.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory');?>/datatables/js/jquery.bdt.min.js" type="text/javascript"></script>
<script>
    $(document).ready( function () {
        $('#bootstrap-table').bdt({
            showSearchForm: 0,
            showEntriesPerPageField: 0
        });
    });
</script>
	
	
	<?php get_footer('new'); ?>