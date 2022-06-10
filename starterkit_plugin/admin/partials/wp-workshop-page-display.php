<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.digitalcopilote.io
 * @since      1.0.0
 *
 * @package    Wpworkshop
 * @subpackage Wpworkshop/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

      <div class="wrap">
        <h1> 
        <?php echo get_admin_page_title(); ?>
        </h1>
        <form action="options.php" method="post">
          <?php
          settings_fields('workshop_plugin_settings');
          do_settings_sections('workshop_plugin_settings');
          submit_button();
          ?>
        </form>
      </div>
