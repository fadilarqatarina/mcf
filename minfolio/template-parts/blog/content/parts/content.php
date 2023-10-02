
<div class="entry-content">

	<?php

		if ( ! is_single() ) {

			the_excerpt();

			minfolio_excerpt_more();

		}
		else {

			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'minfolio' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		}

	?>
	
</div><!-- .entry-content -->