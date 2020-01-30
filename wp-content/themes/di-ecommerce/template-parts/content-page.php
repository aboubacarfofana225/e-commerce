<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix single-posst di-page-contents'); ?> itemscope itemtype="http://schema.org/CreativeWork">
	<div class="content-first">
				
		<?php
		if( get_post_meta( get_the_id(), '_di_ecommerce_hide_title', true ) != 1 ) {
		?>
			<div class="content-second di-post-title">
				<h1 class="the-title entry-title" itemprop="headline"><?php the_title(); ?></h1>
			</div>
		<?php
		}
		?>
				
		<div class="content-third" itemprop="text">
					
			<div class="entry-content">

				<?php di_ecommerce_post_thumbnail(); ?>

				<?php the_content(); ?>

			</div>
					
			<?php
			wp_link_pages( array(
				'before'           => '<p class="pagelinks">' . __( 'Pages:', 'di-ecommerce' ),
				'after'            => '</p>',
				'link_before'      => '<span class="pagelinksa">',
				'link_after'       => '</span>',
			) );
			?>
					
		</div>
					
	</div>
</div>
