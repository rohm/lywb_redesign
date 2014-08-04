<?php global $bpxl_ublog_options;
get_header(); ?>
<div class="main-wrapper">
	<div id="page">
<div class="main-content">
<?php
if($bpxl_ublog_options['bpxl_featured'] == '1') {
	if(!is_paged()) {
		get_template_part('inc/featured-section');
	}
} ?>
<?php if($bpxl_ublog_options['bpxl_layout'] == 'scb_layout') { ?>
	<div class="sidebar-small">
		<div class="small-sidebar">
			<?php
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
			?>
		</div><!--End .small-sidebar-->
	</div><!--End .sidebar-small-->
<?php } ?>
<div class="content-area home-content-area">
	<div class="content-home">
		<div class="content<?php if($bpxl_ublog_options['bpxl_layout'] == 'c_layout' || $bpxl_ublog_options['bpxl_layout'] == 'gs_layout' || $bpxl_ublog_options['bpxl_layout'] == 'sg_layout' || $bpxl_ublog_options['bpxl_layout'] == 'g_layout') { echo ' masonry masonry-home'; } ?>">
			<?php
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }
				
				if($bpxl_ublog_options['bpxl_home_latest_posts'] == '1') {
					$recent_cats = $bpxl_ublog_options['bpxl_home_latest_cat'];
					$recent_cat = implode(",", $recent_cats);
					$args = array(
						'cat' => $recent_cat,
						'paged' => $paged
					);
				} else {					
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged
					);
				}

				// The Query
				query_posts( $args );
			
				if (have_posts()) : while (have_posts()) : the_post();
				
				get_template_part( 'content', get_post_format() );
			?>
			<?php endwhile; else: ?>
				<div class="post">
					<div class="no-results">
						<p><strong><?php _e('There has been an error.', 'bloompixel'); ?></strong></p>
						<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'bloompixel'); ?></p>
						<?php get_search_form(); ?>
					</div><!--noResults-->
				</div>  
			<?php endif; ?>
		</div><!--content-->
		<?php if ($bpxl_ublog_options['bpxl_pagination_type'] == '1') {
			bpxl_pagination($wp_query->max_num_pages);
		} else { ?>
			<div class="norm-pagination">
				<div class="nav-previous"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'bloompixel' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'bloompixel' ).' &rarr;' ); ?></div>
			</div>
		<?php } ?>
	</div><!--content-page-->
</div><!--content-area-->
<?php
	$bpxl_layout_array = array(
		'c_layout',
		'g_layout',
		'f_layout'
	);

	if(!in_array($bpxl_ublog_options['bpxl_layout'],$bpxl_layout_array)) {
		get_sidebar();
	}
?>
</div><!--.main-->
<?php get_footer(); ?>