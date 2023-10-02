<?php
/**
 * Required plugins for use with the theme via the TGMA
 * 
 */

if ( ! function_exists( 'minfolio_register_required_plugins' ) ) {	
	
	function minfolio_register_required_plugins() {

		$plugins_dir = get_template_directory() .'/include/plugins/';

		$plugins = array(
			array(
				'name'				=> 'Elementor',
				'slug'				=> 'elementor', 			
				'required'			=> false,
				'force_activation'	=> false,				
			),
			array(
				'name'				=> 'Minfolio Core',
				'slug'				=> 'minfolio-core',			
				'source'			=> $plugins_dir .'minfolio-core.zip',
				'required'			=> false,
				'force_activation'	=> false,
				'version'           => '1.0.6',
			),						
			array(
				'name'				=> 'One Click Demo Import',
				'slug'				=> 'one-click-demo-import',							
				'required'			=> false,
				'force_activation'	=> false,
			),		
			array(
				'name'				=> 'Contact Form 7',
				'slug'				=> 'contact-form-7',				
				'required'			=> false,
				'force_activation'	=> false,
			),	
			array(
				'name'				=> 'Safe SVG',
				'slug'				=> 'safe-svg',				
				'required'			=> false,
				'force_activation'	=> false,
			),												
		);		

		// Config settings
		$config = array(
			'id'				=> 'minfolio',		
			'menu'				=> 'install-required-plugins',			
			'parent_slug'		=> 'themes.php',
			'has_notices'		=> true,
			'is_automatic'		=> false,		
		);

		tgmpa( $plugins, $config );		
	}

}

add_action( 'tgmpa_register', 'minfolio_register_required_plugins' );