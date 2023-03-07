<?php
/**
 * Template Name: Home Page Template
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_bakery_before_slider' ); ?>

  <?php if( get_theme_mod( 'vw_bakery_slider_hide_show', false) == 1 || get_theme_mod( 'vw_bakery_resp_slider_hide_show', false) == 1) { ?>

    <section id="slider">
      <?php if(get_theme_mod('vw_bakery_slider_type', 'Default slider') == 'Default slider' ){ ?>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr(get_theme_mod( 'vw_bakery_slider_speed',4000)) ?>">
        <?php $vw_bakery_slider_pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_bakery_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $vw_bakery_slider_pages[] = $mod;
            }
          }
          if( !empty($vw_bakery_slider_pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $vw_bakery_slider_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php if(has_post_thumbnail()){
                the_post_thumbnail();
              } else{?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/block-patterns/images/banner.png" alt="" />
              <?php } ?>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <div class="inner-carousel-conetnt">
                    <?php if( get_theme_mod('vw_bakery_slider_title_hide_show',true) == 1){ ?>
                      <h1 class="wow rollIn" data-wow-duration="3s"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <?php } ?>
                    <img class="border-width wow rollIn" data-wow-duration="3s" src="<?php echo esc_url( get_theme_mod('',get_template_directory_uri().'/assets/images/titleline.png') ); ?>" alt="slider-title-border">
                    <?php if( get_theme_mod('vw_bakery_slider_content_hide_show',true) == 1){ ?>
                      <p class="wow rollIn" data-wow-duration="3s"><?php $vw_bakery_excerpt = get_the_excerpt(); echo esc_html( vw_bakery_string_limit_words( $vw_bakery_excerpt, esc_attr(get_theme_mod('vw_bakery_slider_excerpt_number','20')))); ?></p>
                    <?php } ?>
                    <?php if( get_theme_mod('vw_bakery_slider_button_text','READ MORE') != ''){ ?>
                      <div class="wow rollIn" data-wow-duration="3s">
                        <a class="more-btn" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_bakery_slider_button_text',__('READ MORE','vw-bakery')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_bakery_slider_button_text',__('READ MORE','vw-bakery')));?></span></a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
          <span class="carousel-control-prev-icon w-auto h-auto" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-bakery' );?></span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
          <span class="carousel-control-next-icon w-auto h-auto" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-bakery' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
        <?php } else if(get_theme_mod('vw_bakery_slider_type', 'Advance slider') == 'Advance slider'){?>
          <?php echo do_shortcode(get_theme_mod('vw_bakery_advance_slider_shortcode')); ?>
        <?php } ?>
    </section>

  <?php } ?>

  <?php do_action( 'vw_bakery_after_slider' ); ?>

  <?php if( get_theme_mod( 'vw_bakery_opening_text') != '' || get_theme_mod( 'vw_bakery_opening_time' )!= '' || get_theme_mod( 'vw_bakery_call_us')!= '' || get_theme_mod( 'vw_bakery_call_no' )!= '' || get_theme_mod( 'vw_bakery_email_us' )!= '' || get_theme_mod( 'vw_bakery_email_address' )!= '' || get_theme_mod( 'vw_bakery_contact_link' )!= '' ) { ?>

  <section id="contact-us" class="wow flipInX delay-1000" data-wow-duration="3s">
    <div class="container">
      <div class="row main-box">
        <div class="col-lg-2 col-md-6 time">
          <?php if ( get_theme_mod('vw_bakery_opening_text','') != "" ) {?>
            <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_timing_icon','far fa-clock')); ?>"></i><span><?php echo esc_html( get_theme_mod('vw_bakery_opening_text','') ); ?></span>
          <?php }?>
          <?php if ( get_theme_mod('vw_bakery_opening_time','') != "" ) {?>
            <p><?php echo esc_html( get_theme_mod('vw_bakery_opening_time','') ); ?></p>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-6 mid-contact">
          <?php if ( get_theme_mod('vw_bakery_call_us','') != "" ) {?>
            <span><?php echo esc_html( get_theme_mod('vw_bakery_call_us','') ); ?></span>
          <?php }?>
          <div class="row">
            <?php if ( get_theme_mod('vw_bakery_call_no','') != "" ) {?>
              <div class="col-lg-2 col-md-2 col-3 mid-icon">
                <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_phone_icon','fas fa-phone')); ?>"></i>
              </div>
              <div class="col-lg-10 col-md-10 col-9">
                <p><a href="tel:<?php echo esc_attr( get_theme_mod('vw_bakery_call_no','') ); ?>"><?php echo esc_html(get_theme_mod('vw_bakery_call_no',''));?></a></p>            
              </div>
            <?php }?>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mid-contact">
          <?php if ( get_theme_mod('vw_bakery_email_us','') != "" ) {?>
            <span><?php echo esc_html( get_theme_mod('vw_bakery_email_us','') ); ?></span>
          <?php }?>
          <div class="row">
            <?php if ( get_theme_mod('vw_bakery_email_address','') != "" ) {?>
              <div class="col-lg-2 col-md-2 col-3 mid-icon">
                <i class="<?php echo esc_attr(get_theme_mod('vw_bakery_email_icon','far fa-envelope')); ?>"></i>
              </div>
              <div class="col-lg-10 col-md-10 col-9">
                <p><a href="mailto:<?php echo esc_attr(get_theme_mod('vw_bakery_email_address',''));?>"><?php echo esc_html(get_theme_mod('vw_bakery_email_address',''));?></a></p>
              </div>
            <?php }?>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <?php if ( get_theme_mod('vw_bakery_contact_link','') != "" ) {?>
            <div class="contact-btn">
              <a href="<?php echo esc_html( get_theme_mod('vw_bakery_contact_link','') ); ?>"><?php echo esc_html(get_theme_mod('vw_bakery_contact_button_text',__('Contact us','vw-bakery')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_bakery_contact_button_text',__('Contact us','vw-bakery')));?></span></a>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </section>

  <?php }?>

  <section id="bakery-product" class="wow bounceInRight delay-1000" data-wow-duration="3s"> 
    <div class="container">
      <?php $vw_bakery_product_page = array();
        $mod = absint( get_theme_mod( 'vw_bakery_product_settings','vw-bakery'));
        if ( 'page-none-selected' != $mod ) {
          $vw_bakery_product_page[] = $mod;
        }
        if( !empty($vw_bakery_product_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_bakery_product_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $count = 0;
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <h2><?php the_title(); ?></h2>
              <img class="product-border" src="<?php echo esc_url( get_theme_mod('',get_template_directory_uri().'/assets/images/titleline.png') ); ?>" alt="product-title-border">
              <?php the_content(); ?>
            <?php $count++; endwhile; ?>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
        endif;
        wp_reset_postdata()
      ?>
    </div>
  </section>

  <?php do_action( 'vw_bakery_after_bakery_product' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>