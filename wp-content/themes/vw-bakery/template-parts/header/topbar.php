<?php
/**
 * The template part for Topbar
 *
 * @package VW Bakery 
 * @subpackage vw_bakery
 * @since VW Bakery 1.0
 */
?>

<?php if( get_theme_mod( 'vw_bakery_topbar_hide_show', false) == 1 || get_theme_mod( 'vw_bakery_resp_topbar_hide_show', false) == 1) { ?>
  <div id="topbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5 location">
          <?php if ( get_theme_mod('vw_bakery_location','') != "" ) {?>
            <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_location_address_icon','fas fa-location-arrow')); ?>"></i><span><?php echo esc_html( get_theme_mod('vw_bakery_location','') ); ?></span>
          <?php }?>
        </div>
        <div class="col-lg-2 col-md-1">
        </div>
        <div class="col-lg-4 col-md-5 col-9">
          <?php dynamic_sidebar('social-icon'); ?>
        </div>
        <div class="col-lg-1 col-md-1 col-3">
          <div class="cart_box">
            <span class="hi_normal"><i class="<?php echo esc_attr(get_theme_mod('vw_bakery_cart_icon','fas fa-shopping-cart')); ?>"></i></span>
            <div class="top-cart-content">
              <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>