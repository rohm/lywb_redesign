<?php if ( has_post_format( 'video' )) {
	echo '<div class="post-type post-type-video"><i class="fa fa-film"></i></div>';
  } else if ( has_post_format( 'audio' )) {
	echo '<div class="post-type post-type-audio"><i class="fa fa-music"></i></div>';
  } else if ( has_post_format( 'image' )) {
	echo '<div class="post-type post-type-image"><i class="fa fa-camera"></i></div>';
  } else if ( has_post_format( 'link' )) {
	echo '<div class="post-type post-type-link"><i class="fa fa-link"></i></div>';
  } else if ( has_post_format( 'quote' )) {
	echo '<div class="post-type post-type-quote"><i class="fa fa-quote-left"></i></div>';
  } else if ( has_post_format( 'gallery' )) {
	echo '<div class="post-type post-type-gallery"><i class="fa fa-th-large"></i></div>';
  } else if ( has_post_format( 'status' )) {
	echo '<div class="post-type post-type-status"><i class="fa fa-comment-o"></i></div>';
  } else {
	echo '<div class="post-type post-type-standard"><i class="fa fa-thumb-tack"></i></div>';
  }
?>