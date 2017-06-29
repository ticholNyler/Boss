<?php
function get_franchise(){
	global $post;
	
	$args = array(
	'posts_per_page'   => 3,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => 'Franchise',
	'orderby'          => 'date',
	'order'            => 'DESC'
);
$posts_array = get_posts( $args );
?>
<div class="post-grid">	
<?php	
	foreach ( $posts_array as $post ) : 
    	setup_postdata( $post ); 
	
	
?>
      
        <div class="post-grid-item">
<a href="<?php echo get_permalink($post->ID);?>">
<img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>"> 
</a>
<div class="franchise-info">       
<h2><?php echo get_the_title( $post->ID ); ?></h2>
	</div>
	</div>

<?php endforeach;?>
</div>
<?php wp_reset_postdata();
}

function buffer_franchise(){
	ob_start();
	get_franchise();
	$output = ob_get_clean();
	return $output;
}


add_shortcode("franchise", "buffer_franchise");


function filter_blogs(){

global $wp_query, $paged, $post;
	
if($_POST['idx']){
	$paged = $_POST['idx'];
}else{
	$paged = 1;
}

if($_POST['cat']){
	$cat = $_POST['cat'];
}else{
	$cat = 'Blog';
}
	
$wp_query = null;	
	$args = array(
	'posts_per_page'   => 6,
	'category'         => '',
	'category_name'    => $cat,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'paged' => $paged
);
	
$pre = $paged - 1;
$nex = $paged + 1;	
	
$wp_query = new WP_Query( $args );  
$page_count = ceil($wp_query->max_num_pages);
?>
<div class="dot-nav-wrap">
<?php 
	for ($i = 1; $i <= $page_count; $i++) {
    echo "<div class='dot-nav' data-dot='$i'><i class='fa fa-circle'></i></div>";
	}
?>
</div>
<div class="post-grid">
<?php
if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>

<div class="post-grid-item">
<a href="<?php echo get_permalink($post->ID);?>">
<img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>"> 
</a>
<div class="post-info">       
<h1><?php echo get_the_title( $post->ID ); ?></h1>
	<h5><?php the_time('F jS, Y'); ?> By:&nbsp;<?php the_author_posts_link(); ?></h5>
	</div>
	</div>

<?php endwhile;?>
<?php endif;?>
</div>
<div class="page_nav">
  
   <?php if($pre > 0){
    echo '<div class="page_prev"><i class="fa fa-chevron-left"></i><span>&nbsp;Older Posts</span></div>';
    }
	if($nex <= $page_count){
	echo '<div class="page_next" ><span>Newer Posts&nbsp;</span><i class="fa fa-chevron-right"></i></div>';
	}
	?>
</div>
<script>
(function($){
"use strict";

jQuery(document).ready( function(){

	$('.blog-drop').on('change', function() {
  var cat = this.value;

	blog_details(1,cat);
});
	
$('.cat-switch').each(function(){
	var cat = $(this).attr('data-cat');
	var setcat = '<?php echo $cat;?>';
	if(cat === setcat){
		$(this).addClass('yellow');
		$('.cat-switch').not(this).removeClass('yellow');
	}
});

$('.cat-switch').click(function(){
	var cat = $(this).attr('data-cat');
	blog_details(1,cat);
});
$('.dot-nav').each(function(){
	var page = parseInt($(this).attr('data-dot'));

	if(page === <?php echo $paged;?>){
	   $(this).addClass('yellow');
	   }
});
$('.page_prev').click(function(){
	var cat = '<?php echo $cat;?>';
	blog_details(<?php echo $pre; ?>, cat)
});

$('.page_next').click(function(){
	var cat = '<?php echo $cat;?>';
	blog_details(<?php echo $nex; ?>, cat)
});
	
$('.dot-nav').click(function(){
	var page = $(this).attr('data-dot');
	var cat = '<?php echo $cat;?>';
	$(this).addClass('yellow');
	$('.dot-nav').not(this).removeClass('yellow');
	blog_details(page, cat);
});
	
	
});
})(jQuery);
</script>
<?   
wp_reset_query();	
die();
}

function buffer_filtered_blogs(){
	ob_start();
	filter_blogs();
	$output = ob_get_clean();
	return $output;
}


add_action('wp_ajax_boss_filter', 'buffer_filtered_blogs'); 
add_action('wp_ajax_nopriv_boss_filter', 'buffer_filtered_blogs');

add_action('wp_ajax_boss_detailed_filter', 'buffer_filtered_blogs'); 
add_action('wp_ajax_nopriv_boss_detailed_filter', 'buffer_filtered_blogs');

add_action('wp_ajax_feat_detailed_filter', 'buffer_filtered_feat'); 
add_action('wp_ajax_nopriv_feat_detailed_filter', 'buffer_filtered_feat');

function buffer_filtered_feat(){
	ob_start();
	filter_featured();
	$output = ob_get_clean();
	return $output;
}

function featured_drop(){
	$terms = get_terms( 'category', array('parent' => 4) );?>
	
	<div style="position:relative;" class="blog-drop-wrap">
	<span class="arrow"></span>
	<select class="blog-drop">
	<option value="Featured"><a href="">All</a></option>
	<?php foreach($terms as $term):?>
	<option value="<?php echo $term->name;?>"><?php echo $term->name;?></option>
	<?php endforeach;?>
	</select>
	</div>
	
	
	<?php
	
}

function buffer_featured_drop(){
	ob_start();
	featured_drop();
	$output = ob_get_clean();
	return $output;
}

add_shortcode("featured-drop", "buffer_featured_drop");

function filter_featured(){

global $wp_query, $paged, $post;
	
if($_POST['idx']){
	$paged = $_POST['idx'];
}else{
	$paged = 1;
}

if($_POST['cat']){
	$cat = $_POST['cat'];
}else{
	$cat = 'Featured';
}
	
$wp_query = null;	
	$args = array(
	'posts_per_page'   => 3,
	'category'         => '',
	'category_name'    => $cat,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'paged' => $paged
);
	
$pre = $paged - 1;
$nex = $paged + 1;	
	
$wp_query = new WP_Query( $args );  
$page_count = ceil($wp_query->max_num_pages);
$terms = get_terms( 'category', array('parent' => 4) );?>
<div class="cat-switch-wrap">
<div class="cat-switch" data-cat="Featured">
All
</div>
<?php foreach($terms as $term):?>

<div class="cat-switch" data-cat="<?php echo $term->name;?>">
<?php echo $term->name;?>
</div>
<? endforeach; ?>
</div>
<div class="blog-drop-section">
<?php echo do_shortcode("[featured-drop]");?>
</div>
<div class="dot-nav-wrap">
<?php 
	for ($i = 1; $i <= $page_count; $i++) {
    echo "<div class='dot-nav' data-dot='$i'><i class='fa fa-circle'></i></div>";
	}
?>
</div>
<div class="featured-archive-wrap">
<?php 
	function make_money($field){
		$price = number_format($field, 0);
		
		return $price;
	}
	
	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
         
	
        $asking_price = make_money(get_field('asking_price'));
	    $cash_flow = make_money(get_field('cash_flow'));
	    $down_payment = make_money(get_field('down_payment'));
	
	
?>
       
        <?php if( have_rows('financial_info') ){?>
        <?php while( have_rows('financial_info') ): the_row();?>
        
        <?php
		$benefit = get_sub_field('owner_benefit');
		?>
        
        
        <?php endwhile;?>
        <?php }else{
		
		$benefit = 'N/A';
		
		}		
		?>
        
       <div class="col-md-4">
        	<div class="listing-box">
        		<div class="featured-listing-img">
					<img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>">
				</div>
				<div class="business-type">
					<h2><?php the_field('property_name'); ?></h2>
					<h3>Listing #: <?php the_field('listing_number'); ?></h3>
				</div>
				<div class="listing-detail">
					Asking Price: $<?php echo $asking_price; ?>
				</div>
				<div class="listing-detail">
					Down Payment: $<?php echo $down_payment; ?>
				</div>
				<div class="listing-detail">
					Owner Benefit: <?php if($benefit !== 'N/A'){echo '$'. $benefit;}else{echo $benefit;} ?>
				</div>
				<a href="<?php echo get_permalink($post->ID);?>">
				<div class="listing-detail-bottom">
					<span>VIEW LISTING</span>
				</div>
				</a>
        	</div>
		</div>

<?php endwhile;?>
<?php endif;?>
</div>
<div class="page_nav">
  
   <?php if($pre > 0){
    echo '<div class="page_prev"><i class="fa fa-chevron-left"></i><span>&nbsp;Previous Listings</span></div>';
    }
	if($nex <= $page_count){
	echo '<div class="page_next" ><span>Next Listings&nbsp;</span><i class="fa fa-chevron-right"></i></div>';
	}
	?>
</div>
<script>
(function($){
"use strict";

jQuery(document).ready( function(){

	$('.blog-drop').on('change', function() {
  var cat = this.value;

	feat_details(1,cat);
});
	
$('.blog-drop').val('<?php echo $cat;?>')
	
$('.blog-drop option').each(function(i){
       var curr = '<?php echo $cat;?>';
	   if(curr === $(this).val()){
		   $('blog-drop').val($(this).val());
	   }
    });
	
$('.cat-switch').each(function(){
	var cat = $(this).attr('data-cat');
	var setcat = '<?php echo $cat;?>';
	if(cat === setcat){
		$(this).addClass('yellow');
		$('.cat-switch').not(this).removeClass('yellow');
	}
});

$('.cat-switch').click(function(){
	var cat = $(this).attr('data-cat');
	feat_details(1,cat);
});
$('.dot-nav').each(function(){
	var page = parseInt($(this).attr('data-dot'));

	if(page === <?php echo $paged;?>){
	   $(this).addClass('yellow');
	   }
});
$('.page_prev').click(function(){
	var cat = '<?php echo $cat;?>';
	feat_details(<?php echo $pre; ?>, cat)
});

$('.page_next').click(function(){
	var cat = '<?php echo $cat;?>';
	feat_details(<?php echo $nex; ?>, cat)
});
	
$('.dot-nav').click(function(){
	var page = $(this).attr('data-dot');
	var cat = '<?php echo $cat;?>';
	$(this).addClass('yellow');
	$('.dot-nav').not(this).removeClass('yellow');
	feat_details(page, cat);
});
	
	
});
})(jQuery);
</script>
<?php wp_reset_postdata();
wp_die();
}

function get_professionals(){
	
	global $post;
	
	$args = array(
	'posts_per_page'   => 30,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => 'Professionals',
	'orderby'          => 'meta_value',
	'order'            => 'DESC',
	'meta_key'         => 'prof-position',

);
	$posts_array = get_posts( $args );
	
	function make_money($field){
		$price = number_format($field, 0);
		
		return $price;
	}
	
	?>
<h1 class="pro-title">Find A Professional</h1>
<div class="pro-outer-wrap">
	<div class="bar-div"></div>
	
<?php $posArray = [];?>

<?php
	
	foreach ( $posts_array as $post ) : 
    	setup_postdata( $post ); 
        
	    $position = get_field('prof-position');
	    array_push($posArray, $position);
?>

<?php endforeach;?>

<?php 
$profCat = array_unique($posArray);?>

<div class="col-md-12 prof-filter-col">
<div class="prof-filter-wrap">
<select class="prof-select">
	<option value="All">All</option>
<?php foreach($profCat as $cat):?>
	<option value="<?php echo $cat;?>"><?php echo $cat;?></option>
<?php endforeach;?>
</select>
</div>
<div class="filter-prof-button">FILTER</div>
</div>

<?php
	
	foreach ( $posts_array as $post ) : 
    	setup_postdata( $post ); 
        
	    $position = get_field('prof-position');
	    $name = get_field('prof-name');
	    $company = get_field('prof-company');
	    $addressOne = get_field('prof-address_1');
	    $addressTwo = get_field('prof-address_2');
	    $city = get_field('prof-city');
		$state = get_field('prof-state');
		$zip = get_field('prof-zip');
		$phone = get_field('prof-phone');
		$email = get_field('prof-email');
		$web = get_field('prof-website');
?>
 
  
        <div class="col-md-4 pro-wrap" data-prof="<?php echo $position;?>">
         <?php  if ($position){?>
        	<h3><?php echo $position; ?></h3>
         <?php };
			    if ($name){?> 
        	<h4><?php echo $name; ?></h4>
         <?php };
				if ($company){?>
			<h4><?php echo $company; ?></h4>
		 <?php };
				if ($addressOne){?>
		    <h4><?php echo $addressOne; ?></h4>
		 <?php };
	    		if ($addressTwo){?>
	    	<h4><?php echo $addressTwo; ?></h4>
	     <?php };
				if ($city){?>
			<h4><?php echo $city . ","; ?>
		 <?php };
				if ($state){?>
			<?php echo $state; ?>
		 <?php };
				if ($zip){?>
			<?php echo ' ' . $zip; ?></h4>
		 <?php };
				if ($phone){?>
			<h4><?php echo $phone; ?></h4>
		 <?php };
				if ($email){?>
			<h4><?php echo $email; ?></h4>
		 <?php };
				if ($web){?>
			<h4><?php echo $web; ?></h4>
		 <?php }; ?>
		</div>

<?php endforeach;?>
</div>
<?php wp_reset_postdata();
}

function buffer_professionals(){
	ob_start();
	get_professionals();
	$output = ob_get_clean();
	return $output;
}

add_shortcode("professionals", "buffer_professionals");

function get_featured(){
	global $post;
	
	$args = array(
	'posts_per_page'   => 6,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => 'Featured',
	'orderby'          => 'date',
	'order'            => 'DESC'
);
$posts_array = get_posts( $args );
	
	function make_money($field){
		$price = number_format($field, 0);
		
		return $price;
	}
	
	foreach ( $posts_array as $post ) : 
    	setup_postdata( $post ); 
        
	    
        $asking_price = make_money(get_field('asking_price'));
	    $cash_flow = make_money(get_field('cash_flow'));
	    $down_payment = make_money(get_field('down_payment'));
	
	
?>
         <?php if( have_rows('financial_info') ){?>
        <?php while( have_rows('financial_info') ): the_row();?>
        
        <?php
		$benefit = get_sub_field('owner_benefit');
		?>
        
        
        <?php endwhile;?>
        <?php }else{
		
		$benefit = 'N/A';
		
		}		
		?>
        <div class="col-md-4">
        	<div class="listing-box">
        		<div class="featured-listing-img">
					<img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>">
				</div>
				<div class="business-type">
					<h2><?php the_field('property_name'); ?></h2>
					<h3>Listing #: <?php the_field('listing_number'); ?></h3>
				</div>
				<div class="listing-detail">
					Asking Price: $<?php echo $asking_price; ?>
				</div>
				<div class="listing-detail">
					Down Payment: $<?php echo $down_payment; ?>
				</div>
				<div class="listing-detail">
					Owner Benefit: <?php if($benefit !== 'N/A'){echo '$'. $benefit;}else{echo $benefit;} ?>
				</div>
				<a href="<?php echo get_permalink($post->ID);?>">
				<div class="listing-detail-bottom">
					<span>VIEW LISTING</span>
				</div>
				</a>
        	</div>
		</div>

<?php endforeach;
wp_reset_postdata();
}

function buffer_featured(){
	ob_start();
	get_featured();
	$output = ob_get_clean();
	return $output;
}

function get_all_featured(){
	global $post;
	
	$args = array(
	'posts_per_page'   => 12,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => 'Featured',
	'orderby'          => 'date',
	'order'            => 'DESC'
);
$posts_array = get_posts( $args );
	
	function make_money($field){
		$price = number_format($field, 0);
		
		return $price;
	}
	
	foreach ( $posts_array as $post ) : 
    	setup_postdata( $post ); 
        
	    
        $asking_price = make_money(get_field('asking_price'));
	    $cash_flow = make_money(get_field('cash_flow'));
	    $down_payment = make_money(get_field('down_payment'));
	
	
?>
        
        <div class="col-md-4">
        	<div class="listing-box">
        		<div class="featured-listing-img">
					<img src="<?php echo get_the_post_thumbnail_url($post_id, 'large');?>">
				</div>
				<div class="business-type">
					<h2><?php the_field('property_name'); ?></h2>
					<h3>Listing #: <?php the_field('listing_number'); ?></h3>
				</div>
				<div class="listing-detail">
					Asking Price: $<?php echo $asking_price; ?>
				</div>
				<div class="listing-detail">
					Cash Flow: $<?php echo $cash_flow; ?>
				</div>
				<div class="listing-detail">
					Down Payment: $<?php echo $down_payment; ?>
				</div>
				<a href="<?php echo get_permalink($post->ID);?>">
				<div class="listing-detail-bottom">
					<span>VIEW LISTING</span>
				</div>
				</a>
        	</div>
		</div>

<?php endforeach;
wp_reset_postdata();
}

function buffer_all_featured(){
	ob_start();
	get_all_featured();
	$output = ob_get_clean();
	return $output;
}




/*
* Define a constant path to our single template folder
*/
define(SINGLE_PATH, get_stylesheet_directory() . '/single');



/**
* Single template function which will choose our template
*/
function my_single_template($single) {
global $wp_query, $post;
	
$flag = '';
/**
* Checks for single template by category
* Check by category slug and ID
*/
foreach((array)get_the_category() as $cat) :


if(file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
$flag = SINGLE_PATH . '/single-cat-' . $cat->slug . '.php';


endforeach;
	
	if($flag == ''){
		return SINGLE_PATH . '.php';
	}else{
		return $flag;
	}
}

/**
* Filter the single_template with our custom function
*/
add_filter('single_template', 'my_single_template');

// Update Dashboard CSS
function admin_style() {
wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function add_js_functions(){
?>
<script>
function blog_details(page, cat){
	var curUrl = '<?php echo site_url();?>';
	var info = {
        'action': 'boss_detailed_filter',
        'cat': cat,
		'idx': page
        
    };
	jQuery.ajax({
        type: "POST",
        url: curUrl + '/wp-admin/admin-ajax.php',
  	    data: info,
        success:function(data){
			 jQuery('.blog-data').html(data);
			   }
          });
	
}
	
function feat_details(page, cat){
	var curUrl = '<?php echo site_url();?>';
	var info = {
        'action': 'feat_detailed_filter',
        'cat': cat,
		'idx': page
        
    };
	jQuery.ajax({
        type: "POST",
        url: curUrl + '/wp-admin/admin-ajax.php',
  	    data: info,
        success:function(data){
			 jQuery('.featured-wrap').html(data);
			   }
          });
	
}
</script>
<?php
}


add_action('wp_head','add_js_functions');

add_shortcode("featured", "buffer_featured");
add_shortcode("featured_all", "buffer_all_featured");


wp_register_script( 'boss', get_stylesheet_directory_uri() . '/js/boss.js' );
wp_enqueue_script('jquery');
wp_enqueue_script('boss');

$translation_array = array( 'templateUrl' => site_url() );
//after wp_enqueue_script
wp_localize_script( 'boss', 'object_name', $translation_array );

?>