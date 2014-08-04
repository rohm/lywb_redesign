<?php global $bpxl_ublog_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>">
		<div class="post-inner">
			<?php
				$bpxl_sourcename = rwmb_meta( 'bpxl_sourcename', $args = array('type' => 'text'), $post->ID );
				$bpxl_sourceurl = rwmb_meta( 'bpxl_sourceurl', $args = array('type' => 'text'), $post->ID );
				
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'featured');
				
				$status_bg = $thumb_url[0];
				if(!empty($status_bg)) {
					$status_bg_code = 'style=" background-image:url('.$status_bg.'); background-size: cover;"';
				} else {
					$status_bg_code = '';
				}
			?>
			<div class="post-content post-format-quote" <?php echo $status_bg_code; ?>>
				<i class="fa fa-quote-left post-format-icon"></i>
				<div class="post-format-quote-content">
					<?php the_content(); ?>
					<div class="quote-source">
					<?php
						if ($bpxl_sourceurl != '') {
							echo '- <a href="' . $bpxl_sourceurl . '">' . $bpxl_sourcename . '</a>';
						} else if ($bpxl_sourcename != '') {
							echo '- ' . $bpxl_sourcename;
						}
					?>
					</div>
				</div>
			</div>
		</div><!--.post-inner-->
	</div><!--.post excerpt-->
</article><!--.post-box-->