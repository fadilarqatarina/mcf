<?php 
/**
 * Template part for displaying blog archive banner
 * 
 */
?>

<?php 
		
	$background_style = array();		

	$blog_banner_image = minfolio_get_option( 'blog-archive-banner-image' );		
	
	if( $blog_banner_image ) {		
		$background_style[ 'background-image' ] = 'url("' . $blog_banner_image . '")';	
	}

?>

	<header class="blog-banner" <?php echo minfolio_build_inline_style( $background_style ); ?> >

		<div class="color-overlay"></div>		

		<div class="blog-banner-content-wrap wrap">
			<div class="blog-banner-content">
					
				<?php if ( is_search() ) {
					
					if ( have_posts() ) { ?>
						<h1 class="banner-title"><?php printf( esc_html__( 'Search Results for: %s', 'minfolio' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php } else { ?>
						<h1 class="banner-title"><?php esc_html_e( 'Nothing Found', 'minfolio' ); ?></h1>
					<?php }
							
				} elseif ( is_archive() ) {					
					
					the_archive_title( '<h1 class="banner-title">', '</h1>' );
					the_archive_description( '<div class="description">', '</div>' );	
							
				} ?>

			</div>
		</div>
			
	</header>

