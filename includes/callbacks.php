<?php
/**
 * @package Bulk Create
 * Contains all callback methods to help with handling plugin features
 */

namespace Geokongo\BulkCreate;

class Callbacks extends Base {

    public $post_type = '';
    public $post_category = '';
    public $post_titles = [];
    public $post_slugs = [];
    public $post_draft = '';
    public $post_author = '';
    public $post_status = 'publish';
    public $post_data = [];
    public $post_error = false;

    /**
     * Entry point to the Callbacks class
     * Displays the admin dashboard, errors, messages and forms.
     * @param null
     */
    public function adminDashboard(){

        /**
         * Check for POST request using the NONCE field
         */
        if( isset( $_POST['bulk-create-awesome_form'] )){
            
            //It's a valid form submission
            if( wp_verify_nonce( $_POST['bulk-create-awesome_form'], 'bulk-create-awesome_update' )){

                //set post data
                $this->post_data = $_POST;

                //Prepair the input for saving in the database
                $this->setPostElements()
                        ->getPostDraft()
                        ->savePosts();

            }
            //Invalid form submission
            else{

                $error_message = '<div class="error">';
                $error_message .= '<p>Sorry, this form is invalid. Please try again.</p>';
                $error_message .= '</div>';

                echo $error_message;

            }
        }
        // Load admin page, proceed.       
        $page_elements = $this->getPageElements();
        $post_data = $this->post_data;
        return require_once("$this->plugin_path/templates/admin.php");
        
    }

    /**
     * Get the elements that you'll use to set up the form fields
     * @param null
     * @return array Form options and default values
     */
    public function getPageElements(){

        //get post types
        $post_types = get_post_types();

        //get post categories
        $post_categories = get_categories(['hide_empty' => 0]);

        //get post authors
        $post_authors = get_users( ['role__not_in' => 'subscriber'] );

        //get draft pages
        $post_drafts = get_pages(['post_status' => 'draft']);


        //get post status
        $post_statuses = [
            'publish',
            'draft',
            'pending',
            'private',
            'trash',
        ];

        return [
            'post_types' => $post_types,
            'post_categories' => $post_categories,
            'post_drafts' => $post_drafts,
            'post_authors' => $post_authors,
            'post_statuses' => $post_statuses,
        ];

    }

    /**
     * This method prepares the posts for the insert class
     * @param null
     * @return $this 
     */
    public function setPostElements(){
        
        /**
         * @post_type
         * 
         * Check if the post type has been set before accessing it.
         * If it's not set return an error message. 
         * Post type is mandatory
         */
        $post_type = isset($_POST['bulk_create_post_type']) ? $_POST['bulk_create_post_type']:"";

        if (strlen($post_type) == 0) {
            $error_message = '<div class="error">';
            $error_message .= '<p>Sorry, you did not submit any post type. Please try again.</p>';
            $error_message .= '</div>';

            echo $error_message;

            $this->post_error = true;
            return $this;
        }

        $this->post_type = $post_type;
        
        /**
         * @post_category
         */
        $post_category = isset($_POST['bulk_create_post_category']) ? $_POST['bulk_create_post_category']: "";
        $this->post_category = $post_category;

        /**
         * @post_titles
         * 
         * Check if the post titles have been sent before accessing them.
         * If there are no post titles return an error message.
         * If all looks good, explore each line of text it into an array 
         */

        $post_titles = isset($_POST['bulk_create_post_titles']) ? $_POST['bulk_create_post_titles']:"";

        if (strlen($post_titles) == 0) {
             $error_message = '<div class="error">';
             $error_message .= '<p>Sorry, you did not submit any post titles. Please try again.</p>';
             $error_message .= '</div>';
 
             echo $error_message;

             $this->post_error = true;
             return $this;
        }
 
        $post_titles = explode("\n", str_replace("\r", "", $post_titles));
        $this->post_titles = $post_titles;
         
        /**
         * @post_slugs
         * 
         * Check if the post slugs have been submitted before accessing them.
         * If they've beeen submitted, explode into an array with \n delimiter
         * Otherwise set value to null
         */
        $post_slugs = isset($_POST['bulk_create_post_slugs']) ? $_POST['bulk_create_post_slugs']: "";

        if (strlen($post_slugs) > 0)
            $post_slugs = explode("\n", str_replace("\r", "", $post_slugs));
        else
            $post_slugs = [];

        $this->post_slugs = $post_slugs;

        /**
         * @post_draft
         */
        $post_draft = isset($_POST['bulk_create_post_draft']) ? $_POST['bulk_create_post_draft']: "";
        $this->post_draft = absint($post_draft);

        /**
         * @post_author
         */
        $post_author = isset($_POST['bulk_create_post_author']) ? $_POST['bulk_create_post_author']: "";
        $this->post_author = $post_author;

        /**
         * @post_status
         */
        $post_status = isset($_POST['bulk_create_post_status']) ? $_POST['bulk_create_post_status']: "";
        $this->post_status = $post_status;
  
        return $this;

    }

    /**
     * This methods get's post draft from the database
     * @param null
     * @return object $this
     */
    public function getPostDraft(){
        
        //check if an error was encountered previously
        if ($this->post_error) return $this;

        //check if there's a draft defined
        if ($this->post_draft == null) return $this;
        $draft_content = get_post($this->post_draft);
        $this->post_draft = $draft_content->post_content;

        return $this;

    }

    /**
     * Handle the submitted form and and create the posts in the database
     * @param null
     */
    public function savePosts(){

        //check if an error was encountered
        if ($this->post_error) return;

        /**
         * Disable term counting.
         * This is extremely necessary for bulk insert
         */
        wp_defer_term_counting( true );
        wp_defer_comment_counting( true );

        //loop though the titles and save each, one at a time
        foreach($this->post_titles as $key => $title){

            //prepare the post array
            $post_array = [
                'post_author' => $this->post_author,
                'post_title' => wp_strip_all_tags($title),
                'post_status' => $this->post_status,
                'post_type' => $this->post_type,
                'post_name' => isset($this->post_slugs[$key]) ? $this->post_slugs[$key] : '',
                'post_category' => [$this->post_category],
            ];

            //check if there's actual content in draft
            if($this->post_draft != null) $post_array['post_content'] = $this->post_draft;

            $post_save = wp_insert_post($post_array);

        }

        /**
         * Reenable term counting.
         * It important to do this cleanup to set back to normal.
         */
        wp_defer_term_counting( false );
        wp_defer_comment_counting( false );

        $success_message = '<div class="updated">';
        $success_message .= '<p>All posts were published successfully.</p>';
        $success_message .= '</div>';

        //unset post data
        $this->post_data = [];
        echo $success_message;

    }

    public function wpbulkcreateOptionsGroup($input){
        return $input;
    }

    public function wpbulkcreateAdminSection(){
        echo "Check this section";
    }

    public function wpbulkcreateTextExample(){
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here">';
    }

    public function wpbulkcreateFirstName(){
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Your First Name">';
    }
}