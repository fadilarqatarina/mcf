<?php	
	// Get Tags for posts.
	$tags_list = get_the_tag_list();
?>
		
	<footer class="entry-footer">

		<div class="footer-links">
						
            <?php if ( $tags_list && ! is_wp_error( $tags_list ) ) { ?>

                <div class="tags-links">
                    <span class="screen-reader-text"><?php echo esc_html__( 'Tags', 'minfolio' ); ?></span>
                        
                    <?php echo wp_kses( $tags_list, array( 'a' =>  array( 'href' => array(),'target' => array() ) ) );  ?>	
               </div>

            <?php } ?>
                            
            <?php do_action( 'minfolio_action_post_social_share' ); ?>
						
		</div>
				
	</footer>