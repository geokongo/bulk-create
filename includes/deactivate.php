<?php
/**
 * @package Bulk Create
 */

namespace Geokongo\BulkCreate;

class Deactivate{
    public static function deactivate(){
        flush_rewrite_rules();
    }
 }