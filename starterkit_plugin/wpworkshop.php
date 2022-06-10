<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.digitalcopilote.io
 * @since             1.0.0
 * @package           Wpworkshop
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Workshop
 * Plugin URI:        https://github.com/digital-copilote-agency/workshop-wordpress_php
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Digital Copilote
 * Author URI:        https://www.digitalcopilote.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpworkshop
 * Domain Path:       /languages
 */
require __DIR__ . '/vendor/autoload.php';

use Workshop\Core\WpWorkshopActivator;
use Workshop\Core\WpWorkshopDeactivator;
use Workshop\Core\WpWorkshop;

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die();
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WPWORKSHOP_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpworkshop-activator.php
 */
function activate_wpworkshop()
{
  WpWorkshopActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpworkshop-deactivator.php
 */
function deactivate_wpworkshop()
{
  WpWorkshopDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wpworkshop');
register_deactivation_hook(__FILE__, 'deactivate_wpworkshop');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpworkshop()
{
  $plugin = new Wpworkshop();
  $plugin->run();
}
run_wpworkshop();
