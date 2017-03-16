// CSSMin Task - https://github.com/gruntjs/grunt-contrib-cssmin
// ----------------------------------------------------------------------------
module.exports = {
	// All Styles.
	// -------------------------------------
	all: {
		files: [ {
			expand: true,
			cwd: '<%= siteInfo.css_dir %>',
			src: ['*.css'],
			dest: '<%= pluginInfo.css_dir %>',
			ext: '.min.css'
		} ]
	}
};
