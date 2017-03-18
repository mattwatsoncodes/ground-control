var MKDO_Map = (function ( canvas_id, args ) {

	this.map;
	this.map_center;
	this.map_markers;

	this.get_location = function() {
		var self = this;
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition( function( position ){
				self.map_center = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
		
				if( self.map != undefined ) {
					self.map.panTo( self.map_center );
				}
			});
		}
	}

	this.set_position = function(position) {

		this.map.panTo( position );
	}

	this.add_marker = function( title, location, distance, data, self ) {

		var marker 	= new google.maps.Marker({
			position: 	location,
			map: 		args['marker_cluster'] != undefined ? undefined : self.map,
			//icon: 		"img/pin.png", // Custom pin
			title: 		title,
			data: 		data
		});
		self.map_markers.push(marker);

		return marker;
	}
	
	this.initialize = function() {

		var self = this;
		var mapOptions = {
			zoom: args['zoom_level'],
			center: this.map_center,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: false,
			mapTypeControl: false,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.LEFT_BOTTOM
			},
			streetViewControl: false
		};

		this.map = new google.maps.Map( document.getElementById( canvas_id ), mapOptions );

		// Add markers from JSON

		$.each( map_data[args['data_id']], function() {

			var location = this;

			var latlong = unserialize(location['data'][args['latlong_meta']]);

			if( latlong != null ) {

				position = new google.maps.LatLng( latlong['lat'], latlong['long'] );
				distance = getDistanceFromLatLonInM( self.map_center.lat(), self.map_center.lng(), position.lat(), position.lng() );

				// Add the map marker to the markers array, and add event listener
				
				if( latlong['lat'] != null && latlong['lat'] != '' && latlong['long'] != null && latlong['long'] != '' ) {
					google.maps.event.addListener( args['add_marker']( location['title'], position, distance, location['data'], self ) , 'click', function(){

						if(args['marker_function'] != undefined) {
							args['marker_function']( this, self );
						}

					});
				}

			}

			// END Add the map marker to the markers array, and add event listener

		});

		// END Add markers from JSON


		// After the map has loaded, do the following

		google.maps.event.addListenerOnce( this.map, 'idle', function(){


			if(args['marker_cluster'] != undefined) {
				args['marker_cluster'](self);
			}

			if(args['after_setup'] != undefined) {
				args['after_setup'](self);
			}

			
		});
	}

	this.constructor = function() {

		canvas_id  				= canvas_id 				== undefined ? 'map-canvas' 		: canvas_id
		args['data_id'] 		= args['data_id'] 			== undefined ? 'locations' 			: args['data_id'];
		args['latlong_meta'] 	= args['latlong_meta']		== undefined ? '_mkdo_locations' 	: args['latlong_meta'];
		args['add_marker'] 		= args['add_marker']		== undefined ? this.add_marker 		: args['add_marker'];
		args['marker_cluster'] 	= args['marker_cluster'] 	== undefined ? undefined 			: args['marker_cluster'];
		args['after_setup'] 	= args['after_setup'] 		== undefined ? undefined 			: args['after_setup'];
		args['marker_function'] = args['marker_function'] 	== undefined ? undefined 			: args['marker_function'];
		args['zoom_level'] 		= args['zoom_level'] 		== undefined ? 9 					: args['zoom_level'];

		if( $('#' + canvas_id).length > 0 )
		{

			this.map_center = new google.maps.LatLng( 53.381171, -1.471064 );
			this.map_markers = [];

			google.maps.event.addDomListener( window, 'load', this.initialize() );
		}
	}

	return this.constructor();

});

