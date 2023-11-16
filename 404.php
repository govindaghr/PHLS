<?php
/**
 * Template Name: 404 Error Page
 */

get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-9">								
				<article>
				<?php the_post(); ?>
				<h2><?php _e( 'Not Found', 'phls' ); ?></h2>
				<div class="blog-p">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'phls' ); ?></p>
				</div>
				<?php get_search_form(); ?>
				</article>
				<!-- divider -->
				<div class="row nomargin">
						<div class="solidline">
						</div>
				</div>
				<div class="col-md-4">
				  <?php get_template_part( 'epi', 'calendar' ); ?>
				</div>
			</div>
			<div class="col-md-3">
				  <?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	</section>
<?php get_footer(); ?>