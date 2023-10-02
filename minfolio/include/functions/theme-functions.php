<?php 
/* 
 * Return value for key
 *  
 */
	
if ( ! function_exists( 'minfolio_get_option' ) ) {		

	function minfolio_get_option( $key ) {

		return get_theme_mod( $key, minfolio_theme_default_options( $key ) );	

	}

}


if ( ! function_exists( 'minfolio_build_data_attr' ) ) {	

	function minfolio_build_data_attr( $data_attr ) {

		$data_attrs_array = array();

		foreach ( $data_attr as $key => $value ) {

			if ( ! empty( $value ) ) {			
				$data_attrs_array[] = $key . '="' . esc_attr( $value ) . '"';				
			}
		}

		return implode( ' ', $data_attrs_array );	
	}
}

if ( ! function_exists( 'minfolio_build_inline_style' ) ) {
	
	function minfolio_build_inline_style( $css_properties ) {

		$inline_style = array();

		foreach ( $css_properties as $key => $value ) {

			if ( ! empty( $value ) ) {			
				$inline_style[] = $key . ':' . $value;				
			}
		}

		if ( ! empty( $inline_style ) ) {

			$inline_style = implode( ';', $inline_style );
			return ' style="'. esc_attr( $inline_style ) .';"';

		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'minfolio_get_category_ids' ) ) {
	
	function minfolio_get_category_ids( $category_slugs ) {

		$exclude_categories = array();

		if( !empty( $category_slugs ) ) {

			foreach ( $category_slugs as $slug ) {

				$idObj = get_category_by_slug( $slug ); 
				$exclude_categories[] = $idObj->term_id;

			}
		}

		return $exclude_categories;
	}
}


if ( ! function_exists( 'minfolio_get_post_meta' ) ) {
	
	function minfolio_get_post_meta( $meta_key, $multiple = false, $post_id = null ) {

		if( class_exists( 'RWMB_Core' ) ) {  
			$meta_value  = rwmb_meta( 'minfolio_meta_' . $meta_key, array( 'multiple' => $multiple ), $post_id );
		}
		else {
			return false;
		}

		return $meta_value;
	} 
}

if ( ! function_exists( 'minfolio_is_blog' ) ) {
	
	function minfolio_is_blog() {  
		
		$taxonomy = '';
		
		if( get_query_var( 'taxonomy' ) == 'portfolio_category' ) {			
			return false;
		}		
		
		if( get_query_var( 'taxonomy' ) == 'portfolio_tag' ) {			
			return false;
		}						

		if ( is_home() || is_singular( 'post' ) || is_search() || is_category() || is_archive() || is_author() || is_date() || is_attachment() ) {
			return true;
		} else {
			return false;
		}
	}

}


if ( ! function_exists( 'minfolio_theme_default_options' ) ) {
	
	function minfolio_theme_default_options( $key ) {	

		$defaults = array( 

			//General			
			'lazy-load-switch' => '1',														
			'minify-js-switch' => '1',		
			'elementor-global-switch' => '0',		
			'multilingual-switch' => '0',						
	
			//Branding				
			'menu-dark-logo' => get_theme_file_uri( 'assets/images/logo.png' ),
			'menu-dark-retina-logo' => get_theme_file_uri( 'assets/images/logo2x.png' ),
			'menu-light-logo' => get_theme_file_uri( 'assets/images/light-logo.png' ),
			'menu-light-retina-logo' => get_theme_file_uri( 'assets/images/light-logo2x.png' ),	
			'menu-text-logo-switch'  => 0,			
			'menu-text-logo' => 'Minfolio',			
							
			//Menu		
			'menu-type' => 'default-menu',		    
			'menu-layout' => 'boxed',
			'menu-display' => 'solid',		
			'menu-sticky' => 0,				
			'contact-email' => 'hello@example.com',			
											
			//Blog			
			'blog-banner-upper-heading'  => '',		
			'blog-post-banner-upper-heading'  => '',				
			'blog-banner-heading'  => esc_html__( 'Blog', 'minfolio' ),			
			'blog-post-slider-navigation' => '1',			
			'blog-post-slider-pagination' => '0',
			'blog-readmore-text' => esc_html__( 'Read More', 'minfolio' ),				
			'blog-next-text' => esc_html__( 'Next Post', 'minfolio' ),			
			'blog-prev-text' => esc_html__( 'Prev Post', 'minfolio' ),	
									
			//404
			'page-title' => esc_html__( '404', 'minfolio' ),			
			'page-subtitle' => esc_html__( 'Sorry, the page requested couldn\'t be found.', 'minfolio' ),	
			'page-desc' => esc_html__( 'The page you are looking for might have been removed had its name changed or its temporarily unavailable.', 'minfolio' ),				
			'page-btn-text' => esc_html__( 'Back to Home', 'minfolio' ),
	
			//Footer			
			'footer-layout'  => 'boxed',	
			'footer-columns'  => 'four-cols',	
			'footer-scroll-top' => '1',					
			'footer-author'  => esc_html__( 'Designed by Caliberthemes.', 'minfolio' ),		
			'footer-copyright' => esc_html__( '&#169; 2023 CaliberThemes', 'minfolio' ),			

		);	

		if( !empty( $defaults[ $key ] ) ) {
            return $defaults[ $key ];
        }

        return false;
	}
}


if ( ! function_exists( 'minfolio_body_classes' ) ) {	

	function minfolio_body_classes( $classes ) {					
				
		if ( minfolio_is_blog() ) {			
			
			if ( is_active_sidebar( 'sidebar-blog' ) ) {			
				$classes[] = 'has-sidebar';
			}

			if ( is_single() && has_post_thumbnail() ) {			
				$classes[] = 'has-post-thumbnail';
			}
			
		}					
		
		return $classes;
	}
}

add_filter( 'body_class', 'minfolio_body_classes' );

/**
 * Disable theme update notification
 */

if ( ! function_exists( 'minfolio_disable_theme_update_notification' ) ) {	
	
	function minfolio_disable_theme_update_notification( $value ) {
		
		if ( isset( $value ) && is_object( $value ) ) {
			unset( $value->response[ 'minfolio' ] );
		}
		
		return $value;
	}
}

add_filter( 'site_transient_update_themes', 'minfolio_disable_theme_update_notification' );


/**
 * Register custom fonts.
 */

if ( ! function_exists( 'minfolio_fonts_url' ) ) {	
	
	function minfolio_fonts_url() {
		
		$fonts_url = '';
		$font_families = array();
		
		if ( ! did_action( 'elementor/loaded' ) ) {
			
			$font_families[] = 'Mukta:400,500,600,700';			
			$font_families[] = 'Inter:400';		
						
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);		

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );					
		}
		
		return esc_url_raw( $fonts_url );	
		
	}
}

if ( ! function_exists( 'minfolio_get_youtube_id_from_url' ) ) {
	
	function minfolio_get_youtube_id_from_url( $url ) {

		$url_string = parse_url( $url, PHP_URL_QUERY );
		parse_str( $url_string, $args );

		return isset( $args['v'] ) ? $args['v'] : false;
	  
	}
}

if ( ! function_exists( 'minfolio_header_classes' ) ) {
	
	function minfolio_header_classes() {

		$classes = array( 'site-header', 'standard' );		
		
		$menu_type_class    = minfolio_get_option( 'menu-type' );	
		$menu_layout_class  = minfolio_get_option( 'menu-layout' );	
		$menu_display_class = minfolio_get_option( 'menu-display' );					
		$menu_sticky        = minfolio_get_option( 'menu-sticky' );
		
		$page_menu_override = 'inherit';
	
		if( is_singular( 'portfolio' ) || is_singular( 'page' ) || is_singular( 'post' ) ) {
			
			$page_menu_override  = minfolio_get_post_meta( 'page_menu_override' );		
			
			if( $page_menu_override == 'custom' ) {				
				
				$menu_type_class    = minfolio_get_post_meta( 'page_menu_type' );
				$menu_layout_class  = minfolio_get_post_meta( 'page_menu_layout' );	
				$menu_display_class = minfolio_get_post_meta( 'page_menu_display' );						
				$menu_sticky 		= minfolio_get_post_meta( 'page_menu_sticky' );
			}
		}			

		if( is_404() ) {
			$menu_display_class = 'solid';	
		}
		
		$classes[] = $menu_type_class;

		$classes[] = $menu_layout_class;
		$classes[] = $menu_display_class;			
		
			
		if( $menu_sticky == 1 ) {
			$classes[] = 'sticky';
		}
		
		return implode( ' ', $classes );		
	
	}
}

if ( ! function_exists( 'minfolio_footer_classes' ) ) {
	
	function minfolio_footer_classes() {

		$classes = array( 'site-footer' );
		
		$footer_layout_class  = minfolio_get_option( 'footer-layout' );	
		$footer_column_class  = minfolio_get_option( 'footer-columns' );	
		
		$classes[] = 'standard';		
		$classes[] = $footer_layout_class;		
		$classes[] = $footer_column_class;	

		return implode( ' ', $classes );		
	
	}
}

if ( ! function_exists( 'minfolio_menu_type' ) ) {
	
	function minfolio_menu_type() {

		$menu_type	= minfolio_get_option( 'menu-type' );	
		
		if( is_singular( 'portfolio' ) || is_singular( 'page' ) || is_singular( 'post' ) ) {			
			
			$page_menu_override  = minfolio_get_post_meta( 'page_menu_override' );		
			
			if( $page_menu_override == 'custom' ) {
				
				$menu_type  = minfolio_get_post_meta( 'page_menu_type' );					
			}
		}			
		
		return $menu_type;
	
	}
}


if ( ! function_exists( 'minfolio_page_footer_display' ) ) {
	
	function minfolio_page_footer_display() {

		$page_footer_display  = true;
		
		if( is_singular( 'portfolio' ) || is_singular( 'page' ) || is_singular( 'post' ) ) {			
			
			$page_footer_override  = minfolio_get_post_meta( 'page_footer_override' );			
			
			if( $page_footer_override == 'custom' ) {				
				$page_footer_display  = minfolio_get_post_meta( 'footer_display' );					
			}
		}			
		
		return $page_footer_display;
	
	}
}

/**
 * Get an attachment ID given a URL. 
 */

if ( ! function_exists( 'minfolio_get_attachment_id' ) ) {	

	function minfolio_get_attachment_id( $url ) {

		$attachment_id = 0;

		$dir = wp_upload_dir();

		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?

			$file = basename( $url );

			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);

			$query = new WP_Query( $query_args );

			if ( $query->have_posts() ) {

				foreach ( $query->posts as $post_id ) {

					$meta = wp_get_attachment_metadata( $post_id );

					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );

					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}

				}

			}

		}

		return $attachment_id;
	}

}

if ( ! function_exists( 'minfolio_check_portfolio_categories' ) ) {	

	function minfolio_check_portfolio_categories( $categories_flag, $category, $exclude_categories ) {
		
		$show_category = false;
				
		if( !empty( $exclude_categories ) ) {
			
			if( $categories_flag == 'exclude' ) { 

				if( !in_array( $category, $exclude_categories ) ) {
					$show_category = true;
				}			
			}
			else {

				if( in_array( $category, $exclude_categories ) ) {
					$show_category = true;
				}			
			}
		}
		else {
			$show_category = true;
		}
					
		return $show_category;
	}	
}

if ( ! function_exists( 'minfolio_get_social_url' ) ) {	

	function minfolio_get_social_url( $url_key ) {

		$social_url = minfolio_get_option( $url_key );

		if ( !empty( $social_url ) ) {

			if( $url_key == 'url-envelope-o' && is_email( sanitize_email( $social_url ) )) {

				return 'mailto:' . sanitize_email( $social_url );			
			}
			elseif( $url_key == 'url-skype' ) {

				return 'skype:' . $social_url . '?userinfo';			
			}
			else {
				return esc_url( $social_url );
			}
		}
		else {
			return "#";
		}

	}

}

if ( ! function_exists( 'minfolio_page_404_heading' ) ) {	

	function minfolio_page_404_heading() {
		
		$multilingual_switch  = minfolio_get_option( 'multilingual-switch' );
				
		$page_title		= minfolio_get_option( 'page-title' );					
		$page_subtitle  = minfolio_get_option( 'page-subtitle' );		
		
		$page_heading_markup = '';
		
		if( $multilingual_switch == 1 ) {		
		
			$page_heading_markup .= '<h1 class="page-title">' . esc_html__( '404', 'minfolio' ) . '</h1>';
			$page_heading_markup .= '<div>' . esc_html__( 'Sorry, the page requested couldn\'t be found.', 'minfolio' ) . '</div>';			
		}
		else {
			
			$page_heading_markup .= '<h1 class="page-title">' . $page_title . '</h1>';
			$page_heading_markup .= '<div>' . $page_subtitle . '</div>';			
		}
		
		echo apply_filters( 'minfolio_page_404_heading', $page_heading_markup );

	}

}

if ( ! function_exists( 'minfolio_page_404_content' ) ) {	

	function minfolio_page_404_content() {
		
		$multilingual_switch  = minfolio_get_option( 'multilingual-switch' );
				
		$page_desc		= minfolio_get_option( 'page-desc' );					
		$page_btn_text  = minfolio_get_option( 'page-btn-text' );		
		
		$page_content_markup = '';
		
		if( $multilingual_switch == 1 ) {		
		
			$page_content_markup .= '<p>' . esc_html__( 'The page you are looking for might have been removed had its name changed or its temporarily unavailable.', 'minfolio' ) . '</p>';
			$page_content_markup .= '<div class="clbr-btn-wrapper">';
			$page_content_markup .= '<a class="clbr-btn clbr-btn-lg" href="' . esc_url( home_url('/') ) . '" >' . esc_html__( 'Back to home', 'minfolio' ) . '</a>';			
			$page_content_markup .= '</div>';
		}
		else {
			
			$page_content_markup .= '<p>' . $page_desc . '</p>';
			$page_content_markup .= '<div class="clbr-btn-wrapper">';
			$page_content_markup .= '<a class="clbr-btn clbr-btn-lg" href="' . esc_url( home_url('/') ) . '" >' . $page_btn_text . '</a>';			
			$page_content_markup .= '</div>';
		}
		
		echo apply_filters( 'minfolio_page_404_content', $page_content_markup );

	}

}

if ( ! function_exists( 'minfolio_override_wp_video_shortcode' ) ) {	
	
	function minfolio_override_wp_video_shortcode( $output ) {
		
		preg_match( '@src="([^"]+)"@' , $output, $match );
		
		$src = array_pop( $match );
		$src = preg_replace( '/\?.*/', '', $src );

		$output = str_replace( "<video", "<video muted playsinline ", $output );
		$output = str_replace( "controls=", "data-controls=", $output );
		
		$str = preg_replace( '/\<[\/]{0,1}div[^\>]*\>/i', '', $output );
		
		$wrap = "<div class='flex-video'>" . $str . "</div>";

		$output = $wrap;
		
		return $output;
		
	}
}

add_filter( 'wp_video_shortcode', 'minfolio_override_wp_video_shortcode' );


if ( ! function_exists( 'minfolio_custom_footer_socials' ) ) {	
	
	function minfolio_custom_footer_socials() {

		$social_link_target = '';
		$footer_social_target = minfolio_get_option( 'footer-social-target' );
					
		if( $footer_social_target == '_blank' ) {
			$social_link_target = 'target="_blank"';
		}

		$footer_social_icon_1 = minfolio_get_option( 'custom-footer-social-icon-1' );
		$footer_social_text_1 = minfolio_get_option( 'custom-footer-social-text-1' );
		$footer_social_url_1  = minfolio_get_option( 'custom-footer-social-url-1' );

		$footer_social_icon_2 = minfolio_get_option( 'custom-footer-social-icon-2' );
		$footer_social_text_2 = minfolio_get_option( 'custom-footer-social-text-2' );
		$footer_social_url_2  = minfolio_get_option( 'custom-footer-social-url-2' );

		$footer_custom_social_markup = '';

		if ( $footer_social_icon_1 ) {
		
			$footer_custom_social_markup .= '<li>';

			$footer_custom_social_markup .= '<a href="' . $footer_social_url_1 . '"  ' . esc_attr( $social_link_target ) . ' >';
			
			$footer_custom_social_markup .= '<span>';	
			$footer_custom_social_markup .= esc_html( $footer_social_text_1 );	
			$footer_custom_social_markup .= '</span>';	

			$footer_custom_social_markup .= '<i class="' . esc_attr( $footer_social_icon_1 ) . '"></i>';	

			$footer_custom_social_markup .= '</a>';		
			
			$footer_custom_social_markup .= '</li>';			

		}

		if ( $footer_social_icon_2 ) {
		
			$footer_custom_social_markup .= '<li>';

			$footer_custom_social_markup .= '<a href="' . $footer_social_url_2 . '"  ' . esc_attr( $social_link_target ) . ' >';

			$footer_custom_social_markup .= '<span>';	
			$footer_custom_social_markup .= esc_html( $footer_social_text_2 );	
			$footer_custom_social_markup .= '</span>';	

			$footer_custom_social_markup .= '<i class="' . esc_attr( $footer_social_icon_2 ) . '"></i>';	

			$footer_custom_social_markup .= '</a>';		
			
			$footer_custom_social_markup .= '</li>';			

		}

		echo apply_filters( 'minfolio_custom_footer_socials', $footer_custom_social_markup ); 

	}
}

if ( ! function_exists( 'minfolio_custom_menu_socials' ) ) {	
	
	function minfolio_custom_menu_socials() {

		$social_link_target = '';
		$menu_social_target = minfolio_get_option( 'menu-social-target' );
					
		if( $menu_social_target == '_blank' ) {
			$social_link_target = 'target="_blank"';
		}

		$menu_social_icon_1 = minfolio_get_option( 'custom-menu-social-icon-1' );
		$menu_social_url_1  = minfolio_get_option( 'custom-menu-social-url-1' );

		$menu_social_icon_2 = minfolio_get_option( 'custom-menu-social-icon-2' );
		$menu_social_url_2  = minfolio_get_option( 'custom-menu-social-url-2' );

		$menu_custom_social_markup = '';

		if ( $menu_social_icon_1 ) {
		
			$menu_custom_social_markup .= '<li>';

			$menu_custom_social_markup .= '<a href="' . $menu_social_url_1 . '"  ' . esc_attr( $social_link_target ) . ' >';

			$menu_custom_social_markup .= '<i class="' . esc_attr( $menu_social_icon_1 ) . '"></i>';			 			

			$menu_custom_social_markup .= '</a>';		
			
			$menu_custom_social_markup .= '</li>';			

		}

		if ( $menu_social_icon_2 ) {
		
			$menu_custom_social_markup .= '<li>';

			$menu_custom_social_markup .= '<a href="' . $menu_social_url_2 . '"  ' . esc_attr( $social_link_target ) . ' >';
			
			$menu_custom_social_markup .= '<i class="' . esc_attr( $menu_social_icon_2 ) . '"></i>';						

			$menu_custom_social_markup .= '</a>';		
			
			$menu_custom_social_markup .= '</li>';			

		}

		echo apply_filters( 'minfolio_custom_menu_socials', $menu_custom_social_markup ); 

	}
}