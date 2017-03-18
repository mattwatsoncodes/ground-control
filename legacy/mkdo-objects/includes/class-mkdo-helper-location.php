<?php
/**
 * A helper plugin
 *
 * @link       http://makedo.in
 * @since      1.0.0
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/admin
 */

/**
 * A helper plugin
 *
 * A helper plugin for common regex's
 *
 * @package    MKDO_Objects
 * @subpackage MKDO_Objects/includes
 * @author     Make Do <hello@makedo.in>
 */
class MKDO_Helper_Location {

	/**
	 * Calculate the distance between two locations
	 *
	 * @since 	1.0.0
	 * @var 	string 		$lat1 	The first latitude to compare
	 * @var 	string 		$long1	The first longitude to compare
	 * @var 	string 		$lat2 	The second latitude to compare
	 * @var 	string 		$long2 	The second longitude to compare
	 * @return	string 		$miles 	The distance in miles
	 */
	public static function calculate_distance( $lat1, $lon1, $lat2, $lon2 ) {

		$theta 	= $lon1 - $lon2;
		$dist 	= sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist 	= acos($dist);
		$dist 	= rad2deg($dist);
		$miles 	= $dist * 60 * 1.1515;
		
		return $miles;
	}

	/**
	 * Get UK latlong from an address
	 *
	 * Uses the google map API
	 *
	 * @since 	1.0.0
	 * @var 	string 		$address 	The address to get the latlong from
	 * @return	array 		$latlong 	An array containing the latitude and longitude
	 */
	public static function get_uk_lat_long_from_address( $address ) {

		$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false&region=UK';
		$xml = simplexml_load_file( $url );

		$latlong = array();
		
		if( $xml->status == 'OK' )
		{
			foreach( $xml->children() as $result ) 
			{
				foreach( $result->children() as $detail ) 
				{
					if( $detail->getName() == 'address_component' )
					{
						foreach( $detail->children() as $address ) 
						{
							if( $address->getName() == 'short_name' && $address == 'GB' ) 
							{
								$latlong['lat']  = $result->geometry->location->lat . '';
								$latlong['long'] = $result->geometry->location->lng . '';
							}

							if( !empty( $latlong['lat'] ) )
							{
								break;
							}
						}
					}
				}
			}
		}

		if( empty( $latlong['lat'] ) )
		{
			$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false';
			$xml = simplexml_load_file( $url );

			$latlong = array();
			
			if( $xml->status == 'OK' )
			{
				foreach( $xml->children() as $result ) 
				{
					foreach( $result->children() as $detail ) 
					{
						if( $detail->getName() == 'address_component' )
						{
							foreach( $detail->children() as $address ) 
							{
								if( $address->getName() == 'short_name' && $address == 'GB' ) 
								{
									$latlong['lat']  = $result->geometry->location->lat . '';
									$latlong['long'] = $result->geometry->location->lng . '';
								}

								if( !empty( $latlong['lat'] ) )
								{
									break;
								}
							}
						}
					}
				}
			}
		}

		return $latlong;
	}

	/**
	 * Get UK city from an address
	 *
	 * Uses the google map API
	 *
	 * @since 	1.0.0
	 * @var 	string 		$address 	The address to get the latlong from
	 * @return	array 		$town 		The town or city
	 */
	public static function get_uk_city_from_address( $address ) {

		$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false&region=UK';
		$xml = simplexml_load_file( $url );

		$town = '';
		
		if( $xml->status == 'OK' )
		{
			foreach( $xml->children() as $result ) 
			{
				foreach( $result->children() as $detail ) 
				{
					if( $detail->getName() == 'address_component' )
					{
						foreach( $detail->children() as $address ) 
						{
							if( $address->getName() == 'short_name' && $address == 'GB' ) 
							{
								$town = $result->address_component[1]->long_name;
							}

							if( !empty( $town) )
							{
								break;
							}
						}
					}
				}
			}
		}

		if( empty( $town ) )
		{
			$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false';
			$xml = simplexml_load_file( $url );

			$town = '';
			
			if( $xml->status == 'OK' )
			{
				foreach( $xml->children() as $result ) 
				{
					foreach( $result->children() as $detail ) 
					{
						if( $detail->getName() == 'address_component' )
						{
							foreach( $detail->children() as $address ) 
							{
								if( $address->getName() == 'short_name' && $address == 'GB' ) 
								{
									$town = $result->address_component[1]->long_name;
								}

								if( !empty( $town) )
								{
									break;
								}
							}
						}
					}
				}
			}
		}

		return $town;
	}

	/**
	 * Get UK city from an address
	 *
	 * Uses the google map API
	 *
	 * @since 	1.0.0
	 * @var 	string 		$address 	The address to get the latlong from
	 * @return	array 		$town 		The town or city
	 */
	public static function get_uk_postal_town_from_address( $address ) {

		$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false&region=UK';
		$xml = simplexml_load_file( $url );

		$town = '';
		
		if( $xml->status == 'OK' )
		{
			foreach( $xml->children() as $result ) 
			{
				foreach( $result->children() as $detail ) 
				{
					if( $detail->getName() == 'address_component' )
					{
						foreach( $detail->children() as $address ) 
						{
							if( $address->getName() == 'short_name' && $address == 'GB' ) 
							{
								$town = $result->address_component[2]->long_name;
							}

							if( !empty( $town) )
							{
								break;
							}
						}
					}
				}
			}
		}

		if( empty( $town ) )
		{
			$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false';
			$xml = simplexml_load_file( $url );

			$town = '';
			
			if( $xml->status == 'OK' )
			{
				foreach( $xml->children() as $result ) 
				{
					foreach( $result->children() as $detail ) 
					{
						if( $detail->getName() == 'address_component' )
						{
							foreach( $detail->children() as $address ) 
							{
								if( $address->getName() == 'short_name' && $address == 'GB' ) 
								{
									$town = $result->address_component[2]->long_name;
								}

								if( !empty( $town) )
								{
									break;
								}
							}
						}
					}
				}
			}
		}

		return $town;
	}

	/**
	 * Get UK county from an address
	 *
	 * Uses the google map API
	 *
	 * @since 	1.0.0
	 * @var 	string 		$address 	The address to get the latlong from
	 * @return	array 		$town 		The town or city
	 */
	public static function get_uk_county_from_address( $address ) {

		$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false&region=UK';
		$xml = simplexml_load_file( $url );

		$county = '';
		
		if( $xml->status == 'OK' )
		{
			foreach( $xml->children() as $result ) 
			{
				foreach( $result->children() as $detail ) 
				{
					if( $detail->getName() == 'address_component' )
					{
						foreach( $detail->children() as $address ) 
						{
							if( $address->getName() == 'short_name' && $address == 'GB' ) 
							{
								$county = $result->address_component[3]->long_name;
							}

							if( !empty( $county) )
							{
								break;
							}
						}
					}
				}
			}
		}

		if( empty( $county ) )
		{
			$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false';
			$xml = simplexml_load_file( $url );

			$county = '';
			
			if( $xml->status == 'OK' )
			{
				foreach( $xml->children() as $result ) 
				{
					foreach( $result->children() as $detail ) 
					{
						if( $detail->getName() == 'address_component' )
						{
							foreach( $detail->children() as $address ) 
							{
								if( $address->getName() == 'short_name' && $address == 'GB' ) 
								{
									$county = $result->address_component[3]->long_name;
								}

								if( !empty( $county) )
								{
									break;
								}
							}
						}
					}
				}
			}
		}

		return $county;
	}

}
