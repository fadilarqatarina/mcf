<?php

// Theme Version
define(	'MINFOLIO_THEME_VERSION', '1.0.6' );

if ( ! class_exists( 'Minfolio_Theme_Setup' ) ) {		

	class Minfolio_Theme_Setup {

		/**
		 * Initialize the class    
		 */
		public function __construct() {
			
			// Run class functions		
			add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );

			add_action( 'after_setup_theme', array( $this, 'include_files' ), 0 );

			// Load theme CSS
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_css' ) );	

			// Load theme js
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );			

			add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
			
		}
		
		public function setup_theme() {

			global $content_width;

			// Set content width based on theme's default design
			if ( ! isset( $content_width ) ) {
				$content_width = 1260;
			}
			
			// Load text domain
			load_theme_textdomain( 'minfolio', get_parent_theme_file_path( '/languages' ) );
			
			// // Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
			
			//Add title tag support
			add_theme_support( 'title-tag' );
			
			// Enable featured image support
			add_theme_support( 'post-thumbnails' ); 
			
			//blog image sizes			
			add_image_size( 'minfolio-blog-single-image', 1200, 790, true );			
			add_image_size( 'minfolio-blog-list-image', 1200, 790, true );	
			add_image_size( 'minfolio-blog-recent-post-image', 600, 430, true );				
						
			// Enable some useful post formats for the blog
			add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );
												
			/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
			*/
			add_theme_support( 'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );
			
			/*
			* This theme styles the visual editor to resemble the theme style,
			* specifically font, colors, and column width.
			*/
			add_editor_style( array( 'assets/css/editor-style.css', minfolio_fonts_url() ) );
			

			// Register navigation menus
			register_nav_menus (
				array(
					'main-menu'	 => esc_html__( 'Main Menu', 'minfolio' ),								
				)
			);
			
		}
		
		public function theme_css() {						
			
			wp_enqueue_style( 'minfolio-theme-font', minfolio_fonts_url() );					
										
	    	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/icons/fontawesome.min.css' ) );											
		
			// Main Style.css File
			wp_enqueue_style( 'minfolio-style', get_stylesheet_uri(), array(), MINFOLIO_THEME_VERSION );
			
			do_action( 'minfolio_enqueue_styles' );
			
		}
		
		public function theme_js() {
			
			$minify_js_switch  = minfolio_get_option( 'minify-js-switch' );
			$suffix = '';
        
			if( $minify_js_switch == 1 ) {
				$suffix = '.min';
			}  
		
			// Localize array
			$localize_array = array(			
				'ajaxurl'	  => admin_url( 'admin-ajax.php' ),
				'ajax_nonce'  => wp_create_nonce( 'minfolio-secure-ajax' ),
			);

			$localize_array = apply_filters( 'minfolio_main_js', $localize_array );
			
			// Comment reply
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}	

			//vendor plugins								
												
			wp_enqueue_script( 'headsup', get_theme_file_uri( '/assets/js/vendor/headsup.min.js' ), array( 'jquery' ), MINFOLIO_THEME_VERSION, true );

			wp_enqueue_script( 'lazysizes', get_theme_file_uri( '/assets/js/vendor/lazysizes.min.js' ), array(), MINFOLIO_THEME_VERSION, true );

			wp_enqueue_script( 'minfolio-main', get_theme_file_uri( '/assets/js/main' . $suffix . '.js' ), array( 'jquery' ), MINFOLIO_THEME_VERSION, true );	
			
			wp_localize_script( 'minfolio-main', 'minfolioMainJs', $localize_array );  
			
		}
		
		public function include_files() {
			
			if( is_admin() ) {

				require_once get_parent_theme_file_path( '/include/functions/required-plugins.php' );				

				require_once get_parent_theme_file_path( '/include/functions/admin-notices.php' );		
				
				require_once get_parent_theme_file_path( '/include/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php' );		
				
				if( class_exists( 'OCDI_Plugin' ) ) {			
				
					require_once get_parent_theme_file_path( '/include/functions/oneclick-demo-import.php' );				
				}
			}
			else {				
				
				require_once get_parent_theme_file_path( '/include/blog/blog-functions.php' );
							
				require_once get_parent_theme_file_path( '/include/classes/class-custom-menu-walker.php' );	
				
				if( class_exists( 'Minfolio_Core' ) ) {
					require_once get_parent_theme_file_path( '/include/classes/class-theme-options-css.php' );	
				}

			}	
			
			require_once get_parent_theme_file_path( '/include/functions/theme-functions.php' );
				
			 
		}
		
		public function register_sidebars() {
			
			// Main Sidebar
			register_sidebar( array(
				'name'          => esc_html__( 'Blog Sidebar', 'minfolio' ),
				'id'            => 'sidebar-blog',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'minfolio' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title"><span>',
				'after_title'   => '</span></h2>',
			) );

			//Footer Column 1
			register_sidebar( array ( 
				'name'			=> esc_html__('Footer Column 1', 'minfolio'),
				'id'			=> 'footer-widget-col-1',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6>',
			) );

			//Footer Column 2
			register_sidebar( array (
				'name'			=> esc_html__('Footer Column 2', 'minfolio'),
				'id'			=> 'footer-widget-col-2',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h6>',
				'after_title'	=> '</h6>',
			));

			//Footer Column 3
			register_sidebar( array (
				'name'			=> esc_html__('Footer Column 3', 'minfolio'),
				'id'			=> 'footer-widget-col-3',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6>',
			));

			//Footer Column 4
			register_sidebar( array (
				'name'			=> esc_html__('Footer Column 4', 'minfolio'),
				'id'			=> 'footer-widget-col-4',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h6>',
				'after_title'	=> '</h6>',
			)); 	
			
		}

	}		
		
	//Run the theme setup class 
	$minfolio_theme_setup = new Minfolio_Theme_Setup();
	
}


	