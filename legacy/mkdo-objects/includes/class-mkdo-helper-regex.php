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
class MKDO_Helper_Regex {

	/**
	 * URL regex
	 *
	 * @since   1.0.0
	 * @return	string 	$regex 		The regex pattern
	 */
	public static function get_url() {
		return '/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/';
	}

	/**
	 * Hashtag regex
	 *
	 * @since   1.0.0
	 * @return	string 	$regex 		The regex pattern
	 */
	public static function get_hashtag() {
		return '/#([A-Za-z0-9\/\.]*)/';
	}

	/**
	 * Metion regex
	 *
	 * @since   1.0.0
	 * @return	string 	$regex 		The regex pattern
	 */
	public static function get_mention() {
		return '/@([A-Za-z0-9\/\.]*)/';
	}

	/**
	 * Postcode regex
	 *
	 * @since   1.0.0
	 * @return	string 	$regex 		The regex pattern
	 */
	public static function get_postcode() {
		return '/[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}/';
	}

}
