<?php global $bpxl_ublog_options; ?>
		</div><!--#page-->
	</div><!--.main-wrapper-->
	<footer class="footer">
		<div class="container">
			<?php if ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_4') { ?>
				<div class="footer-widgets footer-columns-4">
					<div class="footer-widget footer-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-3">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-4 last">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) : ?>
						<?php endif; ?>
					</div>
				</div><!-- .footer-widgets -->
			<?php } elseif ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_3') { ?>
				<div class="footer-widgets footer-columns-3">
					<div class="footer-widget footer-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-3 last">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
						<?php endif; ?>
					</div>
				</div><!-- .footer-widgets -->
			<?php } elseif ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_2') { ?>
				<div class="footer-widgets footer-columns-2">
					<div class="footer-widget footer-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
						<?php endif; ?>
					</div>
					<div class="footer-widget footer-widget-2 last">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
						<?php endif; ?>
					</div>
				</div><!-- .footer-widgets -->
			<?php } else { ?>
				<div class="footer-widgets footer-columns-1">
					<div class="footer-widget footer-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
						<?php endif; ?>
					</div>
				</div><!-- .footer-widgets -->
			<?php } ?>
		</div><!-- .container -->
	</footer>
	<div class="copyright">
		<div class="copyright-inner">
			<?php if($bpxl_ublog_options['bpxl_footer_text'] != '') { ?><div class="copyright-text"><?php echo $bpxl_ublog_options['bpxl_footer_text']; ?></div><?php } ?>
			<div class="footer-menu">
				<?php if ( has_nav_menu( 'footer-menu' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
				} ?>
			</div>
		</div>
	</div><!-- .copyright -->
	</div><!-- .st-pusher -->
</div><!-- .main-container -->
<?php if ($bpxl_ublog_options['bpxl_scroll_btn'] == '1') { ?>
	<div class="back-to-top"><i class="fa fa-arrow-up"></i></div>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>