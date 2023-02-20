<div class="wrap">        
    <h2>GO Bulk Create</h2>
    <form method="POST" action="">
        <input type="hidden" name="bulk_create_post_hidden" value="true" />
        <?php wp_nonce_field( 'bulk-create-awesome_update', 'bulk-create-awesome_form' ); ?>
        <table class="form-table">
            <tbody>
            <tr>
            <th><label for="bulk_create_post_type">Post Type:</label></th>
            <td><select name="bulk_create_post_type" type="" id="bulk_create_post_type" class="regular-text">
                <option value="">--Select--</option>  
                <?php foreach($page_elements['post_types'] as $post_type){ ?>    
                <option value="<?php echo $post_type; ?>"<?php if (isset($post_data['bulk_create_post_type']) && $post_data['bulk_create_post_type'] == $post_type) echo "selected";?>><?php echo ucwords($post_type); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="bulk_create_post_category">Post Category:</label></th>
            <td><select name="bulk_create_post_category" type="" id="bulk_create_post_category" class="regular-text">
                <option value="">--Select--</option>    
                <?php foreach($page_elements['post_categories'] as $category){ ?>
                <option value="<?php echo $category->term_id; ?>"<?php if (isset($post_data['bulk_create_post_category']) && $post_data['bulk_create_post_category'] == $category->term_id) echo "selected";?>><?php echo ucwords($category->name); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
                <th><label for="bulk_create_post_titles">Post Titles:</label></th>
                <td><textarea id="bulk_create_post_titles" rows="10" class="regular-text" name="bulk_create_post_titles" placeholder="Page titles here..."><?php if(isset($post_data['bulk_create_post_titles'])) echo $post_data['bulk_create_post_titles']; ?></textarea></td>
            </tr>
            <tr>
                <th><label for="bulk_create_post_slugs">Post Slugs:</label></th>
                <td><textarea id="bulk_create_post_slugs" rows="10" class="regular-text" name="bulk_create_post_slugs" placeholder="Page slugs here..."><?php if(isset($post_data['bulk_create_post_slugs'])) echo $post_data['bulk_create_post_slugs']; ?></textarea></td>
            </tr>
            <tr>
            <th><label for="bulk_create_post_draft">Post Draft:</label></th>
            <td><select name="bulk_create_post_draft" type="" id="bulk_create_post_draft" class="regular-text">
                <option value="">--Select--</option>  
                <?php foreach($page_elements['post_drafts'] as $draft) { ?>
                <option value="<?php echo $draft->ID; ?>"<?php if (isset($post_data['bulk_create_post_draft']) && $post_data['bulk_create_post_draft'] == $draft->ID) echo "selected";?>><?php echo $draft->post_title; ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="bulk_create_post_author">Post Author:</label></th>
            <td><select name="bulk_create_post_author" type="" id="bulk_create_post_author" class="regular-text">
                <?php foreach($page_elements['post_authors'] as $author) { ?>
                <option value="<?php echo $author->ID; ?><?php if (isset($post_data['bulk_create_post_author']) && $post_data['bulk_create_post_author'] == $author->ID) echo "selected";?>"><?php echo $author->display_name; ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="bulk_create_post_status">Post Status:</label></th>
            <td><select name="bulk_create_post_status" type="" id="bulk_create_post_status" class="regular-text">
                <?php foreach($page_elements['post_statuses'] as $status) { ?>
                <option value="<?php echo $status; ?>"<?php if (isset($post_data['bulk_create_post_status']) && $post_data['bulk_create_post_status'] == $status) echo "selected";?>><?php echo ucwords($status); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            </tbody>
        </table>
        <p class="submit">
        <input type="submit" name="bulk_create_post_submit" id="bulk_create_post_submit" class="button button-primary" value="Publish Posts Now">
        </p>
    </form>
</div> 