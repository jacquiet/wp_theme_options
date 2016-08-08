<?php
// Template component: Settings
// Displays the settings page
?>

<?php
// Component settings

// Get module options
global $sa_options;

// Instantiate metaboxes
$metabox = new Metabox();

// Instantiate model
$model = new Model();

// Get videos
$videos = $model->getPosts(array(
    'post_type'      => 'video',
    'posts_per_page' => -1
));

// Get templates
$templates = $model->getPosts(array(
    'post_type'      => 'template',
    'posts_per_page' => -1
));

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
                        <p class="block-title"><?php echo __('Social links') ?></p>
                        <p class="block-subtitle"><?php echo __('These links appear in the website\'s footer.'); ?></p>
                    </div>
                    <!-- /title -->

                    <!-- content -->
                    <div class="view-block-content">

                        <?php
                        // Create metabox [social_link_facebook]
                        $metabox->createField('input_text', array(
                            'name'          => 'social_link_facebook',
                            'title'         => 'Facebook',
                            'description'   => __('The URL, leading to your Facebook page'),
                            'required'      => false
                        ));

                        // Create metabox [social_link_twitter]
                        $metabox->createField('input_text', array(
                            'name'          => 'social_link_twitter',
                            'title'         => 'Twitter',
                            'description'   => __('The URL, leading to your Twitter page'),
                            'required'      => false
                        ));

                        // Create metabox [social_link_linkedin]
                        $metabox->createField('input_text', array(
                            'name'          => 'social_link_linkedin',
                            'title'         => 'LinkedIn',
                            'description'   => __('The URL, leading to your LinkedIn page'),
                            'required'      => false
                        ));

                        // Create metabox [social_link_youtube]
                        $metabox->createField('input_text', array(
                            'name'          => 'social_link_youtube',
                            'title'         => 'Youtube',
                            'description'   => __('The URL, leading to your Youtube page'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_4',
                            'title'         => 'Checkbox',
                            'description'   => __('Check this to enable something'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_5',
                            'title'         => 'Checkbox',
                            'description'   => __('Check this to enable something'),
                            'required'      => false
                        ));

                        // Create metabox [checkbox]
                        $metabox->createField('input_checkbox', array(
                            'name'          => 'page_id_6',
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
                            'title'         => 'Videos',
                            'description'   => __('Please choose one of the videos'),
                            'required'      => false,
                            'data'          => $videos
                        ));

                        // Create metabox [templates_dropdown]
                        $metabox->createField('dropdown_single', array(
                            'name'          => 'templates_dropdown',
                            'title'         => 'Templates',
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

                        // Create metabox [file upload]
                        $metabox->createField('input_image_upload', array(
                            'name'          => 'img_upload_1',
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

    </form>
    <!-- /form -->

</div>
<!-- /view-page [settings] -->