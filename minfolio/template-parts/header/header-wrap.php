<?php 
    $header_menu_type = minfolio_menu_type();
?>

<header id="masthead" class="<?php echo esc_attr( minfolio_header_classes() ); ?>" role="banner">		
            
    <div class="wrap">
                        
        <?php get_template_part( 'template-parts/header/site-branding' ); ?>
                    
        <span id="menu-trigger-wrap"><span class="menu-trigger"><span></span></span></span>
                    
        <?php if ( has_nav_menu( 'main-menu' ) ) {
            get_template_part( 'template-parts/header/navigation', 'top' );
         } ?>

        <?php
            if( $header_menu_type == 'centered-menu' ) {
                get_template_part( 'template-parts/header/contact-info' ); 
            }
        ?>        
                        
    </div><!-- .wrap -->		

</header><!-- #masthead -->
