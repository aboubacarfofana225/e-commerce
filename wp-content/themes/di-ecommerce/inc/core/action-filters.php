<?php

/**
 * Admin Info bar.
 */
if( ! function_exists( 'di_ecommerce_admin_notice' ) ) {
	/**
	 * Printing info in admin screen.
	 * @return [type] [description]
	 */
	function di_ecommerce_admin_notice() {
		global $current_user ;
		$user_id = $current_user->ID;
		
		/* Check that the user hasn't already clicked to ignore the message */
		if( ! get_user_meta( $user_id, 'di_ecommerce_ignore_notice' ) ) {
			echo '<div class="updated"><p>';
			
			printf( __( 'Thank you for activating Di eCommerce Theme. Let start from <a target="_blank" href="%1$s">Video Tutorials</a> | <a target="_blank" href="%2$s">Documentation</a> | <a target="_blank" href="%3$s">Visit Demo</a> | <a target="_blank" href="%4$s">Customize Now</a> | <a href="%5$s">Hide it</a>', 'di-ecommerce' ), 'https://www.youtube.com/watch?v=lOEn0gsUarc&list=PLi1mp3OyXn1bAKHc1799BIRjUyAeBiejB', 'https://dithemes.com/di-ecommerce-free-wordpress-theme-documentation/', 'http://demo.dithemes.com/di-ecommerce/', esc_url( get_admin_url() . 'customize.php' ) , esc_url( add_query_arg( 'di_ecommerce_notics_ignore', '0' ) ) );
			
			echo "</p></div>";
		}
	}
}
add_action( 'admin_notices', 'di_ecommerce_admin_notice' );

if( ! function_exists( 'di_ecommerce_handle_notic' ) ) {
	/**
	 * Handling hide me link.
	 * @return [type] [description]
	 */
	function di_ecommerce_handle_notic() {
		global $current_user;
		$user_id = $current_user->ID;
		if( isset( $_GET['di_ecommerce_notics_ignore']) && '0' == $_GET['di_ecommerce_notics_ignore'] ) {
			add_user_meta( $user_id, 'di_ecommerce_ignore_notice', 'true', true );
		}
	}
}
add_action( 'admin_init', 'di_ecommerce_handle_notic' );

if( ! function_exists( 'di_ecommerce_delete_user_meta_ignore_notice' ) ) {
	/**
	 * Delete user meta for admin screen info on theme switch.
	 * @return [type] [description]
	 */
	function di_ecommerce_delete_user_meta_ignore_notice() {
		global $current_user;
		$user_id = $current_user->ID;
		if( get_user_meta( $user_id, 'di_ecommerce_ignore_notice' ) ) {
			delete_user_meta( $user_id, 'di_ecommerce_ignore_notice' );
		}
	}
}
add_action('switch_theme', 'di_ecommerce_delete_user_meta_ignore_notice');

/**
 * Admin Info bar END.
 */

if( ! is_admin() ) {

	if( ! function_exists(  'di_ecommerce_custom_excerpt_length' ) ) {
		/**
		 * Custom excerpt length.
		 * @param  [type] $length [description]
		 * @return [type]         [description]
		 */
		function di_ecommerce_custom_excerpt_length( $length ) {
			return absint( get_theme_mod( 'excerpt_length', '40' ) );
		}
	}
	add_filter( 'excerpt_length', 'di_ecommerce_custom_excerpt_length', 999 );

	if( ! function_exists( 'di_ecommerce_excerpt_more' ) ) {
		/**
		 * Custom excerpt last ...... replace.
		 * @param  [type] $more [description]
		 * @return [type]       [description]
		 */
		function di_ecommerce_excerpt_more( $more ) {
			global $post;
			return '&#8230; <a class="di-continue-reading" href="' . esc_url( get_permalink( $post->ID ) ) . '"> ' . __( 'Continue Reading', 'di-ecommerce' ) . '&#8230;</a>';
		}
	}
	add_filter( 'excerpt_more', 'di_ecommerce_excerpt_more', 1001 );
	
}

if( ! function_exists( 'di_ecommerce_calendar_modify' ) ) {
	/**
	 * Add class="table table-bordered" to default calendar.
	 * @param  [type] $html [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_calendar_modify( $html ) {
		return str_replace( 'id="wp-calendar"', 'id="wp-calendar" class="table table-bordered"', $html );
	}
}
add_filter( 'get_calendar', 'di_ecommerce_calendar_modify' );


if( ! function_exists( 'di_ecommerce_comment_form_fields' ) ) {
	/**
	 * Comment form fields name, email, url only.
	 * @param  [type] $fields [description]
	 * @return [type]         [description]
	 */
	function di_ecommerce_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
			
		$fields   =  array(

			'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'di-ecommerce' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input class="form-control" placeholder="' . __( 'Your name', 'di-ecommerce' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
			
			'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'di-ecommerce' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			'<input class="form-control" placeholder="' . __( 'Your email', 'di-ecommerce' ) . '" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
			
			'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'di-ecommerce' ) . '</label> ' .
			'<input class="form-control" placeholder="' . __( 'Your website', 'di-ecommerce' ) . '" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'   
			
			);
		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'di_ecommerce_comment_form_fields' );


if( ! function_exists( 'di_ecommerce_comment_form' ) ) {
	/**
	 * Comment form text area and submit button.
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_comment_form( $args ) {
		$args['comment_field'] = '<div class="form-group comment-form-comment">
		<label for="comment">' . _x( 'Comment', 'noun' , 'di-ecommerce' ) . '<span class="required"> *</span></label> 
		<textarea class="form-control" placeholder="' . __( 'Your comment', 'di-ecommerce' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
		</div>';
		
		$args['class_submit'] = 'masterbtn'; // since WP 4.1
		
		return $args;
	}
}
add_filter( 'comment_form_defaults', 'di_ecommerce_comment_form' );


if( ! function_exists( 'di_ecommerce_the_head_contain' ) ) {
	/**
	 * Add code in head.
	 * @return [type] [description]
	 */
	function di_ecommerce_the_head_contain() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php } ?>
		
		<?php
	}
}
add_action( 'di_ecommerce_the_head', 'di_ecommerce_the_head_contain' );

if( ! function_exists( 'di_ecommerce_body_overflowhide' ) ) {
	/**
	 * Add overflowhide class to page body.
	 * @param  [type] $classes [description]
	 * @return [type]          [description]
	 */
	function di_ecommerce_body_overflowhide( $classes ) {
		return array_merge( $classes, array( 'overflowhide' ) );
	}
}

// Add overflowhide class to body if page preloader enabled. overflowhide class will be remove using js after page loaded.
if( get_theme_mod( 'loading_icon', '0' ) == 1 ) {
	add_filter( 'body_class', 'di_ecommerce_body_overflowhide' );
}

if( ! function_exists( 'di_ecommerce_change_logo_class_pre' ) ) {
	/**
	 * Add classes to logo in some case.
	 * @return [type] [description]
	 */
	function di_ecommerce_change_logo_class_pre() {
		$header_layout = absint( get_theme_mod( 'header_layout', '3' ) );
		if( $header_layout == 2 || $header_layout == 6 ) {
			add_filter( 'get_custom_logo', 'di_ecommerce_change_logo_class' );
		}
	}
}
add_action( 'wp_loaded', 'di_ecommerce_change_logo_class_pre' );

if( ! function_exists( 'di_ecommerce_change_logo_class' ) ) {
	/**
	 * Add aligncenter class to logo HTML in some case.
	 * @param  [type] $html [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_change_logo_class( $html ) {
	    $html = str_replace( 'custom-logo', 'custom-logo aligncenter', $html );
	    return $html;
	}
}

if( ! function_exists( 'di_ecommerce_footer_copyright_right_setting_front_cntnt' ) ) {
	/**
	 * Footer copyright right content.
	 * @return [type] [description]
	 */
	function di_ecommerce_footer_copyright_right_setting_front_cntnt() {
		echo '<p>' . __( 'WordPress', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/di-ecommerce-free-wordpress-theme/"><span class="fa fa-thumbs-o-up"></span> ' . __( 'Di eCommerce', 'di-ecommerce' ) . '</a> ' . __( 'Theme', 'di-ecommerce' ) . '</p>';
	}
}
add_action('di_ecommerce_footer_copyright_right_setting_front', 'di_ecommerce_footer_copyright_right_setting_front_cntnt' );

if( ! function_exists( 'di_ecommerce_page_sidebar_file_clbk' ) ) {
	/**
	 * Page sidebar file contents.
	 * @return [type] [description]
	 */
	function di_ecommerce_page_sidebar_file_clbk() {
		if( is_active_sidebar( 'sidebar_page' ) ) {
			dynamic_sidebar( 'sidebar_page' );
		}
	}
}
add_action( 'di_ecommerce_page_sidebar_file', 'di_ecommerce_page_sidebar_file_clbk' );

if( ! function_exists( 'di_ecommerce_post_sidebar_file_clbk' ) ) {
	/**
	 * Post sidebar file contents.
	 * @return [type] [description]
	 */
	function di_ecommerce_post_sidebar_file_clbk() {
		if( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		}
	}
}
add_action( 'di_ecommerce_post_sidebar_file', 'di_ecommerce_post_sidebar_file_clbk' );

if( ! function_exists( 'di_ecommerce_hdrimg_file_clbk' ) ) {
	/**
	 * Header image file contents.
	 * @return [type] [description]
	 */
	function di_ecommerce_hdrimg_file_clbk() {

		// Get current post ID (if on blog, then checks current posts page for it's ID)
		if ( is_home() ) {
			$di_post_id = get_option( 'page_for_posts' );
		} else {
			$di_post_id = get_the_ID();
		}

		// Do not load, if disabled using meta box option.
		if( $di_post_id ) {
			if( get_post_meta( $di_post_id, '_di_ecommerce_hide_hdrimg', true ) == '1' ) {
				return;
			}
		}

		if( has_header_image() ) { ?>
		<div class="container-fluid">
			<div class="row">
				<div class="alignc wd100">
					<?php the_custom_header_markup(); ?>
				</div>
			</div>
		</div>
		<?php
		}
	}
}
add_action( 'di_ecommerce_hdrimg_file', 'di_ecommerce_hdrimg_file_clbk' );

if( ! function_exists( 'di_ecommerce_top_bar_search_form_free_content_field' ) ) {
	/**
	 * Pro link to get color options for top bar section.
	 * @return [type] [description]
	 */
	function di_ecommerce_top_bar_search_form_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_topbar_freecon',
			'label'       => esc_attr__( 'Color Options', 'di-ecommerce' ),
			'section'     => 'top_bar',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_attr__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
			'active_callback'  => array(
				array(
					'setting'  => 'display_top_bar',
					'operator' => '==',
					'value'    => 1,
				),
			)
		) );
	}
}
add_action( 'di_ecommerce_top_bar_search_form', 'di_ecommerce_top_bar_search_form_free_content_field' );

if( ! function_exists( 'di_ecommerce_color_options_free_content_field' ) ) {
	/**
	 * Pro link to get color options for color options section.
	 * @return [type] [description]
	 */
	function di_ecommerce_color_options_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_clroptions_freecon',
			'label'       => esc_attr__( 'More Colors', 'di-ecommerce' ),
			'section'     => 'color_options',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'More color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_attr__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
		) );
	}
}
add_action( 'di_ecommerce_color_options', 'di_ecommerce_color_options_free_content_field' );

if( ! function_exists( 'di_ecommerce_blog_options_free_content_field' ) ) {
	/**
	 * Pro link for blog section.
	 * @return [type] [description]
	 */
	function di_ecommerce_blog_options_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_blog_options_freecon',
			'label'       => esc_attr__( 'Color Options', 'di-ecommerce' ),
			'section'     => 'blog_options',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
		) );	
	}
}
add_action( 'di_ecommerce_blog_options', 'di_ecommerce_blog_options_free_content_field' );


if( ! function_exists( 'di_ecommerce_sidebar_cart_options_free_content_field' ) ) {
	/**
	 * Pro link for sidebar cart section.
	 * @return [type] [description]
	 */
	function di_ecommerce_sidebar_cart_options_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_sidebar_cart_options_freecon',
			'label'       => esc_attr__( 'Color Options', 'di-ecommerce' ),
			'section'     => 'sidebar_cart_optins',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
			'active_callback'  => array(
				array(
					'setting'  => 'sb_cart_onoff',
					'operator' => '==',
					'value'    => 1,
				),
			),
		) );	
	}
}
add_action( 'di_ecommerce_sidebar_cart_options', 'di_ecommerce_sidebar_cart_options_free_content_field' );

if( ! function_exists( 'di_ecommerce_woo_options_free_content_field' ) ) {
	/**
	 * Pro link for woo options section.
	 * @return [type] [description]
	 */
	function di_ecommerce_woo_options_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_woo_options_freecon',
			'label'       => esc_attr__( 'Color Options', 'di-ecommerce' ),
			'section'     => 'woocommerce_options',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
		) );	
	}
}
add_action( 'di_ecommerce_woo_options', 'di_ecommerce_woo_options_free_content_field' );


if( ! function_exists( 'di_ecommerce_footer_widget_options_free_content_field' ) ) {
	/**
	 * Pro link for footer widget options section.
	 * @return [type] [description]
	 */
	function di_ecommerce_footer_widget_options_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_footer_options_freecon',
			'label'       => esc_attr__( 'Color Options', 'di-ecommerce' ),
			'section'     => 'footer_options',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Color options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
			'active_callback'  => array(
				array(
					'setting'  => 'endis_ftr_wdgt',
					'operator' => '==',
					'value'    => 1,
				),
			)
		) );
	}
}
add_action( 'di_ecommerce_footer_widget_options', 'di_ecommerce_footer_widget_options_free_content_field' );


if( ! function_exists( 'di_ecommerce_footer_copyright_free_content_field' ) ) {
	/**
	 * Pro link for footer copyright options section.
	 * @return [type] [description]
	 */
	function di_ecommerce_footer_copyright_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_footer_copy_options_freecon',
			'label'       => esc_attr__( 'Footer Right', 'di-ecommerce' ),
			'section'     => 'footer_copy_options',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'Footer Right Option and Color Options are available in', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Di eCommerce Pro', 'di-ecommerce' ) . '</a>.</div>',
		) );
	}
}
add_action( 'di_ecommerce_footer_copyright', 'di_ecommerce_footer_copyright_free_content_field' );

if( ! function_exists( 'di_ecommerce_cutmzr_theme_info_free_content_field' ) ) {
	/**
	 * List of pro features in theme info section.
	 * @return [type] [description]
	 */
	function di_ecommerce_cutmzr_theme_info_free_content_field() {
		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_theme_info_sprt_freecon',
			'label'       => esc_attr__( 'Di eCommerce Support', 'di-ecommerce' ),
			'section'     => 'theme_info',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . esc_html__( 'If you want our support, Please', 'di-ecommerce' ) . ' <a target="_blank" href="https://wordpress.org/support/theme/di-ecommerce">' . esc_html__( 'Create a Support Topic', 'di-ecommerce' ) . '</a>.</div>',
		) );

		Kirki::add_field( 'di_ecommerce_config', array(
			'type'        => 'custom',
			'settings'    => 'custom_theme_info_pro_freecon',
			'label'       => esc_attr__( 'Di eCommerce Pro', 'di-ecommerce' ),
			'section'     => 'theme_info',
			'default'     => '<div style="background-color: #333;border-radius: 9px;color: #fff;padding: 13px 7px;">' . __( 'Premium Features:<br />- All Color Options<br />- Option to Update Footer Right Credit<br />- Widget Creation and Selection<br />- Advance Header Image<br />- Slider in Header<br />- Premium Support<br />', 'di-ecommerce' ) . ' <a target="_blank" href="https://dithemes.com/product/di-ecommerce-pro-wordpress-theme/">' . esc_html__( 'Get Di eCommerce Pro', 'di-ecommerce' ) . '</a></div>',
		) );
	}
}
add_action( 'di_ecommerce_cutmzr_theme_info', 'di_ecommerce_cutmzr_theme_info_free_content_field' );

/**
 * Kirki action content free version END.
 */

if( ! function_exists( 'di_ecommerce_tag_cloud_fontsize_fix' ) ) {
	/**
	 * Tag cloud widget css font size fix.
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_tag_cloud_fontsize_fix( $args ) {
		$args['largest']  = 11;
		$args['smallest'] = 11;
		$args['unit']     = 'px';
		return $args;
	}
}
add_filter( 'widget_tag_cloud_args', 'di_ecommerce_tag_cloud_fontsize_fix', 10, 1 );

if( class_exists( 'WooCommerce' ) ) {
	if( ! function_exists( 'di_ecommerce_woo_tag_cloud_fontsize_fix' ) ) {
		/**
		 * Woo tag cloud widget css font size fix.
		 * @param  [type] $args [description]
		 * @return [type]       [description]
		 */
		function di_ecommerce_woo_tag_cloud_fontsize_fix( $args ) {
			$args['largest']  = 11;
			$args['smallest'] = 11;
			$args['unit']     = 'px';
			return $args;
		}
	}
	add_filter( 'woocommerce_product_tag_cloud_widget_args', 'di_ecommerce_woo_tag_cloud_fontsize_fix', 10, 1 );
}

