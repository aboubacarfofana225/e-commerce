<?php get_header(); ?>
<div class="col-md-8">
	<div class="left-content" >
		<div class="content-first single-posst di-page-contents">

			<div class="content-second di-post-title">
				<h1 class="the-title entry-title" itemprop="headline"><?php esc_html_e( 'Oops! That page can not be found.', 'di-ecommerce' ); ?></h1>
			</div>
			
			<div class="content-third">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'di-ecommerce' ); ?></p>
				<br />
				<?php get_search_form(); ?>
			</div>
			
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
