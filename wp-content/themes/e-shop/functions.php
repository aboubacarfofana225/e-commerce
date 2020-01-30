<?php
/**
 * Function describe for E-Shop 
 * 
 * @package e-shop
 */
include_once( trailingslashit( get_stylesheet_directory() ) . 'lib/e-shop-metaboxes.php' );
include_once( trailingslashit( get_stylesheet_directory() ) . 'lib/custom-config.php' );

add_action( 'wp_enqueue_scripts', 'e_shop_enqueue_styles' );
function e_shop_enqueue_styles() {

  wp_enqueue_style( 'maxstore-stylesheet', get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );
	wp_enqueue_style( 'e-shop-child-style', get_stylesheet_uri(), array( 'maxstore-stylesheet' ) );
  
  wp_enqueue_script( 'e-shop-custom-script', get_stylesheet_directory_uri() . '/js/e-shop-custom.js', array('jquery'), '1.0.1' );
}


function e_shop_theme_setup() {
    
    load_child_theme_textdomain( 'e-shop', get_stylesheet_directory() . '/languages' );

    add_image_size( 'maxstore-slider', 1140, 488, true );
    
    // Add Custom logo Support
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		
		// Add Custom Background Support
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'e_shop_theme_setup' );

function e_shop_custom_remove( $wp_customize ) {
    
    $wp_customize->remove_control( 'header-logo' );
    $wp_customize->remove_section( 'site_bg_section' );
}

add_action( 'customize_register', 'e_shop_custom_remove', 100);

// Remove parent theme homepage style.
function e_shop_remove_page_templates( $templates ) {
    unset( $templates['template-home.php'] );
    return $templates;
}
add_filter( 'theme_page_templates', 'e_shop_remove_page_templates' );

// Load theme info page.
if ( is_admin() ) {
	include_once(trailingslashit( get_template_directory() ) . 'lib/welcome/welcome-screen.php');
}



