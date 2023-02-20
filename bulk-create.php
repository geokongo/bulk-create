<?php
/**
 * Plugin Name          
 *
 * @package           PluginPackage
 * @author            Geoffrey Okongo
 * @copyright         2023 (c) Geoffrey Okongo
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       GO Bulk Create
 * Plugin URI:        https://github.com/geokongo/bulk-create
 * Description:       This plugin will help you create and publish WordPress pages and post in bulk. You can do this from a list of page titles and URL slugs that you can copy directly into the plugin admin area.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Geoffrey Okongo
 * Author URI:        https://geokongo.com
 * Text Domain:       bulk-create
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://wordpress.com/plugins/bulk-create
 */

//If this file is called directly, abort!
defined('ABSPATH') or die;

//Require the composer autoload file once
if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')){ 
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function bulkcreate_activate(){
    flush_rewrite_rules();
}

/**
 * The code that runs during plugin deactivation
 */
function bulkcreate_deactivate(){
    flush_rewrite_rules();
}

/**
 * The code that runs during plugin uninstall
 */
function bulkcreate_uninstall(){
    
}

register_activation_hook(__FILE__, 'bulkcreate_activate');
register_deactivation_hook(__FILE__, 'bulkcreate_deactivate');
register_uninstall_hook(__FILE__, 'bulkcreate_uninstall');

/**
 * Initialize all the core classes of the plugin
 */
if(class_exists('Geokongo\BulkCreate\Initialize')){
    $bulkcreate = new Geokongo\BulkCreate\Initialize();
    $bulkcreate->start();
}