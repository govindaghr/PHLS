<?php
/*
 Template Name:Profile listing Page
*/

?>
<?php get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
						<div class="post-heading">
							<h3><?php the_title(); ?></h3>
							<div class="dottedline-green">
							</div>
						</div>
						<h4>Management Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'Management',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>Water Quality Monitoring Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'WQTL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>Influenza Centre/Molecular Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'Molecular',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>National Tuberculosis Reference Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'NTRL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>National Drug Testing Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'NDTL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>Disease Serology Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'IDSL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>Enteric Disease Laboratory Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'EDL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>ICT Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'ICT',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
						<h4>Epidemiology Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'Epidemiology',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
				
				<h4>Food Safety and Poison Information Center Team</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'FSPIC',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
				
				<h4>General Administration</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'GeneralAdmin',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				
				
				<div class="row">
				</div>
				<div class="dottedline-green">
				</div>
				
				
				<h4>Study Leave & EOL</h4>
					<?php	
					  $args = array(
						'post_type'     => 'phl_profile',
						'division' => 'EOL',
						'orderby'       => 'division_rank',
						'order'         => 'ASC',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					  );
					  $the_query = new WP_Query( $args );
					?>
							
							<?php if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							
				<article class="col-sm-4 dottedline-bar">
					<div class="profile">
						 <?php the_post_thumbnail( array( 'class'=> "blog-img pull-left attachment-post-thumbnail",130, 130 ) ); ?>
						
						<div class="blog-p">
						<b>Name:</b> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
						<b>Designation:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Designation', true ) ); ?><br />
						<!--<b>Responsibility:</b> <?php //echo esc_html( get_post_meta( get_the_ID(), 'Responsibility', true ) ); ?><br />-->
						<b>Contact:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Contact', true ) ); ?><br />
						<b>Email ID:</b> <?php echo esc_html( get_post_meta( get_the_ID(), 'Email', true ) ); ?><br />
						</div>
					</div>
					<div class="row nomargin">
					</div>
				</article>
				<?php endwhile; wp_reset_postdata();  else: ?>
				<article>
							<div class="post-heading">
								<h3><a href="#">Oh no!</a></h3>
								<div class="dottedline-green">
								</div>
							</div>						
							<div class="blog-p">
							<p>
							No content is appearing for this page!
							</p>
							</div>
						<div class="bottom-article">							
						</div>
				</article>
				<?php endif; 
							 //wp_reset_query();
							?>
				<!-- divider -->
				<!--<div class="row nomargin">
					<div class="col-md-12">
						<div class="solidline">
						</div>
					</div>
				</div>-->
				</div>
			</div>
		</div>
	</div>
	</section>

<?php get_footer(); ?>