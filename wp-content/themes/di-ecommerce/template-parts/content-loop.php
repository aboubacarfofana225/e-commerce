<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix postsloop dimasonrybox di-post-contents di-archive'); ?> itemscope itemtype="http://schema.org/CreativeWork">
	
	<div class="content-first">
		<?php
		$template_parts = get_theme_mod( 'archive_structure', array( 'categories', 'loop_headline', 'date', 'featured_image', 'loop_content' ) );
		if ( ! empty( $template_parts ) && is_array( $template_parts ) ) {
			foreach ( $template_parts as $part ) {
				get_template_part( 'template-parts/post-parts/post-' . $part );
			}
		}
		?>
	</div>

</div>