<?php
/**
 * The template for displaying archive pages 
 */

get_header(); 

get_template_part( 'template-parts/blog/layout/archive-banner' ); 

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

