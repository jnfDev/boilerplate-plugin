<?php
/**
 * Plugin Name: My Plugin (Boilerplate Plugin)
 * Author: jnfdev
 * Text Domain: boilerplate-plugin-domain
 * Domain Path: /languages
 */
namespace Jnfdev\MyPlugin;

defined( 'ABSPATH' ) || exit;

require_once __DIR__.'/vendor/autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'JNFDEV_MYPLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boilerplate-wppb-deactivator.php
 */
register_activation_hook( __FILE__, function() {
    Installer::instance();
} );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boilerplate-wppb-deactivator.php
 */
register_deactivation_hook( __FILE__, function() {
    Uninstaller::instance();
} );

MyPlugin::instance();