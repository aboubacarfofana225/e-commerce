<?php

function dtdsi_di_blog_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => __( 'Di Blog Demo Site', 'di-dtdsi' ),
			'categories'                   => array( __( 'Di Blog Demo Main', 'di-dtdsi' ) ),
			'local_import_file'            => DTDSI_PATH . 'inc/di-themes/di-blog/files/demo-content.xml',
			'local_import_widget_file'     => DTDSI_PATH . 'inc/di-themes/di-blog/files/widgets.wie',
			'local_import_customizer_file' => DTDSI_PATH . 'inc/di-themes/di-blog/files/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png',
			'import_notice'                => __( 'Make sure Elementor Page Builder, Contact Form 7, WooCommerce (optional) plugins are activated.', 'di-dtdsi' ),
			'preview_url'                  => 'http://demo.dithemes.com/di-blog/',
		),
	);
}
add_filter( 'dtdsi/import_files', 'dtdsi_di_blog_ocdi_import_files' );

/**
 * [dtdsi_di_blog_after_import_setup description]
 * @return [type] [description]
 */
function dtdsi_di_blog_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'slug', 'topmain', 'nav_menu' );
	$sidebar_menu = get_term_by( 'slug', 'sidemenu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $primary_menu->term_id,
			'sidebar' => $sidebar_menu->term_id,
		)
	);

	// Set front page to display posts.
	update_option( 'show_on_front', 'posts' );

	// Front slider set correct tag id for front_slider_tag.
	$tag_id_arr = get_term_by( 'slug', 'owl', 'post_tag' );
	$tag_id = isset( $tag_id_arr->term_id ) ? $tag_id_arr->term_id : '';

	set_theme_mod( 'front_slider_tag', $tag_id );

	// Set WooCommerce pages.
	if( class_exists( 'WooCommerce' ) ) {
		// Set shop page.
		$pagearr = get_page_by_path( 'shop' );
		if( $pagearr ) {
			$pageid = $pagearr->ID;
			update_option( 'woocommerce_shop_page_id', absint( $pageid ) );
		}

		// Set cart page.
		$pagearr = get_page_by_path( 'cart' );
		if( $pagearr ) {
			$pageid = $pagearr->ID;
			update_option( 'woocommerce_cart_page_id', absint( $pageid ) );
		}

		// Set checkout page.
		$pagearr = get_page_by_path( 'checkout' );
		if( $pagearr ) {
			$pageid = $pagearr->ID;
			update_option( 'woocommerce_checkout_page_id', absint( $pageid ) );
		}

		// Set my-account page.
		$pagearr = get_page_by_path( 'my-account' );
		if( $pagearr ) {
			$pageid = $pagearr->ID;
			update_option( 'woocommerce_myaccount_page_id', absint( $pageid ) );
		}
	}

}
add_action( 'dtdsi/after_import', 'dtdsi_di_blog_after_import_setup' );
