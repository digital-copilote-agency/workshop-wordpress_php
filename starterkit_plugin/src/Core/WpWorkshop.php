<?php
namespace Workshop\Core;

use Workshop\Public\WpWorkshopPublic;
use Workshop\Admin\WpWorkshopAdmin;
// use Workshop\Admin\WpWorkshopAdminHooks;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wpworkshop
 * @subpackage Wpworkshop/src/Core
 * @author     Digital Copilote <devs.digitalcopilote@gmail.com>
 */
class WpWorkshop
{
  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      WpWorkshopLoader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct()
  {
    if (defined('WPWORKSHOP_VERSION')) {
      $this->version = WPWORKSHOP_VERSION;
    } else {
      $this->version = '1.0.0';
    }
    $this->plugin_name = 'wpworkshop';

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  /**
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   * 
   * Necessary classes are loaded using autoload namespaces.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies()
  {
    $this->loader = new WpWorkshopLoader();
  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Wpworkshop_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale()
  {
    $plugin_i18n = new WpWorkshopI18n();

    $this->loader->add_action(
      'plugins_loaded',
      $plugin_i18n,
      'load_plugin_textdomain'
    );
  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks()
  {
    $pluginAdmin = new WpWorkshopAdmin($this->get_plugin_name(), $this->get_version());
    $adminHooks = [
      ['hook' => 'admin_enqueue_scripts', 'callback' => 'enqueue_styles'],
      ['hook' => 'admin_enqueue_scripts', 'callback' => 'enqueue_scripts'],
      ['hook' => 'admin_menu', 'callback' => 'addPluginAdminMenu'],
      ['hook' => 'admin_init', 'callback' => 'registerPluginSettings'],
    ];
    // $adminHooks = WpWorkshopAdminHooks::hooks();

    foreach($adminHooks as $hookInfos) {
      $this->loader->add_action($hookInfos['hook'], $pluginAdmin, $hookInfos['callback']);
    }
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks()
  {
    $plugin_public = new WpWorkshopPublic(
      $this->get_plugin_name(),
      $this->get_version()
    );

    $this->loader->add_action(
      'wp_enqueue_scripts',
      $plugin_public,
      'enqueue_styles'
    );
    $this->loader->add_action(
      'wp_enqueue_scripts',
      $plugin_public,
      'enqueue_scripts'
    );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run()
  {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Wpworkshop_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader()
  {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version()
  {
    return $this->version;
  }
}
