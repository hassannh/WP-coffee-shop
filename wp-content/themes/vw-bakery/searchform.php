<?php
/**
 * The template for displaying search forms in VW Bakery
 *
 * @package VW Bakery
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:','vw-bakery'); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod('vw_bakery_search_placeholder', __('Search', 'vw-bakery')) ); ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_html_x( 'Search', 'submit button','vw-bakery' ); ?>">
</form>