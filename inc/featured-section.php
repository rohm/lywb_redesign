<?php global $bpxl_ublog_options; ?>
<div class="featured-section clearfix loading">
	<div class="featuredslider">
		<ul class="slides">
			<?php
				$featured_cats = $bpxl_ublog_options['bpxl_featured_cat'];
				$featured_cat = implode(",", $featured_cats);
				$featured_slider_cats = $bpxl_ublog_options['bpxl_featured_slider_cat'];
				$featured_slider_posts = $bpxl_ublog_options['bpxl_slider_posts_count'];
				$featured_slider_cat = implode(",", $featured_slider_cats);
				$featured_posts = new WP_Query("cat=".$featured_slider_cat."&orderby=date&order=DESC&showposts=".$featured_slider_posts);
				
				if($featured_posts->have_posts()) : while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
						<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail('featured');
							} else {
								echo '<img src="' . get_stylesheet_directory_uri() . '/images/770x355.png" width="770" height"355" />';
							} ?>
						<div class="post-inner">
							<header>
								<h2 class="title f-title title24">
									<?php the_title(); ?>
								</h2>
							</header><!--.header-->
							<?php 
								if(isset($bpxl_ublog_options['bpxl_post_meta_options']['3']) == '1') { ?>
								<div class="post-cats uppercase">
									<?php
										$category = get_the_category();
										if ($category) {										
											echo '<span>' . $category[0]->name.'</span> ';										
										}
									?>
								</div>
							<?php } ?>
						</div>
					</a>
				</li>
			<?php endwhile; endif; ?>
		</ul>
	</div><!--.featuredslider-->
	<?php
		$fcount = 1;
		$featured_a = new WP_Query("cat=".$featured_cat."&orderby=date&order=DESC&showposts=4");
	
		if($featured_a->have_posts()) : while ($featured_a->have_posts()) : $featured_a->the_post();
		
		if($fcount == 1) { ?>
		<div class="featured-posts">
			<div class="featured-post featured-post-<?php echo $fcount; ?>">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('featured395');
						} else {
							echo '<img width="395" height="175" src="' . get_stylesheet_directory_uri() . '/images/395x175.png" />';
						} ?>
					<div class="post-inner">
						<header>
							<h2 class="title f-title title18">
								<?php the_title(); ?>
							</h2>
						</header><!--.header-->
						<?php 					
							if(isset($bpxl_ublog_options['bpxl_post_meta_options']['3']) == '1') { ?>
							<div class="post-cats uppercase">
								<?php
									$category = get_the_category();
									if ($category) {
									  echo '<span>' . $category[0]->name.'</span> ';
									}
								?>
							</div>
						<?php } ?>
					</div><!-- .post-inner -->
				</a>
			</div><!--.featured-post--> 
			<?php } elseif($fcount == 2) { ?>
			<div class="featured-post featured-post-<?php echo $fcount; ?>">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('featured395');
						} else {
							echo '<img width="395" height="175" src="' . get_stylesheet_directory_uri() . '/images/395x175.png" />';
						} ?>
					<div class="post-inner">
						<header>
							<h2 class="title f-title title18">
								<?php the_title(); ?>
							</h2>
						</header><!--.header-->
						<?php 					
							if(isset($bpxl_ublog_options['bpxl_post_meta_options']['3']) == '1') { ?>
							<div class="post-cats uppercase">
								<?php
									$category = get_the_category();
									if ($category) {
									  echo '<span>' . $category[0]->name.'</span> ';
									}
								?>
							</div>
						<?php } ?>
					</div><!-- .post-inner -->
				</a>
			</div><!--.smallpost-->
		<?php } $fcount++; endwhile; endif; ?>
	</div>
</div>