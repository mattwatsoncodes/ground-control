// SVG Min Task - https://github.com/sindresorhus/grunt-svgmin
// ----------------------------------------------------------------------------
module.exports = {
    options: {
        plugins: [
        {
            removeTitle: true
        },
        {
            removeDimensions: true
        },
        {
            removeStyleElement: true
        },
        {
            sortAttrs: true
        }]
    },
    svg: {
        files: [{
            expand: true,
            cwd: '<%= siteInfo.assets_path %>/<%= siteInfo.img_dir %>',
            src: ['**/*.svg'],
            dest: '<%= pluginInfo.img_dir %>'
        }]
    }
};
