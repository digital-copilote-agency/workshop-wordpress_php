<?php

namespace Workshop\Admin;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.digitalcopilote.io
 * @since      1.0.0
 *
 * @package    Wpworkshop
 * @subpackage Wpworkshop/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpworkshop
 * @subpackage Wpworkshop/admin
 * @author     Digital Copilote <devs.digitalcopilote@gmail.com>
 */
class WpWorkshopAdmin
{
  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Wpworkshop_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Wpworkshop_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style(
      $this->plugin_name,
      plugin_dir_url(__FILE__) . 'css/wpworkshop-admin.css',
      [],
      $this->version,
      'all'
    );
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {
    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Wpworkshop_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Wpworkshop_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script(
      $this->plugin_name,
      plugin_dir_url(__FILE__) . 'js/wpworkshop-admin.js',
      ['jquery'],
      $this->version,
      false
    );
  }

  public function addPluginAdminMenu()
  {
    /**
     *
     * An instance of this class should be passed to the run() function
     * defined in Wpworkshop_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Wpworkshop_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */
    add_menu_page(
      'WP Workshop Plugin Page',
      'WP Workshop Menu',
      'manage_options',
      'wpworkshop',
      [$this, 'displayPluginAdminPage'],
      'dashicons-hammer',
      50
    );
  }

  public function displayPluginAdminPage()
  {
    require_once plugin_dir_path(__FILE__) .
      '../../admin/partials/wp-workshop-page-display.php';
  }

  public function registerPluginSettings()
  {
    $args = [
      'show_in_rest' => true,
      'default' => null,
    ];

    add_settings_section(
      'send_parameter_section',
      'Sending parameters',
      [$this, 'sendParameterSectionHtml'],
      'workshop_plugin_settings'
    );
    add_settings_field(
      'dcwps_recipient_email',
      'Recipient address',
      fn() => $this->settingFieldHtml('dcwps_recipient_email'),
      'workshop_plugin_settings',
      'send_parameter_section'
    );
    add_settings_field(
      'dcwps_recipient_firstname',
      'Firstname',
      fn() => $this->settingFieldHtml('dcwps_recipient_firstname'),
      'workshop_plugin_settings',
      'send_parameter_section'
    );
    register_setting(
      'workshop_plugin_settings',
      'dcwps_recipient_email',
      $args
    );
    register_setting(
      'workshop_plugin_settings',
      'dcwps_recipient_firstname',
      $args
    );
  }
  public function sendParameterSectionHtml()
  {
    ?>
    <div>
      <h3>Register</h3>
    </div>
    <?php
  }

  public function settingFieldHtml(string $fieldId)
  {
    ?>
    <input type='text' name='<?php echo $fieldId; ?>' value='<?php echo get_option($fieldId); ?>'/>
    <?php
  }
}
