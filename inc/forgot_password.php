<?php
/*
 Template Name: Forgot Password Template
*/

?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
?>
		<script type="text/javascript">

		function nospaces(t){

		if(t.value.match(/\s/g)){

		alert('Sorry, you are not allowed to enter any spaces for username');

		t.value=t.value.replace(/\s/g,'');

		}

		}

		</script>
<?php get_header(); ?>
	
	
	

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="box-white aligncenter">
					<h4 class="aligncenter">System User Password Reset</h4>
					<div class="dottedline-green">
					</div>
					<form id="loginform" action="../../redirect_user_password.php" method="post" class="validateform" name="loginForm">		
						<fieldset>
						<?php
							error_reporting(E_ERROR);
							session_start();
							if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) 
								{
									foreach($_SESSION['ERRMSG_ARR'] as $msg) 
										{
											echo("<p  style='color: red;'>$msg</p>");
										}
									unset($_SESSION['ERRMSG_ARR']);
								}
						?>
								<div class="form-group">
								<select name="selsys" class="form-control" required>
									<option value="">Select Online System</option>
									<option value="bdsis">BDSIS</option>
									<option value="ilisari">ILI & SARI System</option>
									<option value="newarsis">NEWARSIS</option>					
									<option value="tbiss">TbISS</option>							
									<option value="wqms">WQMIS</option>
								</select>
								</div>
								<div class="form-group">
									<input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email ID" onkeyup="nospaces(this)" required >
								</div>
								<button type="submit" class="btn btn-success align-left">Reset Password</button>			
						</fieldset>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<br />
			</div>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
	</div>
	</section>
	<?php get_footer(); ?>