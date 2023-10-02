<?php
/**
 * Template part for displaying content posts
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-wrap">	
		
		<?php get_template_part( 'template-parts/blog/content/media/thumbnail', get_post_format() ); ?>		

		<div class="post-content">
			
			<?php get_template_part( 'template-parts/blog/layout/header' ); ?>

			<?php get_template_part( 'template-parts/blog/content/parts/content' ); ?>

			<?php	

				if ( is_single() ) {

					get_template_part( 'template-parts/blog/layout/footer' );

					get_template_part( 'template-parts/blog/layout/author' );
				}
				
			?>
			
		</div>
	
	</div>

</article><!-- #post-## -->
