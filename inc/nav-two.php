<?php global $bpxl_ublog_options; ?>
<div class="main-navigation clearfix">
	<div class="main-nav">
		<nav id="navigation" >
			<?php if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
			} ?>
		</nav>
	</div><!-- .main-nav -->
</div><!-- .main-navigation -->