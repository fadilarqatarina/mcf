<?php

    $audio_url = false;

    $audio_url = minfolio_get_post_meta( 'post_audio_url' );		

?>

<?php if ( !post_password_required() ) { 

    if( ! empty( $audio_url ) ) { ?>

        <div class="post-media">			
            <div class="entry-audio">
                <?php echo wp_oembed_get( esc_url( $audio_url ) ); ?>
            </div>
        </div>

    <?php }	elseif( '' !== get_the_post_thumbnail() ) { ?>		

        <div class="post-media">
            <?php minfolio_get_post_thumbnail(); ?>
        </div>	
        
    <?php }	

} ?>
