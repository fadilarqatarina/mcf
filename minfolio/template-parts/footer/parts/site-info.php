<?php
/**
 * Displays footer site info
 *
 */
?>

<?php 

	$footer_author = minfolio_get_option( 'footer-author' );
	$footer_copyright = minfolio_get_option( 'footer-copyright' );
?>

<div class="site-info-wrap">

	<div class="site-author">		
		<?php echo wp_kses( $footer_author, array( 'a' =>  array( 'href' => array(),'target' => array() ) ) );  ?>
	</div>
			
	<div class="site-copyright">
		<?php echo wp_kses( $footer_copyright, array( 'a' =>  array( 'href' => array(),'target' => array() ) ) );  ?>
	</div>
	
</div><!-- .site-info -->