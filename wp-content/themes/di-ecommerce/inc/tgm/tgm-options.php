<?php

if( ! function_exists( 'di_ecommerce_register_required_plugins' ) ) {
	/**
	 * Display recommended plugins using TGMPA class.
	 * @return [type] [description]
	 */
	function di_ecommerce_register_required_plugins() {
		
		$plugins = array(
			
			array(
				'name'      => __( 'Elementor Page Builder', 'di-ecommerce'),
				'slug'      => 'elementor',
				'required'  => false,
			),

			array(
				'name'      => __( 'Essential Addons for Elementor', 'di-ecommerce'),
				'slug'      => 'essential-addons-for-elementor-lite',
				'required'  => false,
			),
			
			array(
				'name'      => __( 'WooCommerce (For E-Commerce)', 'di-ecommerce'),
				'slug'      => 'woocommerce',
				'required'  => false,
			),
			
			array(
				'name'      => __( 'Contact Form 7 (For Forms)', 'di-ecommerce'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),

			array(
				'name'      => __( 'Max Mega Menu (for Mega Menu)', 'di-ecommerce'),
				'slug'      => 'megamenu',
				'required'  => false,
			),

			array(
				'name'      => __( 'Regenerate Thumbnails', 'di-ecommerce'),
				'slug'      => 'regenerate-thumbnails',
				'required'  => false,
			),

			array(
				'name'      => __( 'Di Themes Demo Site Importer', 'di-ecommerce'),
				'slug'      => 'di-themes-demo-site-importer',
				'required'  => false,
			),

			array(
				'name'      => __( 'YITH WooCommerce Quick View', 'di-ecommerce'),
				'slug'      => 'yith-woocommerce-quick-view',
				'required'  => false,
			),

			array(
				'name'      => __( 'WooCommerce Wishlist Plugin', 'di-ecommerce'),
				'slug'      => 'ti-woocommerce-wishlist',
				'required'  => false,
			),

			array(
				'name'      => __( 'WooCommerce PDF Invoices & Packing Slips', 'di-ecommerce'),
				'slug'      => 'woocommerce-pdf-invoices-packing-slips',
				'required'  => false,
			),

			array(
				'name'      => __( 'MailOptin - Popups, Email Optin Forms & Newsletters for MailChimp, Aweber etc.', 'di-ecommerce'),
				'slug'      => 'mailoptin',
				'required'  => false,
			),
			
		);
		
		
		$config = array(
			'id'           => 'di-ecommerce',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'di-ecommerce-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}
add_action( 'tgmpa_register', 'di_ecommerce_register_required_plugins' );

