<?php

get_header();

?>

<div id="main-content">
	<div class="container">
	<div class="row">
	<div class="col-md-12 blog-detail-title">
	<h1><?php the_title(); ?></h1>
		<div class="bar-div"></div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-12 blog-detail-wrap">
		   <img src="<?php echo get_the_post_thumbnail_url($post_id, 'full');?>" align="left">
		   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>
		</div>
		
		</div>
		
		
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>