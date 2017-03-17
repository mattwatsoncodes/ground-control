# Ground Control

A brief description of the plugin.

## [Useage](#useage)

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

## [About](#about)

A more in depth description of the plugin.

The plugin provides the following functionality:

- Example functionality
- etc...

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

## [Deploying](#deploying)
This plugin framework contains a deployment script that will tag your build in GitHub
and deploy to the WordPress SVN.

To use this you will need to make the script executable via the command line using `chmod a+x tools/deploy.sh`, and run it using `./tools/deploy.sh`.

You will be asked to confirm your GitHub and SVN repositories.

## [More Information](#more-information)
You can find out more about the plugin, including the changelog in the [`readme.text` file](https://github.com/mwtsn/ground-control/blob/master/readme.txt), which the WordPress repository uses to display information about the plugin.

You can also view the plugin on the WordPress repository here: N/A

## [Credits](#credits)

Built using the [Ground Control](https://github.com/mwtsn/ground-control) plugin framework. A framework based on root composition principles, built by [Matt Watson](https://github.com/mwtsn/) and [Dave Green](https://github.com/davetgreen/), with thanks to [Make Do](https://www.makedo.net/).

_"Ground Control to Major Tom"_
&mdash; With a big thanks to [Tom Nowell](https://tomjn.com) for his tutorial on [Root composition](https://tomjn.com/2015/06/24/root-composition-in-wordpress-plugins/) that got this all started.

Grunt workflow comes with thanks to [Dave Green](https://github.com/davetgreen/), and [Make Do](https://www.makedo.net/)
