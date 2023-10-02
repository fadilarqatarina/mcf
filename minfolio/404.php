<?php
/**
 * The template for displaying 404 pages (not found) 
 */

get_header(); ?>


<div id="content" class="site-content">

	<div class="wrap">

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<div class="error-404-content">
						
						<header class="page-header">						
							<?php minfolio_page_404_heading(); ?>						
						</header><!-- .page-header -->
						
						<div class="page-content">
							<?php minfolio_page_404_content(); ?>
						</div><!-- .page-content -->
									
					</div>
				</section><!-- .error-404 -->
				
			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .wrap -->

</div>

<?php get_footer();
