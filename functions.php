<?php
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/options/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/options/ReduxCore/framework.php' );
}
if ( !isset( $bpxl_ublog_options ) && file_exists( dirname( __FILE__ ) . '/options/settings/sample-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/options/settings/sample-config.php' );
}

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 713;
}

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
/* UBlog supports.
/*-----------------------------------------------------------------------------------*/
function bpxl_theme_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports the following post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'image', 'status', 'audio' ) );

	// Register WordPress Custom Menus
	add_theme_support( 'menus' );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'bloompixel' ) );
	register_nav_menu( 'secondary-menu', __( 'Secondary Menu', 'bloompixel' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'bloompixel' ) );

	// Register Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'featured', 713, 330, true ); //featured
	add_image_size( 'featured395', 453, 163, true ); //featured370
	add_image_size( 'related', 240, 185, true ); //related
	add_image_size( 'widgetthumb', 90, 90, true ); //widgetthumb

	// Load Localization Files
	$lang_dir = get_template_directory() . '/lang';
	load_theme_textdomain('bloompixel', $lang_dir);
}
add_action( 'after_setup_theme', 'bpxl_theme_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Post Meta Boxes
/*-----------------------------------------------------------------------------------*/
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
// Include the meta box script
require_once ( RWMB_DIR . 'meta-box.php' );
// Include the meta box definition (the file where you define meta boxes, see 'demo/demo.php')
include_once(get_template_directory() . '/inc/meta-box/meta-boxes.php');

get_template_part('inc/category-meta/Tax-meta-class/class-usage');

/*-----------------------------------------------------------------------------------*/
/*	Add Stylesheets
/*-----------------------------------------------------------------------------------*/
function bpxl_stylesheets() {
	global $bpxl_ublog_options;
	wp_enqueue_style( 'goblog-style', get_stylesheet_uri() );

	// Color Scheme
	if (is_category()) {
		$category_ID = get_query_var('cat');

		$cat_color_1 = get_tax_meta($category_ID,'bpxl_color_field_id');
		$cat_bg_color = get_tax_meta($category_ID,'bpxl_cat_bg_color_field_id');
		$cat_bg = get_tax_meta($category_ID,'bpxl_bg_field_id');
		$cat_repeat = get_tax_meta($category_ID,'bpxl_category_repeat_id');
		$cat_position = get_tax_meta($category_ID,'bpxl_category_position_id');
		$cat_attachment = get_tax_meta($category_ID,'bpxl_category_attachment_id');
		$cat_size = get_tax_meta($category_ID,'bpxl_category_size_id');
	}
	if (is_single() || is_page()) {
		$single_bg_color = rwmb_meta( 'bpxl_post_bg_color', $args = array('type' => 'color'), get_the_ID() );
		$single_bg_images = rwmb_meta( 'bpxl_post_bg_img', $args = array('type' => 'plupload_image'), get_the_ID() );
			foreach ($single_bg_images as $single_bg_img_id) {
				$single_bg_img_code = wp_get_attachment_image_src($single_bg_img_id['ID'],'full');
				$single_bg_img = $single_bg_img_code[0];
			}
		$single_repeat = rwmb_meta( 'bpxl_post_bg_repeat', $args = array('type' => 'select'), get_the_ID() );
		$single_position = rwmb_meta( 'bpxl_post_bg_position', $args = array('type' => 'select'), get_the_ID() );
		$single_size = rwmb_meta( 'bpxl_post_bg_size', $args = array('type' => 'select'), get_the_ID() );
		$single_attachment = rwmb_meta( 'bpxl_post_bg_attachment', $args = array('type' => 'select'), get_the_ID() );
	}

	// Color Scheme 1
	$color_scheme_1 = "";
	if (is_category()) {
		if (strlen($cat_color_1) > 2 ) {
			$color_scheme_1 = $cat_color_1;
		} else { $color_scheme_1 = $bpxl_ublog_options['bpxl_color_one']; }
	} elseif ($bpxl_ublog_options['bpxl_color_one'] != '') {
		$color_scheme_1 = $bpxl_ublog_options['bpxl_color_one'];
	}

	// Background Color
	if (!empty($bpxl_ublog_options['bpxl_body_bg']['background-color'])) { $background_color = $bpxl_ublog_options['bpxl_body_bg']['background-color']; } else { $background_color = '#f2f2f2'; }

	// Background Pattern
	$background_img = get_template_directory_uri(). "/images/bg.png";
	$bg_repeat = 'repeat';
	$bg_attachment = 'scroll';
	$bg_position = '0 0';
	$bg_size = 'inherit';
	if (is_category()) {
		if ($cat_bg != '') { // Category Background Pattern
			$background_img = $cat_bg['src'];
			$bg_repeat = $cat_repeat;
			$bg_attachment = $cat_attachment;
			$bg_position = $cat_position;
			$bg_size = $cat_size;
		} elseif (strlen($cat_bg_color) > 2) {
			$background_color = $cat_bg_color;
		}
		elseif (!empty($bpxl_ublog_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
			$background_img = $bpxl_ublog_options['bpxl_body_bg']['background-image'];
			$bg_repeat = $bpxl_ublog_options['bpxl_body_bg']['background-repeat'];
			$bg_attachment = $bpxl_ublog_options['bpxl_body_bg']['background-attachment'];
			$bg_size = $bpxl_ublog_options['bpxl_body_bg']['background-size'];
			$bg_position = $bpxl_ublog_options['bpxl_body_bg']['background-position'];
		} elseif ($bpxl_ublog_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
			$background_img = get_template_directory_uri(). "/images/".$bpxl_ublog_options['bpxl_bg_pattern'].".png";
			$bg_repeat = 'repeat';
			$bg_attachment = 'scroll';
			$bg_position = '0 0';
		}
	} elseif (is_single() || is_page()) {
		if (!empty($single_bg_img)) { // Single Background Image
			$background_img = $single_bg_img;
			$bg_repeat = $single_repeat;
			$bg_position = $single_position;
			$bg_size = $single_size;
			$bg_attachment = $single_attachment;
		} elseif (!empty($single_bg_color)) { // Single Background Color
			$background_color = rwmb_meta( 'bpxl_post_bg_color', $args = array('type' => 'color'), get_the_ID() );
		} elseif (!empty($bpxl_ublog_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
			$background_img = $bpxl_ublog_options['bpxl_body_bg']['background-image'];
			$bg_repeat = $bpxl_ublog_options['bpxl_body_bg']['background-repeat'];
			$bg_attachment = $bpxl_ublog_options['bpxl_body_bg']['background-attachment'];
			$bg_size = $bpxl_ublog_options['bpxl_body_bg']['background-size'];
			$bg_position = $bpxl_ublog_options['bpxl_body_bg']['background-position'];
		} elseif ($bpxl_ublog_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
			$background_img = get_template_directory_uri(). "/images/".$bpxl_ublog_options['bpxl_bg_pattern'].".png";
			$bg_repeat = 'repeat';
			$bg_attachment = 'scroll';
			$bg_position = '0 0';
		}
	} elseif (!empty($bpxl_ublog_options['bpxl_body_bg']['background-image'])) { // Body Custom Background Pattern
		$background_img = $bpxl_ublog_options['bpxl_body_bg']['background-image'];
		$bg_repeat = $bpxl_ublog_options['bpxl_body_bg']['background-repeat'];
		$bg_attachment = $bpxl_ublog_options['bpxl_body_bg']['background-attachment'];
		$bg_size = $bpxl_ublog_options['bpxl_body_bg']['background-size'];
		$bg_position = $bpxl_ublog_options['bpxl_body_bg']['background-position'];
	} elseif ($bpxl_ublog_options['bpxl_bg_pattern'] != 'nopattern') { // Body Default Background Pattern
		$background_img = get_template_directory_uri(). "/images/".$bpxl_ublog_options['bpxl_bg_pattern'].".png";
		$bg_repeat = 'repeat';
		$bg_attachment = 'scroll';
		$bg_position = '0 0';
		$bg_size = 'inherit';
	}

	// Layout Options
	$bpxl_layout = '';
	$bpxl_archive_layout = '';
	$bpxl_single_layout = '';
	$bpxl_header_css = '';
	$bpxl_featured_css = '';
	$bpxl_sticky_css = '';
	$bpxl_custom_css = '';

	// Home Layout
	if(is_home() || is_front_page() || is_search()) {
		if($bpxl_ublog_options['bpxl_layout'] == 'scb_layout') {
			$bpxl_layout = '.home-content-area { margin:0 2.55% 0 0; width:48.7% } .home .sidebar { width:23.1% } .home .sidebar-small { float:left; margin:0 2.55% 0 0 }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'bc_layout') {
			$bpxl_layout = '.home-content-area { float:right; margin-left:2.2%; margin-right:0; }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'c_layout') {
			$bpxl_layout = '.home-content-area { margin:0; width:100%; } .masonry-home .header-cat, .masonry-home .post-type { top:38px; padding:0; } .masonry-home .header-time { padding:15px 0 } .masonry-home .header-cat { left:15px } .masonry-home .post-type { right:15px } .masonry-home .post-month span { display:block; }
			.masonry-home .post { float:left; margin:0 10px 20px; width:31.4%;} .fb-status { min-height:185px } .twitter-status { min-height:285px } .galleryslider { min-height:175px; }
			.masonry-home .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-home .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-home .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-home .header-top, .masonry-home .post-home {padding:0 15px} .masonry-home .gallerytiled ul li { width:32.9% }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'gs_layout') {
			$bpxl_layout = '.home-content-area { margin-right:0; width:70.4% } .masonry-home .header-cat, .masonry-home .post-type { top:38px; padding:0; } .masonry-home .header-time { padding:15px 0 } .masonry-home .header-cat { left:15px } .masonry-home .post-type { right:15px } .masonry-home .post-month span { display:block; }
			.masonry-home .post { float:left; margin:0 10px 20px; width:47%;} .fb-status { min-height:185px } .twitter-status { min-height:285px } .galleryslider { min-height:175px; }
			.masonry-home .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-home .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-home .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-home .post-home { padding:0 15px } .sidebar {width:28.6%} .masonry-home .gallerytiled ul li { width:32.9% }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'sg_layout') {
			$bpxl_layout = '.home-content-area { margin:0; width:67.4%; float:right } .masonry-home .header-cat, .masonry-home .post-type { top:38px; padding:0; } .masonry-home .header-time { padding:15px 0 } .masonry-home .header-cat { left:15px } .masonry-home .post-type { right:15px } .masonry-home .post-month span { display:block; }
			.masonry-home .post { float:left; margin:0 10px 20px; width:47%;} .fb-status { min-height:185px } .twitter-status { min-height:285px }
			.masonry-home .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-home .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-home .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-home .post-home { padding:0 15px } .masonry-home .gallerytiled ul li { width:32.9% }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'g_layout') {
			$bpxl_layout = '.home-content-area { margin:0; width:100%; }
			.masonry-home .post { float:left; margin:0 10px 20px; width:48%;} .fb-status { min-height:185px } .twitter-status { min-height:240px } .galleryslider { min-height:262px; } .masonry-home .gallerytiled ul li { width:24.7% }';
		}
		elseif ($bpxl_ublog_options['bpxl_layout'] == 'f_layout') {
			$bpxl_layout = '.home-content-area { margin:0; width:100%; } .gallerytiled ul li { width:13.8% }';
		}
		else {
			$bpxl_layout = '';
		}
	}

	// Archive Layout
	if(is_archive() || is_author()) {
		if ($bpxl_ublog_options['bpxl_archive_layout'] == 'scb_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { margin:0 2.55% 0 0; width:48.7% } .archive-page .sidebar { width:23.1% } .archive-page .sidebar-small { float:left; margin:0 2.55% 0 0 }';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'bc_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { float:right; margin-left:2.2%; margin-right:0; }';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'c_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { margin:0; width:100%; } .masonry-archive .header-cat, .masonry-archive .post-type { top:38px; padding:0; } .masonry-archive .header-time { padding:15px 0 } .masonry-archive .header-cat { left:15px } .masonry-archive .post-type { right:15px } .masonry-archive .post-month span { display:block; }
			.masonry-archive .post { float:left; margin:0 10px 20px; width:31.4%;} .fb-status { min-height:185px } .twitter-status { min-height:285px } .galleryslider { min-height:175px; }
			.masonry-archive .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-archive .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-archive .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-archive .post-home {padding:0 15px} .masonry-archive .gallerytiled ul li { width:32.9% }';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'gs_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area {  margin-right:0; width:67.4%  } .content-archive { margin:0 2% 0 0; width:98% } .masonry-archive .header-cat, .masonry-archive .post-type { top:38px; padding:0; } .masonry-archive .header-time { padding:15px 0 } .masonry-archive .header-cat { left:15px } .masonry-archive .post-type { right:15px } .masonry-archive .post-month span { display:block; }
			.masonry-archive .post { float:left; margin:0 10px 20px; width:47%;} .fb-status { min-height:185px } .twitter-status { min-height:285px } .galleryslider { min-height:175px; }
			.masonry-archive .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-archive .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-archive .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-archive .post-home { padding:0 15px  .masonry-archive .gallerytiled ul li { width:32.9% }}';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'sg_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { margin:0; width:67.4%; float:right } .masonry-archive .header-cat, .masonry-archive .post-type { top:38px; padding:0; } .masonry-archive .header-time { padding:15px 0 } .masonry-archive .header-cat { left:15px } .masonry-archive .post-type { right:15px } .masonry-archive .post-month span { display:block; }
			.masonry-archive .post { float:left; margin:0 10px 20px; width:47%;} .fb-status { min-height:185px } .twitter-status { min-height:285px } .galleryslider { min-height:175px; }
			.masonry-archive .post header time { border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:15px 0; width:100% } .masonry-archive .post .title-wrap { border:0; padding-left:4%; padding-top:15px; padding-bottom:15px; width:69% }
			.masonry-archive .post .title { font-size:26px; line-height:32px; margin-bottom:5px } .masonry-archive .post-home { padding:0 15px } .masonry-archive .gallerytiled ul li { width:32.9% }';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'g_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { margin:0; width:100%; }
			.masonry-archive .post { float:left; margin:0 10px 20px; width:48%;} .fb-status { min-height:185px } .twitter-status { min-height:240px } .galleryslider { min-height:262px; } .masonry-archive .gallerytiled ul li { width:24.7% }';
		}
		elseif ($bpxl_ublog_options['bpxl_archive_layout'] == 'f_archive_layout') {
			$bpxl_archive_layout = '.archive-content-area { margin:0; width:100%; } .gallerytiled ul li { width:13.8% }';
		}
		else { $bpxl_archive_layout = ''; }
	}

	// Single Layout
	if( is_single() || is_page() ) {
		if($bpxl_ublog_options['bpxl_single_layout'] == 'bc_single_layout') {
			$bpxl_single_layout = '.single-content-area { float:right; margin-left:2.2%; margin-right:0; }';
		}
		elseif ($bpxl_ublog_options['bpxl_single_layout'] == 'scb_single_layout') {
			$bpxl_single_layout = '.single-content-area { margin:0 2.55% 0 0; width:48.7% } .detail-page .sidebar { width:23.1% } .detail-page .sidebar-small { float:left; margin:0 2.55% 0 0 }';
		}
		elseif ($bpxl_ublog_options['bpxl_single_layout'] == 'f_single_layout') {
			$bpxl_single_layout = '.single-content-area { margin:0; width:100%; } .relatedPosts ul li { width:21.6% }';
		}

		$sidebar_positions = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );

		if( !empty($sidebar_positions) ) {
			$sidebar_position = $sidebar_positions;

			if( $sidebar_position == 'left' ) $bpxl_single_layout = '.single-content-area { float:right; margin-left:2.2%; margin-right:0 }';
			elseif( $sidebar_position == 'right' ) $bpxl_single_layout = '.single-content-area { float:left; margin-right:2.2%; margin-left:0 }';
			elseif( $sidebar_position == 'none' ) $bpxl_single_layout = '.single-content-area { margin:0; width:100% } .relatedPosts ul li { width:21.6% }';
		}
	}

	// Header Style
	if ($bpxl_ublog_options['bpxl_header_style'] == 'header_two') {
		$bpxl_header_css = '.header { text-align:left; }';
	}
	if ($bpxl_ublog_options['bpxl_header_style'] == 'header_three') {
		$bpxl_header_css = '.header { text-align:left; } .main-navigation { border:0; float:right; width:auto } .main-nav { width:auto }';
	}

	// Featured Posts
	if ($bpxl_ublog_options['bpxl_featured_style'] == 'style_2') {
		$bpxl_featured_css = '.featuredslider { float:right; margin:0 0 0 0.4% }';
	}

	// Sticky Menu
	if ($bpxl_ublog_options['bpxl_sticky_menu'] == '1') {
		$bpxl_sticky_css = '.stickymenu { position:fixed; z-index:100; left:0; top:0; width:100%; opacity:0.9 }';
	}

	// Hex to RGB
	$bpxl_hex = $color_scheme_1;
	list($bpxl_r, $bpxl_g, $bpxl_b) = sscanf($bpxl_hex, "#%02x%02x%02x");

	// Custom CSS
	if ($bpxl_ublog_options['bpxl_custom_css'] != '') {
		$bpxl_custom_css = $bpxl_ublog_options['bpxl_custom_css'];
	}

	$custom_css = "
	body { background-color:{$background_color}; background-image:url({$background_img}); background-repeat:{$bg_repeat}; background-attachment:{$bg_attachment}; background-position:{$bg_position}; background-size:{$bg_size} }
	.top-bar, .tagcloud a:hover, .pagination span, .pagination a:hover, .read-more a, .post-format-quote, .flex-control-nav .flex-active, #subscribe-widget input[type='submit'], #wp-calendar caption, #wp-calendar td#today, #commentform #submit, .wpcf7-submit, .off-canvas-search { background-color:{$color_scheme_1}; }
	a, a:hover, .title a:hover, .sidebar a:hover, .sidebar-small-widget a:hover, .breadcrumbs a:hover, .meta a:hover, .post-meta a:hover, .post .post-content ul li:before, .content-page .post-content ul li:before, .reply:hover i, .reply:hover a, .edit-post a, .error-text { color:{$color_scheme_1}; }
	.tagcloud a:hover .post blockquote, .comment-reply-link:hover { border-color:{$color_scheme_1}; } .widget:hover .widget-title:before { border-bottom-color:{$color_scheme_1}; }
	#wp-calendar th { background: rgba({$bpxl_r},{$bpxl_g},{$bpxl_b}, 0.6) }
	{$bpxl_layout} {$bpxl_archive_layout} {$bpxl_single_layout} {$bpxl_header_css} {$bpxl_featured_css} {$bpxl_sticky_css} {$bpxl_custom_css}";
	wp_add_inline_style( 'goblog-style', $custom_css );

	// Font-Awesome CSS
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );

	if ($bpxl_ublog_options['bpxl_responsive_layout'] == '1') {
		// Responsive
		wp_register_style( 'responsive', get_template_directory_uri() . '/css/responsive.css' );
		wp_enqueue_style( 'responsive' );
	}

	if ($bpxl_ublog_options['bpxl_rtl'] == '1') {
		// Responsive
		wp_register_style( 'rtl', get_template_directory_uri() . '/css/rtl.css' );
		wp_enqueue_style( 'rtl' );
	}
}
add_action( 'wp_enqueue_scripts', 'bpxl_stylesheets' );

/*-----------------------------------------------------------------------------------*/
/*	Add JavaScripts
/*-----------------------------------------------------------------------------------*/
function bpxl_scripts() {
global $bpxl_ublog_options;
    wp_enqueue_script( 'jquery' );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	// Sticky Menu
	if ($bpxl_ublog_options['bpxl_sticky_menu'] == '1') {
		wp_register_script( 'stickymenu', get_template_directory_uri() . '/js/stickymenu.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'stickymenu' );
	}

	// Masonry
	$bpxl_masonry_array = array(
		'c_layout',
		'gs_layout',
		'sg_layout',
		'g_layout',
		'c_archive_layout',
		'gs_archive_layout',
		'sg_archive_layout',
		'g_archive_layout',
		'c_single_layout',
		'gs_single_layout',
		'sg_single_layout',
		'g_single_layout',
	);
	if(in_array($bpxl_ublog_options['bpxl_layout'],$bpxl_masonry_array) || in_array($bpxl_ublog_options['bpxl_single_layout'],$bpxl_masonry_array) || in_array($bpxl_ublog_options['bpxl_archive_layout'],$bpxl_masonry_array)) {
		wp_register_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array( 'jquery' ), '3.1.5', true );
		wp_enqueue_script( 'masonry' );
	}

	// Required jQuery Scripts
    wp_register_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'theme-scripts' );
}
add_action( 'wp_enqueue_scripts', 'bpxl_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/
function bpxl_admin_scripts() {
    wp_register_script( 'admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'admin-scripts' );

    wp_register_script( 'select2', get_template_directory_uri() . '/js/select2.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'select2' );

	wp_register_style( 'select2', get_template_directory_uri() . '/css/select2.css' );
	wp_enqueue_style( 'select2' );

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome' );
}
add_action( 'admin_enqueue_scripts', 'bpxl_admin_scripts' );

// Header Code
function bpxl_header_code_fn() {
	global $bpxl_ublog_options;
	if (!empty($bpxl_ublog_options['bpxl_header_code'])) {
		echo $bpxl_ublog_options['bpxl_header_code'];
	}
}
add_action('wp_head','bpxl_header_code_fn');

// Footer Code
function bpxl_footer_code_fn() {
	global $bpxl_ublog_options;
	if (!empty($bpxl_ublog_options['bpxl_footer_code'])) {
		echo $bpxl_ublog_options['bpxl_footer_code'];
	}
	// Masonry
	$bpxl_masonry_array = array(
		'c_layout',
		'gs_layout',
		'sg_layout',
		'g_layout',
		'c_archive_layout',
		'gs_archive_layout',
		'sg_archive_layout',
		'g_archive_layout',
		'c_single_layout',
		'gs_single_layout',
		'sg_single_layout',
		'g_single_layout',
	);
	if(in_array($bpxl_ublog_options['bpxl_layout'],$bpxl_masonry_array) || in_array($bpxl_ublog_options['bpxl_single_layout'],$bpxl_masonry_array) || in_array($bpxl_ublog_options['bpxl_archive_layout'],$bpxl_masonry_array)) { ?>
		<script>
		/*---[ Masonry ]---*/
		jQuery(document).ready(function() {
			var container = jQuery('.masonry').imagesLoaded(function() {
				container.masonry({
					itemSelector : '.masonry .post',
					columnWidth : '.masonry .post',
					isAnimated : true,
				});
			});
		});
		</script>
	<?php }
}
add_action('wp_footer','bpxl_footer_code_fn');

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/
// Theme Functions
include("inc/widgets/widget-ad160.php"); // 160x600 Ad Widget
include("inc/widgets/widget-ad300.php"); // 300x250 Ad Widget
include("inc/widgets/widget-ad125.php"); // 125x125 Ad Widget
include("inc/widgets/widget-fblikebox.php"); // Facebook Like Box
include("inc/widgets/widget-flickr.php"); // Flickr Widget
include("inc/widgets/widget-popular-posts.php"); // Popular Posts
include("inc/widgets/widget-cat-posts.php"); // Category Posts
include("inc/widgets/widget-random-posts.php"); // Random Posts
include("inc/widgets/widget-recent-posts.php"); // Recent Posts
include("inc/widgets/widget-social.php"); // Social Widget
include("inc/widgets/widget-subscribe.php"); // Subscribe Widget
include("inc/widgets/widget-tabs.php"); // Tabs Widget
include("inc/widgets/widget-tweets.php"); // Tweets Widget
include("inc/widgets/widget-video.php"); // Video Widget
include("inc/widgets/widget-slider.php"); // Slider Widget
include("inc/nav-walker.php"); // Nav Walker Class

/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Register Theme Widgets
/*-----------------------------------------------------------------------------------*/
function bpxl_widgets_init() {
	global $bpxl_ublog_options;
	register_sidebar(array(
		'name' => 'Primary Sidebar',
		'before_widget' => '<div class="widget sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title uppercase">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Secondary Sidebar',
		'description' => 'Only displayed when 3 column layout is enabled.',
		'before_widget' => '<div class="widget sidebar-widget sidebar-small-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title uppercase">',
		'after_title' => '</h3>',
	));
	if ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_4') {
		$sidebars = array(1, 2, 3, 4);
		foreach($sidebars as $number) {
			register_sidebar(array(
				'name' => 'Footer ' . $number,
				'id' => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title uppercase">',
				'after_title' => '</h3>'
			));
		}
	} elseif ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_3') {
		$sidebars = array(1, 2, 3);
		foreach($sidebars as $number) {
			register_sidebar(array(
				'name' => 'Footer ' . $number,
				'id' => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title uppercase">',
				'after_title' => '</h3>'
			));
		}
	} elseif ($bpxl_ublog_options['bpxl_footer_columns'] == 'footer_2') {
		$sidebars = array(1, 2);
		foreach($sidebars as $number) {
			register_sidebar(array(
				'name' => 'Footer ' . $number,
				'id' => 'footer-' . $number,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title uppercase">',
				'after_title' => '</h3>'
			));
		}
	} else {
		register_sidebar(array(
			'name' => 'Footer',
			'id' => 'footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title uppercase">',
			'after_title' => '</h3>'
		));
	}
}
add_action( 'widgets_init', 'bpxl_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function bpxl_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo home_url();
		echo '"> <i class="fa fa-home"></i>';
		echo 'Home';
		echo "</a>";
		if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			the_category(' &bull; ');
			if (is_single()) {
				echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
				the_title();
			}
		} elseif (is_page()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			echo the_title();
		}
	}
	elseif (is_tag()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		single_tag_title();
		}
	elseif (is_day()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F jS, Y');
		}
	elseif (is_month()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F, Y');
		}
	elseif (is_year()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('Y');
		}
	elseif (is_author()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Author Archive";
		}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo "Blog Archives";
		}
	elseif (is_search()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Search Results";
		}
}

/*-----------------------------------------------------------------------------------*/
/*	Track Post Views
/*-----------------------------------------------------------------------------------*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function bpxl_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
?>
		<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>

			<span class="reply uppercase">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply'))) ?>
			</span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','bloompixel') ?></em>
				<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','bloompixel'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','bloompixel'),'  ','' );
			?>
		</div>

		<div class="commentBody">
			<?php comment_text() ?>
		</div>
		</div>
<?php }


/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function bpxl_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) { $pages = 1; }
     }

     if(1 != $pages) {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*-----------------------------------------------------------------------------------*/
/*	Insert ads after 'X' paragraph of single post content.
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content', 'prefix_insert_post_ads' );

function prefix_insert_post_ads( $content ) {
	global $bpxl_ublog_options;
	$bpxl_ad_code = '';
	$bpxl_num_para = '';
	if ($bpxl_ublog_options['bpxl_para_ad'] != '') {
		$bpxl_ad_code = $bpxl_ublog_options['bpxl_para_ad_code'];
		$bpxl_num_para = $bpxl_ublog_options['bpxl_para_ad'];
	}

	//$bpxl_ad_code = '<div>Ads code goes here</div>';

	if ( is_single() && ! is_admin() ) {
		return prefix_insert_after_paragraph( $bpxl_ad_code, $bpxl_num_para, $content );
	}

	return $content;
}

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}

	return implode( '', $paragraphs );
}

/*-----------------------------------------------------------------------------------*/
/*	Add Extra Fields to User Profiles
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'bpxl_user_profile_fields' );
add_action( 'edit_user_profile', 'bpxl_user_profile_fields' );

function bpxl_user_profile_fields( $user ) { ?>
<h3><?php _e("Social Profiles", "bloompixel"); ?></h3>

<table class="form-table">
	<tr>
		<th><label for="facebook"><?php _e("Facebook","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your facebook profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="twitter"><?php _e("Twitter","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your twitter profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="googleplus"><?php _e("Google+","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Google+ profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="linkedin"><?php _e("LinkedIn","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your LinkedIn profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="pinterest"><?php _e("Pinterest","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Pinterest profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="dribbble"><?php _e("Dribbble","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Dribbble profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_bpxl_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_bpxl_user_profile_fields' );

function save_bpxl_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
}

function contributors() {
	global $wpdb;

		$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");

		foreach($authors as $author) {
		echo "<div class=\"author-box author-desc-box\">";
		echo "<h4 class=\"author-box-title widget-title uppercase\">";
		echo  _e('Author Description','bloompixel'); 
		echo "</h4>";
		echo "<div class=\"author-box-content\"><div class=\"author-box-avtar\">";
		echo get_avatar($author->ID);
		echo "</div>";
		
		echo "<div class=\"author-info-container\">";
		echo "<div class=\"author-info\">";
		echo "<div class=\"author-head\"><h5>";
		echo  the_author_meta('display_name');
		echo "</h5";
		echo "</div>";
		echo "<p>";
		echo the_author_meta('description');
		echo "</p>";
		echo "<div class=\"author-social\">";
		echo "<span class=\"author-fb\"><a class=\"fa fa-facebook\" href=\"";
		echo get_the_author_meta('facebook');
		echo "\"></a></span>";
		echo "<span class=\"author-fb\"><a class=\"fa fa-twitter\" href=\"";
		echo get_the_author_meta('twitter');
		echo "\"></a></span>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Automatic Theme Updates
/*-----------------------------------------------------------------------------------*/
global $bpxl_ublog_options;
$username = $bpxl_ublog_options['bpxl_envato_user_name'];
$apikey = $bpxl_ublog_options['bpxl_envato_api_key'];
$author = 'Simrandeep Singh';

load_template( trailingslashit( get_template_directory() ) . 'inc/wp-theme-upgrader/envato-wp-theme-updater.php' );
Envato_WP_Theme_Updater::init( $username, $apikey, $author );
?>

