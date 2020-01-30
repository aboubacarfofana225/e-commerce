<?php
if( ! function_exists( 'di_ecommerce_inline_css' ) ) {
	/**
	 * Custom inline css addition.
	 * @return [type] [description]
	 */
	function di_ecommerce_inline_css() {

		$custom_css = "";

		// For load icon.
		if( get_theme_mod( 'loading_icon_img' ) ) {
			$icon_link =  esc_url( get_theme_mod( 'loading_icon_img' ) );
		} else {
			$icon_link =  esc_url( get_template_directory_uri() . '/assets/images/Preloader_2.gif' );
		}

		$custom_css .= "
		.load-icon
		{
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999999;
			background: url( '" . $icon_link . "' ) center no-repeat #fff;
		}
		";

		// Masonry.
		if( get_theme_mod( 'blog_list_grid', 'list' ) == 'grid2c' ) {

			$custom_css .= "
			@media (min-width: 768px) {
			  .dimasonrybox {
			    width: 48%;
			    margin-right: 2% !important;
			  }
			}
			";

		} elseif( get_theme_mod( 'blog_list_grid', 'list' ) == 'grid3c' ) {

			$custom_css .= "
			@media (min-width: 768px) {
			  .dimasonrybox {
			    width: 31%;
			    margin-right: 2% !important;
			  }
			}
			";

		} else {
			$custom_css .= "";
		}

		// Center the logo img.
		$center_logo = get_theme_mod( 'cntr_logo_conditn', '1' );
		if( $center_logo == 1 ) {
			$custom_css .= "
			@media (max-width: 768px) {
				.center-logo-img {
					margin: 0 auto;
					display: table;
				}
			}
			";
		}

		// for woo products effects.
		$effect = get_theme_mod( 'woo_product_img_effect', 'zoomin' );
		if( $effect == 'zoomin' ) {
			$custom_css .= "
			.woocommerce ul.products li.product a img {
				-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
				transition: opacity 0.5s ease, transform 0.5s ease;
			}

			.woocommerce ul.products li.product:hover a img {
				opacity: 0.9;
				transform: scale(1.1);
			}
			";
		} elseif( $effect == 'zoomout' ) {
			$custom_css .= "
			.woocommerce ul.products li.product a img {
				-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
				transition: opacity 0.5s ease, transform 0.5s ease;
			}

			.woocommerce ul.products li.product a img {
				opacity: 0.9;
				transform: scale(1.1);
			}

			.woocommerce ul.products li.product:hover a img {
				opacity: 0.9;
				transform: scale(1);
			}
			";
		} elseif( $effect == 'rotate' ) {
			$custom_css .= "
			.woocommerce ul.products li.product a img {
				-webkit-transition: transform 0s ease;
				transition: transform 0s ease;
			}
			.woocommerce ul.products li.product:hover a img {
				-webkit-transition: transform 0.7s ease;
				transition: transform 0.7s ease;
			}
			.woocommerce ul.products li.product:hover img {
				-ms-transform: rotate(360deg);
				-webkit-transform: rotate(360deg);
				transform: rotate(360deg);
			}
			";
		} elseif( $effect == 'blur' ) {
			$custom_css .= "
			.woocommerce ul.products li.product img {
				-webkit-filter: blur(3px);
				filter: blur(3px);
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out;
			}

			.woocommerce ul.products li.product:hover img {
				-webkit-filter: blur(0px);
				filter: blur(0px);
			}
			";
		} elseif( $effect == 'grayscale' ) {
			$custom_css .= "
			.woocommerce ul.products li.product img {
				-webkit-filter: grayscale(100%);
				filter: grayscale(100%);
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out;
			}

			.woocommerce ul.products li.product:hover img {
				-webkit-filter: grayscale(0%);
				filter: grayscale(0%);
			}
			";
		} elseif( $effect == 'sepia' ) {
			$custom_css .= "
			.woocommerce ul.products li.product img {
				-webkit-filter: sepia(100%);
				filter: sepia(100%);
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out;
			}

			.woocommerce ul.products li.product:hover img {
				-webkit-filter: sepia(0%);
				filter: sepia(0%);
			}
			";
		} elseif( $effect == 'opacity' ) {
			$custom_css .= "
			.woocommerce ul.products li.product a img {
				-webkit-transition: opacity 0.5s ease;
				transition: opacity 0.5s ease;
			}

			.woocommerce ul.products li.product:hover a img {
				opacity: 0.7;
			}
			";
		} elseif( $effect == 'flash' ) {
			$custom_css .= "
			.woocommerce ul.products li.product:hover a img {
				opacity: 1;
				-webkit-animation: recflash 1.5s;
				animation: recflash 1.5s;
			}
			@-webkit-keyframes recflash {
				0% {
					opacity: .4;
				}
				100% {
					opacity: 1;
				}
			}
			@keyframes recflash {
				0% {
					opacity: .4;
				}
				100% {
					opacity: 1;
				}
			}
			";
		} else {
			$custom_css .= "";
		}
		
		wp_add_inline_style( 'di-ecommerce-style-core', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'di_ecommerce_inline_css' );
