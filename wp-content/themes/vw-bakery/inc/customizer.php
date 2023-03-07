<?php
/**
 * VW Bakery Theme Customizer
 *
 * @package VW Bakery
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_bakery_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_bakery_custom_controls' );

function vw_bakery_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_bakery_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_bakery_customize_partial_blogdescription', 
	));

	//Homepage Settings
	$wp_customize->add_panel( 'vw_bakery_homepage_panel', array(
		'title' => esc_html__( 'Homepage Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_panel_id',
		'priority' => 20,
	));

	//Contact us
	$wp_customize->add_section('vw_bakery_topbar',array(
		'title'	=> __('Contact Section','vw-bakery'),
		'description'=> __('This section will appear in the topbar and below slider','vw-bakery'),
		'priority'   => 3,
		'panel' => 'vw_bakery_homepage_panel',
	));	

	$wp_customize->add_setting( 'vw_bakery_topbar_hide_show',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_topbar_hide_show',array(
		'label' => esc_html__( 'Show / Hide Topbar','vw-bakery' ),
		'section' => 'vw_bakery_topbar'
    )));

    $wp_customize->add_setting('vw_bakery_topbar_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_topbar_padding_top_bottom',array(
		'label'	=> __('Topbar Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_topbar',
		'type'=> 'text'
	));

    //Sticky Header
	$wp_customize->add_setting( 'vw_bakery_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-bakery' ),
        'section' => 'vw_bakery_topbar'
    )));

    $wp_customize->add_setting('vw_bakery_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_navigation_menu_font_weight',array(
        'default' => 'Default',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-bakery'),
        'section' => 'vw_bakery_topbar',
        'choices' => array(
        	'Default' => __('Default','vw-bakery'),
            'Normal' => __('Normal','vw-bakery')
        ),
	) );

	$wp_customize->add_setting('vw_bakery_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-bakery'),
		'section'  => 'vw_bakery_topbar',
	)));

	$wp_customize->add_setting('vw_bakery_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-bakery'),
		'section'  => 'vw_bakery_topbar',
	)));

	$wp_customize->add_setting('vw_bakery_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-bakery'),
		'section'  => 'vw_bakery_topbar',
	)));

	$wp_customize->add_setting('vw_bakery_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-bakery'),
		'section'  => 'vw_bakery_topbar',
	)));

	$wp_customize->add_setting('vw_bakery_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_menus_item_style',array(
        'type' => 'select',
        'section' => 'vw_bakery_topbar',
		'label' => __('Menu Item Hover Style','vw-bakery'),
		'choices' => array(
            'None' => __('None','vw-bakery'),
            'Zoom In' => __('Zoom In','vw-bakery'),
        ),
	) );

    $wp_customize->add_setting( 'vw_bakery_search_hide_show',
       array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_search_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Search','vw-bakery' ),
      'section' => 'vw_bakery_topbar'
    )));

    $wp_customize->add_setting('vw_bakery_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_search_icon',array(
		'label'	=> __('Add Search Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('vw_bakery_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_search_font_size',array(
		'label'	=> __('Search Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_search_placeholder',array(
       'default' => esc_html__('Search','vw-bakery'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_bakery_search_placeholder',array(
       'type' => 'text',
       'label' => __('Search Placeholder Text','vw-bakery'),
       'section' => 'vw_bakery_topbar'
    ));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_location', array( 
		'selector' => '.location span', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_location', 
	));

    $wp_customize->add_setting('vw_bakery_location_address_icon',array(
		'default'	=> 'fas fa-location-arrow',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_location_address_icon',array(
		'label'	=> __('Add Location Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_location_address_icon',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting('vw_bakery_location',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_location',array(
		'label'	=> __('Location','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_location',
		'type'=> 'text'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_opening_text', array( 
		'selector' => '.time span', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_opening_text', 
	));

	$wp_customize->add_setting('vw_bakery_timing_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_timing_icon',array(
		'label'	=> __('Add Timing Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_timing_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_opening_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_opening_text',array(
		'label'	=> __('Opening Time Text','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_opening_text',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_opening_time',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_opening_time',array(
		'label'	=> __('Opening Time','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_opening_time',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_phone_icon',array(
		'label'	=> __('Add Call Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_call_us',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_call_us',array(
		'label'	=> __('Phone no. Text','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_call_us',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_call_no',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_bakery_sanitize_phone_number'
	));	
	$wp_customize->add_control('vw_bakery_call_no',array(
		'label'	=> __('Phone Number','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_call_no',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_email_icon',array(
		'label'	=> __('Add Email Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_email_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_email_us',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_email_us',array(
		'label'	=> __('Email Text','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_email_us',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('vw_bakery_email_address',array(
		'label'	=> __('Email Address','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_email_address',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_contact_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_contact_button_text',array(
		'label'	=> __('Contact Button Text','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_contact_button_text',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_contact_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vw_bakery_contact_link',array(
		'label'	=> __('Contact Link','vw-bakery'),
		'section'=> 'vw_bakery_topbar',
		'setting'=> 'vw_bakery_contact_link',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_bakery_cart_icon',array(
		'default'	=> 'fas fa-shopping-cart',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_cart_icon',array(
		'label'	=> __('Add Cart Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_topbar',
		'setting'	=> 'vw_bakery_cart_icon',
		'type'		=> 'icon'
	)));

	//Social
	$wp_customize->add_section(
		'vw_bakery_social_links', array(
			'title'		=>	__('Social Links', 'vw-bakery'),
			'priority'	=>	3,
			'panel'		=>	'vw_bakery_homepage_panel'
		)
	);

	$wp_customize->add_setting('vw_bakery_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icons',array(
		'label' =>  __('Steps to setup social icons','vw-bakery'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Social Icon Media Widget area.</p>
			<p>3. Add social icons url and save.</p>','vw-bakery'),
		'section'=> 'vw_bakery_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('vw_bakery_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'vw_bakery_social_links',
		'type'=> 'hidden'
	));

	//Slider
	$wp_customize->add_section( 'vw_bakery_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-bakery' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/bakery-wordpress-theme/">GO PRO</a>','vw-bakery'),
		'priority'   => 10,
		'panel' => 'vw_bakery_homepage_panel'
	) );

	$wp_customize->add_setting( 'vw_bakery_slider_hide_show',
       array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
   $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_slider_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Slider','vw-bakery' ),
      'section' => 'vw_bakery_slidersettings'
    )));

   $wp_customize->add_setting('vw_bakery_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	) );
	$wp_customize->add_control('vw_bakery_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-bakery'),
        'section' => 'vw_bakery_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-bakery'),
            'Advance slider' => __('Advance slider','vw-bakery'),
        ),
	));

	$wp_customize->add_setting('vw_bakery_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-bakery'),
		'section'=> 'vw_bakery_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_bakery_advance_slider'
	));

   //Selective Refresh
   $wp_customize->selective_refresh->add_partial('vw_bakery_slider_hide_show',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_slider_hide_show',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_bakery_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_bakery_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_bakery_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-bakery' ),
			'description' => __('Slider image size (1500 x 600)','vw-bakery'),
			'section'  => 'vw_bakery_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_bakery_default_slider'
		) );
	}

	$wp_customize->add_setting('vw_bakery_slider_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_bakery_default_slider'
	));

	$wp_customize->add_setting( 'vw_bakery_slider_title_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_slider_title_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Title','vw-bakery' ),
		'section' => 'vw_bakery_slidersettings',
		'active_callback' => 'vw_bakery_default_slider'
    )));

	$wp_customize->add_setting( 'vw_bakery_slider_content_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_slider_content_hide_show',array(
		'label' => esc_html__( 'Show / Hide Slider Content','vw-bakery' ),
		'section' => 'vw_bakery_slidersettings',
		'active_callback' => 'vw_bakery_default_slider'
    )
 	));

	//content layout
	$wp_customize->add_setting('vw_bakery_slider_content_option',array(
        'default' => 'Center',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Bakery_Image_Radio_Control($wp_customize, 'vw_bakery_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-bakery'),
        'section' => 'vw_bakery_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ),
     		'active_callback' => 'vw_bakery_default_slider'
  	)));

    //Slider content padding
    $wp_customize->add_setting('vw_bakery_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in %. Example:20%','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_bakery_default_slider'
	));

	$wp_customize->add_setting('vw_bakery_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','vw-bakery'),
		'description'	=> __('Enter a value in %. Example:20%','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_bakery_default_slider'
	));

   //Slider excerpt
	$wp_customize->add_setting( 'vw_bakery_slider_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-bakery' ),
		'section'     => 'vw_bakery_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_bakery_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
		'active_callback' => 'vw_bakery_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('vw_bakery_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_bakery_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-bakery' ),
		'section'     => 'vw_bakery_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_bakery_slider_opacity_color',
		'choices' => array(
	      '0' =>  esc_attr('0','vw-bakery'),
	      '0.1' =>  esc_attr('0.1','vw-bakery'),
	      '0.2' =>  esc_attr('0.2','vw-bakery'),
	      '0.3' =>  esc_attr('0.3','vw-bakery'),
	      '0.4' =>  esc_attr('0.4','vw-bakery'),
	      '0.5' =>  esc_attr('0.5','vw-bakery'),
	      '0.6' =>  esc_attr('0.6','vw-bakery'),
	      '0.7' =>  esc_attr('0.7','vw-bakery'),
	      '0.8' =>  esc_attr('0.8','vw-bakery'),
	      '0.9' =>  esc_attr('0.9','vw-bakery')
		),
		'active_callback' => 'vw_bakery_default_slider'
	));

	$wp_customize->add_setting( 'vw_bakery_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_bakery_switch_sanitization'
   ));
   $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_slider_image_overlay',array(
      	'label' => esc_html__( 'Slider Image Overlay','vw-bakery' ),
      	'section' => 'vw_bakery_slidersettings',
      	'active_callback' => 'vw_bakery_default_slider'
   )));

   $wp_customize->add_setting('vw_bakery_slider_image_overlay_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-bakery'),
		'section'  => 'vw_bakery_slidersettings',
		'active_callback' => 'vw_bakery_default_slider'
	)));

	//Slider height
	$wp_customize->add_setting('vw_bakery_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_slider_height',array(
		'label'	=> __('Slider Height','vw-bakery'),
		'description'	=> __('Specify the slider height (px).','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_bakery_default_slider'
	));

	$wp_customize->add_setting( 'vw_bakery_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'vw_bakery_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_bakery_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-bakery'),
		'section' => 'vw_bakery_slidersettings',
		'type'  => 'number',
		'active_callback' => 'vw_bakery_default_slider'
	) );

	//About Section
	$wp_customize->add_section('vw_bakery_about', array(
		'title'       => __('About Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_about_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_about_text',array(
		'description' => __('<p>1. More options for About section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for About section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_about',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_about_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_about_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_about',
		'type'=> 'hidden'
	));

	//Services Section
	$wp_customize->add_section('vw_bakery_services', array(
		'title'       => __('Services Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_services_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_services_text',array(
		'description' => __('<p>1. More options for Services section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Services section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_services',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_services_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_services_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_services',
		'type'=> 'hidden'
	));

	//Bakery Products
	$wp_customize->add_section( 'vw_bakery_product_section' , array(
    	'title'      => __( 'Bakery products', 'vw-bakery' ),
    	'description' => __('For more options of the products section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/bakery-wordpress-theme/">GO PRO</a>','vw-bakery'),
		'priority'   => null,
		'panel' => 'vw_bakery_homepage_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_bakery_product_settings', array( 
		'selector' => '#bakery-product h2', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_product_settings',
	));

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'vw_bakery_product_settings', array(
		'default'           => '',
		'sanitize_callback' => 'vw_bakery_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_bakery_product_settings', array(
		'label'    => __( 'Select Product Page', 'vw-bakery' ),
		'section'  => 'vw_bakery_product_section',
		'type'     => 'dropdown-pages'
	) );	

	//Our Records Section
	$wp_customize->add_section('vw_bakery_records', array(
		'title'       => __('Our Records Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_records_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_records_text',array(
		'description' => __('<p>1. More options for Our Records section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Records section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_records',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_records_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_records_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_records',
		'type'=> 'hidden'
	));

	//VW Gallery Section
	$wp_customize->add_section('vw_bakery_gallery', array(
		'title'       => __('Gallery Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_gallery_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_gallery_text',array(
		'description' => __('<p>1. More options for Gallery section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Gallery section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_gallery',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_gallery_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_gallery_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_gallery',
		'type'=> 'hidden'
	));

	//Our Skills Section
	$wp_customize->add_section('vw_bakery_skills', array(
		'title'       => __('Our Skills Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_skills_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_skills_text',array(
		'description' => __('<p>1. More options for Our Skills section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Our Skills section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_skills',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_skills_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_skills_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_skills',
		'type'=> 'hidden'
	));

	//Team Section
	$wp_customize->add_section('vw_bakery_team', array(
		'title'       => __('Team Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_team_text',array(
		'description' => __('<p>1. More options for Team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Team section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_team',
		'type'=> 'hidden'
	));

	//Testimonial Section
	$wp_customize->add_section('vw_bakery_testimonial', array(
		'title'       => __('Testimonial Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_testimonial_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_testimonial_text',array(
		'description' => __('<p>1. More options for Testimonial section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Testimonial section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_testimonial',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_testimonial_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_testimonial_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_testimonial',
		'type'=> 'hidden'
	));

	//Latest Post Section
	$wp_customize->add_section('vw_bakery_latest_post', array(
		'title'       => __('Latest Post Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_latest_post_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_latest_post_text',array(
		'description' => __('<p>1. More options for Latest Post section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Latest Post section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_latest_post',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_latest_post_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_latest_post_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_latest_post',
		'type'=> 'hidden'
	));

	//Get In Touch Section
	$wp_customize->add_section('vw_bakery_get_in_touch', array(
		'title'       => __('Get In Touch Section', 'vw-bakery'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-bakery'),
		'priority'    => null,
		'panel'       => 'vw_bakery_homepage_panel',
	));

	$wp_customize->add_setting('vw_bakery_get_in_touch_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_get_in_touch_text',array(
		'description' => __('<p>1. More options for Get In Touch section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for Get In Touch section.</p>','vw-bakery'),
		'section'=> 'vw_bakery_get_in_touch',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_bakery_get_in_touch_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_get_in_touch_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url(VW_BAKERY_GETSTARTED_URL) ." '>More Info</a>",
		'section'=> 'vw_bakery_get_in_touch',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_bakery_footer',array(
		'title'	=> __('Footer','vw-bakery'),
		'description' => __('For more options of the footer section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/themes/bakery-wordpress-theme/">GO PRO</a>','vw-bakery'),
		'panel' => 'vw_bakery_homepage_panel',
	));	

	$wp_customize->add_setting('vw_bakery_footer_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-bakery'),
		'section'  => 'vw_bakery_footer',
	)));

	$wp_customize->add_setting('vw_bakery_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_bakery_footer_background_image',array(
        'label' => __('Footer Background Image','vw-bakery'),
        'section' => 'vw_bakery_footer'
	)));

	// footer padding
	$wp_customize->add_setting('vw_bakery_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-bakery' ),
    ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-bakery'),
        'section' => 'vw_bakery_footer',
        'choices' => array(
        	'Left' => __('Left','vw-bakery'),
            'Center' => __('Center','vw-bakery'),
            'Right' => __('Right','vw-bakery')
        ),
	) );

	$wp_customize->add_setting('vw_bakery_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-bakery'),
        'section' => 'vw_bakery_footer',
        'choices' => array(
        	'Left' => __('Left','vw-bakery'),
            'Center' => __('Center','vw-bakery'),
            'Right' => __('Right','vw-bakery')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_footer_text', array( 
		'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_footer_text', 
	));
	
	$wp_customize->add_setting('vw_bakery_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_bakery_footer_text',array(
		'label'	=> __('Copyright Text','vw-bakery'),
		'section'=> 'vw_bakery_footer',
		'setting'=> 'vw_bakery_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_bakery_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

    $wp_customize->add_setting('vw_bakery_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Bakery_Image_Radio_Control($wp_customize, 'vw_bakery_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-bakery'),
        'section' => 'vw_bakery_footer',
        'settings' => 'vw_bakery_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    // footer social icon
  	$wp_customize->add_setting( 'vw_bakery_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_footer_icon',array(
		'label' => esc_html__( 'Footer Social Icon','vw-bakery' ),
		'section' => 'vw_bakery_footer'
    )));

	$wp_customize->add_setting( 'vw_bakery_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-bakery' ),
      	'section' => 'vw_bakery_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_bakery_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_footer',
		'setting'	=> 'vw_bakery_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-bakery'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_bakery_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Bakery_Image_Radio_Control($wp_customize, 'vw_bakery_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-bakery'),
        'section' => 'vw_bakery_footer',
        'settings' => 'vw_bakery_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

	//Blog Post Settings
	$wp_customize->add_panel( 'vw_bakery_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_bakery_post_settings', array(
		'title' => __( 'Post Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_toggle_postdate', 
	));

  	$wp_customize->add_setting('vw_bakery_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_post_settings',
		'setting'	=> 'vw_bakery_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_bakery_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-bakery' ),
        'section' => 'vw_bakery_post_settings'
    )));

    $wp_customize->add_setting('vw_bakery_toggle_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_post_settings',
		'setting'	=> 'vw_bakery_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_bakery_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_toggle_author',array(
		'label' => esc_html__( 'Author','vw-bakery' ),
		'section' => 'vw_bakery_post_settings'
    )));

    $wp_customize->add_setting('vw_bakery_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_post_settings',
		'setting'	=> 'vw_bakery_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_bakery_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-bakery' ),
		'section' => 'vw_bakery_post_settings'
    )));

  	$wp_customize->add_setting('vw_bakery_toggle_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_post_settings',
		'setting'	=> 'vw_bakery_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_bakery_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_toggle_time',array(
		'label' => esc_html__( 'Time','vw-bakery' ),
		'section' => 'vw_bakery_post_settings'
    )));

    $wp_customize->add_setting( 'vw_bakery_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_featured_image_hide_show', array(
		'label' => esc_html__( 'Featured Image','vw-bakery' ),
		'section' => 'vw_bakery_post_settings'
    )));

    $wp_customize->add_setting( 'vw_bakery_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_bakery_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-bakery' ),
		'section'     => 'vw_bakery_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting( 'vw_bakery_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-bakery' ),
		'section'     => 'vw_bakery_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_bakery_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_bakery_meta_field_separator',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-bakery'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-bakery'),
		'section'=> 'vw_bakery_post_settings',
		'type'=> 'text'
	));

	//Blog layout
    $wp_customize->add_setting('vw_bakery_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Bakery_Image_Radio_Control($wp_customize, 'vw_bakery_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-bakery'),
        'section' => 'vw_bakery_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

   	$wp_customize->add_setting('vw_bakery_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Page posts','vw-bakery'),
        'section' => 'vw_bakery_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-bakery'),
            'Without Blocks' => __('Without Blocks','vw-bakery')
        ),
	) );

    $wp_customize->add_setting('vw_bakery_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-bakery'),
        'section' => 'vw_bakery_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-bakery'),
            'Excerpt' => __('Excerpt','vw-bakery'),
            'No Content' => __('No Content','vw-bakery')
        ),
	) );

	$wp_customize->add_setting('vw_bakery_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-bakery' ),
      'section' => 'vw_bakery_post_settings'
    )));

	$wp_customize->add_setting( 'vw_bakery_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_bakery_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_bakery_blog_pagination_type', array(
        'section' => 'vw_bakery_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-bakery' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-bakery' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-bakery' ),
    )));

    	//Featured Image
	$wp_customize->add_setting('vw_bakery_blog_post_featured_image_dimension',array(
	       'default' => 'default',
	       'sanitize_callback'	=> 'vw_bakery_sanitize_choices'
	));
  $wp_customize->add_control('vw_bakery_blog_post_featured_image_dimension',array(
     'type' => 'select',
     'label'	=> __('Blog Post Featured Image Dimension','vw-bakery'),
     'section'	=> 'vw_bakery_post_settings',
     'choices' => array(
          'default' => __('Default','vw-bakery'),
          'custom' => __('Custom Image Size','vw-bakery'),
      ),
  ));

	$wp_customize->add_setting('vw_bakery_blog_post_featured_image_custom_width',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_bakery_blog_post_featured_image_custom_width',array(
			'label'	=> __('Featured Image Custom Width','vw-bakery'),
			'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
			'input_attrs' => array(
	    'placeholder' => __( '10px', 'vw-bakery' ),),
			'section'=> 'vw_bakery_post_settings',
			'type'=> 'text',
			'active_callback' => 'vw_bakery_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_bakery_blog_post_featured_image_custom_height',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_blog_post_featured_image_custom_height',array(
			'label'	=> __('Featured Image Custom Height','vw-bakery'),
			'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
			'input_attrs' => array(
	    'placeholder' => __( '10px', 'vw-bakery' ),),
			'section'=> 'vw_bakery_post_settings',
			'type'=> 'text',
			'active_callback' => 'vw_bakery_blog_post_featured_image_dimension'
	));

    // Button Settings
	$wp_customize->add_section( 'vw_bakery_button_settings', array(
		'title' => __( 'Button Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_bakery_button_border',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_button_border',array(
        'label' => esc_html__( 'Button Border','vw-bakery' ),
        'section' => 'vw_bakery_button_settings'
    )));

	$wp_customize->add_setting('vw_bakery_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	// font size button
	$wp_customize->add_setting('vw_bakery_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_button_font_size',array(
		'label'	=> __('Button Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-bakery' ),
    ),
    'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_bakery_button_settings',
	));

	$wp_customize->add_setting('vw_bakery_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-bakery' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_bakery_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('vw_bakery_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-bakery'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-bakery'),
            'Capitalize' => __('Capitalize','vw-bakery'),
            'Lowercase' => __('Lowercase','vw-bakery'),
        ),
		'section'=> 'vw_bakery_button_settings',
	));


	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_button_text', array( 
		'selector' => '.post-main-box a.content-bttn', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_button_text', 
	));

    $wp_customize->add_setting('vw_bakery_button_text',array(
		'default'=> esc_html__( 'READ MORE', 'vw-bakery' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_button_text',array(
		'label'	=> __('Add Button Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'READ MORE', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_bakery_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_bakery_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_bakery_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_related_post',array(
		'label' => esc_html__( 'Related Post','vw-bakery' ),
		'section' => 'vw_bakery_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_bakery_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_bakery_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_bakery_sanitize_float'
	));
	$wp_customize->add_control('vw_bakery_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_bakery_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-bakery' ),
		'section'     => 'vw_bakery_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_bakery_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'vw_bakery_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_bakery_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_bakery_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_postdate',array(
	    'label' => esc_html__( 'Date','vw-bakery' ),
	   'section' => 'vw_bakery_single_blog_settings'
	)));

    $wp_customize->add_setting( 'vw_bakery_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_bakery_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_author',array(
	    'label' => esc_html__( 'Author','vw-bakery' ),
	    'section' => 'vw_bakery_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_bakery_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_bakery_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_comments',array(
	    'label' => esc_html__( 'Comments','vw-bakery' ),
	    'section' => 'vw_bakery_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_bakery_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_bakery_switch_sanitization'
	) );

	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_time',array(
	    'label' => esc_html__( 'Time','vw-bakery' ),
	    'section' => 'vw_bakery_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_bakery_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_post_breadcrumb',array(
		'label' => esc_html__( 'Single Post Breadcrumb','vw-bakery' ),
		'section' => 'vw_bakery_single_blog_settings'
    )));

    // Single Posts Category
  	$wp_customize->add_setting( 'vw_bakery_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_post_category',array(
		'label' => esc_html__( 'Single Post Category','vw-bakery' ),
		'section' => 'vw_bakery_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_bakery_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-bakery' ),
		'section' => 'vw_bakery_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_bakery_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Post Navigation','vw-bakery' ),
		'section' => 'vw_bakery_single_blog_settings'
    )));

   	$wp_customize->add_setting('vw_bakery_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-bakery'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-bakery'),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	//navigation text
	$wp_customize->add_setting('vw_bakery_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_single_blog_comment_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_single_blog_comment_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','vw-bakery'),
		'description'	=> __('Enter a value in %. Example:50%','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'vw_bakery_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_bakery_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_grid_postdate',array(
        'label' => esc_html__( 'Post Date','vw-bakery' ),
        'section' => 'vw_bakery_grid_layout_settings'
    )));

    $wp_customize->add_setting( 'vw_bakery_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_grid_author',array(
		'label' => esc_html__( 'Author','vw-bakery' ),
		'section' => 'vw_bakery_grid_layout_settings'
    )));

    $wp_customize->add_setting( 'vw_bakery_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_grid_comments',array(
		'label' => esc_html__( 'Comments','vw-bakery' ),
		'section' => 'vw_bakery_grid_layout_settings'
    )));

	//Others Settings
	$wp_customize->add_panel( 'vw_bakery_others_panel', array(
		'title' => esc_html__( 'Others Settings', 'vw-bakery' ),
		'panel' => 'vw_bakery_panel_id',
		'priority' => 20,
	));

	$wp_customize->add_section( 'vw_bakery_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'vw-bakery' ),
		'priority'   => 10,
		'panel' => 'vw_bakery_others_panel'
	) );

	$wp_customize->add_setting('vw_bakery_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Bakery_Image_Radio_Control($wp_customize, 'vw_bakery_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-bakery'),
        'description' => __('Here you can change the width layout of Website.','vw-bakery'),
        'section' => 'vw_bakery_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_bakery_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_bakery_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-bakery'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-bakery'),
        'section' => 'vw_bakery_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-bakery'),
            'Right Sidebar' => __('Right Sidebar','vw-bakery'),
            'One Column' => __('One Column','vw-bakery'),
            'Three Columns' => __('Three Columns','vw-bakery'),
            'Four Columns' => __('Four Columns','vw-bakery'),
            'Grid Layout' => __('Grid Layout','vw-bakery')
        ),
	));

	$wp_customize->add_setting('vw_bakery_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-bakery'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-bakery'),
        'section' => 'vw_bakery_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-bakery'),
            'Right Sidebar' => __('Right Sidebar','vw-bakery'),
            'One Column' => __('One Column','vw-bakery')
        ),
	) );

	$wp_customize->add_setting( 'vw_bakery_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_single_page_breadcrumb',array(
		'label' => esc_html__( 'Single Page Breadcrumb','vw-bakery' ),
		'section' => 'vw_bakery_left_right'
    )));

	//Wow Animation
	$wp_customize->add_setting( 'vw_bakery_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_animation',array(
        'label' => esc_html__( 'Animations','vw-bakery' ),
        'description' => __('Here you can disable overall site animation effect','vw-bakery'),
        'section' => 'vw_bakery_left_right'
    )));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_bakery_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-bakery' ),
        'section' => 'vw_bakery_left_right'
    )));

	$wp_customize->add_setting('vw_bakery_preloader_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-bakery'),
		'section'  => 'vw_bakery_left_right',
	)));

	$wp_customize->add_setting('vw_bakery_preloader_border_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-bakery'),
		'section'  => 'vw_bakery_left_right',
	)));

    //404 Page Setting
	$wp_customize->add_section('vw_bakery_404_page',array(
		'title'	=> __('404 Page Settings','vw-bakery'),
		'panel' => 'vw_bakery_others_panel',
	));	

	$wp_customize->add_setting('vw_bakery_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_404_page_title',array(
		'label'	=> __('Add Title','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_404_page_content',array(
		'label'	=> __('Add Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('vw_bakery_no_results_page',array(
		'title'	=> __('No Results Page Settings','vw-bakery'),
		'panel' => 'vw_bakery_others_panel',
	));	

	$wp_customize->add_setting('vw_bakery_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_no_results_page_title',array(
		'label'	=> __('Add Title','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_bakery_no_results_page_content',array(
		'label'	=> __('Add Text','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_bakery_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-bakery'),
		'panel' => 'vw_bakery_others_panel',
	));	

	$wp_customize->add_setting('vw_bakery_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icon_width',array(
		'label'	=> __('Icon Width','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_social_icon_height',array(
		'label'	=> __('Icon Height','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_bakery_responsive_media',array(
		'title'	=> __('Responsive Media','vw-bakery'),
		'panel' => 'vw_bakery_others_panel',
	));

	$wp_customize->add_setting( 'vw_bakery_resp_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','vw-bakery' ),
      'section' => 'vw_bakery_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_bakery_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-bakery' ),
      'section' => 'vw_bakery_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_bakery_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-bakery' ),
      'section' => 'vw_bakery_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_bakery_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-bakery' ),
      'section' => 'vw_bakery_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_bakery_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-bakery' ),
      'section' => 'vw_bakery_responsive_media'
    )));

    $wp_customize->add_setting('vw_bakery_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_responsive_media',
		'setting'	=> 'vw_bakery_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Bakery_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_bakery_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-bakery'),
		'transport' => 'refresh',
		'section'	=> 'vw_bakery_responsive_media',
		'setting'	=> 'vw_bakery_res_close_menus_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_bakery_resp_menu_toggle_btn_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_bakery_resp_menu_toggle_btn_color', array(
		'label'    => __('Toggle Button Color', 'vw-bakery'),
		'section'  => 'vw_bakery_responsive_media',
	)));

    //Woocommerce settings
	$wp_customize->add_section('vw_bakery_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-bakery'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_bakery_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_bakery_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-bakery' ),
		'section' => 'vw_bakery_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_bakery_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-bakery'),
        'section' => 'vw_bakery_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-bakery'),
            'Right Sidebar' => __('Right Sidebar','vw-bakery'),
        ),
	) );

     //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_bakery_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'vw_bakery_customize_partial_vw_bakery_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_bakery_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-bakery' ),
		'section' => 'vw_bakery_woocommerce_section'
    )));

   	$wp_customize->add_setting('vw_bakery_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-bakery'),
        'section' => 'vw_bakery_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-bakery'),
            'Right Sidebar' => __('Right Sidebar','vw-bakery'),
        ),
	) );

  	// Related Product
    $wp_customize->add_setting( 'vw_bakery_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_bakery_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Bakery_Toggle_Switch_Custom_Control( $wp_customize, 'vw_bakery_related_product_show_hide',array(
        'label' => esc_html__( 'Related product','vw-bakery' ),
        'section' => 'vw_bakery_woocommerce_section'
    )));

    //Products per page
    $wp_customize->add_setting('vw_bakery_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'vw_bakery_sanitize_float'
	));
	$wp_customize->add_control('vw_bakery_products_per_page',array(
		'label'	=> __('Products Per Page','vw-bakery'),
		'description' => __('Display on shop page','vw-bakery'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_bakery_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_products_per_row',array(
		'label'	=> __('Products Per Row','vw-bakery'),
		'description' => __('Display on shop page','vw-bakery'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_bakery_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_bakery_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-bakery' ),
		'section'     => 'vw_bakery_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_bakery_products_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_bakery_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_products_button_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products Sale Badge
	$wp_customize->add_setting('vw_bakery_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'vw_bakery_sanitize_choices'
	));
	$wp_customize->add_control('vw_bakery_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-bakery'),
        'section' => 'vw_bakery_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-bakery'),
            'right' => __('Right','vw-bakery'),
        ),
	) );

	$wp_customize->add_setting('vw_bakery_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_bakery_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_bakery_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','vw-bakery'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-bakery'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-bakery' ),
        ),
		'section'=> 'vw_bakery_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_bakery_woocommerce_sale_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_bakery_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_bakery_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','vw-bakery' ),
		'section'     => 'vw_bakery_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Bakery_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Bakery_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_bakery_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Bakery_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_bakery_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
 	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Bakery_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_bakery_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_bakery_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_bakery_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
if ( ! class_exists ( 'VW_Bakery_Customize' ) ) {
final class VW_Bakery_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Bakery_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Bakery_Customize_Section_Pro($manager,'vw_bakery_upgrade_pro_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Bakery Pro Theme', 'vw-bakery' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-bakery' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/bakery-wordpress-theme/'),
		)));

		$manager->add_section(new VW_Bakery_Customize_Section_Pro($manager,'vw_bakery_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-bakery' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-bakery' ),
			'pro_url'  => esc_url('https://www.vwthemesdemo.com/docs/free-vw-bakery/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-bakery-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-bakery-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Bakery_Customize::get_instance();
}