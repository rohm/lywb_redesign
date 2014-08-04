<?php get_header(); ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content">
			<div class="content-area">
				<div class="content-page">
					<div class="content-detail">
						<div class="page-content">
							<div class="post-box error-page-content">
								<div class="error-head"><span><?php _e('Oops, This Page Could Not Be Found!','bloompixel'); ?></span></div>
								<div class="error-text"><?php _e('404','bloompixel'); ?></div>
								<p><a href="<?php echo home_url(); ?>"><?php _e('Back to Homepage','bloompixel'); ?></a></p>
								<p>
									<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bloompixel' ); ?>
								</p>
								<?php get_search_form(); ?>
							</div>
						</div><!--.page-content-->
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div><!--.main-content-->
<?php get_footer();?>