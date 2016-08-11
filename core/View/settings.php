<?php
// Page: Settings
// Displays the settings page
?>

<?php
// Page settings

// Get module options
global $sa_options;

// Instantiate metaboxes
$metabox = new Metabox();

// Instantiate model
$model = new Model();

// Get videos
$videos = $model->getPosts('video');

// Get templates
$templates = $model->getPosts('template');

// Require module options
$settings = get_option('sa_options', $sa_options);
?>

<!-- view-page [settings] -->
<div class="view-page" data-view-page="settings">

    <!-- form -->
    <form class="view-form" action="options.php" method="POST">

        <!-- insert security fields -->
        <?php settings_fields('sa_theme_options'); ?>

        <!-- create hidden fields for module options -->
        <?php $metabox->createOptionFields(); ?>

        <!-- view-page-heading -->
        <p class="view-page-heading"><?php echo __('Settings'); ?></p>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Page IDs') ?></p>
                        <p class="block-subtitle"><?php echo __('Insert the page ids to allow internal linking.'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [page_id_home]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_id_home',
                            'title'         => 'Home',
                            'description'   => __('Homepage ID'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_blog]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_id_blog',
                            'title'         => 'Blog',
                            'description'   => __('Blog page ID'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_contact]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_id_contact',
                            'title'         => 'Contact',
                            'description'   => __('Contact page ID'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_about]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_id_about',
                            'title'         => 'About',
                            'description'   => __('About page ID'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_1',
                            'title'         => 'Checkbox',
                            'description'   => __('Check this to enable something'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_2',
                            'title'         => 'Checkbox',
                            'description'   => __('Check this to enable something'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_3',
                            'title'         => 'Checkbox',
                            'description'   => __('Check this to enable something'),
                            'required'      => false
                        ));
                        ?>

                    </div>
                    <!-- /content -->

                </div>
                <!-- /view-block -->

            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Galleries') ?></p>
                        <p class="block-subtitle"><?php echo __('These galleries appear throughout the website.'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create metabox [gallery]
                        $metabox->createField('gallery', array(
                            'name'          => 'gallery_2',
                            'title'         => 'Gallery',
                            'description'   => __('Upload images here'),
                            'required'      => true
                        ));

                        // Create metabox [gallery]
                        $metabox->createField('gallery', array(
                            'name'          => 'gallery_3',
                            'title'         => 'Gallery',
                            'description'   => __('Upload images here'),
                            'required'      => true
                        ));

                        // Create metabox [gallery]
                        $metabox->createField('gallery', array(
                            'name'          => 'gallery_4',
                            'title'         => 'Gallery',
                            'description'   => __('Upload images here'),
                            'required'      => true
                        ));

                        // Create metabox [image upload]
                        $metabox->createField('image_upload', array(
                            'name'          => 'img_upload_1',
                            'title'         => 'Image upload',
                            'description'   => __('Upload an image here'),
                            'required'      => true
                        ));

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

            <div class="col-sm-12 col-md-6 col-lg-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Other stuff') ?></p>
                        <p class="block-subtitle"><?php echo __('More options are available here.'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php
                        // Create metabox [videos_dropdown]
                        $metabox->createField('dropdown_single', array(
                            'name'          => 'videos_dropdown',
                            'title'         => 'Dropdown single - Videos',
                            'description'   => __('Please choose one of the videos'),
                            'required'      => false,
                            'data'          => $videos
                        ));

                        // Create metabox [dropdown_multiselect]
                        $metabox->createField('dropdown_multiple', array(
                            'name'          => 'multi_dropdown_1',
                            'title'         => 'Dropdown multiple - Videos',
                            'description'   => __('Please choose one of the videos'),
                            'required'      => false,
                            'data'          => $videos
                        ));

                        // Create metabox [templates_dropdown]
                        $metabox->createField('dropdown_single', array(
                            'name'          => 'templates_dropdown',
                            'title'         => 'Dropdown single - Templates',
                            'description'   => __('Please choose one of the templates'),
                            'required'      => false,
                            'data'          => $templates
                        ));

                        // Create metabox [date]
                        $metabox->createField('input_date', array(
                            'name'          => 'date_1',
                            'title'         => 'Date input',
                            'description'   => __('Insert a date here'),
                            'required'      => true
                        ));

                        // Create metabox [number]
                        $metabox->createField('input_number', array(
                            'name'          => 'num_1',
                            'title'         => 'Number input',
                            'description'   => __('Insert a number here'),
                            'required'      => true
                        ));

                        // Create metabox [file_upload]
                        $metabox->createField('file_upload', array(
                            'name'          => 'file_upload_1',
                            'title'         => 'File upload',
                            'description'   => __('Upload a file here'),
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
<!-- /view-page [settings] -->