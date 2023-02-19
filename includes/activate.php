<?php
/**
 * @package Bulk Create
 */

namespace Geokongo\BulkCreate;

class Activate {
    public static function activate(){
        flush_rewrite_rules();
    }
}