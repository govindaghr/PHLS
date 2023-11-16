	<footer>
	<div class="container">
		<div class="row nomargin">
			<div class="col-md-3">
				<div class="widget">
					<h4 class="widgetheading">Get in touch with us</h4>
					<address>
					<i class="fa fa-map-marker fa-2x" aria-hidden="true"></i> <strong>Royal Centre for Disease Control</strong><br>
					 Wangchutaba, Serbithang<br>
					 Above Bhutan Agro Industries Limited. </address>
					<p>
						<i class="fa fa-phone fa-lg"></i> (+975) 02-323317 <br>
						<i class="fa fa-link  fa-spin fa-lg fa-fw" aria-hidden="true"></i>
						<!--<i class="fa fa-forward fa-lg" aria-hidden="true"></i>--> EPABX: (+975) 02-350577/350578 <br>
						<i class="fa fa-fax fa-lg"></i> Fax: (+975) 02-332464 <br>
						<i class="fa fa-envelope fa-lg"></i> bhutanphl@gmail.com
					</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget">
					<h4 class="widgetheading">Ministry of Health News Feed</h4>
						<?php 
						$file = 'http://www.health.gov.bt/category/news/feed/';
						$file_headers = @get_headers($file);
						if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
							echo '<a href="http://www.health.gov.bt" target="_blank"> www.health.gov.bt </a> Site is Unreachable';
						}
						else {
   

						if(function_exists('fetch_feed')) {

									include_once(ABSPATH . WPINC . '/feed.php'); // the file to rss feed generator
									$feed = fetch_feed('http://www.health.gov.bt/category/news/feed/'); // specify the rss feed

									$limit = $feed->get_item_quantity(5); // specify number of items
									$items = $feed->get_items(0, $limit); // create an array of items
								}
								if ($limit == 0) echo '<div>The feed is either empty or unavailable.</div>';
								else foreach ($items as $item) : ?>

									<!--// The actual output-->
									<ul class="link-list">
									<li><a href="<?php echo $item->get_permalink(); ?>" alt="<?php echo $item->get_title(); ?>" target="_blank"><?php echo $item->get_title(); ?></a></li>
									</ul>
							<?php endforeach; 
							}?>
							
					
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget">
					<h4 class="widgetheading">Quick Links</h4>
					<ul class="link-list">						
						<li><a href="http://www.health.gov.bt">Ministry of Health</a></li>
						<li><a href="http://www.cdc.gov">Centers for Disease Control and Prevention</a></li>
						<li><a href="http://www.who.int">World Health Organization</a></li>
						<li><a href="http://www.ncah.gov.bt">National Centre for Animal Health</a></li>
						
					</ul>					
				</div>
				<?php get_search_form(); ?>
				<div class="widget pull-left" style="width:100%">
						<?php get_search_form(); ?>
				</div>
				<!--<div class="widget">
				<h4 class="widgetheading">Search</h4>
					<form class="navbar-form">
						<?php get_search_form(); ?>
					</form>
					<div class="col-sm-6 col-sm-offset-3">
						<div id="imaginary_container"> 
							<div class="input-group stylish-input-group">
								<input type="text" class="form-control"  placeholder="Search" >
								<span class="input-group-addon">
									<button type="submit">
										<span class="glyphicon glyphicon-search"></span>
									</button>  
								</span>
							</div>
						</div>
					</div>
					<form class="navbar-form navbar-right">
						<input type="text" class="form-control" placeholder="Search...">
					</form>					
				</div>-->
			</div>
			<div class="col-md-3">
				<div class="widget">
					<!--<h5 class="widgetheading">EPI Calendar</h5>-->
					<?php //get_epi('calendar'); ?>
					<?php include 'epi-calendar.php'; ?>
					<div class="clear">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="sub-footer">
		<div class="container">
			<div class="row nomargin">
				<div class="col-md-9">
					<div class="copyright">
						<p>
							<span>&copy; 2011-<?php echo date('Y'); ?> Royal Centre for Disease Control | Department of Public Health | </span><a href="http://www.health.gov.bt" target="_blank">Ministry of Health</a> | Royal Government of Bhutan
						</p>
					</div>
				</div>
				<div class="col-md-3">
					<ul class="social-network">
						<li><a href="https://www.facebook.com/RCDC.Bhutan" target="_blank" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<!--<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>-->
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<?php wp_footer(); ?>

<script src="<?php bloginfo('template_directory');?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.fancybox.pack.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.fancybox-media.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/google-code-prettify/prettify.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/portfolio/jquery.quicksand.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/portfolio/setting.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.flexslider.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/custom.js"></script>

<script>//call flex slider function
    jQuery('#main-slider').flexslider();</script>
<!-- templatemo 399 tamarillo -->
<script>//call flex slider function
    jQuery('#event-slider').flexslider();</script>
<!-- templatemo 399 tamarillo -->
</body>
</html>