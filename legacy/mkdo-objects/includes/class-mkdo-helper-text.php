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
class MKDO_Helper_Text {

	/**
	 * URL regex
	 *
	 * @since   1.0.0
	 * @param 	string 	$text 			The input text
	 * @param 	int 	$length 		The length of the excerpt
	 * @param 	bool 	$strip_to_stop 	Strip to the nearest full sentance
	 * @return	string 	$string 		The custom excerpt
	 */
	public static function get_custom_excerpt( $text, $length = 60, $strip_to_stop = TRUE ) {

		$excerpt 			= strip_shortcodes( $text );
		$excerpt        	= wp_strip_all_tags( $excerpt, TRUE );
		$words              = explode( ' ', $excerpt, $length + 1 );
		
		if( count( $words ) > $length ) {
			array_pop( $words );
			$excerpt   		= implode( ' ', $words );
		}

		$stop       		= strripos( $excerpt, '.');

        if ( $strip_to_stop && $stop != -1 && !empty( $stop) ) {
            $excerpt        = substr( $excerpt, 0, $stop );
        }

        $excerpt 			= rtrim($excerpt, '.');

		return $excerpt;
	}

}