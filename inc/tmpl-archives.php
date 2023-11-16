<?php 
/*
Template Name: Archives-Temp
*/
get_header(); ?>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<?php the_post(); ?>
			
				<div class="widget">
					<h4 class="widgetheading">Monthly Archives</h4>
					<ul class="tags">
					  <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
					</ul>					
				</div>
				
				<div class="widget">
					<h4 class="widgetheading">Authors</h4>
					<ul class="tags">					
						<?php wp_list_authors('optioncount=1&orderby=post_count&order=DESC'); ?>
					</ul>
				</div>
				
				<div class="widget">
					<h4 class="widgetheading">Subject</h4>
					<ul class="tags">
						 <?php category(); ?>
					</ul>
				</div>
				
				
				<div class="widget">
					<h4 class="widgetheading">Popular tags</h4>
					<ul class="tags">
						 <?php top_tags(); ?>
					</ul>
				</div>
				
				<div class="widget">
					<h4 class="widgetheading">Latest posts</h4>
					<ul class="tags">
						<?php query_posts('post_type=post&post_status=publish&posts_per_page=10'); ?>
										
										<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<?php
											$thumbnail_id = get_post_thumbnail_id(); 
											$thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
											$thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);                
										  ?>
						<li>
						<?php if ( has_post_thumbnail() ) { ?>
						<!--img src="<?php //echo $thumbnail_url[0]; ?>" alt="<?php //echo $thumbnail_meta; ?>" class="pull-left" />-->
						<?php } ?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>						
						</li>
						<?php endwhile; endif; wp_reset_postdata(); ?>
					</ul>
				</div>
				
			</div>
			<div class="col-md-4">
				<div class="widget">
					<form class="navbar-form">
						<?php get_search_form(); ?>
					</form>
				</div>
				<div class="widget">
					<h4 class="widgetheading">Pages</h4>
					<ul class="cat">
						   <?php wp_list_pages('title_li='); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</section>
<?php get_footer(); ?>