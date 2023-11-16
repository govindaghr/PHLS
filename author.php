<?php get_header(); ?>

	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">							
			<?php if ( have_posts() ) : ?>
			<h3><?php //_e( 'Author', 'phls' ); echo ':';  the_author_link(); ?></h3>
				<?php
					the_archive_title( '<h3 class="page-title">', '</h3>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				<div class="solidline">
				</div>
				<?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . get_the_author_meta( 'user_description' ) . '</div>' ); ?>
				<?php rewind_posts(); ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>
				<!------------Add Navigation Here---------------->
				<?php //get_template_part( 'nav', 'below' ); ?>
            <?php endif; ?>
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
