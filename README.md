# Ground Control

A plugin framework, with lots and lots of useful examples and snippets.

## [Usage](#usage)

This plugin framework has been specifically configured for use by [Matt Watson](https://github.com/mwtsn/). Please fork this for your own plugin and make
sure you do a find and replace for all the variables that make this thing yours.

Here are what to look for, and the defaults that are set (for you to find and replace):

- Plugin Name: `Ground Control`
- Contributors: `mwtsn, davetgreen, mkdo`
- Plugin Slug: `ground-control`
- Plugin Prefix: `mkdo_ground_control`
- Plugin URI: `https://github.com/mkdo/ground-control`
- Author: `Make Do <hello@makedo.net>`
- Author URL: `https://makedo.net`
- Constants Prefix: `MKDO_GROUND_CONTROL`
- SVN Username: `mwtsn`

## [Workflow](#workflow)

The plugin comes with its own Grunt based workflow based on [Kapow Grunt](https://github.com/mkdo/kapow-grunt). You don't have to use it, but it will
help you organise your assets better if you do.

To get this up and running, when you first download the project run the following
commands from the root of the plugin:

`cd tools`  
`sudo npm install`  
`bower update`  
`cd ..`  

This will change the directory to the tools directory, install all the components
you need to run commands such as Grunt, as well as any dependancies that your
project has.

From here on you just need to run the Grunt command:

`grunt`

from your root directory, to compile all of the assets in `/assets/raw/` to the
relevant folders in `/assets/`.

For more information about what this does, read up on [Kapow Grunt](https://github.com/mkdo/kapow-grunt).

## [Hooks and Filters](#hooks-filters)
The plugin takes advantage of various hooks and filters:

### Filters
Here are all the filters within the plugin:

#### Testing
- See [Testing](#testing).

#### Enqueues
CSS and JS Enqueues exist within the plugin for reference and development, but
we highly recommend that the appropriate filters are used to deactivate these
enqueues, and these are concatenated and enqueued using your own theme workflow.

Don't have a workflow? We recommend [Kapow](https://github.com/mkdo/kapow-setup).

The enqueue filters all accept a boolean, and are true by default. Use the
following method to disable them:

`add_filter( 'mkdo_ground_control_[filter_name]', '__return_false');`

The filters available are:

- `mkdo_ground_control_do_public_enqueue` &mdash; hide all the public asset enqueues.
- `mkdo_ground_control_do_public_css_enqueue` &mdash; hide the public CSS enqueue.
- `mkdo_ground_control_do_public_js_enqueue` &mdash; hide the public JS enqueue.
- `mkdo_ground_control_do_admin_enqueue` &mdash; hide all the admin asset enqueues.
- `mkdo_ground_control_do_admin_css_enqueue` &mdash; hide the admin CSS enqueue.
- `mkdo_ground_control_do_admin_editor_css_enqueue` &mdash; hide the admin editor CSS enqueue.
- `mkdo_ground_control_do_admin_js_enqueue` &mdash; hide the admin JS enqueue.
- `mkdo_ground_control_do_customizer_enqueue` &mdash; hide the customizer CSS enqueue.

#### Render Views
Views reside within the `/views` folder in the plugin, but you may wish to override
these views in your theme.

Use the filter `mkdo_ground_control_view_template_folder` to set where the view
sits within your theme. EG:

`add_filter( 'mkdo_ground_control_view_template_folder', function() {  
	return get_stylesheet_directory() . '/template-parts/ground-control/';  
} );`  

You can also return a boolean for the filter `mkdo_ground_control_view_template_folder_check_exists`
to perform an optional check if the template exists in your theme. However best
practice is duplicating the `/views` folder within your theme at a custom location.

## [Testing](#testing)
Runs tests such as example files and functionality by making the filter `mkdo_ground_control_run_tests` return true. EG:

`add_filter( 'mkdo_ground_control_run_tests', '__return_true');`

## [Deploying](#deploying)
This plugin framework contains a deployment script that will tag your build in GitHub
and deploy to the WordPress SVN.

To use this you will need to make the script executable via the command line using `chmod a+x tools/deploy.sh`, and run it using `./tools/deploy.sh`.

You will be asked to confirm your GitHub and SVN repositories.

## [More Information](#more-information)
You can find out more about the plugin, including the changelog in the [`readme.txt` file](https://github.com/mwtsn/ground-control/blob/master/readme.txt), which the
WordPress repository uses to display information about the plugin.

You can also view the plugin on the WordPress repository here: N/A

## [Roadmap](#roadmap)
A bunch of features will be coming to this framework, including:

- A rename script in `/tools/rename.sh` that will go through the plugin, find and
replace the default parameters with custom ones.
- A `README.md` template in `/tools/README-template.md` that will replace this one
with a generic `README.md` tailored specifically for a custom plugin.

## [Credit](#credits)

Built using the [Ground Control](https://github.com/mwtsn/ground-control) plugin framework. A framework based on root composition principles, built by [Matt Watson](https://github.com/mwtsn/) and [Dave Green](https://github.com/davetgreen/), with thanks to [Make Do](https://www.makedo.net/).

_"Ground Control to Major Tom"_
&mdash; With a big thanks to [Tom Nowell](https://tomjn.com) for his tutorial on [Root composition](https://tomjn.com/2015/06/24/root-composition-in-wordpress-plugins/) that got this all started.

[Kapow Grunt](https://github.com/mkdo/kapow-grunt) workflow comes with thanks to [Dave Green](https://github.com/davetgreen/) and [Make Do](https://www.makedo.net/).
