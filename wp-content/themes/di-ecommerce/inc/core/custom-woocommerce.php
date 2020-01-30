<?php
// Return from file if not WooCommerce active.
if( ! class_exists( 'WooCommerce' ) ) {
	return;
}

if( ! function_exists( 'di_ecommerce_woo_setup' ) ) {
	/**
	 * Setup woo.
	 * @return [type] [description]
	 */
	function di_ecommerce_woo_setup() {
		add_theme_support( 'woocommerce' );
	}
}
add_action( 'after_setup_theme', 'di_ecommerce_woo_setup' );

if( ! function_exists( 'di_ecommerce_woo_features_support' ) ) {
	/**
	 * Woo gallery zoom, lightbox, slider Support.
	 * @return [type] [description]
	 */
	function di_ecommerce_woo_features_support() {
		if( get_theme_mod( 'support_gallery_zoom', '1' ) == 1 ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}

		if( get_theme_mod( 'support_gallery_lightbox', '1' ) == 1 ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}

		if( get_theme_mod( 'support_gallery_slider', '1' ) == 1 ) {
			add_theme_support( 'wc-product-gallery-slider' );
		}
	}
}
add_action( 'wp_loaded', 'di_ecommerce_woo_features_support' );

if( ! function_exists( 'di_ecommerce_product_per_page_func' ) ) {
	/**
	 * Products per page handle.
	 * @param  [type] $cols [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_product_per_page_func( $cols ) {
		$cols = absint( get_theme_mod( 'product_per_page', '12' ) );
		return $cols;
	}
}
add_filter( 'loop_shop_per_page', 'di_ecommerce_product_per_page_func', 20 );

if( ! function_exists( 'di_ecommerce_related_products_args' ) ) {
	/**
	 * Related products per column. there will be only one column for related products.
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_related_products_args( $args ) {
		$args['posts_per_page'] = absint( get_theme_mod( 'product_per_column', '3' ) );
		//$args['columns'] = 1;
		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'di_ecommerce_related_products_args' );

if( ! function_exists(  'di_ecommerce_loop_columns' ) ) {
	/**
	 * Products per column handle.
	 * @return [type] [description]
	 */
	function di_ecommerce_loop_columns() {
		return absint( get_theme_mod( 'product_per_column', '3' ) );
	}
}
add_filter('loop_shop_columns', 'di_ecommerce_loop_columns');

if( ! function_exists( 'di_ecommerce_wc_breadcrumbs_handle' ) ) {
	/**
	 * Woo breadcrumbs handle.
	 * @return [type] [description]
	 */
	function di_ecommerce_wc_breadcrumbs_handle() {
		if( get_theme_mod( 'display_wc_breadcrumbs', '0' ) == 0 ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		}
	}
}
add_action( 'wp_loaded', 'di_ecommerce_wc_breadcrumbs_handle' );

if( ! function_exists( 'di_ecommerce_change_breadcrumb_delimiter' ) ) {
	/**
	 * Change woo breadcrumb delimiter, add class breadcrumb in wrap_before
	 * @param  [type] $defaults [description]
	 * @return [type]           [description]
	 */
	function di_ecommerce_change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = '';
		$defaults['wrap_before'] = '<div class="col-md-12"><nav class="woocommerce-breadcrumb breadcrumb small" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
		$defaults['wrap_after']  = '</nav></div>';
		return $defaults;
	}
}
add_filter( 'woocommerce_breadcrumb_defaults', 'di_ecommerce_change_breadcrumb_delimiter' );


// We want breadcrumb before main_content so priority is 30, breadcrumb priority is 20 (default).
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
add_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 30 );

if( ! function_exists( 'di_ecommerce_related_product_handle' ) ) {
	/**
	 * Enable / Disable related product section base on setting.
	 * @return [type] [description]
	 */
	function di_ecommerce_related_product_handle() {
		if( get_theme_mod( 'display_related_prdkt', '1' ) == 0 ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}
}
add_action( 'wp_loaded', 'di_ecommerce_related_product_handle' );

if( ! function_exists( 'di_ecommerce_hide_woocommerce_order_again_button' ) ) {
	/**
	 * Display order again button by default, and hide if set 0 in customize.
	 * @return [type] [description]
	 */
	function di_ecommerce_hide_woocommerce_order_again_button() {
		if( get_theme_mod( 'order_again_btn', '1' ) == '0' ) {
			remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );
		}
	}
}
add_action( 'wp_loaded', 'di_ecommerce_hide_woocommerce_order_again_button' );

if( ! function_exists( 'di_ecommerce_mini_add_to_cart_fragment' ) ) {
	/**
	 * To change cart items number with fixed cart icon.
	 * @param  [type] $fragments [description]
	 * @return [type]            [description]
	 */
	function di_ecommerce_mini_add_to_cart_fragment( $fragments ) {
	 
	    ob_start();

		$count = WC()->cart->cart_contents_count;
		if ( $count >= 1 ) {
			?>
			<span class="di-cart-count-animate"><?php echo esc_html( $count ); ?></span>
			<?php
		}
		else {
			?>
			<span class="di-cart-count-animate"><?php _e( '0', 'di-ecommerce' ); ?></span>
			<?php
		}
	 
	    $fragments['.di-cart-count-animate'] = ob_get_clean();
	     
	    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'di_ecommerce_mini_add_to_cart_fragment' );

if( ! function_exists( 'di_ecommerce_di_shopping_basket_fragment' ) ) {
	/**
	 * To rotate fixed cart icon on add new item in cart.
	 * @param  [type] $fragments [description]
	 * @return [type]            [description]
	 */
	function di_ecommerce_di_shopping_basket_fragment( $fragments ) {

		ob_start();

		?>
		<span class="fa fa-shopping-basket di-shopping-basket"></span>
		<?php

		$fragments['.fa.fa-shopping-basket.di-shopping-basket'] = ob_get_clean();
	     
	    return $fragments;

	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'di_ecommerce_di_shopping_basket_fragment' );
