( function( api ) {

	// Extends our custom "cafe-coffee-shop" section.
	api.sectionConstructor['cafe-coffee-shop'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );