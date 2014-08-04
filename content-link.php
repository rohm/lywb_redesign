<?php global $bpxl_ublog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<div class="header-top uppercase clearfix">
			<?php if(isset($bpxl_ublog_options['bpxl_post_meta_options']['2']) == '1') { ?>
				<div class="header-time">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" title="<?php echo esc_html( get_the_date() ); ?>">
						<span class="post-date"><?php the_time('d'); ?></span>
						<span class="post-month uppercase"><?php the_time('F'); ?> <span><?php the_time('Y'); ?></span></span>
					</time>
				</div>
			<?php } ?>
			<?php if(isset($bpxl_ublog_options['bpxl_post_meta_options']['3']) == '1') { ?>
				<div class="header-cat">
					<?php $category = get_the_category();
					if ($category) {
					  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "bloompixel" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
					} ?>
				</div>
			<?php } ?>
			<?php // Post Format Icons
				if($bpxl_ublog_options['bpxl_post_icon'] == '1') {
					get_template_part('inc/post-format-icons'); 
				}
			?>
		</div><!--.header-top-->
		<div class="post-home">
			<?php
				$bpxl_link_url = rwmb_meta( 'bpxl_linkurl', $args = array('type' => 'text'), $post->ID );
				$bpxl_link_bg = rwmb_meta( 'bpxl_link_background', $args = array('type' => 'text'), $post->ID );
				
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'featured');
				
				$status_bg = $thumb_url[0];
				if(!empty($status_bg)) {
					$status_bg_code = 'style=" background: url('.$status_bg.') cover;"';
				} else if(!empty($bpxl_link_bg)) {
					$status_bg_code = 'style=" background:'.$bpxl_link_bg.'"';
				} else {
					$status_bg_code = '';
				}
			?>
			<header>
				<?php if ( is_single() ) : ?>
					<h2 class="title entry-title title32"><?php the_title(); ?></h2>
				<?php else : ?>
					<h2 class="title entry-title title32">
						<a href="<?php echo $bpxl_link_url; ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php endif; // is_single() ?>
			</header><!--.header-->
			<?php
			// Post Meta
			get_template_part('inc/post-meta'); ?>	
			<div class="post-inner">
				<a href="<?php echo $bpxl_link_url; ?>">
					<div class="post-content post-format-link" <?php echo $status_bg_code; ?>>
						<i class="fa fa-link post-format-icon"></i>
						<div class="post-format-link-content">
							<?php echo $bpxl_link_url; ?>
						</div>
					</div>
				</a>
				<div class="post-content">
					<?php
						if(is_single()) { ?>
							<div class="post-content entry-content single-post-content">
								<?php if($bpxl_ublog_options['bpxl_below_title_ad'] != '') { ?>
									<div class="single-post-ad">
										<?php echo $bpxl_ublog_options['bpxl_below_title_ad']; ?>
									</div>
								<?php } ?>
									
								<?php the_content(); ?>
								
								<?php if($bpxl_ublog_options['bpxl_below_content_ad'] != '') { ?>
									<div class="single-post-ad">
										<?php echo $bpxl_ublog_options['bpxl_below_content_ad']; ?>
									</div>
								<?php } ?>
									
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bloompixel' ), 'after' => '</div>' ) ); ?>
							</div><!--.single-post-content-->
						<?php } elseif ( is_search() ) { ?>
							<div class="post-content entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						<?php } else { ?>
							<?php $bpxl_link_excerpt_home = rwmb_meta( 'bpxl_link_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
							if(empty($bpxl_link_excerpt_home)) { ?>
								<div class="post-content entry-content">
									<?php
									$excerpt_length = $bpxl_ublog_options['bpxl_excerpt_length'];
									if($bpxl_ublog_options['bpxl_home_content'] == '2') {
										the_content('Read more...');
									} else {
										echo '<p>' . excerpt($excerpt_length) . '</p>'; ?>
										<div class="read-more">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e('Read More','bloompixel'); ?></a>
										</div><?php
									} ?>
								</div><!--post-content-->
							<?php } ?>	
						<?php } ?>
				</div>
			</div><!--.post-inner-->
		</div><!--.post-home-->
		<div class="post-share">
			<?php if(is_single()) {
				if($bpxl_ublog_options['bpxl_show_share_buttons'] == '1') {
					get_template_part('inc/share-buttons');
				}
			} else {
				if($bpxl_ublog_options['bpxl_show_home_share_buttons'] == '1') {
					get_template_part('inc/share-buttons');
				}
			} ?>
		</div><!--.post-share-->
	</div><!--.post excerpt-->
</article><!--.post-box-->