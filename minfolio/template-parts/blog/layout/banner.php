<?php 
/**
 * Template part for displaying blog banner
 * 
 */
?>

<?php 
		
	$background_style = array();		
		
	$blog_banner_image = minfolio_get_option( 'blog-banner-bg-image' );	
	
	if( $blog_banner_image ) {
		$background_style[ 'background-image' ] = 'url("' . $blog_banner_image . '")';	
	}
	
?>

	<header class="blog-banner" <?php echo minfolio_build_inline_style( $background_style ); ?> >

		<div class="color-overlay"></div>		

		<div class="blog-banner-content-wrap wrap">
			<div class="blog-banner-content">
					
				<?php 						
					$blog_heading = minfolio_get_option( 'blog-banner-upper-heading' ); 		
					$blog_desc = minfolio_get_option( 'blog-banner-heading' ); 								
				?>

				<?php if( $blog_heading ) { ?>

					<span>
						<?php echo esc_html( $blog_heading ); ?>
					</span>	
					
				<?php } ?>

				<h1 class="banner-desc">
					<?php echo wp_kses_post( $blog_desc ); ?>
				</h1>												
				
			</div>
		</div>
			
	</header>

