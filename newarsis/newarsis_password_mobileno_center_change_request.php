<?php
/*
 Template Name: NEWARSIS Password/MobileNo/Center Change  
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
			$("#form1").validationEngine({binded:false});
			$("#form2").validationEngine({binded:false});
			$('#chkuname1').change(function(){   
                checkUsername1();  
			});
			$('#chkuname2').change(function(){   
                checkUsername2();  
			});
			$('#chkuname3').change(function(){   
                checkUsername3();  
			});
			$('#chkmno1').change(function(){   
                checkMobileNo1();  
			});
			$('#chkmno2').change(function(){   
                checkMobileNo2();  
			});
			$('#chkctid').change(function(){   
                checkCtID();  
			});		
		});
		function checkUsername1(){  
			var username = $('#chkuname1').val();  
			$.post("/COMMON/profile/public/check_uname.php", { username: username },  
			function(result){  
				if(result != 1){  
					$('#uname_result1').html('Matching Username found in database');
					$('#uname1').val(username);
					$("#chkmno1").prop('disabled', false);	
				}else{  
					$('#uname_result1').html('Matching Username Not found in database'); 
					$('#uname1').val('');
					$("#chkmno1").prop('disabled', true);
					$('#chkmno1').val('');	
				}  
			});  
		}
		function checkUsername2(){  
			var username = $('#chkuname2').val();  
			$.post("/COMMON/profile/public/check_uname.php", { username: username },  
			function(result){  
				if(result != 1){  
					$('#uname_result2').html('Matching Username found in database');
					$('#uname2').val(username);
					$("#chkmno2").prop('disabled', false);		
				}else{  
					$('#uname_result2').html('Matching Username Not found in database'); 
					$('#uname2').val('');
					$("#chkmno2").prop('disabled', true);	
					$('#chkmno2').val('');					
				}  
			});  
		}
		function checkUsername3(){  
			var username = $('#chkuname3').val();  
			$.post("/COMMON/profile/public/check_uname.php", { username: username },  
			function(result){  
				if(result != 1){  
					$('#uname_result3').html('Matching Username found in database');
					$('#uname3').val(username);
					$("#chkctid").prop('disabled', false);		
				}else{  
					$('#uname_result3').html('Matching Username Not found in database'); 
					$('#uname3').val('');
					$("#chkctid").prop('disabled', true);
					$('#chkctid').val('');	
				}  
			});  
		}
		function checkMobileNo1(){  
			var username = $('#chkuname1').val();
			var mno = $('#chkmno1').val();	
			$.post("/COMMON/profile/public/check_mobile_no.php", { username: username,mno:mno },  
			function(result){  
				if(result != 1){  
					$('#mno_result1').html('Matching Mobile No. found in database');
					$('#mno1').val(mno);	
				}else{  
					$('#mno_result1').html('Matching Mobile No. Not found in database'); 
					 $('#mno1').val('');		
				}  
			});  
		}
		function checkMobileNo2(){  
			var username = $('#chkuname2').val();
			var mno = $('#chkmno2').val();	
			$.post("/COMMON/profile/public/check_mobile_no.php", { username: username,mno:mno },  
			function(result){  
				if(result != 1){  
					$('#mno_result2').html('Matching Mobile No. found in database');
					$('#mno2').val(mno);
						
				}else{  
					$('#mno_result2').html('Matching Mobile No. Not found in database'); 
					 $('#mno2').val('');		
				}  
			});  
		}
		function checkCtID(){  
			var username = $('#chkuname3').val();
			var ctid = $('#chkctid').val();	
			$.post("/COMMON/profile/public/check_cid1.php", { username: username,ctid:ctid },  
			function(result){  
				if(result != 1){  
					$('#ctid_result').html('Matching Center found in database');
					$('#ctid').val(ctid);	
				}else{  
					$('#ctid_result').html('Matching Center Not found in database'); 
					 $('#ctid').val('');		
				}  
			});  
		}
	</script>
	<script type="text/javascript" src="/COMMON/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="/COMMON/js/plugins/forms/jquery.validationEngine.js"></script>

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
			
				<div class="widget">	
					<div class="whead"><h3>Password Reset</h3></div>
					<form id="form" class="main" method="Post" action="/COMMON/profile/public/reset_password.php">				
						<div class="form-group">
						<div class="row">
							<div class="col-md-3"><label>Username:</label>
							<input type="text" name="chkuname1"  class="form-control" id="chkuname1" placeholder="Valid Username"  /></div>
							<div class="col-md-3"><label>&nbsp;</label>
							<input type="text" name="uname1" id="uname1" readonly class="form-control validate[required]" />
							<div style="display:inline;color:red;" id="uname_result1"></div></div>	
							
						
							<div class="col-md-3"><label>Mobile No:</label>
							<input type="text" name="chkmno1"  class="form-control" id="chkmno1" placeholder="Valid Mobile No" disabled /></div>
							<div class="col-md-3"><label>&nbsp;</label>
							<input type="text" name="mno1" id="mno1" readonly class="form-control validate[required]" />
							<div style="display:inline;color:red;" id="mno_result1"></div></div>							
						</div>
						</div>
						<div class="body" align="center">
							<input type="submit" value="Reset Password" class="btn btn-default buttonM bGreen" />
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</form>	
				</div>
				
				
				
				
				<div class="widget">	
					<div class="whead"><h3>Mobile No Change</h3><div class="clear"></div></div>
					<form id="form1" class="main" method="Post" action="/COMMON/profile/public/update_mobile_number.php">				
						<div class="form-group">
						<div class="row">
							<div class="col-md-2"><label>Username:</label>
							<input type="text" name="chkuname2" class="form-control" id="chkuname2" placeholder="Valid Username" /></div>
							<div class="col-md-2"><label>&nbsp;</label><input type="text" name="uname2" class="form-control" id="uname2" placeholder="Username" readonly class="form-control validate[required]" />
							<div style="display:inline;color:red;" id="uname_result2"></div></div>	
							
						
							<div class="col-md-2"><label>Mobile No:</label>
							<input type="text" name="chkmno2" class="form-control" id="chkmno2" placeholder="Valid Mobile No" disabled /></div>
							<div class="col-md-3"><label>&nbsp;</label><input type="text" name="mno2" id="mno2" readonly class="form-control validate[required]" />
							<div style="display:inline;color:red;" id="mno_result2"></div></div>	
														
							<div class="col-md-3"><label>New Mobile No:</label>
							<input type="text" name="newmno" id="newmno" class="form-control validate[required,custom[integer],minSize[8],maxSize[8]]" /></div>
							
						</div>
						</div>
						<div class="body" align="center">
							<input type="submit" value="Change Mobile No." class="btn btn-default buttonM bGreen" />
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</form>	
				</div>
				
				
				<div class="widget">	
					<div class="whead"><h3>Center Change</h3><div class="clear"></div></div>
					<form id="form2" class="main" method="Post" action="/COMMON/profile/public/save_center_change_request.php">				
						<div class="form-group">
						<div class="row">
						
							<div class="col-md-3"><label>Username:</label>
							<input type="text" name="chkuname3" class="form-control" id="chkuname3" placeholder="Valid Username" /></div>
							<div class="col-md-3"><label>&nbsp;</label><input type="text" name="uname3" id="uname3" placeholder="Username" readonly class="form-control validate[required]" />
							<div style="display:inline;color:red;" id="uname_result3"></div></div>	
							
							<div class="col-md-3"><label>Center:</label>
								<select name="chkctid" id="chkctid" class="form-control validate[required]" disabled>
									<option value="">Select Center</option>
									<?php
										$qry=mysql_query("SELECT center_id,center_name FROM ms_health_center_table ORDER BY center_id ASC");
										while(list($ctid,$cname)=mysql_fetch_row($qry)){	
											echo("<option value='$ctid'>$cname($ctid)</option>");
										}
									?>	
								</select>
							</div>							
							<div class="col-md-3"><label>&nbsp;</label><input type="text" name="ctid" id="ctid"  readonly class="form-control textC validate[required]" />
							<div style="display:inline;color:red;" id="ctid_result"></div></div>	
							
						</div>
						<div class="row">
							<div class="col-md-3"><label>New Center:</label>
								<select name="newctid" id="newctid" class="form-control validate[required]">
									<option value="">Select Center</option>
									<?php
										$qry=mysql_query("SELECT center_id,center_name FROM ms_health_center_table ORDER BY center_id ASC");
										while(list($ctid,$cname)=mysql_fetch_row($qry)){	
											echo("<option value='$ctid'>$cname</option>");
										}
									?>	
								</select>
							</div>
							
							
							
							<div class="col-md-9"><label>Reason for Center Change:</label>
							<textarea name="reason" id="reason" class="form-control validate[required]"></textarea></div>
							
						</div>	
						</div>
						<div class="body" align="center">
							<input type="submit" value="Submit Center Change Request" class="btn btn-default buttonM bGreen" />
							<div class="clear"></div>
						</div>
						
					</form>	
				</div>	

				
			</div>	
		</div>
	</div>
	</section>
	<?php get_footer('custom'); ?>