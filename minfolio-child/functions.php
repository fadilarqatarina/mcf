<?php

function minfolio_child_enqueue_styles() {

    $parent_style = 'minfolio-style';			

    wp_enqueue_style( $parent_style, get_parent_theme_file_uri() . '/style.css' );
    wp_enqueue_style( 'minfolio-child-style', get_theme_file_uri() . '/style.css', array( $parent_style ) );
    
}

add_action( 'wp_enqueue_scripts', 'minfolio_child_enqueue_styles' );