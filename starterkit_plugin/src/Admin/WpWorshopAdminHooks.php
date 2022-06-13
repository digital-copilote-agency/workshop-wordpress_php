<?php

namespace Workshop\Admin;

use Workshop\Core\Interfaces\HookableInterface;

/**
 * The admin-specific hooks of the plugin.
 *
 * @link       https://www.digitalcopilote.io
 * @since      1.0.0
 *
 * @package    WpWorkshop
 * @subpackage WpWorkshop/admin
 */
abstract class WpWorkshopAdminHooks implements HookableInterface
{
  public static function hooks(): array
  {
    return [
      ['hook' => 'admin_enqueue_scripts', 'callback' => 'enqueue_styles'],
      ['hook' => 'admin_enqueue_scripts', 'callback' => 'enqueue_scripts'],
      ['hook' => 'admin_menu', 'callback' => 'addPluginAdminMenu'],
      ['hook' => 'admin_init', 'callback' => 'registerPluginSettings'],
    ];
  }
}
