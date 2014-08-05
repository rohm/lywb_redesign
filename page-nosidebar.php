<?php
/**
 * Template Name: Authors List
 */
?>
<?php get_header(); ?>
<div class="main-wrapper">
	<div id="page">
<?php global $bpxl_ublog_options; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="full-width">
			<?php if($bpxl_ublog_options['bpxl_breadcrumbs'] == '1') { ?>
				<div class="breadcrumbs">
					<?php bpxl_breadcrumb(); ?>
				</div>
			<?php }?>
			<div class="post-box">
				<div class="content clearfix">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						
						<header>
							<h1 class="title page-title"><?php _e('Authors','bloompixel'); ?></h1>
						</header>
						
						<div class="post-content single-page-content">
							<ul>
								<?php wp_list_authors(); ?>
							</ul>
						</div>	
					</div><!--blog post-->
				</div>
			</div><!--.post-box-->
		</article>
		<div id="fullwidth-comments" class="comments-area clearfix">
			<?php comments_template(); ?>
		</div><!-- #comments -->	
		<?php endwhile; ?>

		<?php else : ?>
			<div class="post">
				<div class="single-page-content error-page-content">
					<p><strong><?php _e('Nothing Found', 'bloompixel'); ?></strong></p>
					<?php get_search_form(); ?>
				</div><!--noResults-->
			</div>  
	<?php endif; ?>
</div><!--.main-->
<?php get_footer();?>