<form class="scp-search__form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="scp-search__input" name="s" type="search" placeholder="<?php esc_attr_e( 'Keywords...', 'di-ecommerce' ); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?php echo get_search_query(); ?>" />
	<span class="scp-search__info"><?php esc_html_e( 'Hit enter to search or ESC to close', 'di-ecommerce' ); ?></span>
	<button type="submit" class="masterbtn display_if_usedas_widget"><span class="fa fa-search" aria-hidden="true"></span></button>
</form>