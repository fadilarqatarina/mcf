<?php 

	$scroll_to_top = minfolio_get_option( 'footer-scroll-top' );

	if ( $scroll_to_top ) { ?>		
		
		<a id="scrollToTop" href="#" class="scroll-top-link" >
			<img src="<?php echo get_theme_file_uri( '/assets/images/svg/chevron-up.svg' ); ?>" class="go-to-top" />				
		</a>

<?php } ?>