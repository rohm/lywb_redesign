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
			
				$bpxl_audio_url = rwmb_meta( 'bpxl_audiourl', $args = array('type' => 'text'), $post->ID );
				$bpxl_audio_host = rwmb_meta( 'bpxl_audiohost', $args = array('type' => 'text'), $post->ID );
				$bpxl_audio_mp3 = rwmb_meta( 'bpxl_mp3url', $args = array('type' => 'file_advanced'), $post->ID );
				$bpxl_audio_embed_code = rwmb_meta( 'bpxl_audiocode', $args = array('type' => 'textarea'), $post->ID );
			?>
			<div class="audio-box clearfix">
				<?php if ($bpxl_audio_embed_code != '') {
					echo $bpxl_audio_embed_code;
				} else if($bpxl_audio_host == 'soundcloud') { ?>
					<iframe border="no" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php if($bpxl_audio_url != '') { echo $bpxl_audio_url; } ?>&auto_play=false&hide_related=false&visual=true"></iframe>
				<?php } else if ($bpxl_audio_host == 'mixcloud') { ?>
					<iframe width="100%" src="//www.mixcloud.com/widget/iframe/?feed=<?php if($bpxl_audio_url != '') { echo $bpxl_audio_url; } ?>&embed_type=widget_standard&embed_uuid=43f53ec5-65c0-4d1f-8b55-b26e0e7c2288&hide_tracklist=1&hide_cover=1" frameborder="0"></iframe>
				<?php } else if ($bpxl_audio_mp3 != NULL) {
					foreach ($bpxl_audio_mp3 as $bpxl_audio_mp3_id) {
						echo do_shortcode( '[audio src="'. $bpxl_audio_mp3_id['url'] .'"][/audio]' );
					}
				} ?>
			</div>
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
					<?php $bpxl_audio_excerpt_home = rwmb_meta( 'bpxl_audio_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
					if(empty($bpxl_audio_excerpt_home)) { ?>
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