<?php

    $blog_next_text	 = minfolio_get_option( 'blog-next-text' );					
	$blog_prev_text  = minfolio_get_option( 'blog-prev-text' );
	
	the_posts_pagination( array(
		'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'minfolio' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'minfolio' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'minfolio' ) . ' </span>',
	) );		