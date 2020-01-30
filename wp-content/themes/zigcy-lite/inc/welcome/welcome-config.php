<?php
	/**
	 * Welcome Page Initiation
	*/

	include get_template_directory() . '/inc/welcome/welcome.php';

	/** Plugins **/
	$plugins = array(
		// *** Companion Plugins
		'companion_plugins' => array(

			
		),

		// *** Displays on Import Demo section
		'req_plugins' => array(
			'access-demo-importer' => array(
					'slug' 		=> 'access-demo-importer',
					'name' 		=> esc_html__('Access Demo Importer', 'zigcy-lite'),
					'filename' 	=>'access-demo-importer.php',
					'host_type' => 'wordpress', // Use either bundled, remote, wordpress
					'class' 	=> 'Access_Demo_Importer',
					'location' 	=> get_template_directory().'/inc/welcome/plugins/access-demo-importer.zip',
					'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'zigcy-lite'),
			),

		),

		//Displays on Required Plugins tab
		'required_plugins' => array(
			// Free Plugins
			'free_plugins' => array(
				'smart-slider-3' => array(
					'slug' 		=> 'smart-slider-3',
					'filename' 	=> 'smart-slider-3.php',
					'class' 	=> 'SmartSlider3',
				),

				'woocommerce' => array(
					'slug' 		=> 'woocommerce',
					'filename' 	=> 'woocommerce.php',
					'class' 	=> 'WooCommerce',
				),

				'yith-woocommerce-compare' => array(
					'slug' 		=> 'yith-woocommerce-compare',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_Woocompare',
				),

				'yith-woocommerce-wishlist' => array(
					'slug' 		=> 'yith-woocommerce-wishlist',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_WCWL',
				),

				'yith-woocommerce-quick-view' => array(
					'slug' 		=> 'yith-woocommerce-quick-view',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_WCQV',
				),
			),
		),

		// *** Recommended Plugins
		'recommended_plugins' => array(
			// Free Plugins
			'free_plugins' => array(
				'smart-slider-3' => array(
					'slug' 		=> 'smart-slider-3',
					'filename' 	=> 'smart-slider-3.php',
					'class' 	=> 'SmartSlider3',
					'info' => esc_html__('The perfect all-in-one responsive slider solution for WordPress.', 'zigcy-lite'),
				),

				'woocommerce' => array(
					'slug' 		=> 'woocommerce',
					'filename' 	=> 'woocommerce.php',
					'class' 	=> 'WooCommerce',
					'info' => esc_html__('An eCommerce toolkit that helps you sell anything. Beautifully.', 'zigcy-lite'),
				),

				'yith-woocommerce-compare' => array(
					'slug' 		=> 'yith-woocommerce-compare',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_Woocompare',
					'info' => esc_html__('The YITH WooCommerce Compare plugin allow you to compare in a simple and efficient way products on sale in your shop and analyze their main features in a single table.', 'zigcy-lite'),
				),

				'yith-woocommerce-wishlist' => array(
					'slug' 		=> 'yith-woocommerce-wishlist',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_WCWL',
					'info' => esc_html__('YITH WooCommerce Wishlist gives your users the possibility to create, fill, manage and share their wishlists allowing you to analyze their interests and needs to improve your marketing strategies.', 'zigcy-lite'),
				),

				'yith-woocommerce-quick-view' => array(
					'slug' 		=> 'yith-woocommerce-quick-view',
					'filename' 	=> 'init.php',
					'class' 	=> 'YITH_WCQV',
					'info' => esc_html__('The YITH WooCommerce Quick View plugin allows your customers to have a quick look about products.', 'zigcy-lite'),
				),
			),

			// Pro Plugins
			'pro_plugins' => array(

				'woo-product-grid-list-design' 	=> array(
					'slug' 		=> 'woo-product-grid-list-design',
					'name' 		=> esc_html__('WOO Product Grid/List Design- Responsive Products Showcase Extension for Woocommerce', 'zigcy-lite'),
					'version' 	=> esc_html__( '1.0.3', 'zigcy-lite' ),
					'author' 	=> 'AccessPress Themes',
					'filename' 	=> 'woo-product-grid-list-design.php',
					'host_type' => 'remote', // Use either bundled, remote, wordpress
					'link' 		=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwoo-product-gridlist-design-responsive-products-showcase-extension-for-woocommerce%2F23167226',
					'screenshot' => 'https://accesspressthemes.com/plugin-repo/woo-product-grid/woo-product-grid.jpg',
					'class' 	=> 'WOPGLD_Class',
					'info' 		=> esc_html__('Design your WooCommerce shop like never before! A complete package for your Woo shop designer.', 'zigcy-lite'),
				),

				'product-slider-for-woocommerce' => array(
					'slug' 			=> 'product-slider-for-woocommerce',
					'name'         	=> esc_html__('Product Slider For WooCommerce - Woo Extension to Showcase Products', 'zigcy-lite'),
					'version' 		=> esc_html__('1.0.1', 'zigcy-lite'),
					'author' 		=> 'AccessPress Themes',
					'filename' 		=> 'product-slider-for-woocommerce.php',
					'host_type' 	=> 'remote', // Use either bundled, remote, wordpress
					'link' 			=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fproduct-slider-for-woocommerce-woo-extension-to-showcase-products%2F22645023',
					'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/product-slider-for-woocommerce/product-slider-for-woocommerce.jpg',
					'class' 		=> 'PSFW_Class',
					'info' 			=> esc_html__('Product Slider for WooCommerce is an advanced WooCommerce extension that lets you showcase your online products in the most appealing style.', 'zigcy-lite'),
				),

				'woo-badge-designer' => array(
					'slug' 			=> 'woo-badge-designer',
					'name'         	=> esc_html__('Woo Badge Designer - WooCommerce Product Badge Designer WordPress Plugin', 'zigcy-lite'),
					'version' 		=> esc_html__('1.0.1', 'zigcy-lite'),
					'author' 		=> 'AccessPress Themes',
					'filename' 		=> 'woo-badge-designer.php',
					'host_type' 	=> 'remote', // Use either bundled, remote, wordpress
					'link' 			=> 'https://1.envato.market/LyK3o',
					'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/woo-badge-designer/woo-badge-designer.jpg',
					'class' 		=> 'WOPGLD_Class',
					'info' 			=> esc_html__('Add some attractive badges on your product listing and single page and increase your sales upto 55%.', 'zigcy-lite'),
				),

				'wp-admin-white-label-login' => array(
					'slug' 			=> 'wp-admin-white-label-login',
					'name'      	=> esc_html__('WP Admin White Label Login - WordPress Plugin For Advanced Customizable Login page', 'zigcy-lite'),
					'version' 		=> esc_html__('1.3.5', 'zigcy-lite'),
					'author' 		=> 'AccessPress Themes',
					'filename' 		=> 'wp-admin-white-label-login.php',
					'host_type' 	=> 'remote', // Use either bundled, remote, wordpress
					'link' 		=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Fwp-admin-white-label-login-wordpress-plugin-for-advanced-customizable-login-page%2F23127723',
					'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/wp-admin-white-label-login/wp-admin-white-label-login.jpg',
					'class' 		=> 'WP_Admin_White_Label_Login',
					'info' 		=> esc_html__('Make your default wp-admin screen look like a non WP one! Choose from some great ready to use template designs and many features to boost your WordPress backend.', 'zigcy-lite'),
				),

				'easy-side-tab-pro' => array(
					'slug' 			=> 'easy-side-tab-pro',
					'name'      	=> esc_html__('Easy Side Tab Pro - Responsive Floating Tab Plugin For Wordpress', 'zigcy-lite'),
					'version' 		=> esc_html__('1.0.6', 'zigcy-lite'),
					'author' 		=> 'AccessPress Themes',
					'filename' 		=> 'easy-side-tab-pro.php',
					'host_type' 	=> 'remote', // Use either bundled, remote, wordpress
					'link' 			=> 'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Feasy-side-tab-pro-responsive-floating-tab-plugin-for-wordpress%2F22296723',
					'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/easy-side-tab-pro/easy-side-tab.jpg',
					'class' 		=> 'ESTP_Class',
					'info' 		=> esc_html__('Place some great designed floating tabs on your site for quick links. Increase accessibility of your site.', 'zigcy-lite'),
				),

				'everest-timeline' => array(
					'slug' 			=> 'everest-timeline',
					'name'         	=> esc_html__('Everest Timeline - Responsive WordPress Timeline Plugin', 'zigcy-lite'),
					'version' 		=> esc_html__('2.0.2', 'zigcy-lite'),
					'author' 		=> 'AccessPress Themes',
					'filename' 		=> 'everest-timeline.php',
					'host_type' 	=> 'remote', // Use either bundled, remote, wordpress
					'screenshot' 	=> 'https://accesspressthemes.com/plugin-repo/everest-timeline/everest-timeline.jpg',
					'class' 		=> 'APMM_Class_Pro',
					'link'			=>'https://1.envato.market/c/1302794/275988/4415?u=https%3A%2F%2Fcodecanyon.net%2Fitem%2Feverest-timeline-responsive-wordpress-timeline-plugin%2F20922265',
					'info' 		=> esc_html__('A perfect timeline maker! If you\'re planning to make one go for it!', 'zigcy-lite'),
				),
			)
		),
	);

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' => esc_html__( 'Zigcy Setup', 'zigcy-lite' ),
		'theme_short_description' => esc_html__( 'The Zigcy Lite is full fledged Premium WordPress theme for companies. The theme comes with spectacular design and powerful features. It is a highly flexible theme that gives you full control to design and manage your dream website as per your wish.', 'zigcy-lite' ),

		// Plugin Action Texts
		'install_n_activate' 	=> esc_html__('Install and Activate', 'zigcy-lite'),
		'deactivate' 			=> esc_html__('Deactivate', 'zigcy-lite'),
		'activate' 				=> esc_html__('Activate', 'zigcy-lite'),

		// Getting Started Section
		'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'zigcy-lite'),
		'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'zigcy-lite'),
		'doc_read_now' 		=> esc_html__( 'Read Now', 'zigcy-lite' ),
		'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'zigcy-lite'),
		'cus_description' 	=> esc_html__('Using the Zigcy Lite customizer panel you can easily customize every aspect of the theme.', 'zigcy-lite'),
		'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'zigcy-lite' ),

		// Recommended Plugins Section
		'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'zigcy-lite' ),
		'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'zigcy-lite' ),

		

		// Demo Actions
		'activate_btn' 		=> esc_html__('Activate', 'zigcy-lite'),
		'installed_btn' 	=> esc_html__('Activated', 'zigcy-lite'),
		'demo_installing' 	=> esc_html__('Installing Demo', 'zigcy-lite'),
		'demo_installed' 	=> esc_html__('Demo Installed', 'zigcy-lite'),
		'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'zigcy-lite'),

		// Actions Required
		'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'zigcy-lite' ),
		'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'zigcy-lite' ),
		'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'zigcy-lite' ),
	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Zigcy_lite_Welcome( $plugins, $strings );


	