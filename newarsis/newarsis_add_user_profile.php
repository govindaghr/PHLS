 <?php
/*
 Template Name: NEWARSIS User Registration
*/

?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/COMMON/config/db_config.php");
?>
<link href="/COMMON/css/styles_new.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/COMMON/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/ui.spinner.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="/COMMON/js/jquery-1.8.2.min.js"></script>
<?php get_header(); ?>
	<script>
		$(document).ready(function($){		
			$("#form").validationEngine({binded:false});
			$('#chkuname').change(function(){   
                checkUsername();  
			});
			$('#chkcno').change(function(){   
                checkMobileNo();  
			});	
		});
		function checkUsername(){  
			var username = $('#chkuname').val();  
			$.post("/COMMON/profile/public/check_uname.php", { username: username },  
			function(result){  
				if(result == 1){  
					$('#uname_result').html('Available');
					 $('#uname').val(username);	
				}else{  
					$('#uname_result').html('Not Available'); 
					 $('#uname').val('');		
				}  
			});  
		}
		function checkMobileNo(){  
			var mno = $('#chkcno').val();	
			$.post("/COMMON/profile/public/check_mobile_no1.php", { mno: mno},  
			function(result){  
				if(result == 1){  
					$('#cno_result').html('Mobile No. not registered(Available for registration)');
					$('#cno').val(mno);	
				}else{  
					$('#cno_result').html('Mobile No alreay registered(Not available for registration)'); 
					 $('#cno').val('');		
				}  
			});  
		}
	</script>
	<script type="text/javascript" src="/COMMON/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine.js"></script>
	<script type="text/javascript">

		function nospaces(t){

		if(t.value.match(/\s/g)){

		alert('Sorry, you are not allowed to enter any spaces for username');

		t.value=t.value.replace(/\s/g,'');

		}

		}

		</script>

	

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<form id="form" class="main" method="Post" action="/COMMON/profile/public/save_user_profile.php">
					<div class="widget">
						<div class="whead"><h3>User Registration for NEWARSIS</h3></div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-3"><label>Username:</label>
								<input type="text" name="chkuname" class="form-control validate[required]" id="chkuname" placeholder="Preferred Username" onkeyup="nospaces(this)" /></div>
								
								<div class="col-md-3"><label>&nbsp;</label><input type="text" name="uname" class="form-control validate[required]" id="uname" placeholder="Username" readonly /><div style="display:inline;color:red;" id="uname_result"></div></div>
								<div class="col-md-3"><label>Full Name:</label>
								<input type="text" name="fname" id="fname" class="form-control validate[required]" /></div>
							</div>
							<!--<div class="row">
								<div class="col-md-3"><label>User Category:</label>
									<select name="catid" id="catid" class="form-control validate[required]">
										<option value="">User Category</option>
										<?php
											$qry=mysql_query("SELECT id, value FROM ms_user_category_table ORDER BY id ASC");
											while(list($catid,$cat)=mysql_fetch_row($qry)){	
												echo("<option value='$catid'>$cat</option>");
											}
										?>	
									</select>
								</div>
								<div class="col-md-3"><label>Access:</label>
									<select name="acl" id="acl" class="form-control validate[required]">
										<option value="">Select Access</option>
										<?php
											$qry=mysql_query("SELECT id,value FROM ms_access_level_table WHERE id!='1' ORDER BY value ASC");
											while(list($acl,$usrdecp)=mysql_fetch_row($qry)){	
												echo("<option value='$acl'>$usrdecp</option>");
											}
										?>	
									</select>
								</div>
							</div>-->
							<div class="row">
								<div class="col-md-3"><label>Center:</label>
									<select name="ctid" id="ctid" class="form-control validate[required]">
										<option value="">Select Center</option>
										<?php
											$qry=mysql_query("SELECT center_id,center_name FROM ms_health_center_table ORDER BY center_id ASC");
											while(list($ctid,$cname)=mysql_fetch_row($qry)){	
												echo("<option value='$ctid'>$cname</option>");
											}
										?>	
									</select>
								</div>
								<div class="col-md-3"><label>Designation:</label>
									<select name="desg" id="desg" class="form-control validate[required]">
										<option value="">Select Designation</option>
										<?php
											$qry=mysql_query("SELECT id, value FROM ms_designation_table ORDER BY value ASC");
											while(list($desg_id,$desig)=mysql_fetch_row($qry)){	
												echo("<option value='$desg_id'>$desig</option>");
											}
										?>	
									</select>
								</div>
								<div class="col-md-3"><label>Email ID:</label>
								<input type="email"  class="form-control validate[custom[email]]" name="eid" id="eid" /></div>														
							</div>
							<div class="row">
								<div class="col-md-2"><label>Mobile No:</label>
								<input type="text" name="chkcno" id="chkcno" class="form-control validate[required,custom[integer],minSize[8],maxSize[8]]"/></div>
								<div class="col-md-3"><label>&nbsp;</label><input type="text" name="cno" id="cno" readonly class="form-control validate[required]" />
								<div style="display:inline;color:red;" id="cno_result"></div></div>	
							</div>
						</div>
							
						<div class="body" align="center">
							<input type="submit" value="Submit Registration Details" class="btn btn-default buttonM bGreen" />
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
					</div>
				</form>
			</div>	
		</div>
	</div>
	</section>
	<?php get_footer('custom'); ?>