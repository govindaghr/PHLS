<?php
/**
Template Name: Search Page
 */
?>
<?php get_header(); ?>

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">							
			<?php if ( have_posts() ) : ?>
			<h2><?php printf( __( 'Search Results for: %s', 'phls' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<div class="dottedline-green">
				</div>
			
				 <?php while ( have_posts() ) : the_post(); ?>
						 <?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>
				<!------------Add Navigation Here---------------->
				<?php get_template_part( 'nav', 'below' ); ?>
				 <?php else : ?>
				 <h2><?php _e( 'Nothing Found', 'phls' ); ?></h2>
				 <div class="dottedline-green">
				</div>
				 <article>	
						<div class="blog-p">
						  <?php _e( 'Sorry, nothing matched your search. Please try again.', 'phls' ); ?>
						  <?php get_search_form(); ?>
						</div>
				</article>             
 
            <?php endif; ?>
			</div>
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	</section>	

<?php get_footer(); ?>
