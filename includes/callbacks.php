<?php
/**
 * @package Bulk Create
 */

namespace Geokongo\BulkCreate;

class Callbacks extends Base {

    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/admin.php");
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