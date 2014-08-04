<?php global $bpxl_ublog_options; ?>
<?php $bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID ); ?>
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
			<header>
				<?php if ( is_single() ) {
					if($bpxl_cover == '0' || $bpxl_cover == '') { ?>
					<h2 class="title entry-title title32"><?php the_title(); ?></h2>
				<?php }
				} else { ?>
					<h2 class="title entry-title title32">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php } // is_single() ?>
			</header><!--.header-->
			<?php
			// Post Meta
			get_template_part('inc/post-meta');
			
			$bpxl_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			
			<a href="<?php echo $bpxl_url; ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail featured-thumbnail-big">
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('featured');
					} else {
						echo '<img width="770" height="355" src="' . get_stylesheet_directory_uri() . '/images/770x355.png" />';
					}
				?>
			</a>
			<div class="post-inner">
				<?php if( is_single() ) { ?>
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
					<?php $bpxl_image_excerpt_home = rwmb_meta( 'bpxl_image_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
					if(empty($bpxl_image_excerpt_home)) { ?>
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