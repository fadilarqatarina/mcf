<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); 

get_template_part( 'template-parts/blog/layout/post-banner' ); 

?>

<div id="content" class="site-content">

	<div class="wrap">
	
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php minfolio_get_blog_single(); ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		
	</div><!-- .wrap -->

</div>

<?php get_footer();

