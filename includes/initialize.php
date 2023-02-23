<?php
/**
 * @package Bulk Create
 * This is the class that initiates the plugin core functions.
 * It extends the Base class where the plugin variables are set.
 */

 namespace GOBulkCreate;

class Initialize extends Base{

    /**
     * This method enqueues the plugin CSS and JS files
     * @param null 
     * @return void
     */
    public function enqueue(){
        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/style.css');
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/script.js');
    }

    /**
     * This function is the entry point to this plugin
     * It enqueues the asset files, sets admin page links and registers admin pages.
     * @param null
     * @return void()
     */
    public function start(){
        // // set the plugin settings link
        // add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        // enqueue the plugin css and javascript files
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        // initialize the admin pages class
        $page = new Page();
        $page->register();   
            
    }

 }
