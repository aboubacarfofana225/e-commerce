<div class="content-third di-posts-content" itemprop="text">
	<div class="entry-content" >
		<?php
		if( get_theme_mod( 'excerpt_or_content', 'excerpt' ) == 'content' ) {
			the_content();
		} else {
			the_excerpt();
		}
		?>
	</div>	
</div>