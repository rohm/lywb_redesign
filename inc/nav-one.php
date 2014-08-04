<?php global $bpxl_ublog_options; ?>
<div class="top-bar clearfix">
	<div class="center-width">
		<div class="menu-btn off-menu fa fa-align-justify" data-effect="st-effect-4"></div>
		<div class="top-nav">
			<nav id="navigation" >
				<?php if ( has_nav_menu( 'secondary-menu' ) ) {
					wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
				} ?>
			</nav>
		</div><!-- .main-nav -->
		<?php if ($bpxl_ublog_options['bpxl_social_links'] == '1') { ?>
			<div class="social-links">
				<?php if ($bpxl_ublog_options['bpxl_twitter'] != '') { ?><a class="fa fa-twitter twitter" href="<?php echo $bpxl_ublog_options['bpxl_twitter']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_facebook'] != '') { ?><a class="fa fa-facebook facebook" href="<?php echo $bpxl_ublog_options['bpxl_facebook']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_youtube'] != '') { ?><a class="fa fa-youtube-play youtube" href="<?php echo $bpxl_ublog_options['bpxl_youtube']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_instagram'] != '') { ?><a class="fa fa-instagram instagram" href="<?php echo $bpxl_ublog_options['bpxl_instagram']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_googleplus'] != '') { ?><a class="fa fa-google-plus gplus" href="<?php echo $bpxl_ublog_options['bpxl_googleplus']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_flickr'] != '') { ?><a class="fa fa-flickr flickr" href="<?php echo $bpxl_ublog_options['bpxl_flickr']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_linked'] != '') { ?><a class="fa fa-linkedin linkedin" href="<?php echo $bpxl_ublog_options['bpxl_linked']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_rss'] != '') { ?><a class="fa fa-rss rss" href="<?php echo $bpxl_ublog_options['bpxl_rss']; ?>"></a><?php } ?>
				<?php if ($bpxl_ublog_options['bpxl_pinterest'] != '') { ?><a class="fa fa-pinterest pinterest" href="<?php echo $bpxl_ublog_options['bpxl_pinterest']; ?>"></a><?php } ?>
			</div><!-- .social-links -->
		<?php }
		if ($bpxl_ublog_options['bpxl_header_search'] == '1') { ?>
			<div class="header-search"><?php get_search_form(); ?></div>
		<?php } ?>
	</div>
</div><!--.top-bar-->