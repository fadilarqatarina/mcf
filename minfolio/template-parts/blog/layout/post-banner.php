<?php 
/**
 * Template part for displaying single post banner
 * 
 */
?>

<?php 
		
	$background_style = array();			
	
	$has_featured_banner_class = '';
	
	$blog_post_use_featured_image   = minfolio_get_option( 'blog-post-banner-use-featured-image' );	
	$blog_post_banner_image   = minfolio_get_option( 'blog-post-banner-bg-image' );	
		
	if( $blog_post_use_featured_image && '' !== get_the_post_thumbnail() ) {

		$has_featured_banner_class = 'has-featured-banner-image';			
		$background_style[ 'background-image' ] = 'url("' . get_the_post_thumbnail_url() . '")';
	}	
	else if( $blog_post_banner_image ) {		
		$background_style[ 'background-image' ] = 'url("' . $blog_post_banner_image . '")';	
	}
	
?>

	<header class="blog-banner <?php echo esc_attr( $has_featured_banner_class ); ?>" <?php echo minfolio_build_inline_style( $background_style ); ?> >

		<div class="color-overlay"></div>		

		<div class="blog-banner-content-wrap wrap">
			<div class="blog-banner-content">
					
				<?php 						
					$blog_post_upper_heading = minfolio_get_option( 'blog-post-banner-upper-heading' ); 		
				?>

				<?php if( $blog_post_upper_heading ) { ?>

					<span>
						<?php echo esc_html( $blog_post_upper_heading ); ?>
					</span>	
					
				<?php } ?>

				<h1 class="banner-desc">
					<?php the_title(); ?>
				</h1>												
				
			</div>
		</div>
			
	</header>

