<?php

/**
 * [dtdsi_di_magazine_import_files description]
 * @return [type] [description]
 */
function dtdsi_di_magazine_import_files() {
	return array(
		array(
			'import_file_name'             => __( 'Di Magazine Demo Website', 'dtdsi' ),
			'categories'                   => array( __( 'Di Magazine Demo Main', 'dtdsi' ) ),
			'local_import_file'            => DTDSI_PATH . 'inc/di-themes/di-magazine/files/demo-content.xml',
			'local_import_widget_file'     => DTDSI_PATH . 'inc/di-themes/di-magazine/files/widgets.wie',
			'local_import_customizer_file' => DTDSI_PATH . 'inc/di-themes/di-magazine/files/customizer.dat',
			'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png',
			'import_notice'                => __( 'Make sure Regenerate Thumbnails plugin is activated.', 'dtdsi' ),
			'preview_url'                  => 'http://demo.dithemes.com/di-magazine/',
		),
	);
}
add_filter( 'dtdsi/import_files', 'dtdsi_di_magazine_import_files' );

/**
 * [dtdsi_di_magazine_after_import_setup description]
 * @return [type] [description]
 */
function dtdsi_di_magazine_after_import_setup() {

	// Assign menus to their locations.
	$primary_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $primary_menu->term_id,
		)
	);

	// Assign home and blog pages
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	
}
add_action( 'dtdsi/after_import', 'dtdsi_di_magazine_after_import_setup' );
