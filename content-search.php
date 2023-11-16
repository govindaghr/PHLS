<?php
$thumbnail_id = get_post_thumbnail_id(); 
$thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail-size', true );
$thumbnail_meta = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);                
?>
<article>
		<div class="post-heading">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<div class="dottedline-green">
			</div>
		</div>
		<?php
		if ( has_post_thumbnail() ) { 
		?>
		<img class="blog-img" src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $thumbnail_meta; ?>" />
		<?php } ?>
		<div class="blog-p">
		<?php the_excerpt(); ?>
		</div>
		<div class="bottom-article">
		This was posted on <?php echo the_time('l, F jS, Y');?> By <?php the_author_posts_link(); ?> in <?php the_category( ', ' ); ?>  <?php the_tags( ', ' ) ?>. <!--<a href="<?php comments_link(); ?>">[<?php comments_number(); ?>]</a>-->
		</div>
</article>
<div class="solidline"></div>