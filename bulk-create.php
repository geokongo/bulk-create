<?php
/**
 * @package Bulk Create
 */
/*
Plugin Name: Bulk Create
Plugin URI: https://wordpress.org/plugins/bulk-create
Description: This plugin will help you create and publish WordPress pages and post in bulk. You can do this from a list of page titles and URL slugs that you can copy directly into the plugin area of upload a .csv file. I'm also working on a possibility of saving time by simply linking to you Google Sheets and publishing in just one click.
Version: 1.0.0
Author: Geoffrey Okongo
Author URI: https://geokongo.com
License: MIT
Text Domain: bulk-create
*/
/*

Permission is hereby granted, free of charge, to any person obtaining a copy of this software 
and associated documentation files (the “Software”), to deal in the Software without restriction,
including without limitation the rights to use, copy, modify, merge, publish, distribute, 
sublicense, and/or sell copies of the Software, and to permit persons to whom the Software 
is furnished to do so.

Copyright (c) 2020-2023 Geoffrey Okongo
*/

//If this file is called directly, abort!
defined('ABSPATH') or die;

//Require the composer autoload file once
if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')){ 
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}