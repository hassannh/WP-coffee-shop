<?php
/**
 * Cafe Coffee Shop: Block Patterns
 *
 * @package Cafe Coffee Shop
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'cafe-coffee-shop',
		array( 'label' => __( 'Cafe Coffee Shop', 'cafe-coffee-shop' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'cafe-coffee-shop/banner-section',
		array(
			'title'      => __( 'Banner Section', 'cafe-coffee-shop' ),
			'categories' => array( 'cafe-coffee-shop' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_theme_file_uri()) . "/inc/block-patterns/images/banner.png\",\"id\":5584,\"dimRatio\":0,\"align\":\"full\",\"className\":\"banner-section\"} -->\n<div class=\"wp-block-cover alignfull banner-section\" style=\"background-image:url(" . esc_url(get_theme_file_uri()) . "/inc/block-patterns/images/banner.png)\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"verticalAlignment\":\"center\",\"align\":\"full\"} -->\n<div class=\"wp-block-columns alignfull are-vertically-aligned-center\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"style\":{\"color\":{\"text\":\"#afafad\"}}} -->\n<h4 class=\"has-text-align-center has-text-color\" style=\"color:#afafad\">LOREM IPSUM DOLOR SIT</h4>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":1} -->\n<h1 class=\"has-text-align-center\">Lorem ipsum dolor sit amet consectetur</h1>\n<!-- /wp:heading --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'cafe-coffee-shop/about-section',
		array(
			'title'      => __( ' About Section', 'cafe-coffee-shop' ),
			'categories' => array( 'cafe-coffee-shop' ),
			'content'    => "<!-- wp:cover {\"overlayColor\":\"white\",\"align\":\"wide\",\"className\":\"article-outer-box\"} -->\n<div class=\"wp-block-cover alignwide has-white-background-color has-background-dim article-outer-box\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\",\"className\":\"article-container\"} -->\n<div class=\"wp-block-columns alignwide article-container\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"color\":{\"text\":\"#999999\"}}} -->\n<h3 class=\"has-text-align-left has-text-color\" style=\"color:#999999\">OUR STORY</h3>\n<!-- /wp:heading -->\n\n<!-- wp:heading {\"textAlign\":\"left\",\"textColor\":\"black\"} -->\n<h2 class=\"has-text-align-left has-black-color has-text-color\">Lorem Ipsum Dolor Sit Amet<br>Consectetur</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#999999\"}}} -->\n<p class=\"has-text-color\" style=\"color:#999999\">Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons {\"align\":\"left\"} -->\n<div class=\"wp-block-buttons alignleft\"><!-- wp:button {\"borderRadius\":0,\"backgroundColor\":\"white\",\"textColor\":\"black\",\"className\":\"service-btn\"} -->\n<div class=\"wp-block-button service-btn\"><a class=\"wp-block-button__link has-black-color has-white-background-color has-text-color has-background no-border-radius\">RESERVATION</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"align\":\"right\",\"id\":5598,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->\n<div class=\"wp-block-image\"><figure class=\"alignright size-large\"><img src=\"" . esc_url(get_theme_file_uri()) . "/inc/block-patterns/images/services1.png\" alt=\"\" class=\"wp-image-5598\"/></figure></div>\n<!-- /wp:image --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);
}