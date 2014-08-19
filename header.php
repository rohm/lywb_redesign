<!DOCTYPE html>
<?php global $bpxl_ublog_options; ?>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title itemprop="name"><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if (!empty($bpxl_ublog_options['bpxl_favicon']['url'])) { ?>
<link rel="icon" href="<?php echo $bpxl_ublog_options['bpxl_favicon']['url']; ?>" type="image/x-icon" />
<?php } ?>
<meta name="viewport" content="width=device-width" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<?php if($bpxl_ublog_options['bpxl_layout_type'] != '1') { $layout_class = ' boxed-layout'; } ?>
<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<div id="st-container" class="st-container">
		<nav class="st-menu st-effect-4" id="menu-4">
			<div id="close-button"><i class="fa fa-times"></i></div>
			<div class="off-canvas-search">
				<div class="header-search off-search"><?php get_search_form(); ?></div>
			</div>
			<?php if ( has_nav_menu( 'main-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) ); ?>
			<?php } ?>
			<?php if ( has_nav_menu( 'secondary-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new bpxl_nav_walker ) );
			} ?>
				<ul class="menu">
					<li><a href="/contact-us/" class="contact-us">Contact Us</a></li>
					<li><a href="https://www.reviveourhearts.com/donate/" class="donate">Donate</a></li>
				
				
		</nav>
		<div class="main-container<?php if($bpxl_ublog_options['bpxl_layout_type'] != '1') { echo $layout_class; } ?>">
			<div class="st-pusher">
				<!-- START HEADER -->
				<header class="main-header clearfix">
					<?php if($bpxl_ublog_options['bpxl_header_style'] == 'header_one' || $bpxl_ublog_options['bpxl_header_style'] == 'header_three') { 
						get_template_part('inc/nav-one');
					} ?>
					<div class="header clearfix">
						<div class="container">
							<?php if (!empty($bpxl_ublog_options['bpxl_logo']['url'])) { ?>
								<div id="logo" class="uppercase">
									<a href="<?php echo home_url(); ?>">
										<img src="<?php echo $bpxl_ublog_options['bpxl_logo']['url']; ?>" <?php if (!empty($bpxl_ublog_options['bpxl_retina_logo']['url'])) { echo 'data-at2x="'.$bpxl_ublog_options['bpxl_retina_logo']['url'].'"';} ?> alt="<?php bloginfo( 'name' ); ?>">
									</a>
								</div>
							<?php } else { ?>
								<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="uppercase">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h1>
								<?php } else { ?>
									<h2 id="logo" class="uppercase">
										<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
									</h2>
								<?php } ?>
							<?php } ?>
							<?php if($bpxl_ublog_options['bpxl_header_style'] == 'header_three') {
								get_template_part('inc/nav-two');
							} ?>
						</div><!-- .container -->
					</div><!-- .header -->
					<?php if($bpxl_ublog_options['bpxl_header_style'] == 'header_two') {
						get_template_part('inc/nav-one');
					} elseif($bpxl_ublog_options['bpxl_header_style'] == 'header_one') {
						get_template_part('inc/nav-two');
					} ?>
				</header>
				<!-- END HEADER -->