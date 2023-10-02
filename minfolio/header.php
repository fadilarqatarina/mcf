<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *  
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >	

<?php

	if ( ! function_exists( 'wp_body_open' ) ) {
		
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
	}	
	
?>
	
<div id="page" class="site">
	
	<?php get_template_part( 'template-parts/header/header-wrap' ); ?>		
	
	<div class="site-content-contain">
		
