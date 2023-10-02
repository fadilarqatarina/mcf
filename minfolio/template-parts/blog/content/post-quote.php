<?php
/**
 * Template part for displaying content posts
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-wrap">	

		<?php

			$quote = false;

			$content = apply_filters( 'the_content', get_the_content() );		

			if ( preg_match( '/<blockquote>(.+?)<\/blockquote>/is', $content, $quote ) ) {
				$quote = $quote[0];
			}				

		?>	
		
		<?php if ( !post_password_required() && '' !== get_the_post_thumbnail() && empty( $quote ) ) { 
			get_template_part( 'template-parts/blog/content/media/thumbnail' ); 
		} ?>		

		<div class="post-content">
			
			<?php get_template_part( 'template-parts/blog/layout/header' ); ?>			

			<?php get_template_part( 'template-parts/blog/content/parts/content-quote' ); ?>

			<?php	

				if ( is_single() ) {

					get_template_part( 'template-parts/blog/layout/footer' );

					get_template_part( 'template-parts/blog/layout/author' );
				}
				
			?>
			
		</div>
	
	</div>

</article><!-- #post-## -->
