<?php

if ( ! function_exists( 'minfolio_check_php_version' ) ) {
	
	function minfolio_check_php_version() {

		// Check if phpversion function exists
		if ( function_exists( 'phpversion' ) ) {

			$php_version = phpversion();

			if( version_compare( $php_version, '5.3.5', '<' ) ) {
				
				$message = sprintf( esc_html__( '%s - You are running an obsolete version of PHP. For your security and a proper functioning of the theme you have to upgrade it a newer version (5.6 is recommended). Please contact your hosting provider.', 'minfolio' ), $php_version );
	            printf( '<div class="error"><p>%s</p></div>', $message );				
				
			} 
		}	
	}
}

add_action( 'admin_notices', 'minfolio_check_php_version' );

?>