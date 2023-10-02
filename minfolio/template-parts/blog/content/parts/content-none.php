<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 */

?>

<section class="no-results not-found">
	
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

			<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'minfolio' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php } else { ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minfolio' ); ?></p>
			<?php
				get_search_form();

		} ?>
	</div><!-- .page-content -->
	
</section><!-- .no-results -->
