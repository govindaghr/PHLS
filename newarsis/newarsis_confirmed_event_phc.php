<?php
/*
 Template Name: NEWARSIS Confirmed Event of Public Health 
*/
?>
<?php get_header(); ?>

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<div class="whead"><h3>Confirmed Event of Public Health Concern <?php echo date("Y"); ?></h3></div>
				<table class="table table-hover table-bordered" id="bootstrap-table">
					<thead>
						<tr>
							<th rowspan="2" class="text-center">Event Name</th>
							<th rowspan="2" class="text-center">Event Date</th>
							<th colspan="3" class="text-center">Event Location</th>
							<th rowspan="2" class="text-center">People Affected</th>
							<th rowspan="2" class="text-center">Reported By</th>
							<th rowspan="2" class="text-center">Reporting Center</th>
							<th rowspan="2" class="text-center">Recommendation</th>
							<th rowspan="2" class="text-center">Response</th>
						</tr>
						<tr>
							<th class="text-center">Place</th>
							<th class="text-center">Dzongkhag</th>
							<th class="text-center">Geog</th>
						</tr>
					</thead>	
					<tbody>
						<?php
								require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
								$qry=mysql_query("SELECT event_id,event_date,event_name,event_location,dzongkhag_code,geog_code,reporter_category,reporting_center,population_affected FROM event_report_table WHERE verification_status='02' ORDER BY event_id DESC");
								while(list($eid,$edate,$ename,$eloc,$did,$gid,$cat,$ctid,$popu)=mysql_fetch_row($qry)){
									list($dname)=mysql_fetch_row(mysql_query("SELECT dzongkhag_name FROM ms_dzongkhag_table WHERE dzongkhag_code='".$did."'"));
									list($gname)=mysql_fetch_row(mysql_query("SELECT geog_name FROM ms_geog_table WHERE geog_code='".$gid."'"));
									list($cname)=mysql_fetch_row(mysql_query("SELECT center_name FROM ms_health_center_table WHERE center_id='".$ctid."'"));
									list($rec)=mysql_fetch_row(mysql_query("SELECT mert.recommendation FROM event_recommendation_table ert,ms_event_recommendation_table mert WHERE ert.recommendation_id=mert.recommendation_id AND ert.event_id='".$eid."'"));
									list($res)=mysql_fetch_row(mysql_query("SELECT mert.response FROM event_response_table ert,ms_event_response_type_table mert WHERE ert.response_id=mert.response_id AND ert.event_id='".$eid."'"));
									echo("<tr><td>$ename</td><td class='text-center'>$edate</td><td>$eloc</td><td>$dname</td><td>$gname</td><td class='text-center'>$popu</td><td>$cat</td><td>$cname</td><td>$rec</td><td>$res</td></tr>");
								}	
							?>												
					</tbody>
				</table>		
			</div>	
		</div>
	</div>
	</section>
	<!------datatables--------->
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