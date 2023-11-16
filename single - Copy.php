<?php get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">							
							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>							
				<article>
						<div class="post-heading">
							<h3><?php the_title(); ?></h3>
							<div class="dottedline-green">
							</div>
							<div class="bottom-article">
						This was posted on <?php echo the_time('l, F jS, Y');?><?php //echo get_the_date(); ?> By <?php the_author_posts_link(); ?> in <?php the_category( ', ' ); ?>  <?php the_tags( ', ' ) ?></div>
						</div>
						<div class="blog-p">
						  <?php the_content(); ?>
						</div>
						
						<?php //comments_template(); ?>
				</article>
				<?php endwhile; else: ?>
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
				<div class="row nomargin">
						<div class="solidline">
						</div>
				</div>
			</div>
			<div class="col-md-4">
				  <?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	</section>
<?php get_footer(); ?>