<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * 
 */

get_header(); ?>

<div id="content" class="site-content">

	<div class="wrap">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) {
					
					the_post();			

					get_template_part( 'template-parts/page/content-page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

				} // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
		
	</div><!-- .wrap -->

</div>

<?php get_footer();
