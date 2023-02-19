<?php
/**
 * @package Bulk Create
 * Define the plugin settings
 */

namespace Geokongo\BulkCreate;

class Settings{

    public $admin_page = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();



    public function register(){
        if(!empty($this->admin_page)){
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if(!empty($this->settings)){
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    public function addPage(array $page){
        $this->admin_page = $page;
        return $this;
    }

    public function addAdminMenu(){
        add_menu_page(
            $this->admin_page['page_title'], 
            $this->admin_page['menu_title'], 
            $this->admin_page['capability'], 
            $this->admin_page['menu_slug'], 
            $this->admin_page['callback'], 
            $this->admin_page['icon_url'], 
            $this->admin_page['position']
        );
    }

    public function setSettings(array $settings){
        $this->settings = $settings;
        return $this;
    }
    
    public function setSections(array $sections){
        $this->sections = $sections;
        return $this;
    }
    
    public function setFields(array $fields){
        $this->fields = $fields;
        return $this;
    }
    
    public function registerCustomFields(){

        //register setting
        foreach($this->settings as $setting ){
            register_setting(
                $setting["option_group"], 
                $setting["option_name"], 
                (isset($setting["callback"]) ? $setting["callback"] : '')
            );
        }

        // add settings section
        foreach($this->sections as $section){
            add_settings_section(
                $section["id"], 
                $section["title"], 
                (isset($section["callback"]) ? $section["callback"] : ''), 
                $section["page"]
            );
        }

        // add settings field
        foreach($this->fields as $field){
            add_settings_field(
                $field["id"], 
                $field["title"], 
                (isset($field["callback"]) ? $field["callback"] : ''), 
                $field["page"], 
                $field["section"], 
                (isset($field["args"]) ? $field["args"] : '')
            );
        }
        
    }
}