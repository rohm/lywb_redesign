<?php global $bpxl_ublog_options; ?>
<div class="share-buttons">
	<?php if(is_single()) { ?>
		<div class="social-buttons clearfix">
			<?php
				$bpxl_social_array = $bpxl_ublog_options['bpxl_share_buttons'];
				
				foreach ($bpxl_social_array as $key=>$value) {
					if($key == "twitter" && $value == "1") { ?>
						<!-- Twitter -->
						<div class="social-btn social-twitter">
							<a class="fa fa-twitter" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" target="_blank" original-title="Share on Twitter"></a>
						</div>
					<?php }
					elseif($key == "fb" && $value == "1") { ?>
						<!-- Facebook -->
						<div class="social-btn social-fb">
							<a class="fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on Facebook"></a>
						</div>
					<?php }
					elseif($key == "gplus" && $value == "1") { ?>
						<!-- Google+ -->
						<div class="social-btn social-gplus">
							<a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" original-title="Share on Google+"></a>
						</div>
					<?php }
					elseif($key == "linkedin" && $value == "1") { ?>
						<!-- LinkedIn -->
						<div class="social-btn social-linkedin">
							<a class="fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&source=<?php echo esc_url( home_url() ); ?>" target="_blank" original-title="Share on LinkedIn"></a>
						</div>
					<?php }
					elseif($key == "pinterest" && $value == "1") { ?>
						<!-- Pinterest -->
						<?php $pin_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ); $pin_url = $pin_thumb['0']; ?>
						<div class="social-btn social-pinterest">
							<a class="fa fa-pinterest" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $pin_url; ?>&url=<?php the_permalink() ?>&is_video=false&description=<?php the_title(); ?>" target="_blank" original-title="Share on Pinterest"></a>
						</div>
					<?php }
					elseif($key == "stumbleupon" && $value == "1") { ?>
						<!-- StumbleUpon -->
						<div class="social-btn social-stumbleupon">
							<a class="fa fa-stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on StumbleUpon"></a>
						</div>
					<?php }
					elseif($key == "reddit" && $value == "1") { ?>
						<!-- Reddit -->
						<div class="social-btn social-reddit">
							<a class="fa fa-reddit" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on Reddit"></a>
						</div>
					<?php }
					elseif($key == "tumblr" && $value == "1") { ?>
						<!-- Tumblr -->
						<div class="social-btn social-tumblr">
							<a class="fa fa-tumblr" href="http://www.tumblr.com/share?v=3&u=<?php the_permalink() ?>&t=<?php the_title(); ?>" target="_blank" original-title="Share on Tumblr"></a>
						</div>
					<?php }
					elseif($key == "delicious" && $value == "1") { ?>
						<!-- Delicious -->
						<div class="social-btn social-delicious">
							<a class="fa fa-delicious" href="http://del.icio.us/post?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&notes=<?php the_title(); ?>" target="_blank" original-title="Share on Delicious"></a>
						</div>
					<?php }
					else {
						echo "";
					}
				}			
			?>
		</div>
	<?php } else { ?>
		<div class="social-buttons clearfix">
			<?php
				$bpxl_social_array_home = $bpxl_ublog_options['bpxl_share_buttons_home'];
				
				foreach ($bpxl_social_array_home as $key=>$value) {
					if($key == "twitter" && $value == "1") { ?>
						<!-- Twitter -->
						<div class="social-btn social-twitter">
							<a class="fa fa-twitter" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" target="_blank" original-title="Share on Twitter"></a>
						</div>
					<?php }
					elseif($key == "fb" && $value == "1") { ?>
						<!-- Facebook -->
						<div class="social-btn social-fb">
							<a class="fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on Facebook"></a>
						</div>
					<?php }
					elseif($key == "gplus" && $value == "1") { ?>
						<!-- Google+ -->
						<div class="social-btn social-gplus">
							<a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" original-title="Share on Google+"></a>
						</div>
					<?php }
					elseif($key == "linkedin" && $value == "1") { ?>
						<!-- LinkedIn -->
						<div class="social-btn social-linkedin">
							<a class="fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&source=<?php echo esc_url( home_url() ); ?>" target="_blank" original-title="Share on LinkedIn"></a>
						</div>
					<?php }
					elseif($key == "pinterest" && $value == "1") { ?>
						<!-- Pinterest -->
						<?php $pin_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ); $pin_url = $pin_thumb['0']; ?>
						<div class="social-btn social-pinterest">
							<a class="fa fa-pinterest" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $pin_url; ?>&url=<?php the_permalink() ?>&is_video=false&description=<?php the_title(); ?>" target="_blank" original-title="Share on Pinterest"></a>
						</div>
					<?php }
					elseif($key == "stumbleupon" && $value == "1") { ?>
						<!-- StumbleUpon -->
						<div class="social-btn social-stumbleupon">
							<a class="fa fa-stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on StumbleUpon"></a>
						</div>
					<?php }
					elseif($key == "reddit" && $value == "1") { ?>
						<!-- Reddit -->
						<div class="social-btn social-reddit">
							<a class="fa fa-reddit" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" target="_blank" original-title="Share on Reddit"></a>
						</div>
					<?php }
					elseif($key == "tumblr" && $value == "1") { ?>
						<!-- Tumblr -->
						<div class="social-btn social-tumblr">
							<a class="fa fa-tumblr" href="http://www.tumblr.com/share?v=3&u=<?php the_permalink() ?>&t=<?php the_title(); ?>" target="_blank" original-title="Share on Tumblr"></a>
						</div>
					<?php }
					elseif($key == "delicious" && $value == "1") { ?>
						<!-- Delicious -->
						<div class="social-btn social-delicious">
							<a class="fa fa-delicious" href="http://del.icio.us/post?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&notes=<?php the_title(); ?>" target="_blank" original-title="Share on Delicious"></a>
						</div>
					<?php }
					else {
						echo "";
					}
				}		
			?>
		</div>
	<?php } ?>
</div><!--.share-buttons-->