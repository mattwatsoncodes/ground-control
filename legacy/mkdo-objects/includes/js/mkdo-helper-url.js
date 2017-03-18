var mkdo_url_params;

(function( $ ) {
	'use strict';
	
	/**
	 * mkdo_url_params
	 *
	 * Get query string params in JS 
	 * (http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript)
	 */

	(window.onpopstate = function () {
		var match,
			pl     = /\+/g,  // Regex for replacing addition symbol with a space
			search = /([^&=]+)=?([^&]*)/g,
			decode = function (s) { return decodeURIComponent(s.replace(pl, " ") ); },
			query  = window.location.search.substring(1);

		mkdo_url_params = {};
		while (match = search.exec(query))
			mkdo_url_params[decode(match[1])] = decode(match[2]);
	})();
	
})( jQuery );