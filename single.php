<?php get_header(); ?>
<?php global $bpxl_ublog_options; ?>
<?php
	if (have_posts()) : the_post();
	$bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID );
	if($bpxl_cover == '1') {
?>
	<div class="cover-container">
		<div class="cover-box">
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			<div data-type="background" data-speed="4" class="cover-image" style="background-image: url( <?php echo $url; ?>);">
				<div class="cover-heading">
					<div class="center-width">
						<div class="cover-text">
							<?php the_title( '<h1 class="title entry-title">', '</h1>' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div class="main-wrapper">
	<div id="page">
		<div class="detail-page">
			<div class="main-content">
				<?php
					$sidebar_small_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
					if($bpxl_ublog_options['bpxl_single_layout'] == 'scb_single_layout') {
						if ($sidebar_small_position == 'default' || empty($sidebar_small_position)) { ?>
						<div class="sidebar-small">
							<div class="small-sidebar">
								<?php
									if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Secondary Sidebar') );
								?>
							</div><!--End .small-sidebar-->
						</div><!--End .sidebar-small-->
					<?php }
				} ?>
				<div class="content-area single-content-area">
					<div class="content-single">
						<div class="content-detail">
						<?php
								rewind_posts(); while (have_posts()) : the_post(); ?>
							<?php if ( !current_user_can( 'edit_post' , get_the_ID() ) ) { setPostViews(get_the_ID()); } ?>
							<?php if($bpxl_ublog_options['bpxl_breadcrumbs'] == '1') { ?>
								<div class="breadcrumbs">
									<?php bpxl_breadcrumb(); ?>
								</div>
							<?php }?>
							<div class="single-content">
								<?php get_template_part( 'content', get_post_format() ); ?>
							</div><!--.single-content-->

							<?php if($bpxl_ublog_options['bpxl_author_box'] == '1') { ?>
								<div class="author-box">
									<h3 class="section-heading uppercase"><?php _e('About Author','bloompixel'); ?></h3>
									<div class="author-box-avtar">
										<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' );  } ?>
									</div>
									<div class="author-info-container">
										<div class="author-info">
											<div class="author-head">
												<h5><?php the_author_meta('display_name'); ?></h5>
											</div>
											<p><?php the_author_meta('description') ?></p>
											<div class="author-social">
												<?php if(get_the_author_meta('facebook')) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo get_the_author_meta('facebook'); ?>"></a></span><?php } ?>
												<?php if(get_the_author_meta('twitter')) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo get_the_author_meta('twitter'); ?>"></a></span><?php } ?>
												<?php if(get_the_author_meta('googleplus')) { ?><span class="author-gp"><a class="fa fa-google-plus" href="<?php echo get_the_author_meta('googleplus'); ?>"></a></span><?php } ?>
												<?php if(get_the_author_meta('linkedin')) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo get_the_author_meta('linkedin'); ?>"></a></span><?php } ?>
												<?php if(get_the_author_meta('pinterest')) { ?><span class="author-pinterest"><a class="fa fa-pinterest" href="<?php echo get_the_author_meta('pinterest'); ?>"></a></span><?php } ?>
												<?php if(get_the_author_meta('dribbble')) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo get_the_author_meta('dribble'); ?>"></a></span><?php } ?>
											</div>
										</div>
									</div>
								</div>
							<?php }?>
							<?php if($bpxl_ublog_options['bpxl_next_prev_article'] == '1') { ?>
								<div class="navigation post-navigation clearfix">
									<div class="alignleft post-nav-links prev-link-wrapper">
										<?php previous_post_link('<div class="prev-link"><span>'. __("Previous Article","bloompixel").'</span> %link'."</div>") ?>
									</div>
									<div class="alignright post-nav-links next-link-wrapper">
										<?php next_post_link('<div class="next-link"><span>'. __("Next Article","bloompixel") .'</span> %link'."</div>") ?>
									</div>
								</div><!-- end .navigation -->
							<?php } ?>
							
							<?php $related = rwmb_meta( 'bpxl_singlerelated', $args = array('type' => 'checkbox'), $post->ID ); ?>
							<?php if($related == '1') { ?>
							<?php } else if($bpxl_ublog_options['bpxl_related_posts'] == '1') { ?>	
								<?php $orig_post = $post;
								global $post;
								
								//Related Posts By Categories
								if ($bpxl_ublog_options['bpxl_related_posts_by'] == '1') {
									$categories = get_the_category($post->ID);
									if ($categories) {
										$category_ids = array();
										foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
										$args=array(
											'category__in' => $category_ids,
											'post__not_in' => array($post->ID),
											'posts_per_page'=> $bpxl_ublog_options['bpxl_related_posts_count'], // Number of related posts that will be shown.
											'ignore_sticky_posts'=>1
										);
									}
								}
								//Related Posts By Tags
								else {
									$tags = wp_get_post_tags($post->ID);        
									if ($tags) {
										$tag_ids = array();  
										foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
										$args=array(
											'tag__in' => $tag_ids,  
											'post__not_in' => array($post->ID),  
											'posts_per_page'=> $bpxl_ublog_options['bpxl_related_posts_count'], // Number of related posts to display.  
											'ignore_sticky_posts'=>1 
										); 
									}
								}
								$my_query = new wp_query( $args );
								if( $my_query->have_posts() ) {
									echo '<div class="relatedPosts"><h3 class="section-heading uppercase"><span>' . __('Related Posts','bloompixel') . '</span></h3><ul class="slides">';
									while( $my_query->have_posts() ) {
										$my_query->the_post();?>
										<li>
											<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
												<?php if ( has_post_thumbnail() ) { ?> 
													<div class="relatedthumb blah-blah-1"><?php the_post_thumbnail('related'); ?></div>
												<?php } else { ?>
													<div class="relatedthumb"><img width="240" height="111" src="<?php echo get_template_directory_uri(); ?>/images/240x111.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>"></div>
												<?php } ?>
											</a>
											<?php
												$post_title = the_title('','',false);
												$short_title = substr($post_title,0,38);
												
												if ( $short_title != $post_title ) {
													$short_title .= "...";
												} else {
													$short_title = $post_title;
												}
											?>
											<div class="related-content">
												<header>
													<h2 class="title title18">
														<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
													</h2>
												</header><!--.header-->		
												<div class="r-meta">
													<?php if(isset($bpxl_ublog_options['bpxl_single_post_meta_options']['2']) == '1') { ?>
														<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php echo esc_html( get_the_date() ); ?></time>
													<?php } ?>
												</div>
											</div>
										</li>
										<?php
									}
									echo '</ul></div>';
								}
								$post = $orig_post;
								wp_reset_query(); ?>
							<?php }?>
							<div class="disclaimer" style="font-size: .9em; padding: 20px 30px; font-style: italic; color: #888;">
								<p>HEY, GIRLS! We love hearing from you, but feel limited in the ways we can help. For one thing, we&rsquo;re not trained counselors. If you’re seeking counsel, we encourage you to talk to your pastor or a godly woman in your life as they&rsquo;ll know more details and can provide you with ongoing accountability and help. Also, the following comments do not necessarily reflect the views of Revive Our Hearts. We reserve the right to remove comments which might be unhelpful, unsuitable, or inappropriate. We may edit or remove your comment if it:</p>
								<ul>
									<li>* Requests or gives personal information such as email address, address, or phone number.</li>
									<li>* Attacks other readers.</li>
									<li>* Uses vulgar or profane language.</li>
								</ul>
							</div>
							<?php comments_template(); ?>
							<?php endwhile; else : ?>
								<div class="post">
									<div class="single-page-content error-page-content">
										<p><strong><?php _e('Nothing Found', 'bloompixel'); ?></strong></p>
										<?php get_search_form(); ?>
									</div><!--noResults-->
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php 
					$sidebar_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
					
					if ($bpxl_ublog_options['bpxl_single_layout'] != 'f_single_layout') {
						if ($sidebar_position == 'left' || $sidebar_position == 'right' || $sidebar_position == 'default' || empty($sidebar_position)) {
							get_sidebar();
						}
					}
				?>
			</div><!--.detail-page-->
		</div><!--.main-content-->
<?php get_footer();?>