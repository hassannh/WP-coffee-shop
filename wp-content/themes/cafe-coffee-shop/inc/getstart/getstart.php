<?php
//about theme info
add_action( 'admin_menu', 'cafe_coffee_shop_gettingstarted' );
function cafe_coffee_shop_gettingstarted() {
	add_theme_page( esc_html__('About Cafe Coffee Shop', 'cafe-coffee-shop'), esc_html__('About Cafe Coffee Shop', 'cafe-coffee-shop'), 'edit_theme_options', 'cafe_coffee_shop_guide', 'cafe_coffee_shop_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function cafe_coffee_shop_admin_theme_style() {
   wp_enqueue_style('cafe-coffee-shop-custom-admin-style', esc_url(get_theme_file_uri()) . '/inc/getstart/getstart.css');
   wp_enqueue_script('cafe-coffee-shop-tabs', esc_url(get_theme_file_uri()) . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'cafe_coffee_shop_admin_theme_style');

//guidline for about theme
function cafe_coffee_shop_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'cafe-coffee-shop' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to Cafe Coffee Shop Theme', 'cafe-coffee-shop' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','cafe-coffee-shop'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy Cafe Coffee Shop at 20% Discount','cafe-coffee-shop'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','cafe-coffee-shop'); ?> ( <span><?php esc_html_e('vwpro20','cafe-coffee-shop'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'cafe-coffee-shop' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">		
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'cafe-coffee-shop' ); ?></button>	
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'cafe-coffee-shop' ); ?></button>
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'cafe-coffee-shop' ); ?></button>
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'product_addons_editor')"><?php esc_html_e( 'Woocommerce Product Addons', 'cafe-coffee-shop' ); ?></button>
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'theme_pro')"><?php esc_html_e( 'Get Premium', 'cafe-coffee-shop' ); ?></button>
			<button class="tablinks" onclick="cafe_coffee_shop_open_tab(event, 'free_pro')"><?php esc_html_e( 'Support', 'cafe-coffee-shop' ); ?></button>
		</div>

		<?php
			$cafe_coffee_shop_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$cafe_coffee_shop_plugin_custom_css ='display: block';
			}
		?>
		<div id="lite_theme" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = Cafe_Coffee_Shop_Plugin_Activation_Settings::get_instance();
				$cafe_coffee_shop_actions = $plugin_ins->recommended_actions;
				?>
				<div class="cafe-coffee-shop-recommended-plugins">
				    <div class="cafe-coffee-shop-action-list">
				        <?php if ($cafe_coffee_shop_actions): foreach ($cafe_coffee_shop_actions as $key => $cafe_coffee_shop_actionValue): ?>
				                <div class="cafe-coffee-shop-action" id="<?php echo esc_attr($cafe_coffee_shop_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($cafe_coffee_shop_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($cafe_coffee_shop_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($cafe_coffee_shop_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','cafe-coffee-shop'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($cafe_coffee_shop_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'cafe-coffee-shop' ); ?></h3>
				<hr class="h3hr">
			  	<p><?php esc_html_e('Free cafe WordPress theme is for various types of websites related to coffee shops or restaurants related to fast food. It has an advance slider with multiple effects as well as control options and is translation ready. It is a free perfect WP theme for online business and you can excel without any doubt. It has the parallax image background section and one good thing about this free WP theme is that it abides by the latest trends as well as regulations. It has multiple inner page templates and is compatible with WooCommerce making it a good choice for the online packaged foods. Free cafe WordPress theme has footer widgets and editor style and is responsive, mobile-ready, cross-browser compatible apart from being fast loading and SEO optimized. It has more than 100 font family options and you do not need skill or experience to create pages. It loads fast.','cafe-coffee-shop'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'cafe-coffee-shop' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'cafe-coffee-shop' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'cafe-coffee-shop' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'cafe-coffee-shop'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'cafe-coffee-shop'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'cafe-coffee-shop'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'cafe-coffee-shop'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'cafe-coffee-shop'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'cafe-coffee-shop'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'cafe-coffee-shop'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'cafe-coffee-shop'); ?>  </p>
					<div class="info-link">
						<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'cafe-coffee-shop'); ?></a>
					</div>
			  		<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'cafe-coffee-shop' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','cafe-coffee-shop'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Section','cafe-coffee-shop'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','cafe-coffee-shop'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','cafe-coffee-shop'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','cafe-coffee-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','cafe-coffee-shop'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','cafe-coffee-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','cafe-coffee-shop'); ?></a>
								</div> 
							</div>

						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','cafe-coffee-shop'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','cafe-coffee-shop'); ?></p>
	                <ul>
	                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','cafe-coffee-shop'); ?></span><?php esc_html_e(' Go to ','cafe-coffee-shop'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','cafe-coffee-shop'); ?></b></p>

	                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','cafe-coffee-shop'); ?></p>
	                  	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
	                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','cafe-coffee-shop'); ?></span><?php esc_html_e(' Go to ','cafe-coffee-shop'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','cafe-coffee-shop'); ?></b></p>
					  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','cafe-coffee-shop'); ?></p>
	                  	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
	                  	<p><?php esc_html_e(' Once you are done with this, then follow the','cafe-coffee-shop'); ?> <a class="doc-links" href="https://www.vwthemesdemo.com/docs/free-cafe-coffee-shop/" target="_blank"><?php esc_html_e('Documentation','cafe-coffee-shop'); ?></a></p>
	                </ul>
			  	</div>
			</div>
		</div>

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Cafe_Coffee_Shop_Plugin_Activation_Settings::get_instance();
			$cafe_coffee_shop_actions = $plugin_ins->recommended_actions;
			?>
				<div class="cafe-coffee-shop-recommended-plugins">
				    <div class="cafe-coffee-shop-action-list">
				        <?php if ($cafe_coffee_shop_actions): foreach ($cafe_coffee_shop_actions as $key => $cafe_coffee_shop_actionValue): ?>
				                <div class="cafe-coffee-shop-action" id="<?php echo esc_attr($cafe_coffee_shop_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($cafe_coffee_shop_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($cafe_coffee_shop_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($cafe_coffee_shop_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','cafe-coffee-shop'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($cafe_coffee_shop_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'cafe-coffee-shop' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','cafe-coffee-shop'); ?></p>
	              	<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon >> Click Pattern Tab >> Click on homepage sections >> Publish.','cafe-coffee-shop'); ?></span></b></p>
	              	<div class="cafe-coffee-shop-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','cafe-coffee-shop'); ?></a>
				    </div>
	              	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />
	            </div>

              	<div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'cafe-coffee-shop' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','cafe-coffee-shop'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','cafe-coffee-shop'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','cafe-coffee-shop'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','cafe-coffee-shop'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','cafe-coffee-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','cafe-coffee-shop'); ?></a>
								</div> 
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','cafe-coffee-shop'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','cafe-coffee-shop'); ?></a>
								</div> 
							</div>
						</div>
					</div>	
				</div>			
	        </div>
		</div>

		<div id="gutenberg_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Cafe_Coffee_Shop_Plugin_Activation_Settings::get_instance();
			$cafe_coffee_shop_actions = $plugin_ins->recommended_actions;
			?>
				<div class="cafe-coffee-shop-recommended-plugins">
				    <div class="cafe-coffee-shop-action-list">
				        <?php if ($cafe_coffee_shop_actions): foreach ($cafe_coffee_shop_actions as $key => $cafe_coffee_shop_actionValue): ?>
				                <div class="cafe-coffee-shop-action" id="<?php echo esc_attr($cafe_coffee_shop_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($cafe_coffee_shop_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($cafe_coffee_shop_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($cafe_coffee_shop_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'cafe-coffee-shop' ); ?></h3>
				<hr class="h3hr">
				<div class="cafe-coffee-shop-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','cafe-coffee-shop'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
					<h3><?php esc_html_e( 'Link to customizer', 'cafe-coffee-shop' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','cafe-coffee-shop'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-networking"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_social_icon_settings') ); ?>" target="_blank"><?php esc_html_e('Social Icons','cafe-coffee-shop'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','cafe-coffee-shop'); ?></a>
							</div>
							
							<div class="row-box2">
								<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','cafe-coffee-shop'); ?></a>
							</div>
						</div>

						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','cafe-coffee-shop'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_woocommerce_section') ); ?>" target="_blank"><?php esc_html_e('WooCommerce Layout','cafe-coffee-shop'); ?></a>
							</div> 
						</div>
						
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_bakery_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','cafe-coffee-shop'); ?></a>
							</div>
							 <div class="row-box2">
								<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','cafe-coffee-shop'); ?></a>
							</div> 
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div id="product_addons_editor" class="tabcontent">
			<?php if(!class_exists('IEPA_Loader')){
				$plugin_ins = Cafe_Coffee_Shop_Plugin_Activation_Woo_Products::get_instance();
				$cafe_coffee_shop_actions = $plugin_ins->recommended_actions;
				?>
				<div class="cafe-coffee-shop-recommended-plugins">
					    <div class="cafe-coffee-shop-action-list">
					        <?php if ($cafe_coffee_shop_actions): foreach ($cafe_coffee_shop_actions as $key => $cafe_coffee_shop_actionValue): ?>
					                <div class="cafe-coffee-shop-action" id="<?php echo esc_attr($cafe_coffee_shop_actionValue['id']);?>">
				                        <div class="action-inner plugin-activation-redirect">
				                            <h3 class="action-title"><?php echo esc_html($cafe_coffee_shop_actionValue['title']); ?></h3>
				                            <div class="action-desc"><?php echo esc_html($cafe_coffee_shop_actionValue['desc']); ?></div>
				                            <?php echo wp_kses_post($cafe_coffee_shop_actionValue['link']); ?>
				                        </div>
					                </div>
					            <?php endforeach;
					        endif; ?>
					    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Woocommerce Products Blocks', 'cafe-coffee-shop' ); ?></h3>
				<hr class="h3hr">
				<div class="cafe-coffee-shop-pattern-page">
					<p><?php esc_html_e('Follow the below instructions to setup Products Templates.','cafe-coffee-shop'); ?></p>
					<p><b><?php esc_html_e('1. First you need to activate these plugins','cafe-coffee-shop'); ?></b></p>
						<p><?php esc_html_e('1. Ibtana - WordPress Website Builder ','cafe-coffee-shop'); ?></p>
						<p><?php esc_html_e('2. Ibtana - Ecommerce Product Addons.','cafe-coffee-shop'); ?></p>
						<p><?php esc_html_e('3. Woocommerce','cafe-coffee-shop'); ?></p>

					<p><b><?php esc_html_e('2. Go To Dashboard >> Ibtana Settings >> Woocommerce Templates','cafe-coffee-shop'); ?></span></b></p>
	              	<div class="cafe-coffee-shop-pattern-page">
			    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-woocommerce-templates&ive_wizard_view=parent' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Woocommerce Templates','cafe-coffee-shop'); ?></a>
			    	</div>
	              	<p><?php esc_html_e('You can create a template as you like.','cafe-coffee-shop'); ?></span></p>
			    </div>
			<?php } ?>
		</div>

		<div id="theme_pro" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'cafe-coffee-shop' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('Cafe WordPress theme is well suited for coffee shop websites and you do not need to hire a coder or designer for this. You do not need to start from scratch and this WP theme has the background image option and is integrated with the current font awesome. It is good for all businesses that are directly or indirectly related to the hospitality industry and the main reason is that it is multipurpose. With the WordPress cafe theme, you have the demo kit and this is predefined for utilization out of the box. You have the option to customize and fine-tune the look as per your choice and suitability. It has the web custom elements and is compatible with plugins like contact form 7 and WooCommerce. It has a global color option and is responsive. You can craft your own dream page. It has a social media feature and slider with unlimited slides.','cafe-coffee-shop'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'cafe-coffee-shop'); ?></a>
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'cafe-coffee-shop'); ?></a>
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'cafe-coffee-shop'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_theme_file_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'cafe-coffee-shop' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'cafe-coffee-shop'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'cafe-coffee-shop'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><?php esc_html_e('12', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'cafe-coffee-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'cafe-coffee-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'cafe-coffee-shop'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'cafe-coffee-shop'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'cafe-coffee-shop'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( CAFE_COFFEE_SHOP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'cafe-coffee-shop'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'cafe-coffee-shop'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'cafe-coffee-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'cafe-coffee-shop'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'cafe-coffee-shop'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'cafe-coffee-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'cafe-coffee-shop'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'cafe-coffee-shop'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'cafe-coffee-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'cafe-coffee-shop'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'cafe-coffee-shop'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'cafe-coffee-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','cafe-coffee-shop'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'cafe-coffee-shop'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'cafe-coffee-shop'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( CAFE_COFFEE_SHOP_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'cafe-coffee-shop'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>