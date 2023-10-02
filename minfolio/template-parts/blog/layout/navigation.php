<?php

    $multilingual_switch  = minfolio_get_option( 'multilingual-switch' );	
		
	$blog_next_text	 = minfolio_get_option( 'blog-next-text' );					
	$blog_prev_text  = minfolio_get_option( 'blog-prev-text' );
	
	if( $multilingual_switch == 1 ) {		
		
		the_post_navigation( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'minfolio' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Prev Post', 'minfolio' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'minfolio' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__( 'Next Post', 'minfolio' ) . '</span>',
		) );
			
	}
	else {
			
		the_post_navigation( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'minfolio' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . $blog_prev_text . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'minfolio' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . $blog_next_text . '</span>',
		) );
			
	}