<?php

if( ! function_exists( 'di_ecommerce_post_navigation' ) ) {
	/**
	 * Post navigation.
	 * @return [type] [description]
	 */
	function di_ecommerce_post_navigation() {
		if( get_previous_post_link() || get_next_post_link() ) {
		?>
			<div class="clearfix"></div>
			<nav class="navigation post-navigation dipostnav" role="navigation">
			 	<?php
				if( get_previous_post_link() ) {
					previous_post_link( '<div class="nav-previous"> %link </div>', '&larr; %title' );
				}
				?>

				<?php
				if( get_next_post_link() ) {
					next_post_link( '<div class="nav-next"> %link </div>', '%title &rarr;' );
				}
				?>
			</nav>
			<div class="clearfix"></div>

		<?php
		}
	}
}

if( ! function_exists( 'di_ecommerce_posts_pagination' ) ) {
	/**
	 * Posts navigation or pagination.
	 * @return [type] [description]
	 */
	function di_ecommerce_posts_pagination() {
		if( get_theme_mod( 'display_archive_pagination', 'nextprev' ) == 'nextprev' ) {
			// Navigation.
			if( get_next_posts_link() || get_previous_posts_link() ) {
			?>
				<div class="clearfix"></div>
				<nav class="navigation post-navigation dipostsnav" role="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '&larr; Older Entries ', 'di-ecommerce' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer Entries &rarr;', 'di-ecommerce' ) ); ?></div>
				</nav>
				<div class="clearfix"></div>
			<?php
			}
		} else {
			// Pagination.
			the_posts_pagination( array(
				'prev_text' => __( '&laquo;', 'di-ecommerce' ),
				'next_text' => __( '&raquo;', 'di-ecommerce' ),
			) );
		}
	}
}

if( ! function_exists( 'di_ecommerce_breadcrumbs' ) ) {
	/**
	 * Breadcrumbs.
	 * @return [type] [description]
	 */
	function di_ecommerce_breadcrumbs() {
		$custom_taxonomy = '';

		// Get the query & post information.
		global $post, $wp_query;

		// Do not display on the homepage.
		if( !is_front_page() ) {

			// Build the breadcrumbs.
			echo '<div class="col-md-12"><nav aria-label="breadcrumb"><ol class="breadcrumb small">';

			// Home page.
			echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'di-ecommerce' ) . '</a></li>';

			if ( is_home() ) {

				echo '<li class="breadcrumb-item active">' . __( 'Blog', 'di-ecommerce' ) . '</li>';

			} elseif( is_archive() && !is_tax() && !is_category() && !is_tag() && !is_year() && !is_month() && !is_day() && !is_author() ) {

				// If post is a custom post type
				$post_type = get_post_type();

				// If it is a custom post type display name and link
				if( $post_type != 'post' ) {
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);
					echo '<li class="breadcrumb-item active">' . esc_html( $post_type_object->labels->name ) . '</li>';
				}

			} elseif( is_archive() && is_tax() && !is_category() && !is_tag() ) {

				// If post is a custom post type
				$post_type = get_post_type();

				// If it is a custom post type display name and link
				if( $post_type != 'post' ) {
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);
					echo '<li class="breadcrumb-item"><a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
				}
				
				$custom_tax_name = get_queried_object()->name;
				echo '<li class="breadcrumb-item active">' . esc_html( $custom_tax_name ) . '</li>';

			} elseif( is_single() ) {

				// If post is a custom post type
				$post_type = get_post_type();

				// If it is a custom post type display name and link
				if( $post_type != 'post' ) {
					$post_type_object = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );
					echo '<li class="breadcrumb-item"><a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
				}

				// Get post category info
				$category = get_the_category();
				$last_category = '';

				if( !empty( $category ) ) {

					// Get last category post is in
					$pre_last_category = array_values( $category );
					$last_category = end( $pre_last_category );

					// Get parent any categories and create array
					$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ),',' );
					$cat_parents = explode( ',', $get_cat_parents );

					// Loop through parent categories and store in variable $cat_display
					$cat_display = '';
						foreach( $cat_parents as $parents ) {
						$cat_display .= '<li class="breadcrumb-item">'.  wp_kses_post( $parents ) .'</li>';
					}

				}

				// If it's a custom post type within a custom taxonomy
				$taxonomy_exists = taxonomy_exists( $custom_taxonomy );

				if( empty( $last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
					$cat_name       = $taxonomy_terms[0]->name;
				}

				// Check if the post is in a category.
				if( !empty( $last_category ) ) {

					echo $cat_display; // Already escaped.
					echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';

				} elseif( !empty( $cat_id ) ) {

					echo '<li class="breadcrumb-item"><a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a></li>';
					echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';

				} else {

					echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';

				}

				} elseif( is_category() ) {

					// Category page.
					echo '<li class="breadcrumb-item active">' . esc_html__( 'Category: ', 'di-ecommerce' ) . single_cat_title( '', false ) . '</li>';

				} elseif( is_page() ) {

					// Standard page.
					if( $post->post_parent ) {

					// If child page, get parents.
					$anc = get_post_ancestors( $post->ID );

					// Get parents in the right order.
					$anc = array_reverse($anc);

					// Parent page loop.
					$parents = '';
					foreach ( $anc as $ancestor ) {
						$parents .= '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
					}

					// Display parent pages.
					echo $parents;

					// Current page.
					echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';

					} else {   
						// Just display current page if not parents.
						echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
					}

				} elseif( is_tag() ) {

					// Get tag information
					$term_id        = get_query_var('tag_id');
					$taxonomy       = 'post_tag';
					$args           = 'include=' . $term_id;
					$terms          = get_terms( $taxonomy, $args );
					$get_term_id    = $terms[0]->term_id;
					$get_term_slug  = $terms[0]->slug;
					$get_term_name  = $terms[0]->name;

					// Display the tag name
					echo '<li class="breadcrumb-item active">' . esc_html__( 'Tag: ', 'di-ecommerce' ) . esc_html( $get_term_name ) . '</li>';

			} elseif( is_day() ) {

				// Year link
				echo '<li class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
				// Month link
				echo '<li class="breadcrumb-item"><a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('F') ) . '</a></li>';
				// Day display
				echo '<li class="breadcrumb-item active">' . esc_html( get_the_time('jS') ) . ' ' . esc_html( get_the_time('F') ) . '</li>';

			} elseif( is_month() ) {

				// Year link.
				echo '<li class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a></li>';
				// Month display.
				echo '<li class="breadcrumb-item active">' . esc_html( get_the_time('F') ) . '</li>';

			} elseif( is_year() ) {

				// Display year archive.
				echo '<li class="breadcrumb-item active">' . esc_html( get_the_time('Y') ) . '</li>';

			} elseif( is_author() ) {

				// Display author name.
				echo '<li class="breadcrumb-item active">' . esc_html__( 'Author: ', 'di-ecommerce' ) . get_the_author() . '</li>';

			} elseif( get_query_var( 'paged' ) ) {

				echo '<li class="breadcrumb-item active">' . esc_html__( 'Page: ', 'di-ecommerce' ) . esc_html( get_query_var( 'paged' ) ) . '</li>';

			} elseif( is_search() ) {

				echo '<li class="breadcrumb-item active">' . esc_html__( 'Search: ', 'di-ecommerce' ) . get_search_query() . '</li>';

			} elseif( is_404() ) {

				echo '<li class="breadcrumb-item active">' . esc_html__( 'Error 404', 'di-ecommerce' ) . '</li>';

			} else {

				echo '<li class="breadcrumb-item active">' . esc_html__( 'Untitled', 'di-ecommerce' ) . '</li>';

			}
			
			echo '</ol></nav></div>';
		}
	}
}

if( ! function_exists( 'di_ecommerce_post_thumbnail' ) ) {
	/**
	 * Post thumbnail section.
	 * @return [type] [description]
	 */
	function di_ecommerce_post_thumbnail() {
		if( has_post_thumbnail() ) {
		?>
			<div class="alignc pdt10 pdb10">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter img-fluid' ) ); ?>
			</div>
		<?php
		}
	}
}


if( ! function_exists( 'di_ecommerce_nav_fallback' ) ) {
	/**
	 * Main menu fallback.
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	function di_ecommerce_nav_fallback( $args ) {
		extract( $args );
		$output = null;
		if( $container ) {
			$output = '<' . $container;
			if ( $container_id ) {
				$output .= ' id="' . $container_id . '"';
			}
			if ( $container_class ) {
				$output .= ' class="' . $container_class . '"';
			}
			$output .= '>';
		}
		
		$output .= '<ul';
		if( $menu_id ) {
			$output .= ' id="' . $menu_id . '"';
		}
		if( $menu_class ) {
			$output .= ' class="' . $menu_class . '"';
		}
		$output .= '>';
		
		$output .= '<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item current_page_item active"><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">'. __( 'Home', 'di-ecommerce' ) .'</a></li>';
		
		if( current_user_can( 'manage_options' ) ) {
			$output .= '<li class="menu-item menu-item-type-custom"><a class="nav-link" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">'. __( 'Add Menu', 'di-ecommerce' ) .'</a></li>';
		}
		
		$output .= '</ul>';
		if( $container ) {
			$output .= '</' . $container . '>';
		}
		echo $output;
	}
}


if( ! function_exists( 'di_ecommerce_comments' ) ) {
	/**
	 * Comment render changes.
	 * @param  [type] $comment [description]
	 * @param  [type] $args    [description]
	 * @param  [type] $depth   [description]
	 * @return [type]          [description]
	 */
	function di_ecommerce_comments( $comment, $args, $depth ) {
	?>
		<div <?php comment_class(); ?>>
			<div class="comment-author vcard" itemtype="http://schema.org/Comment" itemscope itemprop="comment">
				<div id="comment-<?php comment_ID(); ?>" class="dimedia" >
					
					<div class="dimedia-left">
						<?php echo get_avatar( $comment, 60 ); ?>
					</div>
							
					<div class="dimedia-body">
						
						<?php if( get_comment_author_url() ) { ?>
							<h6 class="dimedia-heading fn" itemtype="http://schema.org/Person" itemscope itemprop="author">
								<a class="url" target="_blank" rel="external nofollow" itemprop="url" href="<?php echo esc_url( get_comment_author_url() ); ?>"><span itemprop="name"><?php echo esc_html( get_comment_author() ); ?></span></a>
							</h6>
						<?php } else { ?>
							<h6 class="dimedia-heading fn"><span itemprop="name"><?php echo esc_html( get_comment_author() ); ?></span></h6>
						<?php } ?>
						
						<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="alert alert-info" ><?php esc_html_e( 'Your comment is awaiting approval.', 'di-ecommerce' ); ?></p>
						<?php endif; ?>
								
						<small>
							<a itemprop="url" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"> 
								<?php
								printf(
									/* translators: 1: Published Date, 2: Published Time */
									esc_html__( '%1$s at %2$s', 'di-ecommerce' ),
									'<span itemprop="datePublished">' . esc_html( get_comment_date() ) . '</span>', 
									esc_html( get_comment_time() ) );
								?>	
							</a>
						</small>
						
						<div itemprop="text"><?php comment_text(); ?></div>
						
						<small>
						<?php comment_reply_link( array_merge( $args,
							array(
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => __( 'Reply', 'di-ecommerce' ),
								)
						) );
						?>
						
						<?php edit_comment_link( __( 'Edit', 'di-ecommerce' ), '', '' ) ?>
						</small>
						
					</div>
				</div>
			</div>
	<!--</div> is added by WordPress automatically -->
	<?php
	}
}
