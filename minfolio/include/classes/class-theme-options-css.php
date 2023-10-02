<?php

if ( ! class_exists( 'Minfolio_Theme_Options_CSS' ) ) {

    class Minfolio_Theme_Options_CSS {


        public function __construct() {           

            add_action( 'wp_enqueue_scripts', array( $this, 'print_theme_options_style' ) );

            add_action( 'wp_head', array( $this, 'print_custom_css' ) );

        }    

        public function print_theme_options_style() {

            $theme_options_css = '';
          
            $theme_options_css .= ':root { ';

            $theme_options_css .= $this->get_global_layout_container_width();

            $theme_options_css .= $this->get_theme_branding_css_variables();
           
            $theme_options_css .= $this->get_theme_header_css_variables();

            $theme_options_css .= $this->get_theme_footer_css_variables();

            $theme_options_css .= ' }';

            $theme_options_css .= $this->get_theme_header_inline_css();

            $theme_options_css .= $this->get_theme_footer_inline_css();

            $theme_options_css .= $this->get_theme_blog_inline_css();

            $theme_options_css = apply_filters( 'minfolio_add_inline_css', $theme_options_css );

            wp_add_inline_style( 'minfolio-style', $theme_options_css );

        }

        public function print_custom_css() {

            $custom_css = $this->get_theme_style_option( 'custom-css' );

            if( !empty( $custom_css ) ) {
    
                echo '<style type="text/css" id="custom-css">';	
                    echo esc_html( $custom_css );		
                echo '</style>';
            }

        }
      
        private function get_theme_branding_css_variables() { 

            $dark_logo_width = 105;	

            $menu_dark_logo = $this->get_theme_style_option( 'menu-dark-logo' );	
            $menu_text_dark_logo_color = $this->get_theme_style_option( 'menu-text-logo-dark-color' );	
            $menu_text_light_logo_color = $this->get_theme_style_option( 'menu-text-logo-light-color' );

            if( !empty( $menu_dark_logo ) ) {

                $menu_dark_logo_id =  minfolio_get_attachment_id( $menu_dark_logo );
                
                if( $menu_dark_logo_id != 0 ) {				
                    $dark_logo_width = wp_get_attachment_image_src( $menu_dark_logo_id, 'full' );
                    $dark_logo_width = $dark_logo_width[1];
                }
            }			

            $branding_css_variables = '';          

            $branding_css_variables .= '--clbr-width-retina-branding:' . $dark_logo_width . 'px;';
            $branding_css_variables .= '--clbr-branding-text-light-color:' . $menu_text_light_logo_color[ 'value' ] . ';';
            $branding_css_variables .= '--clbr-branding-text-dark-color:' . $menu_text_dark_logo_color[ 'value' ] . ';';
            
            return $branding_css_variables;            

        }

        private function get_theme_header_css_variables() {            
         
            $header_bg_color = $this->get_theme_style_option( 'menu-bg-color' );     
           
            $header_css_variables = '';
          
            $header_css_variables .= '--clbr-color-header-bg:' . $header_bg_color . ';';              

            return $header_css_variables;

        }

        private function get_theme_header_inline_css() {                     
            
            $header_solid_link_custom = $this->get_theme_style_option( 'menu-solid-link-custom' ); 
            $header_solid_link_color = $this->get_theme_style_option( 'menu-link-color' ); 
            $header_transparent_link_color = $this->get_theme_style_option( 'menu-transparent-link-color' );  
                                
            $header_inline_css = '';

            $header_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'menu-text-logo-typo', '', '#site-branding .light-text-logo, #site-branding .dark-text-logo' );

            $header_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'menu-typo', '', '#masthead.site-header.standard #site-navigation .menu > li > a, #masthead.site-header.standard.centered-menu .menu-contact a' );
          
            if( $header_solid_link_custom == 1 ) {
            
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li ul li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li ul li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } ';    
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li.current-menu-item > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent) #site-navigation .menu > li.current-menu-ancestor > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent).centered-menu .menu-contact a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent).centered-menu .menu-contact svg { stroke:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header:not(.transparent).centered-menu .menu-contact a:hover { color:' . $header_solid_link_color[ 'hover' ] . ' } ';     

                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } '; 
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li ul li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li ul li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } ';                       
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li.current-menu-item > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck #site-navigation .menu > li.current-menu-ancestor > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck.centered-menu .menu-contact a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck.centered-menu .menu-contact svg { stroke:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent.is-stuck.centered-menu .menu-contact a:hover { color:' . $header_solid_link_color[ 'hover' ] . ' } ';     

                $header_inline_css .= ' @media (max-width: 991px) { ';

                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } '; 
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li ul li > a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li ul li:hover > a { color:' . $header_solid_link_color[ 'hover' ] . ' } ';                       
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li.current-menu-item > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li.current-menu-ancestor > a { color:' . $header_solid_link_color[ 'active' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact a { color:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact svg { stroke:' . $header_solid_link_color[ 'regular' ] . ' } ';         
                $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact a:hover { color:' . $header_solid_link_color[ 'hover' ] . ' } ';     
            
                $header_inline_css .= ' } ';

            }

            $header_inline_css .= ' @media (min-width: 991px) { ';

            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li > a { color:' . $header_transparent_link_color[ 'regular' ] . ' } ';         
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li:hover > a { color:' . $header_transparent_link_color[ 'hover' ] . ' } ';                     
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li.current-menu-item > a { color:' . $header_transparent_link_color[ 'active' ] . ' } ';         
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck) #site-navigation .menu > li.current-menu-ancestor > a { color:' . $header_transparent_link_color[ 'active' ] . ' } ';         
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact a { color:' . $header_transparent_link_color[ 'regular' ] . ' } ';         
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact svg { stroke:' . $header_transparent_link_color[ 'regular' ] . ' } ';         
            $header_inline_css .= ' #masthead.site-header.transparent:not(.is-stuck).centered-menu .menu-contact a:hover { color:' . $header_transparent_link_color[ 'hover' ] . ' } ';         
            

            $header_inline_css .= ' } ';


            $header_inline_css .= ' @media (max-width: 1024px) { ';

            $header_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'menu-text-logo-typo', '', '#site-branding .light-text-logo, #site-branding .dark-text-logo' );
            $header_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'menu-typo', '', '#masthead.site-header.standard #site-navigation .menu > li > a, #masthead.site-header.standard.centered-menu .menu-contact a' );

            $header_inline_css .= ' } ';


            $header_inline_css .= ' @media (max-width: 767px) { ';      

            $header_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'menu-text-logo-typo', '', '#site-branding .light-text-logo, #site-branding .dark-text-logo' );
            $header_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'menu-typo', '', '#masthead.site-header.standard #site-navigation .menu > li > a, #masthead.site-header.standard.centered-menu .menu-contact a' );
                    
                    
            $header_inline_css .= ' } ';

           

            
            return $header_inline_css;

        }

        private function get_theme_footer_css_variables() { 

            $footer_bg_color   = $this->get_theme_style_option( 'footer-bg-color' );           

            $footer_css_variables = '';

            $footer_css_variables .= '--clbr-color-footer-bg:' . $footer_bg_color . ';';	

            return $footer_css_variables;

        }

        private function get_theme_footer_inline_css() { 

            $footer_border_color = $this->get_theme_style_option( 'footer-border-color' );  

            $footer_inline_css = '';

            $footer_inline_css .= ' .site-footer .site-info-wrap { border-top-color: ' . $footer_border_color . ' } ';	

            $footer_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'footer-heading-typo', 'footer-heading-color', '.site-footer .widget-area .widget h6, .site-footer .widget-area .widget h1, .site-footer .widget-area .widget h2, .site-footer .widget-area .widget h3,  .site-footer .widget-area .widget h4, .site-footer .widget-area .widget h5, .site-footer .widget-area .widget h6' );
            $footer_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'footer-text-typo', 'footer-text-color', '.site-footer .widget-area .widget li, .site-footer .widget-area .widget a, .site-footer .widget-area .widget p, .site-footer .widget li, .site-footer .widget a ' );

            $footer_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'footer-contact-heading-typo', 'footer-contact-heading-color', '.site-footer .widget-area .widget-contact-info h2' );
            $footer_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'footer-contact-text-typo', 'footer-contact-text-color', '.site-footer .widget-area .widget li, .site-footer .widget-area .widget li span a' );

            $footer_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'footer-data-text-typo', 'footer-data-text-color', '.site-footer .site-info-wrap .site-author, .site-footer .site-info-wrap .site-copyright' );

            
            return $footer_inline_css;

        }

        private function get_theme_blog_inline_css() { 
            
            $blog_banner_bg_color           = $this->get_theme_style_option( 'blog-banner-bg-color' );               
            $blog_banner_bg_color_overlay   = $this->get_theme_style_option( 'blog-banner-bg-color-overlay' );	
            
            $blog_archive_banner_bg_color   = $this->get_theme_style_option( 'blog-archive-banner-bg-color' );	           
            $blog_archive_banner_overlay_color = $this->get_theme_style_option( 'blog-archive-banner-overlay-color' );	
            
            $blog_post_banner_bg_color      = $this->get_theme_style_option( 'blog-post-banner-bg-color' );               
            $blog_post_banner_bg_color_overlay   = $this->get_theme_style_option( 'blog-post-banner-bg-color-overlay' );
            
            $blog_post_slider_pag_color         = $this->get_theme_style_option( 'blog-post-slider-pag-color' );
            $blog_post_slider_pag_active_color  = $this->get_theme_style_option( 'blog-post-slider-pag-active-color' );


            $blog_inline_css = '';

            $blog_inline_css .= ' body.blog .blog-banner { background-color: ' . $blog_banner_bg_color . ' } ';	
            $blog_inline_css .= ' body.blog .blog-banner .color-overlay { background: ' . $blog_banner_bg_color_overlay . ' } ';          

            $blog_inline_css .= ' body.single .blog-banner { background-color: ' . $blog_post_banner_bg_color . ' } ';	
            $blog_inline_css .= ' body.single .blog-banner .color-overlay { background: ' . $blog_post_banner_bg_color_overlay . ' } ';
          
            $blog_inline_css .= ' body.archive .blog-banner, body.search .blog-banner { background-color: ' . $blog_archive_banner_bg_color . ' } ';	
            $blog_inline_css .= ' body.archive .blog-banner .color-overlay, body.search .blog-banner .color-overlay { background: ' . $blog_archive_banner_overlay_color . ' } ';
            
            $blog_inline_css .= ' .clbr-post-carousel.basic button.flickity-button { background-color: ' . $blog_post_slider_pag_color . ' } ';	
            $blog_inline_css .= ' .clbr-post-carousel.basic .flickity-page-dots .dot { background-color: ' . $blog_post_slider_pag_color . ' } ';	
            $blog_inline_css .= ' .clbr-post-carousel.basic .flickity-page-dots .dot.is-selected { background-color: ' . $blog_post_slider_pag_active_color . ' } ';	
                 
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'desktop', 'blog-banner-padding', 'body.blog .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'desktop', 'blog-archive-banner-padding', 'body.archive .blog-banner, body.search .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'desktop', 'blog-post-banner-padding', 'body.single .blog-banner' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-banner-upper-heading-typo', 'blog-banner-upper-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-banner-heading-typo', 'blog-banner-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title .vcard' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-archive-banner-desc-typo', 'blog-archive-banner-desc-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content .description' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-post-banner-upper-heading-typo', 'blog-post-banner-upper-heading-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-post-banner-title-typo', 'blog-post-banner-title-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-post-title-typo', 'blog-post-title-color', '.post-list .post .entry-header .entry-title a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-post-meta-typo', 'blog-post-meta-color', '.post-list .post .entry-header .entry-meta span.posted-on time, .post-list .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-post-content-typo', 'blog-post-content-color', '.post-list .post .entry-content p' );
            
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-single-post-title-typo', 'blog-single-post-title-color', '.post-single .post .entry-header .entry-title' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-single-post-meta-typo', 'blog-single-post-meta-color', '.post-single .post .entry-header .entry-meta span.posted-on time, .post-single .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'desktop', 'blog-single-post-content-typo', 'blog-single-post-content-color', '.post-single .post .entry-content p' );

          
            $blog_inline_css .= ' @media (max-width: 1024px) { ';

            $blog_inline_css .= $this->build_responsive_padding_control_css( 'tablet', 'blog-banner-padding', 'body.blog .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'tablet', 'blog-archive-banner-padding', 'body.archive .blog-banner, body.search .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'tablet', 'blog-post-banner-padding', 'body.single .blog-banner' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-banner-upper-heading-typo', 'blog-banner-upper-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-banner-heading-typo', 'blog-banner-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title .vcard' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-archive-banner-desc-typo', 'blog-archive-banner-desc-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content .description' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-post-banner-upper-heading-typo', 'blog-post-banner-upper-heading-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-post-banner-title-typo', 'blog-post-banner-title-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-post-title-typo', 'blog-post-title-color', '.post-list .post .entry-header .entry-title a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-post-meta-typo', 'blog-post-meta-color', '.post-list .post .entry-header .entry-meta span.posted-on time, .post-list .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-post-content-typo', 'blog-post-content-color', '.post-list .post .entry-content p' );
            
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-single-post-title-typo', 'blog-single-post-title-color', '.post-single .post .entry-header .entry-title' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-single-post-meta-typo', 'blog-single-post-meta-color', '.post-single .post .entry-header .entry-meta span.posted-on time, .post-single .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'tablet', 'blog-single-post-content-typo', 'blog-single-post-content-color', '.post-single .post .entry-content p' );


            $blog_inline_css .= ' } ';


            $blog_inline_css .= ' @media (max-width: 767px) { ';            

            $blog_inline_css .= $this->build_responsive_padding_control_css( 'mobile', 'blog-banner-padding', 'body.blog .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'mobile', 'blog-archive-banner-padding', 'body.archive .blog-banner, body.search .blog-banner' );
            $blog_inline_css .= $this->build_responsive_padding_control_css( 'mobile', 'blog-post-banner-padding', 'body.single .blog-banner' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-banner-upper-heading-typo', 'blog-banner-upper-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-banner-heading-typo', 'blog-banner-heading-color', '.blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .archive .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title .vcard' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-archive-banner-heading-typo', 'blog-archive-banner-heading-color', '.search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title, .search .blog-banner .blog-banner-content-wrap .blog-banner-content h1.banner-title span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-archive-banner-desc-typo', 'blog-archive-banner-desc-color', '.archive .blog-banner .blog-banner-content-wrap .blog-banner-content .description' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-post-banner-upper-heading-typo', 'blog-post-banner-upper-heading-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content span' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-post-banner-title-typo', 'blog-post-banner-title-color', 'body.single .blog-banner .blog-banner-content-wrap .blog-banner-content .banner-desc' );

            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-post-title-typo', 'blog-post-title-color', '.post-list .post .entry-header .entry-title a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-post-meta-typo', 'blog-post-meta-color', '.post-list .post .entry-header .entry-meta span.posted-on time, .post-list .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-post-content-typo', 'blog-post-content-color', '.post-list .post .entry-content p' );
            
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-single-post-title-typo', 'blog-single-post-title-color', '.post-single .post .entry-header .entry-title' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-single-post-meta-typo', 'blog-single-post-meta-color', '.post-single .post .entry-header .entry-meta span.posted-on time, .post-single .post .entry-header .entry-meta .cat-links a' );
            $blog_inline_css .= $this->build_responsive_typography_control_css( 'mobile', 'blog-single-post-content-typo', 'blog-single-post-content-color', '.post-single .post .entry-content p' );


            $blog_inline_css .= ' } ';          
          

            return $blog_inline_css;

        }      

        private function build_responsive_padding_control_css( $device, $control_field, $selector ) {

            $padding_css = '';

            $control_value = $this->get_theme_style_option( $control_field );	

            if( !empty( $control_value ) ) {

                $control_value = json_decode( $control_value );

                $padding_css  .= $selector  . ' { ';

                $padding_css  .= !empty( $control_value->{ $device . '_top' } )    ? 'padding-top : ' . $control_value->{ $device . '_top' } . 'px;' : '';
                $padding_css  .= !empty( $control_value->{ $device . '_right' } )  ? 'padding-right : ' . $control_value->{ $device . '_right' } . 'px;' : '';
                $padding_css  .= !empty( $control_value->{ $device . '_bottom' } ) ? 'padding-bottom : ' . $control_value->{ $device . '_bottom' } . 'px;' : '';
                $padding_css  .= !empty( $control_value->{ $device . '_left' } )   ? 'padding-left : ' . $control_value->{ $device . '_left' } . 'px;' : '';

                $padding_css  .= ' } ';
    
            }

            return $padding_css;

        } 

        private function build_responsive_typography_control_css( $device, $control_field, $color_control_field, $selector ) {

            $typography_css = '';

            $control_value = $this->get_theme_style_option( $control_field );	
            $color_control_value = $this->get_theme_style_option( $color_control_field );	           

            if( !empty( $color_control_value ) && $device == 'desktop' ) {

                $typography_css  .= $selector  . ' { ';      
                $typography_css  .= 'color : ' . $color_control_value[ 'value' ] . ';';                    
                $typography_css  .= ' } ';

            }

            if( !empty( $control_value ) ) {

                $control_value = json_decode( $control_value );   
                
                $typography_css  .= $selector  . ' { ';      

                if( $device == 'desktop' ) {                  

                    $typography_css  .= !empty( $control_value->{ 'font-family' } )    ? 'font-family : var(--e-global-typography-' . $control_value->{ 'font-family' } . '-font-family);' : '';
                    $typography_css  .= !empty( $control_value->{ 'font-weight' } )    ? 'font-weight : ' . $control_value->{ 'font-weight' } . ';' : '';
                    $typography_css  .= !empty( $control_value->{ 'text-transform' } ) ? 'text-transform : ' . $control_value->{ 'text-transform' } . ';' : '';
                    $typography_css  .= !empty( $control_value->{ 'font-style' } )     ? 'font-style : ' . $control_value->{ 'font-style' } . ';' : '';
                    $typography_css  .= !empty( $control_value->{ 'desktop-font-size' } ) ? 'font-size : ' . $control_value->{ 'desktop-font-size' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'desktop-line-height' } ) ? 'line-height : ' . $control_value->{ 'desktop-line-height' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'desktop-letter-spacing' } ) ? 'letter-spacing : ' . $control_value->{ 'desktop-letter-spacing' } . 'px;' : '';                                       

                }
                elseif( $device == 'tablet' ) {

                    $typography_css  .= !empty( $control_value->{ 'tablet-font-size' } ) ? 'font-size : ' . $control_value->{ 'tablet-font-size' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'tablet-line-height' } ) ? 'line-height : ' . $control_value->{ 'tablet-line-height' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'tablet-letter-spacing' } ) ? 'letter-spacing : ' . $control_value->{ 'tablet-letter-spacing' } . 'px;' : '';                    

                }
                elseif( $device == 'mobile' ) {

                    $typography_css  .= !empty( $control_value->{ 'mobile-font-size' } ) ? 'font-size : ' . $control_value->{ 'mobile-font-size' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'mobile-line-height' } ) ? 'line-height : ' . $control_value->{ 'mobile-line-height' } . 'px;' : '';
                    $typography_css  .= !empty( $control_value->{ 'mobile-letter-spacing' } ) ? 'letter-spacing : ' . $control_value->{ 'mobile-letter-spacing' } . 'px;' : '';                    

                }      
                
                $typography_css  .= ' } ';
    
            }            
    
            return $typography_css;

        }


        private function get_theme_style_option( $key, $type = null ) { 
           
            return get_theme_mod( $key, $this->theme_style_default_options( $key ) );

        }

        private function theme_style_default_options( $key ) { 

            $defaults = array(    

                'menu-text-logo-dark-color' => array( 'value' => '#000000' ),  
                'menu-text-logo-light-color' => array( 'value' => '#ffffff' ),  
              
                'menu-bg-color' => '#ffffff',   
                'menu-solid-link-custom' => 0,  
                'menu-link-color' => array( 'regular' => '#151515', 'hover' => '#f77f00', 'active' => '#151515' ), 
                'menu-transparent-link-color' => array( 'regular' => 'rgba(255,255,255,1)', 'hover' => 'rgba(255,255,255,.5)', 'active' => 'rgba(255,255,255,1)' ), 
                                
                'footer-bg-color' => '#1e1e1e',    
                'footer-border-color' => 'rgba(255, 255, 255, 0.1)',    
                'footer-heading-color' => array( 'value' => '#ffffff' ),    
                'footer-text-color' => array( 'value' => '#a0a0a0' ),    
                'footer-contact-heading-color' => array( 'value' => '#ffffff' ),    
                'footer-contact-text-color' => array( 'value' => '#a0a0a0' ),    
                'footer-data-text-color' => array( 'value' => '#a0a0a0' ),                 
           
                'blog-banner-upper-heading-color' => array( 'value' => 'rgba(255, 255, 255, 0.5)' ),    
                'blog-banner-heading-color' => array( 'value' => '#151515' ),    
                'blog-post-banner-upper-heading-color' => array( 'value' => 'rgba(255, 255, 255, 0.5)' ),    
                'blog-post-banner-title-color' => array( 'value' => '#ffffff' ),    
                'blog-archive-banner-heading-color' => array( 'value' => '#ffffff' ),    
                'blog-archive-banner-desc-color' => array( 'value' => 'rgba(255, 255, 255, 0.5)' ),    
                'blog-post-title-color' => array( 'value' => '#151515' ),    
                'blog-post-meta-color' => array( 'value' => '#909090' ),    
                'blog-post-content-color' => array( 'value' => '#606060' ),    
                'blog-single-post-title-color' => array( 'value' => '#151515' ),    
                'blog-single-post-meta-color' => array( 'value' => '#909090' ),    
                'blog-single-post-content-color' => array( 'value' => '#606060' ),    
                     
            );	
    
            if( !empty( $defaults[ $key ] ) ) {
                return $defaults[ $key ];
            }
    
            return false;   

        }

        private function get_global_layout_container_width() {
           
            $site_container_css_variables = '';

            if ( did_action( 'elementor/loaded' ) ) {

                $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();               
               
                $settings = $kit->get_settings_for_display(); 
                
                $site_container_css_variables .= '--clbr-site-container-width:' . $settings[ 'container_width' ][ 'size' ] . 'px;';	
                
            }   
            else {
                $site_container_css_variables .= '--clbr-site-container-width: 1200px;';	                
            }         
    
            return $site_container_css_variables;

        }     

    }

    $minfolio_theme_otpion_css = new Minfolio_Theme_Options_CSS();

}