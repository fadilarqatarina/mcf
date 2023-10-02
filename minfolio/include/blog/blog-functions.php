<?php
/* 
 *	Blog Related Functions
 */


if ( ! function_exists( 'minfolio_posted_on' ) ) {
	
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function minfolio_posted_on() {
		
		/* translators: used between list items, there is a space after the comma */
		$separate_meta = esc_html__( ', ', 'minfolio' );
		$in_categories = '';

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );
		
		if ( $categories_list ) {
			$in_categories =  '<span class="cat-links">';
			$in_categories .= '<span class="screen-reader-text">' . esc_html__( 'Categories', 'minfolio' ) . '</span>';			
			$in_categories .= $categories_list;
			$in_categories .= '</span>';
		}

		// Finally, let's write all of this to the page.
		echo  '<span class="posted-on">' . minfolio_time_link()  . '</span>' . $in_categories;
	}

}

if ( ! function_exists( 'minfolio_time_link' ) ) {
	
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function minfolio_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			get_the_date( DATE_W3C ),
			get_the_date(), 
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		if( ! is_single() ) {
			$time_string = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';	
		}
		
		return '<span class="screen-reader-text">' . esc_html__( 'Posted on', 'minfolio' ) . '</span>' . $time_string;
	}
}



/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Read More' link.
 *
 */

if ( ! function_exists( 'minfolio_excerpt_more' ) ) {
	
	function minfolio_excerpt_more() {	
		
		$multilingual_switch  = minfolio_get_option( 'multilingual-switch' );	
		$blog_readmore_text   = minfolio_get_option( 'blog-readmore-text' );					
		
		if( $multilingual_switch == 1 ) {				
		
			$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
				esc_url( get_permalink( get_the_ID() ) ),		
				esc_html__( 'Read More', 'minfolio' ) . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'			
			);
			
		}
		else {
			
			$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
				esc_url( get_permalink( get_the_ID() ) ),		
				$blog_readmore_text . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'			
			);
			
		}
		
		echo apply_filters( 'minfolio_excerpt_more', $link );
	}
}


if ( ! function_exists( 'minfolio_modify_read_more_link' ) ) {
	
	function minfolio_modify_read_more_link() {		
		
		$multilingual_switch  = minfolio_get_option( 'multilingual-switch' );	
		$blog_readmore_text   = minfolio_get_option( 'blog-readmore-text' );					
		
		if( $multilingual_switch == 1 ) {				

			$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
				esc_url( get_permalink( get_the_ID() ) ),		
				esc_html__( 'Read More', 'minfolio' ) . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'			
			);
		
		}
		else {
			
			$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
				esc_url( get_permalink( get_the_ID() ) ),		
				$blog_readmore_text . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'			
			);
			
		}
		
		return $link;
	}
}

add_filter( 'the_content_more_link', 'minfolio_modify_read_more_link' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */

if ( ! function_exists( 'minfolio_pingback_header' ) ) {
	
	function minfolio_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
		}
	}
}

add_action( 'wp_head', 'minfolio_pingback_header' );


/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 */

if ( ! function_exists( 'minfolio_widget_tag_cloud_args' ) ) {
	
	function minfolio_widget_tag_cloud_args( $args ) {
		$args['largest']  = 1;
		$args['smallest'] = 1;
		$args['unit']     = 'em';
		$args['format']   = 'list';

		return $args;
	}
}

add_filter( 'widget_tag_cloud_args', 'minfolio_widget_tag_cloud_args' );


if ( ! function_exists( 'minfolio_get_the_archive_title' ) ) {
	
	function minfolio_get_the_archive_title( $title ) {  

		if ( is_category() ) {    
			$title = single_cat_title( '', false );    
		} elseif ( is_tag() ) {    
			$title = single_tag_title( '', false );    
		} elseif ( is_author() ) {    
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;    
		} elseif ( is_tax() ) { //for custom post types
			$title = sprintf( '%1$s', single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}

		return $title;    
	}

	add_filter( 'get_the_archive_title', 'minfolio_get_the_archive_title' );    
}

if ( ! function_exists( 'minfolio_post_search' ) ) {
	
	function minfolio_post_search( $query ) {

			if ( $query -> is_search ) {
				$query -> set( 'post_type', 'post' );
			}

			return $query;
	}

}
	
add_filter( 'pre_get_posts', 'minfolio_post_search' );		


if ( ! function_exists( 'minfolio_get_post_thumbnail' ) ) {
	
	function minfolio_get_post_thumbnail( $size = 'post-thumbnail', $attr = '' ) {
	
		$post_thumbnail = '';		
		$lazy_load  = minfolio_get_option( 'lazy-load-switch' ); 
		
		$post_thumbnail .= '<div class="post-thumbnail">';
		
		if( ! is_single() ) {
			$post_thumbnail .= '<a href="' . esc_url( get_the_permalink() ) . '">';
		}
		
		if( is_single() ) {
			$size = 'minfolio-blog-single-image';
		}
		else {
			$size = 'minfolio-blog-list-image';
		}
		
		$post_thumbnail .= get_the_post_thumbnail( null, $size, $attr );		
		
		if( $lazy_load == 1 ) {			

			$post_thumbnail =  preg_replace( '/class="/', 'class="lazyload ', $post_thumbnail, 2 );
				
			$post_thumbnail = preg_replace( '/src/', 'data-src', $post_thumbnail, 1 );

			$post_thumbnail = preg_replace( '/srcset/', 'data-srcset', $post_thumbnail, 1 );
		
			$post_thumbnail = preg_replace( '/sizes/', 'data-sizes', $post_thumbnail, 1 );					

		}
		
		if( ! is_single() ) {
			$post_thumbnail .= '</a>';
		}
		
		$post_thumbnail .= '</div>';
		
		
		echo apply_filters( 'minfolio_get_post_thumbnail', $post_thumbnail );				
		
	}

}

if ( ! function_exists( 'minfolio_get_blog_slider_data_attr' ) ) {
	
	function minfolio_get_blog_slider_data_attr() {

		$show_navigation  = minfolio_get_option( 'blog-post-slider-navigation' );
		$show_pagination  = minfolio_get_option( 'blog-post-slider-pagination' );    

    	$data_attr = array();
		$options = array();
		
		$options[ 'wrapAround' ] = true;
		$options[ 'cellAlign' ] = 'center';
		$options[ 'draggable' ] = true;
		$options[ 'autoPlay' ] = true;
		$options[ 'pauseAutoPlayOnHover' ] = false;
		$options[ 'contain' ] = true;
		$options[ 'imagesLoaded' ] = true;
		$options[ 'prevNextButtons' ] = ( $show_navigation === 1 ) ? true : false;
		$options[ 'pageDots' ] = ( $show_pagination === 1 ) ? true : false;
		$options[ 'bypassCheck' ] = true;

		$data_attr[ 'data-flickity-options' ] = stripslashes( wp_json_encode( $options ) );

		return $data_attr;

	}

}

if ( ! function_exists( 'minfolio_get_blog' ) ) {
	
	function minfolio_get_blog() {

		wp_enqueue_script( 'minfolio-blog-script' );
		
		get_template_part( 'template-parts/blog/standard-list' );		
		
	}
}

if ( ! function_exists( 'minfolio_get_blog_single' ) ) {
	
	function minfolio_get_blog_single() {

		wp_enqueue_script( 'minfolio-blog-script' );
		
		get_template_part( 'template-parts/blog/standard-single' );		
		
	}
}
