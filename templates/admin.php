<div class="wrap">        
    <h2>GO Bulk Create</h2>
    <form method="POST" action="">
        <?php wp_nonce_field( 'gobulkcreate-awesome-update', 'gobulkcreate-awesome-form' ); ?>
        <table class="form-table">
            <tbody>
            <tr>
            <th><label for="gobulkcreate-post-type">Post Type:</label></th>
            <td><select name="gobulkcreate-post-type" type="" id="gobulkcreate-post-type" class="regular-text">
                <option value="">--Select--</option>  
                <?php foreach($page_elements['post_types'] as $post_type){ ?>    
                <option value="<?php echo $post_type; ?>"<?php if (isset($post_data['gobulkcreate-post-type']) && $post_data['gobulkcreate-post-type'] == $post_type) echo "selected";?>><?php echo ucwords($post_type); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="gobulkcreate-post-category">Post Category:</label></th>
            <td><select name="gobulkcreate-post-category" type="" id="gobulkcreate-post-category" class="regular-text">
                <option value="">--Select--</option>    
                <?php foreach($page_elements['post_categories'] as $category){ ?>
                <option value="<?php echo $category->term_id; ?>"<?php if (isset($post_data['gobulkcreate-post-category']) && $post_data['gobulkcreate-post-category'] == $category->term_id) echo "selected";?>><?php echo ucwords($category->name); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
                <th><label for="gobulkcreate-post-titles">Post Titles:</label></th>
                <td><textarea id="gobulkcreate-post-titles" rows="10" class="regular-text" name="gobulkcreate-post-titles" placeholder="Page titles here..."><?php if(isset($post_data['gobulkcreate-post-titles'])) echo $post_data['gobulkcreate-post-titles']; ?></textarea></td>
            </tr>
            <tr>
                <th><label for="gobulkcreate-post-slugs">Post Slugs:</label></th>
                <td><textarea id="gobulkcreate-post-slugs" rows="10" class="regular-text" name="gobulkcreate-post-slugs" placeholder="Page slugs here..."><?php if(isset($post_data['gobulkcreate-post-slugs'])) echo $post_data['gobulkcreate-post-slugs']; ?></textarea></td>
            </tr>
            <tr>
            <th><label for="gobulkcreate-post-draft">Post Draft:</label></th>
            <td><select name="gobulkcreate-post-draft" type="" id="gobulkcreate-post-draft" class="regular-text">
                <option value="">--Select--</option>  
                <?php foreach($page_elements['post_drafts'] as $draft) { ?>
                <option value="<?php echo $draft->ID; ?>"<?php if (isset($post_data['gobulkcreate-post-draft']) && $post_data['gobulkcreate-post-draft'] == $draft->ID) echo "selected";?>><?php echo $draft->post_title; ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="gobulkcreate-post-author">Post Author:</label></th>
            <td><select name="gobulkcreate-post-author" type="" id="gobulkcreate-post-author" class="regular-text">
                <?php foreach($page_elements['post_authors'] as $author) { ?>
                <option value="<?php echo $author->ID; ?><?php if (isset($post_data['gobulkcreate-post-author']) && $post_data['gobulkcreate-post-author'] == $author->ID) echo "selected";?>"><?php echo $author->display_name; ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            <tr>
            <th><label for="gobulkcreate-post-status">Post Status:</label></th>
            <td><select name="gobulkcreate-post-status" type="" id="gobulkcreate-post-status" class="regular-text">
                <?php foreach($page_elements['post_statuses'] as $status) { ?>
                <option value="<?php echo $status; ?>"<?php if (isset($post_data['gobulkcreate-post-status']) && $post_data['gobulkcreate-post-status'] == $status) echo "selected";?>><?php echo ucwords($status); ?></option>
                <?php } ?>
                </select>
            </td>                
            </tr>
            </tbody>
        </table>
        <p class="submit">
        <input type="submit" name="gobulkcreate-post-submit" id="gobulkcreate-post-submit" class="button button-primary" value="Publish Posts Now">
        </p>
    </form>
</div> 