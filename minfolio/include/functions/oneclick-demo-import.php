<?php
/* 
 *	One Click Demo import Functions
 */

if ( ! function_exists( 'minfolio_import_files' ) ) {	
	
	function minfolio_import_files() {

		return array(
			array(
				'import_file_name'           => 'Minimal Portfolio',    
				'import_file_url'            => 'https://minfolio.caliberthemes.com/resources/demo-data/minimal/content.xml',					
				'import_widget_file_url'     => 'https://minfolio.caliberthemes.com/resources/demo-data/minimal/widgets.wie',	
				'import_customizer_file_url' => 'https://minfolio.caliberthemes.com/resources/demo-data/minimal/customizer.dat',						
				'import_notice'              => esc_html__( 'Make sure that all plugins are activated.', 'minfolio' ),
				'preview_url'                => 'https://minfolio.caliberthemes.com/minimal',					
			),			
		);		

	}
}

add_filter( 'ocdi/import_files', 'minfolio_import_files' );


if ( ! function_exists( 'minfolio_after_import_setup' ) ) {	

	function minfolio_after_import_setup( $selected_import ) {
	
		// Assign menus to their locations.
		$main_menu	  = get_term_by( 'name', 'Main Menu', 'nav_menu' );		
				
		set_theme_mod( 'nav_menu_locations', array(
				'main-menu'		=> $main_menu->term_id,				
			)
		);	

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home Hero Image' );
		$blog_page_id  = get_page_by_title( 'Blog' );	

		update_option( 'elementor_disable_color_schemes',  'yes' );
		update_option( 'elementor_disable_typography_schemes',  'yes' );
			
		update_option( 'elementor_active_kit', '555' );
				
		update_option( 'show_on_front',  'page' );
		update_option( 'page_on_front',  $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );		

	}

}

add_action( 'ocdi/after_import', 'minfolio_after_import_setup' );

add_filter( 'ocdi/disable_pt_branding', '__return_true' );



if ( ! function_exists( 'minfolio_show_system_status' ) ) {

	function minfolio_show_system_status( $default_text ) {

		$max_execution_time = ini_get('max_execution_time');
		$memory_limit = ini_get('memory_limit');
		$max_post = ini_get('post_max_size');
		$max_upload = ini_get('upload_max_filesize');		

		$default_text .= '<div class="config-info">';

		$default_text .= '<div class="config-intro-text">Recommended PHP Configuration Limits</div>';

		$default_text .= '<div class="config-text">';

		$default_text .= '<span class="config-text-for" >max_execution_time 180</span>';

		if( $max_execution_time < 180 ) {
			$default_text .= '<span class="config-text-fail" >'. $max_execution_time .'</span>';
		}
		else {
			$default_text .= '<span class="config-text-pass" >'. $max_execution_time .'</span>';
		}
		
		$default_text .= '</div>';

		$default_text .= '<div class="config-text">';

		$default_text .= '<span class="config-text-for" >memory_limit 128M</span>';

		if( $memory_limit < 128 ) {
			$default_text .= '<span class="config-text-fail" >'. $memory_limit .'</span>';
		}
		else {
			$default_text .= '<span class="config-text-pass" >'. $memory_limit .'</span>';
		}

		$default_text .= '</div>';

		$default_text .= '<div class="config-text">';

		$default_text .= '<span class="config-text-for" >post_max_size  32M </span>';

		if( $max_post < 32 ) {
			$default_text .= '<span class="config-text-fail" >'. $max_post .'</span>';
		}
		else {
			$default_text .= '<span class="config-text-pass" >'. $max_post .'</span>';
		}

		$default_text .= '</div>';


		$default_text .= '<div class="config-text">';

		$default_text .= '<span class="config-text-for" >upload_max_filesize  32M </span>';

		if( $max_upload < 32 ) {
			$default_text .= '<span class="config-text-fail" >'. $max_upload .'</span>';
		}
		else {
			$default_text .= '<span class="config-text-pass" >'. $max_upload .'</span>';
		}

		$default_text .= '</div>';

		$default_text .= '</div>';


		return $default_text;
	}

}

add_filter( 'ocdi/plugin_intro_text', 'minfolio_show_system_status' );