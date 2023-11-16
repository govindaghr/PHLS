<?php
/*
Template Name: Contact Page
*/
?>


<?php 
session_start();
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError1 = 'Do not enter anything in this field, (leave it blank).';
		$hasError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		
		//Check to make sure that the subject field is not empty
		if(trim($_POST['subject']) === '') {
			$subjectError = 'You forgot to enter your subject.';
			$hasError = true;
		} else {
			$subject = trim($_POST['subject']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your Message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		
		//Check Captcha
		if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
		//Note: the captcha code is compared case insensitively.
		//if you want case sensitive match, update the check above to
		// strcmp()
			$captchaError = 'The captcha code does not match!';
			$hasError = true;
		}
		
		//$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		$ip = $_SERVER['REMOTE_ADDR'];
		
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = get_option( 'admin_email' );//'me@somedomain.com';
			$subject = 'Contact Form Submission from '.$name.' about '.$subject;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\n Email: $email \n\n Message: $comments \n\n IP Address: $ip";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = $subject.' at PHL';
				$headers = 'From:  Public Health Laboratory, <noreply@phls.gov.bt>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>


<?php get_header(); ?>
<!--<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/contact-form.js"></script>-->

<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

					<?php if(isset($emailSent) && $emailSent == true) { ?>

						<div class="thanks">
							<h1>Thank you!  <?=$name;?></h1>
							<h4>Your message has been sent successfully. We will be in touch soon.</h4>							
						</div>

					<?php } else { ?>

						<?php if (have_posts()) : ?>
						
						<?php while (have_posts()) : the_post(); ?>
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							
							
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<h4 style="color:red;">There was an error submitting the form.</h4>
							<?php }
								else {?>
								<h4>Get in touch with us by filling <strong>contact form below</strong></h4>
							<?php }?>
						
							<form action="<?php the_permalink(); ?>" id="contactform" method="post">
						
								<div class="row">
									<div class="col-md-4 field">
										<input type="text" placeholder="* Enter your full name" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
										<div class="validation">						
											<?php if($nameError != '') { ?>
												<span class="error"><?=$nameError;?></span> 
											<?php } ?>
										</div>
									</div>
										<div class="col-md-4 field">
										<input type="text" placeholder="* Enter your email address" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />
										<div class="validation">
											<?php if($emailError != '') { ?>
												<span class="error"><?=$emailError;?></span>
											<?php } ?>
										</div>
									</div>
									
									<div class="col-md-4 field">
										<input type="text" name="subject" placeholder="* Enter your subject" id="subject" value="<?php if(isset($_POST['subject']))  echo $_POST['subject'];?>" class="requiredField subject" />
										<div class="validation">
											<?php if($subjectError != '') { ?>
												<span class="error"><?=$subjectError;?></span>
											<?php } ?>
										</div>
									</div>
									
									<div class="col-md-12 margintop10 field">
										<textarea name="comments" placeholder="* Your message here..." id="commentsText" rows="12" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
										<div class="validation">
											<?php if($commentError != '') { ?>
												<span class="error"><?=$commentError;?></span> 
											<?php } ?>
										</div>
									</div>
									
									<div class="col-md-12 margintop10 field">										
										<img src="<?php bloginfo('template_directory');?>/captcha/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' >

										<div class="inputcontent">
											<label for='message'>Enter the code above here :</label>
											<input id="6_letters_code" name="6_letters_code" type="text"><br>
											<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
										</div>
										<div class="validation">
											<?php if($captchaError != '') { ?>
												<span class="error"><?=$captchaError;?></span> 
											<?php } ?>
										</div>
									</div>
									
									<div class="col-md-12 margintop10 field"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> />Send a copy of this email to yourself</div>
									
									<div class="col-md-6 margintop10 field">
									<input type="text" name="checking" id="checking" placeholder="If you want to submit this form, do not enter anything in this field" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" />
										<div class="validation">
											<?php if($captchaError1 != '') { ?>
												<span class="error"> If you want to submit this form, do not enter anything in this field </span> 
											<?php } ?>
										</div>
									<p>
										<button class="btn btn-primary margintop10 pull-left" type="submitted" name="submitted" id="submitted" value="true">Submit message</button>
										<span class="pull-right margintop20">* Please fill all required form field, thanks!</span>
									</p>
									</div>
																	
								</div>
							</form>
						
							<?php endwhile; ?>
						<?php endif; ?>
					<?php } ?>
			</div>
		</div>
	</div>
</section>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<?php get_footer(); ?>
	