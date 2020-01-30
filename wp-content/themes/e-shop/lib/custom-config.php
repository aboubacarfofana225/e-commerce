<?php
  if ( !class_exists( 'Kirki' ) ) {
    return;
  }
  if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' ) {
  	Kirki::add_section( 'e_shop_woo_demo_section', array(
  		'title'		 => __( 'WooCommerce Homepage Demo', 'e-shop' ),
  		'priority'	 => 10,
  	) );
  }
  
  Kirki::add_field( 'e_shop_settings', array(
  	'type'			 => 'switch',
  	'settings'		 => 'e_shop_demo_front_page',
  	'label'			 => __( 'Enable Demo Homepage?', 'e-shop' ),
  	'description'	 => sprintf( __( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage - Check the %s page for more informations.', 'e-shop' ), '<a href="' . admin_url( 'themes.php?page=maxstore-welcome' ) . '"><strong>' . __( 'Theme info', 'e-shop' ) . '</strong></a>' ),
  	'section'		 => 'e_shop_woo_demo_section',
  	'default'		 => 1,
  	'priority'		 => 10,
  ) );
  Kirki::add_field( 'e_shop_settings', array(
  	'type'				 => 'radio-buttonset',
  	'settings'			 => 'e_shop_front_page_demo_style',
  	'label'				 => esc_html__( 'Homepage Demo Styles', 'e-shop' ),
  	'description'		 => sprintf( __( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own %s.', 'e-shop' ), '<a href="' . admin_url( 'themes.php?page=maxstore-welcome' ) . '"><strong>' . __( 'custom homepage template', 'e-shop' ) . '</strong></a>' ),
  	'section'			 => 'e_shop_woo_demo_section',
  	'default'			 => 'style-one',
  	'priority'			 => 10,
  	'choices'			 => array(
  		'style-one'	 => __( 'Layout one', 'e-shop' ),
  		'style-two'	 => __( 'Layout two', 'e-shop' ),
  	),
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'e_shop_settings', array(
  	'type'				 => 'switch',
  	'settings'			 => 'e_shop_front_page_demo_carousel',
  	'label'				 => __( 'Homepage slider', 'e-shop' ),
  	'description'		 => esc_html__( 'Enable or disable demo homepage slider.', 'e-shop' ),
  	'section'			 => 'e_shop_woo_demo_section',
  	'default'			 => 1,
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );


  Kirki::add_field( 'e_shop_settings', array(
  	'type'				 => 'custom',
  	'settings'			 => 'e_shop_demo_page_intro',
  	'label'				 => __( 'Products', 'e-shop' ),
  	'section'			 => 'e_shop_woo_demo_section',
  	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'e-shop' ),
  	'priority'			 => 10,
  	'active_callback'	 => array(
  		array(
  			'setting'	 => 'demo_front_page',
  			'operator'	 => '==',
  			'value'		 => 1,
  		),
  	),
  ) );
  Kirki::add_field( 'e_shop_settings', array(
  	'type'			 => 'custom',
  	'settings'		 => 'e_shop_demo_dummy_content',
  	'label'			 => __( 'Need Dummy Products?', 'e-shop' ),
  	'section'		 => 'e_shop_woo_demo_section',
  	'description'	 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'e-shop' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'e-shop' ) . '</strong></a>' ),
  	'priority'		 => 10,
  ) );
  Kirki::add_field( 'e_shop_settings', array(
  	'type'			 => 'custom',
  	'settings'		 => 'e_shop_demo_pro_features',
  	'label'			 => __( 'Need More Features?', 'e-shop' ),
  	'section'		 => 'e_shop_woo_demo_section',
  	'description'	 => '<a href="' . esc_url( 'http://themes4wp.com/product/maxstore-pro/' ) . '" target="_blank" class="button button-primary">' . sprintf( esc_html__( 'Learn more about %s PRO', 'e-shop' ), 'MaxStore' ) . '</a>',
  	'priority'		 => 10,
  ) );