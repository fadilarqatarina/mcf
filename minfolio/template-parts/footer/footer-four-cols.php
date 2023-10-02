
<div class="widget-area">	
	
	<?php if ( is_active_sidebar( 'footer-widget-col-1' ) ) { ?>
		<div class="widget-col-one">

			<?php dynamic_sidebar( 'footer-widget-col-1' ); ?>

		</div>
	<?php } ?>
	
	<?php if ( is_active_sidebar( 'footer-widget-col-2' ) ) { ?>
		<div class="widget-col-two">

			<?php dynamic_sidebar( 'footer-widget-col-2' ); ?>

		</div>
	<?php } ?>
	
	<?php if ( is_active_sidebar( 'footer-widget-col-3' ) ) { ?>
		<div class="widget-col-three">

			<?php dynamic_sidebar( 'footer-widget-col-3' ); ?>

		</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'footer-widget-col-4' ) ) { ?>
		<div class="widget-col-four">

			<?php dynamic_sidebar( 'footer-widget-col-4' ); ?>

		</div>
	<?php } ?>
	
</div><!-- .footer-widget-wrap -->
