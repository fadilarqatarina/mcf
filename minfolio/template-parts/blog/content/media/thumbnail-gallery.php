    
<?php if ( !post_password_required() ) { 
	
	$gallery_images = false;		

	$gallery_images  = minfolio_get_post_meta( 'post_gallery_images', true  );

	if( ! empty( $gallery_images ) ) {			
		get_template_part( 'template-parts/blog/content/media/thumbnail-slider' ); 	
	}				
	elseif( '' !== get_the_post_thumbnail() ) { ?>		

		<div class="post-media">
			<?php minfolio_get_post_thumbnail(); ?>
		</div>	
		
	<?php }	

} ?>