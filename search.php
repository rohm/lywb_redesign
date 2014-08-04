<?php global $bpxl_ublog_options; ?>
<?php get_header(); ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content">
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
				<h1 class="section-heading uppercase"><?php _e('Search Results', 'bloompixel'); ?></h1>
				<div class="content<?php if($bpxl_ublog_options['bpxl_layout'] == 'c_layout' || $bpxl_ublog_options['bpxl_layout'] == 'gs_layout' || $bpxl_ublog_options['bpxl_layout'] == 'sg_layout' || $bpxl_ublog_options['bpxl_layout'] == 'g_layout') { echo ' masonry masonry-home'; } ?>">
					<?php
						if (have_posts()) : while (have_posts()) : the_post();
						
						get_template_part( 'content', get_post_format() );
					?>
					<?php endwhile; else: ?>
						<div class="post">
							<div class="single-page-content error-page-content">
								<p><strong><?php _e('Nothing Found', 'bloompixel'); ?></strong></p>
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
				'g_layout'
			);
		?>
		<?php if(!in_array($bpxl_ublog_options['bpxl_layout'],$bpxl_layout_array)) { ?>
		<?php get_sidebar(); ?>
		<?php } ?>
		</div><!--.main-->
<?php get_footer(); ?>