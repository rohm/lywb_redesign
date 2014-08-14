<?php get_header(); ?>
<?php global $bpxl_ublog_options; ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content">
			<div class="detail-page">
				<?php if($bpxl_ublog_options['bpxl_single_layout'] == 'scb_single_layout') { ?>
					<div class="sidebar-small">
						<div class="small-sidebar">
							<?php
								if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
							?>
						</div><!--End .small-sidebar-->
					</div><!--End .sidebar-small-->
				<?php } ?>
				<div class="content-area single-content-area">
					<div class="content-page">
						<div class="content-detail">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
								<?php if($bpxl_ublog_options['bpxl_breadcrumbs'] == '1') { ?>
									<div class="breadcrumbs">
										<?php bpxl_breadcrumb(); ?>
									</div>
								<?php }?>
								<div class="page-content">
									<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
										<div class="post-box">
											<div class="post-home">
												<header>
													<h1 class="title page-title"><?php the_title(); ?></h1>
												</header>
												
												<div class="post-content single-page-content">
													<?php the_content(); ?>
													<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
												</div>
											</div>
										</div>
									</article><!--blog post-->
								</div>	
								<!-- ? php comments_template(); ? -->
								<?php endwhile; ?>
								<?php else : ?>
									<div class="post">
										<div class="single-page-content error-page-content">
											<p><strong><?php _e('Nothing Found', 'bloompixel'); ?></strong></p>
											<?php get_search_form(); ?>
										</div><!--noResults-->
									</div>  
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php 
					$sidebar_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
					
					if ($bpxl_ublog_options['bpxl_single_layout'] != 'f_single_layout') {
						if ($sidebar_position == 'left' || $sidebar_position == 'right' || $sidebar_position == 'default' || empty($sidebar_position)) {
							get_sidebar();
						}
					}
				?>
			</div><!--.detail-page-->
		</div><!--.main-content-->
<?php get_footer();?>