<?php global $bpxl_ublog_options; ?>
<div class="social-links">
	<?php
		$bpxl_social_link_array = $bpxl_ublog_options['bpxl_share_buttons'];
		
		foreach ($bpxl_social_array as $key=>$value) {
			//echo "<span>$value</span> <br>";	  
			if($key == "twitter" && $value == "1") { ?>
				<!-- Twitter -->
				<div class="social-btn social-twitter">
					<a class="fa fa-twitter" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" target="_blank"></a>
				</div>
			<?php }
			elseif($key == "fb" && $value == "1") { ?>
				<!-- Facebook -->
				<div class="social-btn social-fb">
					<a class="fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"></a>
				</div>
			<?php }
			elseif($key == "gplus" && $value == "1") { ?>
				<!-- Google+ -->
				<div class="social-btn social-gplus">
					<a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"></a>
				</div>
			<?php }
			elseif($key == "linkedin" && $value == "1") { ?>
				<!-- LinkedIn -->
				<div class="social-btn social-linkedin">
					<a class="fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&source=<?php echo home_url(); ?>"></a>
				</div>
			<?php }
			elseif($key == "") {
				echo "";
			}
		}			
	?>
</div><!--.share-buttons-->