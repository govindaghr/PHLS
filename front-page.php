<?php get_header(); ?>
		<script type="text/javascript" src="swobject/swfobject.js"></script>
		<script type="text/javascript">
			swfobject.registerObject("myId", "9.0.0", "expressInstall.swf");
		</script>
	<section id="featured">
	<!-- start slider -->
	<div class="container">
		<div class="row nomargin">
			<div class="col-md-7">
			<!-- Slider -->
				<div id="main-slider" class="flexslider">				
					<ul class="slides">						
						<li><?php include('inc/graphs/weekly_ili_sari_sentinel.php');?></li>
						<li><?php include('inc/graphs/weekly_subtype_case.php');?></li>
						<!--<li><?php //include('inc/graphs/weekly_sentinel_ili_sari.php');?></li>
						<?php //include('inc/graphs/ili_sari_subtype.php');/*weekly_ili_subtype & weekly_sari_subtype Code*/ ?>
						<li><?php //include('inc/graphs/weekly_ili_subtype.php');?></li>
						<li><?php //include('inc/graphs/weekly_sari_subtype.php');?></li>
						<!--	
						<li><?php //include('inc/graphs/newarsis_weekly_notifiable_syndrome.php');?></li>
						<li><?php //include('inc/graphs/newarsis_weekly_notifiable_disease.php');?></li>
						<li><?php //include('inc/graphs/newarsis_weekly_immediate_disease.php');?></li>
						-->	
						<object id="myId" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="0" height="0">
							<!--[if !IE]>-->
							<object type="application/x-shockwave-flash" width="0" height="0" style="padding:0; Margin:0">
							<!--<![endif]-->
							<div>
								<h3>Get Adobe Flash player to laod Chart</h3>
								<h3>OR</h3>
								<h3>Allow Flash player for this Site to laod Chart</h3>
								<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
							</div>
							<!--[if !IE]>-->
							</object>
						</object>
					</ul>					
				</div>
			<!-- end slider -->				
			</div>
			
			<div class="col-md-5">
				<div class="box">
					<div class="box-alert">
						<h2 class="aligncenter">Immediately Reported Notifiable Diseases</h2>
						<table class="table table-hover table-bordered"><!--table table-striped -->
							 <thead>	
								<tr>
									<th class="text-center">Disease (Case/Death)</th>	
									<th class="text-center">Case Date</th>
									<th class="text-center">Reporting Center</th>
								</tr>
							 </thead>
							 <tbody>	
							<?php
								include($_SERVER["DOCUMENT_ROOT"]."/COMMON/config/db_config.php");
								include($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
								$qry=mysql_query("SELECT record_id,case_date,center_id FROM nd_immediate_report_table1 ORDER BY case_date DESC LIMIT 4");
								while(list($rid,$cdt,$cid)=mysql_fetch_row($qry)){
									list($ctname)=mysql_fetch_row(mysql_query("SELECT center_name FROM commondb.ms_health_center_table WHERE center_id='".$cid."'"));							
									$dqry=mysql_query("SELECT disease_id,(g1c+g2c+g3c+g4c+g5c+g6c+g7c+g8c+g9c+g10c+g11c),(g1d+g2d+g3d+g4d+g5d+g6d+g7d+g8d+g9d+g10d+g11d) FROM nd_immediate_report_table2 WHERE irt1_record_id='".$rid."'");
									$dstr="";
									while(list($did,$tc,$td)=mysql_fetch_row($dqry)){
										list($dname)=mysql_fetch_row(mysql_query("SELECT disease_syndrome FROM ms_immediate_reportable_disease_table WHERE disease_id='".$did."'"));
										$dstr.=$dname."(".$tc."/".$td.") &nbsp &nbsp";
									}
									echo("<tr><td class='text-justify'>$dstr</td><td>$cdt</td><td>$ctname</td></tr>");
								}	
							?>
							 <tbody>
						</table>
						<ul class="my-list">						
							<a href="<?= get_site_url(); ?>/immediately-reported-notifiable-diseases/">View All Immediately Reported Notifiable Diseases</a>	
						</ul>
							
					</div>
				</div>
			</div>			
		</div>
	</div>	
	</section>
	
	
	
	<section id="content">
	<div class="container">
		<div class="row nomargin">
			<div class="col-md-12">
			<!--<h2 class="heading">Recent Works</h2>-->
				<div class="row">
					<div class="col-md-8">
						<div class="box">
							<div class="box-white table-responsive-md" style="font-size:14px;">
								<h2 class="aligncenter">Confirmed Event of Public Health Concern</h2>
								<div class="dottedline-green">
								</div>
								<table class="table table-striped table-bordered">
									 <thead>	
										<tr>
											<th class="text-center">Event Name</th>	
											<th class="text-center">Date</th>
											<th class="text-center">People Affected</th>
											<th class="text-center">Location/Gewog/Dzongkhag</th>
											<th class="text-center">Reported By</th>
											<th class="text-center">Reporting Center</th>											
										</tr>
									 </thead>
									 <tbody>	
									<?php
										include($_SERVER["DOCUMENT_ROOT"]."/COMMON/config/db_config.php");
										include($_SERVER["DOCUMENT_ROOT"]."/NEWARSIS/config/db_config.php");
										$qry=mysql_query("SELECT ert.event_id,event_date,event_name,event_location,dzongkhag,geog,reporter_category,health_center, status FROM event_report_table ert, event_report_status_table est WHERE est.status IN(2,3) AND ert.event_id=est.event_id ORDER BY ert.event_id DESC LIMIT 5");
										while(list($eid,$edate,$ename,$eloc,$did,$gid,$cat,$cid,$status)=mysql_fetch_row($qry)){
											list($dname)=mysql_fetch_row(mysql_query("SELECT dzongkhag_name FROM commondb.ms_dzongkhag_table WHERE dzongkhag_code='".$did."'"));
											list($gname)=mysql_fetch_row(mysql_query("SELECT geog_name FROM commondb.ms_geog_table WHERE geog_code='".$gid."'"));
											list($cname)=mysql_fetch_row(mysql_query("SELECT center_name FROM commondb.ms_health_center_table WHERE center_id='".$cid."'"));						
											list($catog)=mysql_fetch_row(mysql_query("SELECT value FROM ms_event_reporter_category_table WHERE id='$cat'"));
											list($popu)=mysql_fetch_row(mysql_query("SELECT SUM(cases) FROM event_report_case_death_table WHERE event_id='$eid'"));
											
											list($sts)=mysql_fetch_row(mysql_query("SELECT value FROM ms_event_status_table WHERE id='".$status."'"));
											if($status=="2") $stsclass="style='color:red;'";else $stsclass="";
											echo("<tr><td class='text-justify'>$ename</td><td>$edate</td><td>$popu</td><td>$eloc/$gname/$dname</td><td>$catog</td><td>$cname</td><td $stsclass>$sts</td></tr>");
										}	
									?>
									 <tbody>
								</table>
								<ul class="my-list">						
									<a href="<?= get_site_url(); ?>/confirmed-event-of-phc/">View All Event of Public Health Concern</a>	
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box">
							<div class="box-white">
								<h2 class="aligncenter">Publications</h2>
								<div class="dottedline-green">
								</div>
								<ul class="my-list">
									<?php	
									  $args = array(
										// 'date_query' => array( array( 'after' => '-7 days' ) ),//1 week ago
										'post_type'     => 'post',
										// 'category_name' => 'publications',
										'category_name' => 'Publication',
										'showposts' 	=> 5,
										'orderby'       => 'post_date',
										'order'         => 'DESC',
										'post_status'      => 'publish',
										'suppress_filters' => true 
									  );
									  $the_query = new WP_Query( $args );
									?>
										<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										
										<?php endwhile; ?>
										<?php
											// Get the ID of a given category
											$category_id = get_cat_ID( 'Publication' );

											// Get the URL of this category
											$category_link = get_category_link( $category_id );
										?>
										<a href="<?php echo esc_url( $category_link ); ?>">View All Publications</a>
										<?php endif; wp_reset_postdata(); ?>
								</ul>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
		
		<!-- divider -->
		<div class="row nomargin">
			<div class="col-md-12">
				<div class="solidline">
				</div>
			</div>
		</div>
		<!-- end divider -->
		<div class="row nomargin">
			<div class="col-md-12">
			<h2 class="heading">Recent Works</h2>
				<div class="row">
					<div class="col-md-4">
						<div class="box">
							<div class="box-white">
								<h2 class="aligncenter">Reports</h2>
								<div class="dottedline-green">
								</div>
								<ul class="my-list">
									<?php	
									  $args = array(
										'post_type'     => 'post',
										// 'category_name' => 'reports',
										'category_name' => 'Report',
										'showposts' 	=> 5,
										'orderby'       => 'post_date',
										'order'         => 'DESC',
										'post_status'      => 'publish',
										'suppress_filters' => true 
									  );
									  $the_query = new WP_Query( $args );
									?>
										<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
										<?php
											// Get the ID of a given category
											$category_id = get_cat_ID( 'Report' );

											// Get the URL of this category
											$category_link = get_category_link( $category_id );
										?>
										<a href="<?php echo esc_url( $category_link ); ?>">View All Reports</a>
										<?php endif; wp_reset_postdata(); ?>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="box">
							<div class="box-white">
								<h2 class="aligncenter">Quarterly Disease Surveillance Bulletin</h2>
								<div class="dottedline-green">
								</div>
								<ul class="my-list">
									<?php	
									  $args = array(
										'post_type'     => 'post',
										// 'category_name' => 'reports',
										'category_name' => 'Bulletin',
										'showposts' 	=> 4,
										'orderby'       => 'post_date',
										'order'         => 'DESC',
										'post_status'      => 'publish',
										'suppress_filters' => true 
									  );
									  $the_query = new WP_Query( $args );
									?>
										<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
										<?php
											// Get the ID of a given category
											$category_id = get_cat_ID( 'Bulletin' );

											// Get the URL of this category
											$category_link = get_category_link( $category_id );
										?>
										<a href="<?php echo esc_url( $category_link ); ?>">View All Quarterly-Bulletin</a>
										<?php endif; wp_reset_postdata(); ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box-white aligncenter">
							<h2 class="aligncenter">System User Login</h2>
							<div class="dottedline-green">
							</div>
							<form id="loginform" action="../redirect_user.php" method="post" class="validateform" name="loginForm">		
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
											<option value="rcdc">RCDC Surveillance</option>
											<option value="bdsis">BDSIS</option>
											<option value="cihews">CIHEWS</option>
											<option value="ilisari">ILI & SARI System</option>
											<!--<option value="newarsis">NEWARSIS</option>-->
											<option value="tbiss">TbISS</option>							
											<option value="wqms">WQMIS</option>
										</select>
										</div>
										<div class="form-group">
											<input name="uname" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Username" required >
										</div>
										<div class="form-group">
											<input name="pword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
										</div>
										<button type="submit" class="btn btn-default align-left">Login</button>
										<!--<input class="btn btn-primary" value="Login" />-->
										<p class="form-control-static"><a href="<?php echo site_url('/forgot-password/','http'); ?>" >Forgot your password?</a></p>			
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- divider -->
		<div class="row nomargin">
			<div class="col-md-12">
				<div class="solidline">
				</div>
			</div>
		</div>
		<!-- end divider -->
		<div class="row nomargin">
			<div class="col-md-12">
			<h2 class="heading">News at PHL</h2>
				<div class="row">
				
					<div class="col-md-8">
						<!-- Slider -->
							<div id="event-slider" class="flexslider">
								<ul class="slides">
									<?php
									$args = array(
										'post_type'     => 'post',
										'category_name' => 'Featured',
										'showposts' => '7'
									);
									$the_query = new WP_Query( $args );

									?>
									<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<?php
										$thumbnail_id = get_post_thumbnail_id(); 
										$thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
										$thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);                
									?>
								  <li>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $thumbnail_meta; ?>" /></a> 
									<div class="flex-caption">
										<a href="<?php the_permalink(); ?>"><?php //the_title(); ?></a> 
										<p><?php the_title(); ?></p>
									</div>
								  </li>
								  <?php endwhile; endif; ?>
								</ul>
							</div>
						<!-- end slider -->
					</div>
					<div class="col-md-4">
						<div class="box">
							<div class="box-white">
								<h2 class="aligncenter">Latest Events</h2>
								<div class="dottedline-green">
								</div>
								<ul class="my-list">
									<?php	
									  $args = array(
										'post_type'     => 'post',
										// 'category_name' => 'reports',
										'category_name' => 'News',
										'showposts' 	=> 5,
										'orderby'       => 'post_date',
										'order'         => 'DESC',
										'post_status'      => 'publish',
										'suppress_filters' => true 
									  );
									  $the_query = new WP_Query( $args );
									?>
										<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; ?>
										<?php
											// Get the ID of a given category
											$category_id = get_cat_ID( 'News' );

											// Get the URL of this category
											$category_link = get_category_link( $category_id );
										?>
										<a href="<?php echo esc_url( $category_link ); ?>">View All News</a>
										<?php endif; wp_reset_postdata(); ?>
								</ul>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
	</section>
<?php get_footer(); ?>