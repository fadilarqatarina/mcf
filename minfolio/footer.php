<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after. 
 */

 $footer_column_class  = minfolio_get_option( 'footer-columns' );	

 $page_footer_display = minfolio_page_footer_display();

?>		

	<?php get_template_part( 'template-parts/footer/scroll-top' ); ?>	

	<?php if( $page_footer_display ) { ?>

		<footer id="footer" class="<?php echo esc_attr( minfolio_footer_classes() ); ?>" role="contentinfo">

			<div class="wrap">  

				<?php get_template_part( 'template-parts/footer/footer', $footer_column_class ); ?>		

				<?php get_template_part( 'template-parts/footer/parts/site-info' ); ?>	
				
			</div>
			
		</footer>

	<?php } ?>

	</div><!-- .site-content-contain -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
