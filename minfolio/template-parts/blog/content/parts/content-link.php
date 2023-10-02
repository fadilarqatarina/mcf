
<?php

	if( ! is_single() && ! empty( $link_markup ) ) { ?>
		<div class="entry-link">
			<?php echo wp_kses_post( $link_markup ); ?>
		</div>
	<?php }
?>			

<div class="entry-content">

	<?php

		if ( ! is_single() && empty( $link_markup ) ) {

			the_excerpt();

			minfolio_excerpt_more();

		}
		elseif ( is_single() || empty( $link_markup ) ) {

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