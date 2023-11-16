<?php get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">							
							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
								<?php
								$thumbnail_id = get_post_thumbnail_id(); 
								$thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
								$thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);                
							  ?>
				<article>
						<div class="post-heading">
							<h3><?php the_title(); ?></h3>
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
						  <?php the_content(); ?>
						</div>
						<hr />
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