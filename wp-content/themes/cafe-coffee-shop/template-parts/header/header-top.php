<?php
/**
 * The template part for header
 *
 * @package Cafe Coffee Shop
 * @subpackage cafe_coffee_shop
 * @since Cafe Coffee Shop 1.0
 */
?>

<div id="heade-top">
  <div class="container">
    <div class="row">      
      <div class="col-lg-4 col-md-4 left-box align-self-center">
        <?php if ( get_theme_mod('vw_bakery_call_us','') != "" || get_theme_mod('vw_bakery_call_no','') != "" ) {?>
        <div class="row">
          <div class="col-lg-10 col-md-10 col-7">
            <?php if ( get_theme_mod('vw_bakery_call_us','') != "" ) {?>
              <p><?php echo esc_html( get_theme_mod('vw_bakery_call_us','') ); ?></p>
            <?php }?>
            <?php if ( get_theme_mod('vw_bakery_call_no','') != "" ) {?>
              <p><a href="tel:<?php echo esc_attr( get_theme_mod('vw_bakery_call_no','') ); ?>"><?php echo esc_html(get_theme_mod('vw_bakery_call_no',''));?></a></p>
            <?php }?>
          </div>
          <div class="col-lg-2 col-md-2 col-5 phone">
            <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_phone_icon','fas fa-phone-volume')); ?>"></i>
          </div>
        </div>
        <?php }?>
      </div>      
      <div class="col-lg-4 col-md-4 align-self-center">
        <div class="logo">
          <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php endif; ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( is_front_page() && is_home() ) : ?>
                <?php if( get_theme_mod('vw_bakery_logo_title_hide_show',true) == 1){ ?>
                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php } ?>
              <?php else : ?>
                <?php if( get_theme_mod('vw_bakery_logo_title_hide_show',true) == 1){ ?>
                  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
            <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
            ?>
            <?php if( get_theme_mod('vw_bakery_tagline_hide_show',false) == 1){ ?>
              <p class="site-description">
                <?php echo esc_html( $description ); ?>
              </p>
            <?php } ?>
          <?php endif; ?>
        </div>
      </div>      
      <div class="col-lg-4 col-md-4 right-box align-self-center">
        <?php if ( get_theme_mod('vw_bakery_email_us','') != "" || get_theme_mod('vw_bakery_email_address','') != "" ) {?>
        <div class="row">
          <div class="col-lg-2 col-md-3 col-5 email">
            <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_email_icon','fas fa-envelope-open')); ?>"></i>
          </div>
          <div class="col-lg-10 col-md-9 col-7">
            <?php if ( get_theme_mod('vw_bakery_email_us','') != "" ) {?>
              <p><?php echo esc_html( get_theme_mod('vw_bakery_email_us','') ); ?></p>
            <?php }?>
            <?php if ( get_theme_mod('vw_bakery_email_address','') != "" ) {?>
              <p><a href="mailto:<?php echo esc_attr(get_theme_mod('vw_bakery_email_address',''));?>"><?php echo esc_html(get_theme_mod('vw_bakery_email_address',''));?></a></p>
            <?php }?>
          </div>
        </div>
        <?php }?>
      </div>      
    </div>
  </div>
</div>