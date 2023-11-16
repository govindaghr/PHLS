<aside class="right-sidebar">
	<!--<br />-->
		<div class="widget">
			<form class="navbar-form">
				<?php get_search_form(); ?>
			</form>
		</div>
	
		<div class="widget">
		<h4 class="widgetheading">Latest posts</h4>
		<ul class="recent">
			<?php query_posts('post_type=post&post_status=publish&posts_per_page=3'); ?>
							
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
			<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<p style="font-size:10px;">
				 This was posted on: <?php echo the_time('l, F jS, Y');?>
			</p>
			</li>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</ul>
	</div>
	
	<div class="widget">
		<h4 class="widgetheading">Categories</h4>
		<ul class="cat">
		
			<?php wp_list_categories('title_li='); ?>
			<?php //wp_list_categories('exclude=4,7&title_li='); ?>
			<?php //wp_list_categories('orderby=name&exclude=3,5,9,16'); ?> 
		</ul>
		

	</div>
	<div class="widget">
		<h4 class="widgetheading">Archives</h4>
		<!--<ul class="cat">
			<?php //wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 1, 'limit' => 12 ) ); ?>
		</ul>-->
		<div class="form-group">
		<select name="archive-dropdown" class="form-control" onchange="document.location.href=this.options[this.selectedIndex].value;">
		  <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
		  <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
		</select>
		</div>
		
	</div>

	<!--
	<div class="widget">
		<h4 class="widgetheading">Online Services</h4>
		<ul class="cat">
			<li><i class="icon-angle-right"></i><a href="#">Web design</a><span> (20)</span></li>
			<li><i class="icon-angle-right"></i><a href="#">Online business</a><span> (11)</span></li>
			<li><i class="icon-angle-right"></i><a href="#">Marketing strategy</a><span> (9)</span></li>
			<li><i class="icon-angle-right"></i><a href="#">Technology</a><span> (12)</span></li>
			<li><i class="icon-angle-right"></i><a href="#">About finance</a><span> (18)</span></li>
		</ul>		
	</div>
	-->
	
	<div class="widget">
		<h4 class="widgetheading">Popular tags</h4>
		<ul class="tags">
			 <?php top_tags(); ?>
		</ul>
	</div>
</aside>