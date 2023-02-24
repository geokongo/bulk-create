<?php
/**
 * @package Bulk Create
 * This is the class that initiates the plugin core functions.
 * It extends the Base class where the plugin variables are set.
 */

 namespace GOBulkCreate;

class Init extends Base{

    /**
     * This method enqueues the plugin CSS and JS files
     * @param null 
     * @return void
     */
    public function enqueueScripts(){
        //enqueue all our scripts
        wp_enqueue_style('gobulkcreatestyle', $this->plugin_url . 'assets/style.css');
        wp_enqueue_script('gobulkcreatescript', $this->plugin_url . 'assets/script.js');
    }

    /**
     * Function to define the settings link in the plugin listing page
     * @param array $links The current array list of links
     * @return array The array with the settings link appended
     */
    public function settingsLink($links){
        
        $link = '<a href="admin.php?page=go-bulk-create">Settings</a>';
        array_push($links, $link);
        return $links;

    }

    /**
     * This function is the entry point to this plugin
     * It enqueues the asset files, sets admin page links and registers admin pages.
     * @param null
     * @return void()
     */
    public function init(){

        // add the plugin settings link to plugin listing page
        add_filter("plugin_action_links_$this->plugin", array($this, 'settingsLink'));
        
        // enqueue the plugin css and javascript files
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        // initialize the admin pages class
        
        $page = new Admin();
        $page->load();   
            
    }

 }
