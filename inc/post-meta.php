<?php global $bpxl_ublog_options; ?>
<div class="post-meta uppercase">
	<?php if(isset($bpxl_ublog_options['bpxl_post_meta_options']['1']) == '1') { ?>
		<span class="post-author"><?php _e('<i class="fa fa-user"></i> ','bloompixel'); the_author_posts_link(); ?></span>
	<?php } ?>
	<?php if(isset($bpxl_ublog_options['bpxl_post_meta_options']['4']) == '1') { ?>
		<?php the_tags('<span class="post-tags"><i class="fa fa-tag"></i> ', ', ', '</span>'); ?>
	<?php } ?>
	<?php if(isset($bpxl_ublog_options['bpxl_post_meta_options']['5']) == '1') { ?>
		<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ), 'comments-link', __( 'Comments are off', 'bloompixel' )); ?></span>
	<?php } ?>
	<!-- <span class="post-views"><i class="fa fa-eye"></i> < ?php echo getPostViews(get_the_ID()); ? ></span> -->
	<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' ); ?>
</div><!--.post-meta-->