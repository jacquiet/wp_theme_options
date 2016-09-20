<?php
// Page: WYSIWYG
// Page views are defined in moduledir/core/View/
?>

<?php
// Page settings

// Instantiate metabox
$metabox = new Metabox();

// Instantiate controller
$controller = new Controller();
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
        <p class="view-page-heading"><?php echo __('Insert your page name here'); ?></p>

        <div class="row">
            <div class="col-sm-12 col-md-4 col-full">

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

                        // Create wysiwyg
                        $metabox->createField('wysiwyg', array(
                            'name'          => 'wysiwyg_6',
                            'title'         => 'WYSIWYG',
                            'description'   => __('WYSIWYG editor'),
                            'required'      => false
                        ));

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>
            <div class="col-sm-12 col-md-8 col-full">

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

                        // Create wysiwyg
                        $metabox->createField('wysiwyg', array(
                            'name'          => 'wysiwyg_4',
                            'title'         => 'WYSIWYG',
                            'description'   => __('WYSIWYG editor'),
                            'required'      => false
                        ));

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>
        </div>

        <!-- REQUIRED: button-submit-hidden -->
        <!-- This hidden button is triggered via JS, without it the form validation doesn't work -->
        <input type="submit" class="button-submit-hidden"/>
    </form>
    <!-- /form -->

</div>
<!-- /view-page [insert page name here] -->