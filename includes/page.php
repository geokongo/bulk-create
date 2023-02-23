<?php
/**
 * @package Bulk Create
 * Set the admin pages
 */

 namespace GOBulkCreate;

class Page extends Base {

    public $settings;
    public $page;
    public $callbacks;

    public function register(){
        $this->settings = new Settings();
        $this->callbacks = new Callbacks();
        $this->setPage();
        $this->setSettings();
        $this->setSections();
        $this->setFields();
        $this->settings->addPage($this->page)->register();
   
    }

    public function setPage(){
        $this->page = [
            'page_title' => 'GO Bulk Create', 
            'menu_title' => 'GO Bulk Create',
            'capability' => 'manage_options',
            'menu_slug' => 'bulk_create',
            'callback' => array($this->callbacks, 'adminDashboard'),
            'icon_url' => 'dashicons-store',
            'position' => 70,
        ];
    }

    public function setSettings(){
        $args = [
            [
                'option_group' => 'wp_bulk_create_group',
                'option_name' => 'text_example',
                'callback' => [$this->callbacks, 'wpbulkcreateOptionsGroup']
            ],
            [
                'option_group' => 'wp_bulk_create_group',
                'option_name' => 'first_name',
            ],
        ];

        $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = [
            [
                'id' => 'wpbulkcreate_admin_index',
                'title' => 'Settings',
                'callback' => [$this->callbacks, 'wpbulkcreateAdminSection'],
                'page' => 'wp_bulk_create'   
            ]
        ];

        $this->settings->setSections($args);
    }

    public function setFields(){
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => [$this->callbacks, 'wpbulkcreateTextExample'],
                'page' => 'wp_bulk_create',
                'section' => 'wpbulkcreate_admin_index',
                'args' => 
                [
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                ]  
                
            ],
            [
                'id' => 'first_name',
                'title' => 'First Name',
                'callback' => [$this->callbacks, 'wpbulkcreateFirstName'],
                'page' => 'wp_bulk_create',
                'section' => 'wpbulkcreate_admin_index',
                'args' => 
                [
                    'label_for' => 'first_name',
                    'class' => 'example-class'
                ]  
                
            ],
        ];

        $this->settings->setFields($args);
    }

}