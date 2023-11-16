<?php
/*
 Template Name: Blog Landing Page
*/

?>
<?php get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<?php query_posts('post_type=post&post_status=publish&posts_per_page=5' . '&paged=' . get_query_var('paged')); ?>
							
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php
								$thumbnail_id = get_post_thumbnail_id(); 
								$thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
								$thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);                
							  ?>
				<article>
						<div class="post-heading">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="dottedline-green">
							</div>
						</div>
						<?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						 // the_post_thumbnail();}
						?>
						<img class="blog-img" src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $thumbnail_meta; ?>" />
						<?php } ?>
						<div class="blog-p">
						<?php the_excerpt(); ?>
						</div>
						<div class="bottom-article">
						This was posted on <?php echo the_time('l, F jS, Y');?><?php //echo get_the_date(); ?> By <?php the_author_posts_link(); ?> in <?php the_category( ', ' ); ?>  <?php the_tags( ', ' ) ?>.<!-- <a href="<?php //comments_link(); ?>">[<?php //comments_number(); ?>]</a>	-->						
						</div>
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
					<div class="col-md-12">
						<div class="solidline">
						</div>
					</div>
				</div>
				<?php if (function_exists("pagination")) {
								pagination($additional_loop->max_num_pages);
								} ?>
			</div>
			<div class="col-md-4">
			<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	</section>
<?php get_footer(); ?>