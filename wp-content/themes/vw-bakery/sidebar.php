<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package VW Bakery
 */
?>
<div id="sidebar" <?php if( is_page_template('blog-post-left-sidebar.php')){?> style="float:left;"<?php } ?>>    
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside id="archives" role="complementary" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Archives', 'vw-bakery' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" role="complementary" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Meta', 'vw-bakery' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>	
</div>