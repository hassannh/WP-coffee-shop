<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package Cafe Coffee Shop
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
  <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'cafe-coffee-shop' ); ?></a> 

  <div id="header">
    <?php get_template_part('template-parts/header/header-top'); ?>

    <div class="container">
      <div class="nav-header">
        <div class="row">
          <div class="col-lg-11 col-md-11 col-9 align-self-center">
            <?php if(has_nav_menu('primary-left')){ ?>
              <div class="toggle-nav mobile-menu">
                <button role="tab" onclick="cafe_coffee_shop_menu_open_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_bakery_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','cafe-coffee-shop'); ?></span></button>
              </div>
            <?php } ?>
        		<div id="mySidenav" class="nav sidenav">
              <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'cafe-coffee-shop' ); ?>">
                <?php
                  if(has_nav_menu('primary-left')){ 
                    wp_nav_menu( array( 
                      'theme_location' => 'primary-left',
                      'container_class' => 'main-menu clearfix' ,
                      'menu_class' => 'clearfix',
                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                      'fallback_cb' => 'wp_page_menu',
                    ) ); 
                  }
                ?>
                <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="cafe_coffee_shop_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_bakery_res_close_menus_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','cafe-coffee-shop'); ?></span></a>
              </nav>
            </div>
          </div>
          <div class="col-lg-1 col-md-1 col-3 align-self-center">
            <div class="search-box">
              <span><a href="#"><i class="fas fa-search"></i></a></span>
            </div>
          </div>
        </div>
        <div class="serach_outer">
          <div class="closepop"><a href="#maincontent"><i class="fa fa-window-close"></i></a></div>
          <div class="serach_inner">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<?php if(get_theme_mod('vw_bakery_loader_enable',false) != '') { ?>
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