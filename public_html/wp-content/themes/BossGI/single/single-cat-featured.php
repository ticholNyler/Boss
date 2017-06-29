<?php

$post_id = $post->ID; // current post ID
$cat = get_the_category(); 
$current_cat_id = $cat[0]->cat_ID; // current category ID 

$args = array( 
    'category' => $current_cat_id,
    'orderby'  => 'post_date',
    'order'    => 'DESC'
);
$posts = get_posts( $args );
// get IDs of posts retrieved from get_posts
$ids = array();
foreach ( $posts as $thepost ) {
    $ids[] = $thepost->ID;
}
// get and echo previous and next post in the same category
$thisindex = array_search( $post_id, $ids );
$previd = $ids[ $thisindex - 1 ];
$nextid = $ids[ $thisindex + 1 ];


get_header();

?>

<div id="main-content" class="listing-content">
	<div class="container">
		    
			    <!--Top Section-->
				<div class="row">
					<div class="col-md-12 prop-name">
						<h1><?php the_field('property_name'); ?></h1>
						<h3>Listing #: <?php the_field('listing_number'); ?></h3>
						<div class="bar-div"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<img src="<?php echo get_the_post_thumbnail_url($post_id, 'full');?>">
					</div>
					<div class="col-md-4">
					    <div class="listing-contact-wrap">
					    	<div class="listing-header">
								<h4>Contact Us About This Listing:</h4>
							</div>
						<div class="listing-contact">
							<?php echo do_shortcode("[ninja_form id=4]")?>
						</div>
						</div>
				</div>
				</div>
				<!--End Top Section-->
				
				<!--First Financial Section-->
		<div class="row first-financial">
			<div class="col-md-2 col-xs-6 finance-head">
				<div>Asking Price:</div>
				<div>Down Payment:</div>
				<div>Financing Available:</div>
			</div>
			<div class="col-md-2 col-xs-6 finance-data">
				<div><?php the_field('asking_price'); ?></div>
				<div><?php the_field('down_payment'); ?></div>
				<div><?php the_field('financing_available'); ?></div>
			</div>
			<div class="col-md-2 col-xs-6 finance-head">
				<div>Gross Income:</div>
				<div>Adjust Net:</div>
				<div>Year Established:</div>
			</div>
			<div class="col-md-2 col-xs-6 finance-data">
				<div><?php the_field('gross_income'); ?></div>
				<div><?php the_field('adjust_net'); ?></div>
				<div><?php the_field('year_established'); ?></div>
			</div>
			<div class="col-md-2 col-xs-6 finance-head">
				<div>Category:</div>
				<div>County:</div>
				<div>State:</div>
			</div>
			<div class="col-md-2 col-xs-6 finance-data">
				<div><?php the_field('category'); ?></div>
				<div><?php the_field('county'); ?></div>
				<div><?php the_field('state'); ?></div>
			</div>
		</div>
			
			<!--End First Financial-->
			
	</div> <!-- container -->
	
	
	<!--description-->
	
	<div class="featured-desc-wrapper">
		<div class="container">
				<h3>Description:</h3>
				<p><?php the_field('description'); ?></p>
		</div>
	</div>
	
	<!--End description-->
	
	
	<!--Assets & Liabilites-->
	
	<?php while( have_rows('accounts_receivable') ): the_row();?>
	<?php $arMain = get_sub_field('accounts_receivable_main');?>
	<?php $arIncl = get_sub_field('accounts_receivable_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('inventory') ): the_row();?>
	<?php $invMain = get_sub_field('inventory_main');?>
	<?php $invIncl = get_sub_field('inventory_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('ffande') ): the_row();?>
	<?php $ffMain = get_sub_field('ffande_main');?>
	<?php $ffIncl = get_sub_field('ffande_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('leasehold') ): the_row();?>
	<?php $leaseMain = get_sub_field('leasehold_main');?>
	<?php $leaseIncl = get_sub_field('leasehold_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('real_estate') ): the_row();?>
	<?php $realMain = get_sub_field('real_estate_main');?>
	<?php $realIncl = get_sub_field('real_estate_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('liabilities') ): the_row();?>
	<?php $liabilitiesMain = get_sub_field('liabilities_main');?>
	<?php $liabilitiesIncl = get_sub_field('liabilities_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('other') ): the_row();?>
	<?php $otherMain = get_sub_field('other_main');?>
	<?php $otherIncl = get_sub_field('other_incl');?>
	<?php endwhile;?>
	
	<?php while( have_rows('total_assets') ): the_row();?>
	<?php $assetsMain = get_sub_field('total_assets_main');?>
	<?php $assetsIncl = get_sub_field('total_assets_incl');?>
	<?php endwhile;?>
	
	
	
	
	<div class="container liabilities">
		<h2>Assets &amp; Liabilities:</h2>
		<div class="col-md-6 ">
			<div class="col-md-4 col-xs-6 finance-head">
				<div>Accounts Receivable:</div>
				<div>Inventory:</div>
				<div>FF&amp;E:</div>
				<div>Leasehold:</div>
			</div>
			<div class="col-md-3 col-xs-3 finance-data">
				<div><?php echo $arMain;?></div>
				<div><?php echo $invMain;?></div>
				<div><?php echo $ffMain;?></div>
				<div><?php echo $leaseMain;?></div>
			</div>
			<div class="col-md-2 col-xs-1 finance-head">
				<div>Incl:</div>
				<div>Incl:</div>
				<div>Incl:</div>
				<div>Incl:</div>
			</div>
			<div class="col-md-3 col-xs-2 finance-data">
				<div><?php echo $arIncl;?></div>
				<div><?php echo $invIncl;?></div>
				<div><?php echo $ffIncl;?></div>
				<div><?php echo $leaseIncl;?></div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-4 col-xs-6 finance-head">
				<div>Real Estate:</div>
				<div>Liabilities:</div>
				<div>Other:</div>
				<div>Total Assets:</div>
			</div>
			<div class="col-md-3 col-xs-3 finance-data">
				<div><?php echo $realMain;?></div>
				<div><?php echo $liabilitiesMain;?></div>
				<div><?php echo $otherMain;?></div>
				<div><?php echo $assetsMain;?></div>
			</div>
			<div class="col-md-2 col-xs-1 finance-head">
				<div>Incl:</div>
				<div>Incl:</div>
				<div>Incl:</div>
				<div>Incl:</div>
			</div>
			<div class="col-md-3 col-xs-2 finance-data last-col">
				<div><?php echo $realIncl;?></div>
				<div><?php echo $liabilitiesIncl;?></div>
				<div><?php echo $otherIncl;?></div>
				<div><?php echo $assetsIncl;?></div>
			</div>
		</div>
	</div>	
	
	<!--end liablilities-->
	
	
	
	<!--Financial Info-->
	
	<?php $count = 0;?>
	
	<?php if( have_rows('financial_info') ):?>
	
	<?php 
	
		$numRows = count(get_field('financial_info'));
	    
	    if($numRows == 1){
			$col = "col-md-12";
		}else if($numRows == 2){
			$col = "col-md-6";
		}else if($numRows == 3){
			$col = "col-md-4";
		}
	?>

	
	<div class="container financial-info">
	 	<div class="finance-title-wrap">
			<span class="finance-title">Financial Information:</span>
		</div>
		<?php while( have_rows('financial_info') ): the_row();?>
		    <?php $count++;?>
			<?php $year = get_sub_field('year');?>
			<?php $report = get_sub_field('report_type');?>
			<?php $gross = get_sub_field('gross_income');?>
			<?php $cogs = get_sub_field('cogs');?>
			<?php $grossProfit = get_sub_field('gross_profit');?>
			<?php $expenses = get_sub_field('expenses');?>
			<?php $net = get_sub_field('net');?>
			<?php $adbacks = get_sub_field('adbacks');?>
			<?php $benefit = get_sub_field('owner_benefit');?>
			
			<div class="<?php echo $col;?> finance_section">
				<div class="col-md-7 col-xs-6 finance-head <?php if($count == 1 || $count % 4 == 0){echo 'first-col';}?>">
					<div>Year:</div>
					<div>Type of Report:</div>
					<div>Gross Income:</div>
					<div>COGS:</div>
					<div>Gross Profit:</div>
					<div>Expenses:</div>
					<div>Net:</div>
					<div>Adbacks:</div>
					<div>Owner Benefit:</div>
				</div>
				<div class="col-md-5 col-xs-6 finance-data <?php if($count == $numRows){echo 'last-col';}?>">
					<div><?php echo $year;?></div>
					<div><?php echo $report;?></div>
					<div><?php echo $gross;?></div>
					<div><?php echo $cogs;?></div>
					<div><?php echo $grossProfit;?></div>
					<div><?php echo $expenses;?></div>
					<div><?php echo $net;?></div>
					<div><?php echo $adbacks;?></div>
					<div><?php echo $benefit;?></div>
				</div>
			</div>
		<?php endwhile;?>
	</div>
	
	<?php endif;?>
	
	<!--End financial info-->
	
	<div class="wide-border">
	</div>
	
	
	<!--Lease Info-->
	
	<div class="container lease-info">
		<h2>Lease Information:</h2>
		<div class="col-md-6">
			<div class="col-md-8 col-xs-6 finance-head">
				<div>Rent Price:</div>
				<div>Building Type:</div>
				<div>Square Footage:</div>
			</div>
			<div class="col-md-4 col-xs-6 finance-data">
				<div><?php the_field('rent_price'); ?></div>
				<div><?php the_field('building_type'); ?></div>
				<div><?php the_field('square_footage'); ?></div>
			</div>
		</div>
	</div>
	
	<!--End Lease Info-->
	
	
	<div class="wide-border">
	</div>
	
	<!--Additional Info-->
	
	<div class="container add-info">
		<h2>Additional Information:</h2>
		<div class="col-md-2 col-xs-7 finance-head first-col">
			<div>FT Employees:</div>
			<div>PT Employees:</div>
			<div>Manager(s):</div>
		</div>
		<div class="col-md-2 col-xs-5 finance-data">
			<div><?php the_field('ft_employees'); ?></div>
			<div><?php the_field('pt_employees'); ?></div>
			<div><?php the_field('manager'); ?></div>
		</div>
		<div class="col-md-2 col-xs-7 finance-head">
			<div>Operating Hours:</div>
			<div>Years Owned:</div>
			<div>Hours of Operation:</div>
		</div>
		<div class="col-md-2 col-xs-5 finance-data">
			<div><?php the_field('operating_hours'); ?></div>
			<div><?php the_field('years_owned'); ?></div>
			<div><?php the_field('hours_of_operation'); ?></div>
		</div>
		<div class="col-md-3 col-xs-7 finance-head">
			<div>Experience/License Req'd:</div>
			<div>Familiarization Period:</div>
			<div>Non-Compete:</div>
		</div>
		<div class="col-md-1 col-xs-5 finance-data last-col">
			<div><?php the_field('experience'); ?></div>
			<div><?php the_field('familiarization_period'); ?></div>
			<div><?php the_field('non-compete'); ?></div>
		</div>
	</div>
	
	<!-- End Add Info-->
	
	
	<!--Non Disclosure Button-->
	
	<div class="nd-wrap">
		<div class="container nd-cont">
			<div class="col-md-12">
				<a href="">
     				<div class="nd-button">
          				Fill out a Non-Disclosure <br>Agreement and get started!
     				</div>
				</a>
			</div>
		</div>
	</div>
	
	<!--End Non disclosure button-->
	
	
	<div class="container featured-post-nav">
	<?php
		if ( ! empty( $previd ) ): ?>
		<div class="prev-featured">
			<a rel="prev" href="<?php echo get_permalink($previd) ?>"><i class="fa fa-chevron-left"></i>Previous Listing</a>
		</div>
		<?php endif;

		
		if ( ! empty( $nextid ) ):?>
		<div class="next-featured">
			<a rel="next" href="<?php echo get_permalink($nextid) ?>">Next Listing<i class="fa fa-chevron-right"></i></a>
		</div>
		<?php endif;?>
	</div>
	
	
	
</div>
<?php get_footer(); ?>