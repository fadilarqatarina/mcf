<?php

    $author_description = get_the_author_meta( 'description' );	

	// If no description was added by user, add some default text and stats.
	if ( ! empty( $author_description ) ) { ?>

        <div class="author-profile">

            <div class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?></div>

            <div class="author vcard">

                <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" >
                    <?php echo get_the_author_meta( 'display_name' ); ?>
                </a>

                <p><?php echo wp_kses_post( $author_description ); ?></p>

            </div>

        </div>
		
    <?php } ?>



