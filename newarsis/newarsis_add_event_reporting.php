<?php
/*
 Template Name: NEWARSIS Event Reporting 
*/

?>
<?php	
	require_once($_SERVER["DOCUMENT_ROOT"]."/COMMON/config/db_config.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
?>
<link href="/COMMON/css/styles_new.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/COMMON/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/ui.spinner.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="/COMMON/js/jquery-1.8.2.min.js"></script>
<?php get_header(); ?>
	
	<script>	
		$(document).ready(function(){
			$(".datepicker").datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
			$("#form").validationEngine({binded:false});
		});
	</script>
	<script type="text/javascript">
		function displayFields(type) {
			if(type=="3"){
				document.getElementById("hcdiv").style.display = 'none';
				document.getElementById("hpdiv").style.display = 'none';	
				document.getElementById("cidiv").style.display = 'none';
			}
			if(type=="2"){
				document.getElementById("hcdiv").style.display = 'none';
				document.getElementById("hpdiv").style.display = 'block';	
				document.getElementById("cidiv").style.display = 'block';
			}
			if(type=="1" || type==""){
				document.getElementById("hcdiv").style.display = 'block';
				document.getElementById("hpdiv").style.display = 'none';	
				document.getElementById("cidiv").style.display = 'block';
			}
		}
	</script>
	<script type="text/javascript" src="/COMMON/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine.js"></script>
	
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<form id="form" class="main" method="Post" action="/NEWARSIS/event_report/save_public_event_report.php">					
					<div class="whead"><h3>Public Health Event Reporting</h3><div class="clear"></div></div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12"><h4>Reporter Information</h4></div>
							<div class="col-md-4"><label>Name of Reporter:<span class="req">*</span></label>
							<input type="text" class="validate[required] form-control" name="reporter" id="reporter" placeholder="Name of Reporter"/></div>
							<div class="col-md-4"><label>Mobile Number of Reporter:<span class="req">*</span></label>
							<input type="text"  name="mobileno" id="mobileno" class="form-control validate[required,custom[integer],minSize[8],maxSize[8]]"/></div>
							<div class="col-md-4"><label>Reporter Category:<span class="req">*</span></label>
								<select name="category" id="category" class="validate[required] form-control" onchange="displayFields(this.value);">
									<option value="">Select Category</option>
									<?php 	
										 $qry=mysql_query("SELECT id, value FROM ms_event_reporter_category_table ORDER BY id DESC");
										 while(list($catid,$catname)=mysql_fetch_row($qry)){	
											 echo("<option value='$catid'>$catname</option>");
										 }
									?>
								</select>
							</div>
						</div>
						<div class="row">							
							<div id="hcdiv" style="display:none;">	
								<div class="col-md-6"><label>Name of Health Center(<i>If Reporter is Health Worker</i>):</label>
									<select name="center" id="center" class="form-control validate[required]">
										<option value="">Select Center</option>
									<?php 	
										 $qry=mysql_query("SELECT center_id,center_name FROM commondb.ms_health_center_table ORDER BY dzongkhag_code ASC,center_name ASC");
										 while(list($ctid,$ctname)=mysql_fetch_row($qry)){	
											 echo("<option value='$ctid'>$ctname</option>");
										 }
									?>	
									</select>
								</div>
							</div>
							<div id="hpdiv" style="display:none;">									
								<div class="col-md-6"><label>Allied Healthcare Professional Type(<i>If Reporter is Allied Healthcare Professionals</i>):</label>
									<select name="type" id="type" class="form-control validate[required]">
										<option value="">Select Professional Type</option>
									<?php 	
										 $qry=mysql_query("SELECT id, value FROM ms_event_allied_healthcare_type_table WHERE id !='99' ORDER BY id DESC");
										 while(list($ptypeid,$ptypename)=mysql_fetch_row($qry)){	
											 echo("<option value='$ptypeid'>$ptypename</option>");
										 }
									?>									
									</select>
								</div>									
							</div>			
						</div>
						<div class="row">
							<div class="col-md-12"><h4>Event Information</h4></div>	
							<div class="col-md-6"><label>What do you want to report?(<i>Name of event/suspected outbreak</i>):<span class="req">*</span></label>
							<textarea name="ename" id="ename" class="form-control validate[required]"> </textarea></div>
							<?php
								$curdt=date_create(date("Y-m-d"));
								date_sub($curdt,date_interval_create_from_date_string("15 days"));
								$dtline=date_format($curdt,"Y-m-d");
							?>
							<div class="col-md-6"><label class="col-md-12">When did this happen?(<i>Date/Time of Event</i>):<span class="req">*</span></label>
							<div class="col-md-6">
								<input type="hidden" class="form-control datepicker validate[required,custom[date],past[NOW]]" name="dtline" id="dtline" value="<?php echo $dtline;?>"/>
								<input type="text" class="form-control datepicker validate[required,custom[date],future[#dtline],past[NOW]]" name="edate" id="edate" placeholder="Date" col />
							</div>
							<div class="col-md-6"><input type="time" class="form-control timepicker" size="10" name="etime" id="etime" value="09:30:00" /></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5"><label>Where did this happen?(<i>Location of Event</i>):<span class="req">*</span></label>
							<textarea name="elocation" id="elocation" class="form-control validate[required]"> </textarea></div>
							<div class="col-md-5"><label>How many people have been affected?(<i>Number of cases/people affected</i>):<span class="req">*</span></label>
							<input type="text"  name="popuaffected" id="popuaffected" class="form-control textC validate[required,custom[number]]"/></div>
							<div class="col-md-2"><label>How many people died?:<span class="req">*</span></label>
							<input type="text"  name="death" id="death" class="form-control textC validate[required,custom[number]]" value="0"/></div>
						</div>
						<div id="cidiv" style="display:none;">		
							<div class="row">
								<div class="col-md-6"><label>Mention common signs & symptoms(<i>Clinical Information</i>):</label>
								<textarea name="signsymptoms" class="form-control" id="signsymptoms"> </textarea></div>
								<div class="clear"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6"><label>Do you have any other information?:</label>
							<textarea name="otherinfo" class="form-control" id="otherinfo"> </textarea></div>								
						</div>
					</div>
					<div class="body" align="center">
						<input type="submit" value="Report Event" class="btn btn-default buttonM bGreen" />								
					</div>
				</form>
			</div>
		</div>
	</div>
	</section>
	
	
<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>	
<?php get_footer('new'); ?>