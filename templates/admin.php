<div class="container">
<div class="wrap row">
    <div class="col-sm">
        <p>Column One</p>
    </div>
    <div class="col-sm">
        <p>Column Two</p>
    </div>
    <div class="col-sm">
        <h1>Bulk Create</h1>
        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php
                settings_fields('wp_bulk_create_group');
                do_settings_sections('wp_bulk_create');
                submit_button();
            ?>
        </form>
    </div>
</div>
</div>
