<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *  
 */

get_header();

get_template_part( 'template-parts/blog/layout/banner' );

?>

<div id="content" class="site-content">

	<div class="wrap">	

		<div id="primary" class="content-area content-list">
			<main id="main" class="site-main" role="main">

				<?php minfolio_get_blog(); ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		
	</div><!-- .wrap -->

</div>

<?php get_footer();
