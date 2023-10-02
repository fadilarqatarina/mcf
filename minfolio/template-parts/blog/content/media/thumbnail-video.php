<?php
	
	$video_url = false;

	$video_url = minfolio_get_post_meta( 'post_video_url' );		

?>

<?php if ( !post_password_required() ) { 

	if( ! empty( $video_url ) ) { ?>

		<div class="post-media">			
			<div class="entry-video">
				<?php echo wp_oembed_get( esc_url( $video_url ) ); ?>
			</div>
		</div>

	<?php }	elseif( '' !== get_the_post_thumbnail() ) { ?>		

		<div class="post-media">
			<?php minfolio_get_post_thumbnail(); ?>
		</div>	
		
	<?php }	

} ?>