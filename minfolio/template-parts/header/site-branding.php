<?php
/**
 * Displays header site branding
 *
 */

?>

<?php 

	$menu_text_logo_switch = minfolio_get_option( 'menu-text-logo-switch' );

	$menu_text_logo = minfolio_get_option( 'menu-text-logo' );

	$menu_dark_logo = minfolio_get_option( 'menu-dark-logo' );
	$menu_dark_retina_logo = minfolio_get_option( 'menu-dark-retina-logo' );		

	$menu_light_logo = minfolio_get_option( 'menu-light-logo' );
	$menu_light_retina_logo = minfolio_get_option( 'menu-light-retina-logo' );		

?>

<div id="site-branding" >

	<?php if( $menu_text_logo_switch == 1 ) { ?>

		<a class="logo-brand" href="<?php echo esc_url( home_url('/') ); ?>" >
			<span class="light-text-logo"><?php echo esc_html( $menu_text_logo ); ?></span>
			<span class="dark-text-logo"><?php echo esc_html( $menu_text_logo ); ?></span>
		</a>	

	<?php } else { ?>

		<a class="logo-brand" href="<?php echo esc_url( home_url('/') ); ?>" >

			<img class="logo" src="<?php echo esc_url( $menu_dark_logo ); ?>" alt="<?php echo esc_attr__( 'Logo', 'minfolio' ); ?>">			

			<?php if( $menu_dark_retina_logo ) { ?>
				<img class="retina-logo" src="<?php echo esc_url( $menu_dark_retina_logo ); ?>" alt="<?php echo esc_attr__( 'Retina Logo', 'minfolio' ); ?>">	
			<?php } ?>

			<img class="light-logo" src="<?php echo esc_url( $menu_light_logo ); ?>" alt="<?php echo esc_attr__( 'Logo', 'minfolio' ); ?>">			

			<?php if( $menu_light_retina_logo ) { ?>
				<img class="light-retina-logo" src="<?php echo esc_url( $menu_light_retina_logo ); ?>" alt="<?php echo esc_attr__( 'Retina Logo', 'minfolio' ); ?>">									
			<?php } ?>

		</a>	

	<?php } ?>
	
</div><!-- .site-branding -->
