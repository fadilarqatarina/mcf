<?php 

$blog_post_use_featured_image   = minfolio_get_option( 'blog-post-banner-use-featured-image' );
$lazy_load  = minfolio_get_option( 'lazy-load-switch' ); 

if( is_single() && $blog_post_use_featured_image && !post_password_required() ) { 
	
	$post_image = minfolio_get_post_meta( 'post_image' );	
?>	

	<?php if( $post_image ) { ?>
		<div class="post-media">

			<?php 
			
				if ( $lazy_load == 1 ) {
					echo wp_get_attachment_image( $post_image, 'full', false, array( 'class' => 'lazyload' ) );
				} else {
					echo wp_get_attachment_image( $post_image, 'full' );
				} 
				
			?>

		</div>	
	<?php } ?>

<?php } else if( !post_password_required() && '' !== get_the_post_thumbnail() ) { ?>		

	<div class="post-media">
		<?php minfolio_get_post_thumbnail(); ?>
	</div>	
    
<?php } ?>