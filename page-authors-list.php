<?php
/**
 * Template Name: Authors List
 */
?>
<?php get_header(); ?>
<?php global $bpxl_ublog_options; ?>



<div class="main-wrapper">
	<div id="page">
		<div class="main-content">
			<div class="detail-page">
			
				<div class="single-content-area">
					<div class="content-page">
						<div class="content-detail">
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>					
								<?php if($bpxl_ublog_options['bpxl_breadcrumbs'] == '1') { ?>
									<div class="breadcrumbs">
										<?php bpxl_breadcrumb(); ?>
									</div>
								<?php }?>
								<div class="page-content">
									<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
										<div class="archive-content-area">
											<div class="content-archive" style="margin-top: 20px ">
												<?php

												// Get the authors from the database ordered by user nicename
													global $wpdb;
													$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
													$author_ids = $wpdb->get_results($query);

												// Loop through each author
													foreach($author_ids as $author) :

													// Get user data
														$curauth = get_userdata($author->ID);

													// If user level is above 0 or login name is "admin", display profile
														if($curauth->user_level == 2 && $curauth->ID !== 5)  : 

														// Get link to author page
															$user_link = get_author_posts_url($curauth->ID);

														// Set default avatar (values = default, wavatar, identicon, monsterid)
															$avatar = 'wavatar';
															
												?>
												<div class="author-box author-desc-box">
													<div class="author-box-content">
														<div class="author-box-avtar">
															<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>">
																<?php echo get_avatar($curauth->user_email, '96', $avatar); ?>
															</a>
														</div>
														<div class="author-info-container">
															<div class="author-info">
																<div class="author-head">
																	<h5><a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php echo $curauth->display_name; ?></a></h5>
																</div>
																<p>
																	<?php echo $curauth->description; ?>
																</p>
																<div class="author-social">
																	<?php if ($curauth->facebook) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo $curauth->facebook; ?>"></a></span><?php } ?>
																	<?php if ($curauth->twitter) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo $curauth->twitter; ?>"></a></span><?php } ?>
																	<?php if ($curauth->googleplus) { ?><span class="author-googleplus"><a class="fa fa-google-plus" href="<?php echo $curauth->googleplus; ?>"></a></span><?php } ?>
																	<?php if ($curauth->linkedin) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo $curauth->linkedin; ?>"></a></span><?php } ?>
																	<?php if ($curauth->pinterest) { ?><span class="author-fb"><a class="fa fa-pinterest" href="<?php echo $curauth->pinterest; ?>"></a></span><?php } ?>
																	<?php if ($curauth->dribbble) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo $curauth->dribbble; ?>"></a></span><?php } ?>
																</div>

												
															</div>
														</div>
													</div>
												</div>
												<?php endif; ?>
												<?php endforeach; ?>
											</div>
										</div>
									</article><!--blog post-->
								</div>	
								<!-- ? php comments_template(); ? -->
								<?php endwhile; ?>
								<?php else : ?>
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
				
			</div><!--.detail-page-->
		</div><!--.main-content-->
		
<?php get_footer();?>