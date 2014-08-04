<?php get_header(); ?>
<?php global $bpxl_ublog_options; ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content">
			<div class="archive-page">
				<?php if($bpxl_ublog_options['bpxl_archive_layout'] == 'scb_archive_layout') { ?>
					<div class="sidebar-small">
						<div class="small-sidebar">
							<?php
								if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
							?>
						</div><!--End .small-sidebar-->
					</div><!--End .sidebar-small-->
				<?php } ?>
				<div class="content-area archive-content-area">
					<div class="content-archive">
						<h1 class="section-heading widget-title uppercase">
							<span>
								<?php if (is_category()) { ?>
									<?php single_cat_title(); ?><?php _e(" Archive", "bloompixel"); ?>
								<?php } elseif (is_tag()) { ?> 
									<?php single_tag_title(); ?><?php _e(" Archive", "bloompixel"); ?>
								<?php } elseif (is_search()) { ?> 
									<?php _e("Search Results for:", "bloompixel"); ?> <?php the_search_query(); ?>
								<?php } elseif (is_author()) { ?>
									<?php _e("Author Archive", "bloompixel"); ?> 
								<?php } elseif (is_day()) { ?>
									<?php _e("Daily Archive:", "bloompixel"); ?> <?php the_time('l, F j, Y'); ?>
								<?php } elseif (is_month()) { ?>
									<?php _e("Monthly Archive:", "bloompixel"); ?>: <?php the_time('F Y'); ?>
								<?php } elseif (is_year()) { ?>
									<?php _e("Yearly Archive:", "bloompixel"); ?>: <?php the_time('Y'); ?>
								<?php } ?>
							</span>
						</h1>
						<div class="content<?php if($bpxl_ublog_options['bpxl_archive_layout'] == 'c_archive_layout' || $bpxl_ublog_options['bpxl_archive_layout'] == 'gs_archive_layout' || $bpxl_ublog_options['bpxl_archive_layout'] == 'sg_archive_layout' || $bpxl_ublog_options['bpxl_archive_layout'] == 'g_archive_layout') { echo ' masonry masonry-archive'; } ?>">
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
						</div><!--.content-->
						<?php if ($bpxl_ublog_options['bpxl_pagination_type'] == '1') {
								bpxl_pagination($wp_query->max_num_pages);
						} else { ?>
							<div class="norm-pagination">
								<div class="nav-previous"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'bloompixel' ) ); ?></div>
								<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'bloompixel' ).' &rarr;' ); ?></div>
							</div>
						<?php } ?>
						</div>
				</div>
				<?php
					$bpxl_layout_array = array(
						'c_archive_layout',
						'g_archive_layout',
						'f_archive_layout'
					);
					if(!in_array($bpxl_ublog_options['bpxl_archive_layout'],$bpxl_layout_array)) { get_sidebar(); }
				?>
			</div><!--.archive-page-->
		</div><!--.main-content-->
<?php get_footer(); ?>