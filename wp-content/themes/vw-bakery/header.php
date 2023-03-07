<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package VW Bakery
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) )
  {
    wp_body_open();
  }else{
    do_action('wp_body_open');
  }
?>

<header role="banner">
  <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'vw-bakery' ); ?></a> 

	<div id="header" class="responsive-menu">
    <?php if(has_nav_menu('responsive-menu')){ ?>
      <div class="toggle-nav mobile-menu">
        <button role="tab" onclick="vw_bakery_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_bakery_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-bakery'); ?></span></button>
      </div>
    <?php } ?>
		<div id="mySidenav" class="nav sidenav">
      <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-bakery' ); ?>">
        <?php 
          if(has_nav_menu('responsive-menu')){
            wp_nav_menu( array( 
              'theme_location' => 'responsive-menu',
              'container_class' => 'main-menu clearfix' ,
              'menu_class' => 'clearfix',
              'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
              'fallback_cb' => 'wp_page_menu',
            ) ); 
          }
        ?>
        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_bakery_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_bakery_res_close_menus_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-bakery'); ?></span></a>
      </nav>
    </div>
	</div>
	<div class="home-page-header">
    <?php get_template_part('template-parts/header/topbar'); ?>
    <?php get_template_part('template-parts/header/header-top'); ?>
	</div>
</header>

<?php if(get_theme_mod('vw_bakery_loader_enable',false) == 1) { ?>
  <div id="preloader">
    <div class="loader-inner">
      <div class="loader-line-wrap">
        <div class="loader-line"></div>
      </div>
      <div class="loader-line-wrap">
        <div class="loader-line"></div>
      </div>
      <div class="loader-line-wrap">
        <div class="loader-line"></div>
      </div>
      <div class="loader-line-wrap">
        <div class="loader-line"></div>
      </div>
      <div class="loader-line-wrap">
        <div class="loader-line"></div>
      </div>
    </div>
  </div>
<?php } ?>