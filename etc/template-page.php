<?php
// Template: Page
// Use this template as base for page views
// Page views are defined in moduledir/core/View/
?>

<?php
// Page settings should be added here

// Instantiate metabox
$metabox = new Metabox();
?>

<!-- view-page [insert page name here] -->
<div class="view-page" data-view-page="{insert page name here}">

    <!-- REQUIRED: form -->
    <form class="view-form" action="options.php" method="POST">

        <!-- REQUIRED: insert security fields -->
        <?php settings_fields('sa_theme_options'); ?>

        <!-- REQUIRED: create hidden fields for module options -->
        <?php $metabox->createOptionFields(); ?>

        <!-- page name -->
        <p class="view-component-heading"><?php echo __('Insert your page name here'); ?></p>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Insert your page title here') ?></p>
                        <p class="block-subtitle"><?php echo __('Insert your page subtitle here'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Call page metafields here using the metabox API

                        // Available public metabox methods:

                        // $metabox->createField('input_text', $args);
                        // $metabox->createField('input_number', $args);
                        // $metabox->createField('input_checkbox', $args);
                        // $metabox->createField('input_date', $args);
                        // $metabox->createField('input_image_upload', $args);
                        // $metabox->createField('textarea', $args);
                        // $metabox->createField('dropdown_single', $args);
                        // $metabox->createField('wysiwyg', $args);

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>
        </div>

    </form>
    <!-- /form -->

</div>
<!-- /view-page [insert page name here] -->