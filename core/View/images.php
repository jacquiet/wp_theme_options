<?php
// Page: Other
// Page views are defined in moduledir/core/View/
?>

<?php
// Page settings

// Instantiate metabox
$metabox = new Metabox();

// Instantiate controller;

$controller = new Controller();
?>

<!-- view-page [insert page name here] -->
<div class="view-page" data-view-page="other">

    <!-- REQUIRED: form -->
    <form class="view-form" action="options.php" method="POST">

        <!-- REQUIRED: insert security fields -->
        <?php settings_fields('sa_theme_options'); ?>

        <!-- REQUIRED: create hidden fields for module options -->
        <?php $metabox->createOptionFields(); ?>

        <!-- page name -->
        <p class="view-page-heading"><?php echo __('Other'); ?></p>

        <div class="row">
            <div class="col-sm-6 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Hey, handsome!') ?></p>
                        <p class="block-subtitle"><?php echo __('Message from General Cartman Lee'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [gallery]
                        $metabox->createField('gallery', array(
                            'name'          => 'gallery_4',
                            'title'         => 'Gallery',
                            'description'   => __('Upload images here'),
                            'required'      => true
                        ));

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>
            <div class="col-sm-6 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Hey, there!') ?></p>
                        <p class="block-subtitle"><?php echo __('Lorem ipsum dolor sit amen'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [gallery]
                        $metabox->createField('gallery', array(
                            'name'          => 'gallery_5',
                            'title'         => 'Gallery',
                            'description'   => __('Upload images here'),
                            'required'      => true
                        ));

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Hey, handsome!') ?></p>
                        <p class="block-subtitle"><?php echo __('Message from General Cartman Lee'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [image upload]
                        $metabox->createField('image_upload', array(
                            'name'          => 'img_upload_3',
                            'title'         => 'Image upload',
                            'description'   => __('Upload an image here'),
                            'required'      => true
                        ));

                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 col-full">
                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Hey, handsome!') ?></p>
                        <p class="block-subtitle"><?php echo __('Message from General Cartman Lee'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [image upload]
                        $metabox->createField('image_upload', array(
                            'name'          => 'img_upload_4',
                            'title'         => 'Image upload',
                            'description'   => __('Upload an image here'),
                            'required'      => true
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