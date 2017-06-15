<?php

get_header();

?>

<div id="main-content">
	<div class="container franchise-cont">
		<div class="row">
		<div class="col-md-4">
		   <img src="<?php echo get_the_post_thumbnail_url($post_id, 'full');?>">
		</div>
		<div class="col-md-8">
		</div>
		</div>
		<div class="row">
		<div class="col-md-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

		</div>
		</div>
		
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>