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
						<div class="author-box author-desc-box">
							<h4 class="author-box-title widget-title uppercase"><?php _e('Author Description','bloompixel'); ?></h4>
							<div class="author-box-content">
								<div class="author-box-avtar">
									<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '140' );  } ?>
								</div>
								<div class="author-info-container">
									<div class="author-info">
										<div class="author-head">
											<h5><?php the_author_meta('display_name'); ?></h5>
										</div>
										<p><?php the_author_meta('description') ?></p>
										<div class="author-social">
											<?php if(get_the_author_meta('facebook')) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo get_the_author_meta('facebook'); ?>"></a></span><?php } ?>
											<?php if(get_the_author_meta('twitter')) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo get_the_author_meta('twitter'); ?>"></a></span><?php } ?>
											<?php if(get_the_author_meta('googleplus')) { ?><span class="author-gp"><a class="fa fa-google-plus" href="<?php echo get_the_author_meta('googleplus'); ?>"></a></span><?php } ?>
											<?php if(get_the_author_meta('linkedin')) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo get_the_author_meta('linkedin'); ?>"></a></span><?php } ?>
											<?php if(get_the_author_meta('pinterest')) { ?><span class="author-pinterest"><a class="fa fa-pinterest" href="<?php echo get_the_author_meta('pinterest'); ?>"></a></span><?php } ?>
											<?php if(get_the_author_meta('dribbble')) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo get_the_author_meta('dribble'); ?>"></a></span><?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div><!--.author-desc-box-->
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