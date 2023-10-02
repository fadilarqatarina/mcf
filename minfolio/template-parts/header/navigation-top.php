<?php
/**
 * Displays top navigation
 *
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'minfolio' ); ?>">		

	<?php wp_nav_menu( array(
		'theme_location' => 'main-menu',
		'menu_id'        => 'top-menu',
		'container'      => false,	
		'walker'         => new Minfolio_Walker_Nav_Menu()
	) ); ?>
	
</nav><!-- #site-navigation -->

