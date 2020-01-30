<?php
get_header();
$archive_layout = get_theme_mod( 'blog_archive_layout', 'rights' );
?>
<div class="<?php if( $archive_layout == 'rights' ) { echo 'col-md-8'; } elseif( $archive_layout == 'lefts' ) { echo 'col-md-8 layoutleftsidebar'; } else { echo 'col-md-12'; } ?>">
	<div class="left-content" >
		
		<?php
		if( have_posts() ) {
			echo '<div class="dimasonry">';

			while( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'loop' );

			endwhile;

			echo '</div>';

			di_ecommerce_posts_pagination();

		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>
	</div>
</div>
<?php if( $archive_layout == 'rights' || $archive_layout == 'lefts' ) { get_sidebar(); } ?>
<?php get_footer(); ?>
