<?php
/**
 * The sidebar containing the main widget area
 * 
 */

if ( is_active_sidebar( 'sidebar-blog' ) ) {  ?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'minfolio' ); ?>">
	<?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside><!-- #secondary -->

<?php } ?>
