<?php
// Disable kirki telemetry
add_filter( 'kirki_telemetry', '__return_false' );

//set Kirki config
Kirki::add_config( 'di_ecommerce_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

//the main panel
Kirki::add_panel( 'di_ecommerce_options', array(
    'title'       => esc_attr__( 'Di eCommerce Options', 'di-ecommerce' ),
    'description' => esc_attr__( 'All options of Di eCommerce theme', 'di-ecommerce' ),
) );

//typography
Kirki::add_section( 'typography_options', array(
	'title'          => esc_attr__( 'Typography Options', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'body_typog',
	'label'       => esc_attr__( 'Body Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Lora',
		'variant'        => 'regular',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'site_title_typog',
	'label'       => esc_attr__( 'Site Title Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '22px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => '.headermain h3.site-name-pr',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h1_typog',
	'label'       => esc_attr__( 'H1 / Headline 1 Typography', 'di-ecommerce' ),
	'description' => esc_attr__( 'Used as Headline of Single Post and page.', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '22px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => 'body h1, .h1',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h2_typog',
	'label'       => esc_attr__( 'H2 / Headline 2 Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '22px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => 'body h2, .h2',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h3_typog',
	'label'       => esc_attr__( 'H3 / Headline 3 Typography', 'di-ecommerce' ),
	'description' => esc_attr__( 'Used as Headline of Widgets, Posts on Archive, Comment Box.', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '22px',
		'line-height'    => '1.3',
		'letter-spacing' => '0.5px',
		'text-transform' => 'uppercase'
	),
	'output'      => array(
		array(
			'element' => 'body h3, .h3',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h4_typog',
	'label'       => esc_attr__( 'H4 / Headline 4 Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '20px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => 'body h4, .h4',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h5_typog',
	'label'       => esc_attr__( 'H5 / Headline 5 Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '20px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => 'body h5, .h5',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'h6_typog',
	'label'       => esc_attr__( 'H6 / Headline 6 Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Arvo',
		'variant'        => 'regular',
		'font-size'      => '20px',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => 'body h6, .h6',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'p_typog',
	'label'       => esc_attr__( 'Paragraph Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Fauna One',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '1.7',
		'letter-spacing' => '0.2px',
		'text-transform' => 'inherit',
	),
	'output'      => array(
		array(
			'element' => '.maincontainer p',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'top_bar_typog',
	'label'       => esc_attr__( 'Top Bar Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '15px',
		'line-height'    => '22px',
		'letter-spacing' => '0px',
		'text-transform' => 'inherit',
	),
	'output'      => array(
		array(
			'element' => '.bgtoph',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'top_menu_typog',
	'label'       => esc_attr__( 'Main Menu Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Rajdhani',
		'variant'        => '500',
		'font-size'      => '18px'
	),
	'output'      => array(
		array(
			'element' => '.navbarprimary ul li a',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'sb_cart_typo',
	'label'       => esc_attr__( 'Sidebar Cart Links Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Rajdhani',
		'variant'        => '500',
		'font-size'      => '18px',
		'line-height'    => '25px',
		'letter-spacing' => '0.1px',
		'text-transform' => 'inherit',
	),
	'output'      => array(
		array(
			'element' => '.side-menu-menu-wrap ul li a',
		),
	),
	'transport' => 'auto',
	'active_callback'  => array(
		array(
			'setting'  => 'sb_cart_onoff',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'widget_ul_ol_typog',
	'label'       => esc_attr__( 'Widgets UL/OL Typography', 'di-ecommerce' ),
	'description' => esc_attr__( 'Widgets Unordered List / Ordered List Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '15px',
		'line-height'    => '1.5',
		'letter-spacing' => '0.1px',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => '.widget_sidebar_main ul li, .widget_sidebar_main ol li',
		),
		array(
			'element' => '.widgets_footer ul li, .widgets_footer ol li',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'body_ul_ol_li_typog',
	'label'       => esc_attr__( 'Container UL/OL Typography', 'di-ecommerce' ),
	'description' => esc_attr__( 'Typography for list in main contents.', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Fjord One',
		'variant'        => 'regular',
		'font-size'      => '15px',
		'line-height'    => '1.7',
		'letter-spacing' => '0',
		'text-transform' => 'inherit',
	),
	'output'      => array(
		array(
			'element' => '.entry-content ul li, .entry-content ol li',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'mn_footer_typog',
	'label'       => esc_attr__( 'Footer Widgets Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '15px',
		'line-height'    => '1.7',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => '.footer',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'mn_footer_hdln_typog',
	'label'       => esc_attr__( 'Footer Widgets Headline Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    	=> 'Roboto',
		'variant'        	=> 'regular',
		'font-size'      	=> '17px',
		'line-height'    	=> '1.1',
		'letter-spacing' 	=> '1px',
		'text-transform' 	=> 'uppercase',
		'text-align' 		=> 'left',
	),
	'output'      => array(
		array(
			'element' => '.footer h3.widgets_footer_title',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'typography',
	'settings'    => 'cprt_footer_typog',
	'label'       => esc_attr__( 'Footer Copyright Typography', 'di-ecommerce' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '15px',
		'line-height'    => '1',
		'letter-spacing' => '0',
		'text-transform' => 'inherit'
	),
	'output'      => array(
		array(
			'element' => '.footer-copyright',
		),
	),
	'transport' => 'auto',
) );

//typography END

//top bar
Kirki::add_section( 'top_bar', array(
	'title'          => esc_attr__( 'Top Bar Options', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'display_top_bar',
	'label'       => esc_attr__( 'Top Bar Feature', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Top Bar', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '1',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'display_sicons_top_bar',
	'label'       => esc_attr__( 'Social Icons', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Social Icons', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '1',
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 's_link_open',
	'label'       => esc_attr__( 'Social Links in New Tab?', 'di-ecommerce' ),
	'description' => esc_attr__( 'Open social links in new tab or same.', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '1',
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'display_sicons_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

do_action( 'di_ecommerce_top_bar' );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'select',
	'settings'    => 'tpbr_left_view',
	'label'       => esc_attr__( 'Top Bar Left Content View', 'di-ecommerce' ),
	'description' => esc_attr__( 'Simply phone, email or Text/HTML or Disable ?', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '1',
	'choices'     => array(
		'1' => esc_attr__( 'Phone and Email', 'di-ecommerce' ),
		'2' => esc_attr__( 'Text / HTML', 'di-ecommerce' ),
		'3' => esc_attr__( 'Disable', 'di-ecommerce' ),
	),
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'tpbr_lft_phne',
	'label'			=> esc_attr__( 'Phone Number', 'di-ecommerce' ),
	'description' 	=> esc_attr__( 'Leave empty for disable.', 'di-ecommerce' ),
	'section'		=> 'top_bar',
	'default'		=> esc_attr__( '0123456789', 'di-ecommerce' ),
	'partial_refresh' => array(
		'tpbr_lft_phne' => array(
			'selector'        => '.tpbr_lft_phne_ctmzr',
			'render_callback' => function() {
				if( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ) {
				?>
					<span class="topbarpn"><span class="fa fa-phone"></span> <a href="tel:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?></a></span>
				<?php
				}
				?>
				
				<?php
				if( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ) {
				?>
					<span class="topbarmil"><span class="fa fa-envelope-o"></span> <a href="mailto:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?></a></span>
				<?php
				}
			},
		),
	),
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'tpbr_left_view',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'tpbr_lft_email',
	'label'			=> esc_attr__( 'Email Address', 'di-ecommerce' ),
	'description' 	=> esc_attr__( 'Leave empty for disable.', 'di-ecommerce' ),
	'section'		=> 'top_bar',
	'default'		=> esc_attr__( 'info@example.com', 'di-ecommerce' ),
	'partial_refresh' => array(
		'tpbr_lft_email' => array(
			'selector'        => '.tpbr_lft_phne_ctmzr',
			'render_callback' => function() {
				if( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ) {
				?>
					<span class="topbarpn"><span class="fa fa-phone"></span> <a href="tel:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_phne', '0123456789' ) ); ?></a></span>
				<?php
				}
				?>
				
				<?php
				if( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ) {
				?>
					<span class="topbarmil"><span class="fa fa-envelope-o"></span> <a href="mailto:<?php echo esc_attr( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'tpbr_lft_email', 'info@example.com' ) ); ?></a></span>
				<?php
				}
			},
		),
	),
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'tpbr_left_view',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'editor',
	'settings'    => 'top_bar_left_content',
	'label'       => esc_attr__( 'Top Bar Left Content', 'di-ecommerce' ),
	'description' => esc_attr__( 'Text / HTML of Top Bar Left', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '<p><span class="topbarpn"><span class="fa fa-phone"></span> <a href="tel:0123456789">' . esc_attr__( '0123456789', 'di-ecommerce' ) . '</a></span> <span class="topbarmil"><span class="fa fa-envelope-o"></span> <a href="mailto:info@example.com">' . esc_attr__( 'info@example.com', 'di-ecommerce' ) . '</a></span></p>',
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.topbar_ctmzr',
			'function' => 'html',
		),
	),
	'partial_refresh' => array(
		'top_bar_left_content' => array(
			'selector'        => '.topbar_ctmzr',
			'render_callback' => function() {
				echo wp_kses_post( get_theme_mod( 'top_bar_left_content', '<p><span class="topbarpn"><span class="fa fa-phone"></span> <a href="tel:0123456789">0123456789</a></span> <span class="topbarmil"><span class="fa fa-envelope-o"></span> <a href="mailto:info@example.com">info@example.com</a></span></p>' ) );
			},
		),
	),
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'tpbr_left_view',
			'operator' => '==',
			'value'    => 2,
		),
	)
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'top_bar_seach_icon',
	'label'       => esc_attr__( 'Search Icon', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Search Icon', 'di-ecommerce' ),
	'section'     => 'top_bar',
	'default'     => '1',
	'active_callback'  => array(
		array(
			'setting'  => 'display_top_bar',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

do_action( 'di_ecommerce_top_bar_search_form' );

//top bar END

//Header layout
Kirki::add_section( 'header_layout_section', array(
	'title'          => esc_attr__( 'Header Layout Options', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'header_layout',
	'label'			=> esc_attr__( 'Select Header Layout', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Save and reload front page for alignment', 'di-ecommerce' ),
	'section'		=> 'header_layout_section',
	'default'		=> '3',
	'choices'		=> array(
		'1'		=> get_template_directory_uri() . '/assets/images/header-1.png',
		'2'		=> get_template_directory_uri() . '/assets/images/header-2.png',
		'3'		=> get_template_directory_uri() . '/assets/images/header-3.png',
		'4'		=> get_template_directory_uri() . '/assets/images/header-4.png',
		'5'		=> get_template_directory_uri() . '/assets/images/header-5.png',
		'6'		=> get_template_directory_uri() . '/assets/images/header-6.png',
	),
) );

//Header layout END


// Some logo options
Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'slider',
	'settings'    => 'custom_logo_width',
	'label'       => esc_attr__( 'Logo Width', 'di-ecommerce' ),
	'description' => esc_attr__( 'To resize selected logo image.', 'di-ecommerce' ),
	'section'     => 'title_tagline',
	'default'     => '360',
	'priority'    => 9,
	'choices'     => array(
		'min'  => '10',
		'max'  => '600',
		'step' => '1',
	),
	'output' => array(
		array(
			'element'	=> '.custom-logo',
			'property'	=> 'width',
			'suffix'	=> 'px',
		),
	),
	'transport' => 'auto',
	'active_callback'  => 'has_custom_logo',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'cntr_logo_conditn',
	'label'       => esc_attr__( 'Center Logo', 'di-ecommerce' ),
	'description' => esc_attr__( 'Center logo for mobiles?', 'di-ecommerce' ),
	'section'     => 'title_tagline',
	'default'     => '1',
	'priority'    => 9,
	'active_callback'  => 'has_custom_logo',
) );


//color options
Kirki::add_section( 'color_options', array(
	'title'          => esc_attr__( 'Color Options', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        	=> 'color',
	'settings'    	=> 'default_a_color',
	'label'       	=> esc_attr__( 'Default Links Color', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'This will be color of all default links.', 'di-ecommerce' ),
	'section'     	=> 'color_options',
	'default'     	=> apply_filters( 'di_ecommerce_default_a_color', '#f66f66' ),
	'choices'     	=> array(
		'alpha' => true,
	),
	'output' => array(
		array(
			'element'  => 'body a, .woocommerce .woocommerce-breadcrumb a, .woocommerce .star-rating span',
			'property' => 'color',
		),
		array(
			'element'  => '.widget_sidebar_main ul li::before',
			'property' => 'color',
		),
		array(
			'element'  => '.navigation.pagination .nav-links .page-numbers, .navigation.pagination .nav-links .page-numbers:last-child',
			'property' => 'border-color',
		),
		array(
			'element'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
			'property' => 'border-top-color',
		),
		array(
			'element'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
			'property' => 'border-bottom-color',
		),
		array(
			'element'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce-message',
			'property' => 'border-top-color',
		),
		array(
			'element'  => '.woocommerce-message::before',
			'property' => 'color',
		),
	),
	'transport' => 'auto',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        	=> 'color',
	'settings'    	=> 'default_a_mover_color',
	'label'       	=> esc_attr__( 'Default Links Color Mouse Over', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'This will be color of all default links on mouse over.', 'di-ecommerce' ),
	'section'     	=> 'color_options',
	'default'     	=> apply_filters( 'di_ecommerce_default_a_mover_color', '#ff2c1e' ),
	'choices'     	=> array(
		'alpha' => true,
	),
	'output' => array(
		array(
			'element'  => 'body a:hover, body a:focus, .woocommerce .woocommerce-breadcrumb a:hover',
			'property' => 'color',
		),
		array(
			'element'  => '.widget_sidebar_main ul li:hover::before',
			'property' => 'color',
		),
		array(
			'element'  => '.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a',
			'property' => 'color',
		),
	),
	'transport' => 'auto',
) );

do_action( 'di_ecommerce_color_options' );

//color options END

//social profile
Kirki::add_section( 'social_options', array(
	'title'          => esc_attr__( 'Social Profile', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_facebook',
	'label'			=> esc_attr__( 'Facebook Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> 'http://facebook.com',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_twitter',
	'label'			=> esc_attr__( 'Twitter Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> 'http://twitter.com',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_youtube',
	'label'			=> esc_attr__( 'YouTube Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> 'http://youtube.com',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_vk',
	'label'			=> esc_attr__( 'VK Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_okru',
	'label'			=> esc_attr__( 'Ok.ru (odnoklassniki) Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_linkedin',
	'label'			=> esc_attr__( 'Linkedin Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_pinterest',
	'label'			=> esc_attr__( 'Pinterest Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_instagram',
	'label'			=> esc_attr__( 'Instagram Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_telegram',
	'label'			=> esc_attr__( 'Telegram Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_snapchat',
	'label'			=> esc_attr__( 'Snapchat Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_flickr',
	'label'			=> esc_attr__( 'Flickr Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_reddit',
	'label'			=> esc_attr__( 'Reddit Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_tumblr',
	'label'			=> esc_attr__( 'Tumblr Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_yelp',
	'label'			=> esc_attr__( 'Yelp Link', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_whatsappno',
	'label'			=> esc_attr__( 'WhatsApp Number', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'text',
	'settings'		=> 'sprofile_link_skype',
	'label'			=> esc_attr__( 'Skype Id', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Leave empty for disable', 'di-ecommerce' ),
	'section'		=> 'social_options',
	'default'		=> '',
) );
//social profile END


// Blog
Kirki::add_section( 'blog_options', array(
	'title'          => esc_attr__( 'Blog Options', 'di-ecommerce' ),
	'panel'          => 'di_ecommerce_options',
	'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'breadcrumbx_setting',
	'label'       => esc_attr__( 'Breadcrumb', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Breadcrumb', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => '1',
) );



Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'sortable',
	'settings'    => 'archive_structure',
	'label'       => __( 'Archive Posts Structure', 'di-ecommerce' ),
	'description' => __( 'Show / Hide / Reorder parts of posts page.', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => array(
		'categories',
		'loop_headline',
		'date',
		'featured_image',
		'loop_content',
	),
	'choices'     => array(
		'categories'		=> esc_attr__( 'Post Categories', 'di-ecommerce' ),
		'loop_headline'		=> esc_attr__( 'Post Headline', 'di-ecommerce' ),
		'date'				=> esc_attr__( 'Post Date', 'di-ecommerce' ),
		'featured_image'	=> esc_attr__( 'Post Featured Image', 'di-ecommerce' ),
		'loop_content'		=> esc_attr__( 'Post Content', 'di-ecommerce' ),
	),
	'priority'    => 10,
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'sortable',
	'settings'    => 'single_structure',
	'label'       => __( 'Single Post Structure', 'di-ecommerce' ),
	'description' => __( 'Show / Hide / Reorder parts of single post.', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => array(
		'categories',
		'single_headline',
		'date',
		'featured_image',
		'single_content',
		'tags',
	),
	'choices'     => array(
		'categories'		=> esc_attr__( 'Post Categories', 'di-ecommerce' ),
		'single_headline'	=> esc_attr__( 'Post Headline', 'di-ecommerce' ),
		'date'				=> esc_attr__( 'Post Date', 'di-ecommerce' ),
		'featured_image'	=> esc_attr__( 'Post Featured Image', 'di-ecommerce' ),
		'single_content'	=> esc_attr__( 'Post Content', 'di-ecommerce' ),
		'tags'				=> esc_attr__( 'Post Tags', 'di-ecommerce' ),
		'author'			=> esc_attr__( 'Post Author', 'di-ecommerce' ),
	),
	'priority'    => 10,
) );


Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'select',
	'settings'    => 'post_date_view',
	'label'       => esc_attr__( 'Post Date View', 'di-ecommerce' ),
	'description' => esc_attr__( 'Which date do you want to display for single post?', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => '1',
	'choices'     => array(
		'1' => esc_attr__( 'Display Updated Date', 'di-ecommerce' ),
		'2' => esc_attr__( 'Display Publish Date', 'di-ecommerce' ),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'select',
	'settings'    => 'excerpt_or_content',
	'label'       => esc_attr__( 'Display Excerpt or Content on Archive', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 'excerpt',
	'choices'     => array(
		'excerpt' => esc_attr__( 'Display Excerpt', 'di-ecommerce' ),
		'content' => esc_attr__( 'Display Content', 'di-ecommerce' ),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'number',
	'settings'    => 'excerpt_length',
	'label'       => esc_attr__( 'Excerpt Length', 'di-ecommerce' ),
	'description' => esc_attr__( 'How much words you want to display on Archive page?', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 40,
	'choices'     => array(
		'min'  => 1,
		'step' => 1,
	),
	'active_callback'  => array(
		array(
			'setting'  => 'excerpt_or_content',
			'operator' => '==',
			'value'    => 'excerpt',
		),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'select',
	'settings'    => 'display_archive_pagination',
	'label'       => esc_attr__( 'Display Pagination on Archive', 'di-ecommerce' ),
	'description' => esc_attr__( 'Which type of pagination, you want to display?', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 'nextprev',
	'choices'     => array(
		'nextprev'	=> esc_attr__( 'Next Previous Pagination', 'di-ecommerce' ),
		'number' 	=> esc_attr__( 'Number Pagination', 'di-ecommerce' ),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'select',
	'settings'    => 'blog_list_grid',
	'label'       => esc_attr__( 'Posts View on Archive', 'di-ecommerce' ),
	'description' => esc_attr__( 'Display List or Grid?', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 'list',
	'choices'     => array(
		'list'		=> esc_attr__( 'List', 'di-ecommerce' ),
		'grid2c'	=> esc_attr__( 'Grid 2 Column', 'di-ecommerce' ),
		'grid3c'	=> esc_attr__( 'Grid 3 Column', 'di-ecommerce' ),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'radio-image',
	'settings'    => 'blog_archive_layout',
	'label'       => esc_attr__( 'Archive / Loop Layout', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 'rights',
	'choices'     => array(
		'fullw'	  => get_template_directory_uri() . '/assets/images/fullw.png',
		'rights'  => get_template_directory_uri() . '/assets/images/rights.png',
		'lefts'   => get_template_directory_uri() . '/assets/images/lefts.png',
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'radio-image',
	'settings'    => 'blog_single_layout',
	'label'       => esc_attr__( 'Single Post Layout', 'di-ecommerce' ),
	'section'     => 'blog_options',
	'default'     => 'rights',
	'choices'     => array(
		'fullw'	  => get_template_directory_uri() . '/assets/images/fullw.png',
		'rights'  => get_template_directory_uri() . '/assets/images/rights.png',
		'lefts'   => get_template_directory_uri() . '/assets/images/lefts.png',
	),
) );

do_action( 'di_ecommerce_blog_options' );

// Blog END

//woocommerce section
if( class_exists( 'WooCommerce' ) ) {

	// Sidebar cart options.
	Kirki::add_section( 'sidebar_cart_optins', array(
		'title'          => esc_attr__( 'Sidebar Cart Options', 'di-ecommerce' ),
		'panel'          => 'di_ecommerce_options',
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'sb_cart_onoff',
		'label'       => esc_attr__( 'Sidebar Cart', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable Sidebar Cart', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'select',
		'settings'    => 'sb_cart_icon_postn',
		'label'       => esc_attr__( 'Sidebar Cart Icon Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Icon position of sidebar cart.', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '3',
		'choices'     => array(
			'1' => esc_attr__( 'Top Left', 'di-ecommerce' ),
			'2' => esc_attr__( 'Top Right', 'di-ecommerce' ),
			'3' => esc_attr__( 'Bottom Left', 'di-ecommerce' ),
			'4' => esc_attr__( 'Bottom Right', 'di-ecommerce' ),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	// if sb_cart_icon_postn == 1
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_a_t',
		'label'       => esc_attr__( 'Top Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from top. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '50',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'top',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_a_l',
		'label'       => esc_attr__( 'Left Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from left. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '20',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'left',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 1,
			),
		)
	) );

	// if sb_cart_icon_postn == 2
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_b_t',
		'label'       => esc_attr__( 'Top Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from top. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '50',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'top',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 2,
			),
		)
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_b_r',
		'label'       => esc_attr__( 'Right Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from right. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '20',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'right',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 2,
			),
		)
	) );

	// if sb_cart_icon_postn == 3
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_c_b',
		'label'       => esc_attr__( 'Bottom Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from bottom. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '50',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'bottom',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 3,
			),
		)
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_c_l',
		'label'       => esc_attr__( 'Left Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from left. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '20',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'left',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 3,
			),
		)
	) );

	// if sb_cart_icon_postn == 4
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_d_b',
		'label'       => esc_attr__( 'Bottom Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from bottom. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '70',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'bottom',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 4,
			),
		)
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'text',
		'settings'    => 'sb_cart_icon_postn_d_r',
		'label'       => esc_attr__( 'Right Position', 'di-ecommerce' ),
		'description' => esc_attr__( 'Pixels to move from right. (i.e. 60)', 'di-ecommerce' ),
		'section'     => 'sidebar_cart_optins',
		'default'     => '20',
		'output' => array(
			array(
				'element'	=> '.side-menu-menu-button',
				'property'	=> 'right',
				'suffix'	=> 'px',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'sb_cart_onoff',
				'operator' => '==',
				'value'    => 1,
			),
			array(
				'setting'  => 'sb_cart_icon_postn',
				'operator' => '==',
				'value'    => 4,
			),
		)
	) );

	do_action( 'di_ecommerce_sidebar_cart_options' );
	
	// WooCommerce options.
	Kirki::add_section( 'woocommerce_options', array(
		'title'          => esc_attr__( 'Woocommerce Options', 'di-ecommerce' ),
		'panel'          => 'di_ecommerce_options',
		'capability'     => 'edit_theme_options',
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_shop_link_top_bar',
		'label'       => esc_attr__( 'Display shop icon in Top Bar?', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable shop icon in Top Bar', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
		'partial_refresh' => array(
			'display_shop_link_top_bar' => array(
				'selector'        => '.woo_icons_top_bar_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/partial/content', 'woo-icons-topbar' );
				},
			),
		),
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_cart_link_top_bar',
		'label'       => esc_attr__( 'Display cart icon in Top Bar?', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable cart icon in Top Bar', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
		'partial_refresh' => array(
			'display_cart_link_top_bar' => array(
				'selector'        => '.woo_icons_top_bar_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/partial/content', 'woo-icons-topbar' );
				},
			),
		),
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_myaccount_link_top_bar',
		'label'       => esc_attr__( 'Display My Account icon in Top Bar?', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable My Account icon in Top Bar', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
		'partial_refresh' => array(
			'display_myaccount_link_top_bar' => array(
				'selector'        => '.woo_icons_top_bar_ctmzr',
				'render_callback' => function() {
					get_template_part( 'template-parts/partial/content', 'woo-icons-topbar' );
				},
			),
		),
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_wc_breadcrumbs',
		'label'       => esc_attr__( 'WC Breadcrumbs', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable WooCommerce Breadcrumbs.', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '0',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'display_related_prdkt',
		'label'       => esc_attr__( 'Related Products', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable WooCommerce Related Products,', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'support_gallery_zoom',
		'label'       => esc_attr__( 'Gallery Zoom', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable gallery zoom support on single product.', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'toggle',
		'settings'    => 'support_gallery_lightbox',
		'label'       => esc_attr__( 'Gallery Light Box', 'di-ecommerce' ),
		'description' => esc_attr__( 'Enable/Disable gallery light box support on single product.', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'			=> 'toggle',
		'settings'		=> 'support_gallery_slider',
		'label'			=> esc_attr__( 'Gallery Slider', 'di-ecommerce' ),
		'description'	=> esc_attr__( 'Enable/Disable gallery slider support on single product.', 'di-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> '1',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'			=> 'toggle',
		'settings'		=> 'order_again_btn',
		'label'			=> esc_attr__( 'Display Order Again Button?', 'di-ecommerce' ),
		'description'	=> esc_attr__( 'It will show / hide order again button on singe order page.', 'di-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> '1',
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'number',
		'settings'    => 'product_per_page',
		'label'       => esc_attr__( 'Number of products display on loop page', 'di-ecommerce' ),
		'description' => esc_attr__( 'How much products you want to display on loop page?', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => 12,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	) );
	
	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'slider',
		'settings'    => 'product_per_column',
		'label'       => esc_attr__( 'Number of products display per column', 'di-ecommerce' ),
		'description' => esc_attr__( 'How much products you want to display in single line?', 'di-ecommerce' ),
		'section'     => 'woocommerce_options',
		'default'     => 3,
		'choices'     => array(
			'min'  => '1',
			'max'  => '5',
			'step' => '1',
			),
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'			 => 'select',
		'settings'		=> 'woo_product_img_effect',
		'label'			=> __( 'Product Image Effect', 'di-ecommerce' ),
		'description'	=> __( 'Product image effect on shop page', 'di-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'zoomin',
		'priority'		=> 10,
		'choices'		=> array(
			'none'			=> esc_attr__( 'None', 'di-ecommerce' ),
			'zoomin'		=> esc_attr__( 'Zoom In', 'di-ecommerce' ),
			'zoomout'		=> esc_attr__( 'Zoom Out', 'di-ecommerce' ),
			'rotate'		=> esc_attr__( 'Rotate', 'di-ecommerce' ),
			'blur'			=> esc_attr__( 'Blur', 'di-ecommerce' ),
			'grayscale'		=> esc_attr__( 'Gray Scale', 'di-ecommerce' ),
			'sepia'			=> esc_attr__( 'Sepia', 'di-ecommerce' ),
			'opacity'		=> esc_attr__( 'Opacity', 'di-ecommerce' ),
			'flash'			=> esc_attr__( 'Flash', 'di-ecommerce' ),
		),
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'        => 'custom',
		'settings'    => 'info_woo_layout',
		'section'     => 'woocommerce_options',
		'default'     => '<hr /><div style="padding: 10px;background-color: #333; color: #fff; border-radius: 8px;">' . esc_attr__( 'Layouts: For Cart, Checkout and My Account pages layout, use: Template option under Page Attributes on page edit screen.', 'di-ecommerce' ) . '</div>',
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'			=> 'radio-image',
		'settings'		=> 'woo_layout',
		'label'			=> esc_attr__( 'Shop / Archive Page Layout', 'di-ecommerce' ),
		'description'	=> esc_attr__( 'This layout will apply on shop, archive, search (products loop) pages.', 'di-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'fullw',
		'choices'		=> array(
			'fullw' => get_template_directory_uri() . '/assets/images/fullw.png',
			'rights' => get_template_directory_uri() . '/assets/images/rights.png',
			'lefts' => get_template_directory_uri() . '/assets/images/lefts.png',
		),
	) );

	Kirki::add_field( 'di_ecommerce_config', array(
		'type'			=> 'radio-image',
		'settings'		=> 'woo_singleprod_layout',
		'label'			=> esc_attr__( 'Single Product Page Layout', 'di-ecommerce' ),
		'description'	=> esc_attr__( 'This layout will apply on single product page.', 'di-ecommerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'fullw',
		'choices'		=> array(
			'fullw' => get_template_directory_uri() . '/assets/images/fullw.png',
			'rights' => get_template_directory_uri() . '/assets/images/rights.png',
			'lefts' => get_template_directory_uri() . '/assets/images/lefts.png',
		),
	) );

	do_action( 'di_ecommerce_woo_options' );

}
//woocommerce section END

//footer widgets section - footer means footer widget section (footer copyright not covered)
Kirki::add_section( 'footer_options', array(
    'title'          => esc_attr__( 'Footer Widget Options', 'di-ecommerce' ),
    'panel'          => 'di_ecommerce_options',
    'capability'     => 'edit_theme_options',
) );


Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'endis_ftr_wdgt',
	'label'       => esc_attr__( 'Footer Widgets', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Footer Widgets.', 'di-ecommerce' ),
	'section'     => 'footer_options',
	'default'     => '0',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'ftr_wdget_lyot',
	'label'			=> esc_attr__( 'Footer Widget Layout', 'di-ecommerce' ),
	'description'	=> esc_attr__( 'Save and go to Widgets page to add.', 'di-ecommerce' ),
	'section'		=> 'footer_options',
	'default'		=> '3',
	'choices'		=> array(
		'1'		=> get_template_directory_uri() . '/assets/images/ftrwidlout1.png',
		'2'		=> get_template_directory_uri() . '/assets/images/ftrwidlout2.png',
		'3'		=> get_template_directory_uri() . '/assets/images/ftrwidlout3.png',
		'4'		=> get_template_directory_uri() . '/assets/images/ftrwidlout4.png',
		'48'	=> get_template_directory_uri() . '/assets/images/ftrwidlout48.png',
		'84'	=> get_template_directory_uri() . '/assets/images/ftrwidlout84.png',
	),
	'active_callback'  => array(
		array(
			'setting'  => 'endis_ftr_wdgt',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

do_action( 'di_ecommerce_footer_widget_options' );

//footer section END

//footer copyright section
Kirki::add_section( 'footer_copy_options', array(
    'title'          => esc_attr__( 'Footer Copyright Options', 'di-ecommerce' ),
    'panel'          => 'di_ecommerce_options',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'editor',
	'settings'    => 'left_footer_setting',
	'label'       => esc_attr__( 'Footer Left', 'di-ecommerce' ),
	'description' => esc_attr__( 'Content of Footer Left Side', 'di-ecommerce' ),
	'section'     => 'footer_copy_options',
	'default'     => '<p>' . esc_html__( 'Site Title, Some rights reserved.', 'di-ecommerce' ) . '</p>',
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.cprtlft_ctmzr',
			'function' => 'html',
		),
	),
	'partial_refresh' => array(
		'left_footer_setting' => array(
			'selector'        => '.cprtlft_ctmzr',
			'render_callback' => function() {
				return wp_kses_post( get_theme_mod( 'left_footer_setting' ) );
			},
		),
	),
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'editor',
	'settings'    => 'center_footer_setting',
	'label'       => esc_attr__( 'Footer Center', 'di-ecommerce' ),
	'description' => esc_attr__( 'Content of Footer Center Side', 'di-ecommerce' ),
	'section'     => 'footer_copy_options',
	'default'     => '<p><a href="#">' . esc_html__( 'Terms of Use - Privacy Policy', 'di-ecommerce' ) . '</a></p>',
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '.cprtcntr_ctmzr',
			'function' => 'html',
		),
	),
	'partial_refresh' => array(
		'center_footer_setting' => array(
			'selector'        => '.cprtcntr_ctmzr',
			'render_callback' => function() {
				return wp_kses_post( get_theme_mod( 'center_footer_setting' ) );
			},
		),
	),
) );

do_action( 'di_ecommerce_footer_copyright_right_setting' );

do_action( 'di_ecommerce_footer_copyright' );

//footer copyright section END

//misc section
Kirki::add_section( 'misc_options', array(
    'title'          => esc_attr__( 'MISC Options', 'di-ecommerce' ),
    'panel'          => 'di_ecommerce_options',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'stickymenu_setting',
	'label'       => esc_attr__( 'Sticky Menu', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Sticky Menu (for Large Devices)', 'di-ecommerce' ),
	'section'     => 'misc_options',
	'default'     => '0',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'back_to_top',
	'label'       => esc_attr__( 'Back To Top Button', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Back To Top Button', 'di-ecommerce' ),
	'section'     => 'misc_options',
	'default'     => '1',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'toggle',
	'settings'    => 'loading_icon',
	'label'       => esc_attr__( 'Page Loading Icon', 'di-ecommerce' ),
	'description' => esc_attr__( 'Enable/Disable Page Loading Icon', 'di-ecommerce' ),
	'section'     => 'misc_options',
	'default'     => '0',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'image',
	'settings'    => 'loading_icon_img',
	'label'       => esc_attr__( 'Upload Custom Loading Icon', 'di-ecommerce' ),
	'description' => esc_attr__( 'It will replace default loading icon.', 'di-ecommerce' ),
	'section'     => 'misc_options',
	'default'     => '',
	'active_callback'  => array(
		array(
			'setting'  => 'loading_icon',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );
//misc section END

//Theme Info section
Kirki::add_section( 'theme_info', array(
    'title'          => esc_attr__( 'Theme Info', 'di-ecommerce' ),
    'panel'          => 'di_ecommerce_options',
    'capability'     => 'edit_theme_options',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'custom',
	'settings'    => 'custom_dib_demo',
	'label'       => esc_attr__( 'Di eCommerce Demo', 'di-ecommerce' ),
	'section'     => 'theme_info',
	'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'You can check demo of ', 'di-ecommerce' ) . ' <a target="_blank" href="http://demo.dithemes.com/di-ecommerce/">' . esc_html__( 'Di eCommerce Theme Here', 'di-ecommerce' ) . '</a>.</div>',
) );

Kirki::add_field( 'di_ecommerce_config', array(
	'type'        => 'custom',
	'settings'    => 'custom_dib_docs',
	'label'       => esc_attr__( 'Di eCommerce Docs', 'di-ecommerce' ),
	'section'     => 'theme_info',
	'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'You can check documentation of ', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/di-ecommerce-free-wordpress-theme-documentation/">' . esc_html__( 'Di eCommerce Theme Here', 'di-ecommerce' ) . '</a>.</div>',
) );

do_action( 'di_ecommerce_cutmzr_theme_info' );

//Theme Info section END
