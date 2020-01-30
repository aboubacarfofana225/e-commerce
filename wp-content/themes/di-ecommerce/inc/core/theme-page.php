<?php

if( ! function_exists( 'di_ecommerce_theme_page' ) ) {
	/**
	 * Theme page initialize.
	 * @return [type] [description]
	 */
	function di_ecommerce_theme_page() {
		add_theme_page(
			__( 'Di eCommerce Theme', 'di-ecommerce' ),
			__( 'Di eCommerce Theme', 'di-ecommerce' ),
			'manage_options',
			'di-ecommerce-theme',
			'di_ecommerce_theme_page_callback'
		);
	}
}
add_action( 'admin_menu', 'di_ecommerce_theme_page' );

if( ! function_exists( 'di_ecommerce_theme_page_callback' ) ) {
	/**
	 * Render the theme page.
	 * @return [type] [description]
	 */
	function di_ecommerce_theme_page_callback() {
	?>
		<div class="wrap">
			<h1><?php _e( 'Di eCommerce Theme Info', 'di-ecommerce' ); ?></h1>
			<br />
			<div class="container-fluid" style="border: 2px dashed #C3C3C3;">
				<div class="row">

					<div class="col-md-6" style="padding:0px;">
						<img class="img-fluid" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
					</div>

					<div class="col-md-6">

						<h2><?php _e( 'Di eCommerce WordPress Theme', 'di-ecommerce' ); ?></h2>

						<p style="font-size:16px;"><?php _e( 'Di eCommerce is a Responsive, SEO Friendly, Fast to Load, Fully Customizable and perfect eCommerce theme. it is specially design and develop for eCommerce websites. it is fully compatible with all popular eCommerce plugins like WooCommerce, Quick View, Wishlist, PDF Invoices and Packing Slips, Easy Forms for Mailchimp, contact form 7 etc.', 'di-ecommerce' ); ?></p>

						<p style="font-size:16px;"><?php _e( 'Theme Features : one click demo import, sidebar mini cart, WooCommerce widgets area, WooCommerce options, top bar options, 6 header layouts, footer widget with 6 layouts, typography options, advance blog options, footer copyright section, social profiles, sidebar layouts, mega menu, sticky menu, back to top icon, page loading icon, header widgets, page widget, post widgets, page with left sidebar, page with right sidebar, full width page, full width template for page builder plugins, social profile widget, recent posts with thumbnail widget, translation ready, fully SEO friendly, structured data implemented, search engine recommended structure, compatible with SEO plugins and much more.', 'di-ecommerce' ); ?></p>

						<?php
						if( ! function_exists( 'di_ecommerce_pro' ) ) {
						?>
						<p style="font-size:16px;"><b><?php _e( 'Di eCommerce Pro Features: ', 'di-ecommerce' ); ?></b><?php _e( 'Widget Area Creation and Selection, Advance Header Image Options, Slider in Header, All Color Options, Options to Update Footer Front Credit Link, Premium Support.', 'di-ecommerce' ); ?><p>
						<?php
						}
						?>

						<div style="text-align: center;" >

							<a target="_blank" class="btn btn-outline-success btn-sm" href="http://demo.dithemes.com/di-ecommerce/" role="button"><?php _e( 'Theme Demo', 'di-ecommerce' ); ?></a>

							<a target="_blank" class="btn btn-outline-success btn-sm" href="https://dithemes.com/di-ecommerce-free-wordpress-theme-documentation/" role="button"><?php _e( 'Theme Docs', 'di-ecommerce' ); ?></a>

							<a target="_blank" class="btn btn-outline-success btn-sm" href="<?php echo esc_url( get_dashboard_url() . 'customize.php' ); ?>" role="button"><?php _e( 'Theme Options', 'di-ecommerce' ); ?></a>

							<?php
							if( function_exists( 'di_ecommerce_pro' ) ) {
							?>
								<a target="_blank" class="btn btn-outline-success btn-sm" href="https://dithemes.com/my-tickets/" role="button"><?php _e( 'Get Premium Support', 'di-ecommerce' ); ?></a>
							<?php
							} else {
							?>
								<a target="_blank" class="btn btn-outline-success btn-sm" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/" role="button"><?php _e( 'Get Di eCommerce Pro', 'di-ecommerce' ); ?></a>
							<?php
							}
							?>

						</div>
						<br />

					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

// Enqueue js css files only if pagenow is themes.php and query string is page=di-ecommerce-them.
global $pagenow;
if ( $pagenow === 'themes.php' && $_SERVER['QUERY_STRING'] === 'page=di-ecommerce-theme' ) {
	add_action( 'admin_enqueue_scripts', 'di_ecommerce_admin_js_css' );
}

if( ! function_exists( 'di_ecommerce_admin_js_css' ) ) {
	/**
	 * Add bootstrap files on admin screen theme page.
	 * @return [type] [description]
	 */
	function di_ecommerce_admin_js_css() {
		// Load bootstrap css.
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '4.0.0', 'all' );
		// Load bootstrap js.
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery' ), '4.0.0', true );
	}
}
