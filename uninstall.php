<?php
/**
 * @package Bulk Create
 */

if(!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'bulk_create_option';
delete_option( $option_name );   
