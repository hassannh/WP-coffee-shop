<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Bakery_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-bakery' ),
				'family'      => esc_html__( 'Font Family', 'vw-bakery' ),
				'size'        => esc_html__( 'Font Size',   'vw-bakery' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-bakery' ),
				'style'       => esc_html__( 'Font Style',  'vw-bakery' ),
				'line_height' => esc_html__( 'Line Height', 'vw-bakery' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-bakery' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-bakery-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-bakery-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-bakery' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-bakery' ),
        'Acme' => __( 'Acme', 'vw-bakery' ),
        'Anton' => __( 'Anton', 'vw-bakery' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-bakery' ),
        'Arimo' => __( 'Arimo', 'vw-bakery' ),
        'Arsenal' => __( 'Arsenal', 'vw-bakery' ),
        'Arvo' => __( 'Arvo', 'vw-bakery' ),
        'Alegreya' => __( 'Alegreya', 'vw-bakery' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-bakery' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-bakery' ),
        'Bangers' => __( 'Bangers', 'vw-bakery' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-bakery' ),
        'Bad Script' => __( 'Bad Script', 'vw-bakery' ),
        'Bitter' => __( 'Bitter', 'vw-bakery' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-bakery' ),
        'BenchNine' => __( 'BenchNine', 'vw-bakery' ),
        'Cabin' => __( 'Cabin', 'vw-bakery' ),
        'Cardo' => __( 'Cardo', 'vw-bakery' ),
        'Courgette' => __( 'Courgette', 'vw-bakery' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-bakery' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-bakery' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-bakery' ),
        'Cuprum' => __( 'Cuprum', 'vw-bakery' ),
        'Cookie' => __( 'Cookie', 'vw-bakery' ),
        'Chewy' => __( 'Chewy', 'vw-bakery' ),
        'Days One' => __( 'Days One', 'vw-bakery' ),
        'Dosis' => __( 'Dosis', 'vw-bakery' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-bakery' ),
        'Economica' => __( 'Economica', 'vw-bakery' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-bakery' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-bakery' ),
        'Francois One' => __( 'Francois One', 'vw-bakery' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-bakery' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-bakery' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-bakery' ),
        'Handlee' => __( 'Handlee', 'vw-bakery' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-bakery' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-bakery' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-bakery' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-bakery' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-bakery' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-bakery' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-bakery' ),
        'Kanit' => __( 'Kanit', 'vw-bakery' ),
        'Lobster' => __( 'Lobster', 'vw-bakery' ),
        'Lato' => __( 'Lato', 'vw-bakery' ),
        'Lora' => __( 'Lora', 'vw-bakery' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-bakery' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-bakery' ),
        'Merriweather' => __( 'Merriweather', 'vw-bakery' ),
        'Monda' => __( 'Monda', 'vw-bakery' ),
        'Montserrat' => __( 'Montserrat', 'vw-bakery' ),
        'Muli' => __( 'Muli', 'vw-bakery' ),
        'Marck Script' => __( 'Marck Script', 'vw-bakery' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-bakery' ),
        'Open Sans' => __( 'Open Sans', 'vw-bakery' ),
        'Overpass' => __( 'Overpass', 'vw-bakery' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-bakery' ),
        'Oxygen' => __( 'Oxygen', 'vw-bakery' ),
        'Orbitron' => __( 'Orbitron', 'vw-bakery' ),
        'Patua One' => __( 'Patua One', 'vw-bakery' ),
        'Pacifico' => __( 'Pacifico', 'vw-bakery' ),
        'Padauk' => __( 'Padauk', 'vw-bakery' ),
        'Playball' => __( 'Playball', 'vw-bakery' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-bakery' ),
        'PT Sans' => __( 'PT Sans', 'vw-bakery' ),
        'Philosopher' => __( 'Philosopher', 'vw-bakery' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-bakery' ),
        'Poiret One' => __( 'Poiret One', 'vw-bakery' ),
        'Quicksand' => __( 'Quicksand', 'vw-bakery' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-bakery' ),
        'Raleway' => __( 'Raleway', 'vw-bakery' ),
        'Rubik' => __( 'Rubik', 'vw-bakery' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-bakery' ),
        'Russo One' => __( 'Russo One', 'vw-bakery' ),
        'Righteous' => __( 'Righteous', 'vw-bakery' ),
        'Slabo' => __( 'Slabo', 'vw-bakery' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-bakery' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-bakery'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-bakery' ),
        'Sacramento' => __( 'Sacramento', 'vw-bakery' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-bakery' ),
        'Tangerine' => __( 'Tangerine', 'vw-bakery' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-bakery' ),
        'VT323' => __( 'VT323', 'vw-bakery' ),
        'Varela Round' => __( 'Varela Round', 'vw-bakery' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-bakery' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-bakery' ),
        'Volkhov' => __( 'Volkhov', 'vw-bakery' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-bakery' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-bakery' ),
			'100' => esc_html__( 'Thin',       'vw-bakery' ),
			'300' => esc_html__( 'Light',      'vw-bakery' ),
			'400' => esc_html__( 'Normal',     'vw-bakery' ),
			'500' => esc_html__( 'Medium',     'vw-bakery' ),
			'700' => esc_html__( 'Bold',       'vw-bakery' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-bakery' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-bakery' ),
			'italic'  => esc_html__( 'Italic', 'vw-bakery' ),
			'oblique' => esc_html__( 'Oblique', 'vw-bakery' )
		);
	}
}
