<?php

    $slider_images  = minfolio_get_post_meta( 'post_gallery_images', true  );

    wp_enqueue_script( 'flickity' );    

?>
	<div class="post-media">
        <div class="entry-slider">

            <?php if( ! empty( $slider_images ) ) { ?>
                    
                <div class="post-carousel-wrapper">
                                                    
                    <div class="clbr-post-carousel basic" <?php echo minfolio_build_data_attr( minfolio_get_blog_slider_data_attr() ); ?> >

                        <?php foreach ( $slider_images as $slide_image ) { ?>

                            <div class="carousel-cell">
                                <?php echo wp_get_attachment_image( $slide_image, 'full' ); ?>                                    
                            </div>

                        <?php } ?>    

                    </div>
                   
                </div>
                
            <?php } ?>
            
        </div>
    </div>