<div class="content-third di-entry-content">
	<div class="entry-content" itemprop="text">	
		<?php the_content(); ?>	
		<div class="clearfix pdt20"></div>	
		<?php
		wp_link_pages( array(
				'before'           => '<p class="pagelinks">' . __( 'Pages:', 'di-ecommerce' ),
				'after'            => '</p>',
				'link_before'      => '<span class="pagelinksa">',
				'link_after'       => '</span>',
				)
		);
		?>	
	</div>
</div>