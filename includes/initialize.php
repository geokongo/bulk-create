<?php
/**
 * @package Bulk Create
 * This is the class that initiates the plugin core functions.
 * It extends the Base class where the plugin variables are set.
 */

namespace Geokongo\BulkCreate;

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
     * This method defines the plugin settings page link
     * @param array $links 
     * @return array The html for the settings link
     */
    public function settings_link($links){
        //add custom settings link
        $settings_link = '<a href="admin.php?page=bulk_create">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    /**
     * This function is the entry point to this plugin
     * It enqueues the asset files, sets admin page links and registers admin pages.
     * @param null
     * @return void()
     */
    public function start(){
        // set the plugin settings link
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        // enqueue the plugin css and javascript files
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
        // initialize the admin pages class
        $page = new Page();
        $page->register();   
        
        $post = [
            'post_content' => '<p>Can this be a reusable block?</p>',
            'post_title' => 'Hello World',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => [1],
            'post_name' => 'hello-me-world'
        ];
        
        //wp_insert_post($post);
        //var_dump($insert);
    
    }

 }
