<?php
/**
 * @package Bulk Create
 */

namespace Geokongo\BulkCreate;

class Uninstall {

    public static function uninstall(){

        if(!defined('WP_UNINSTALL_PLUGIN')) {
            die;
        }

        $option_name = 'bulk_create_option';
        delete_option( $option_name );   
    }
    
}