<?php
// Template component: Pages
// Displays the pages page
?>

<?php
// Component settings

// Get module options
global $sa_options;

// Instantiate metabox
$metabox = new Metabox();

// Instantiate controller
$controller = new Controller();

// Request module options
$settings = get_option( 'sa_options', $sa_options );
?>

<div class="view-component" data-view-component="pages">

    <form class="view-form" action="options.php" method="POST">

        <!-- insert security fields -->
        <?php settings_fields('sa_theme_options'); ?>

        <!-- create hidden fields for module options -->
        <?php $metabox->createOptionFields(); ?>

        <p class="view-component-heading"><?php echo __('Pages'); ?></p>

        <div class="row">

            <div class="col-sm-12 col-md-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Home') ?></p>
                        <p class="block-subtitle"><?php echo __('Fields required for the homepage.'); ?></p>
                    </div>

                    <!-- content -->
                    <div class="view-block-content">

                        <?php

                        // Create wysiwyg
                        $metabox->createField('wysiwyg', array(
                            'name'          => 'wysiwyg_2',
                            'title'         => 'WYSIWYG',
                            'description'   => __('WYSIWYG editor'),
                            'required'      => false
                        ));

                        ?>

                    </div>

                </div>
                <!-- /view-block -->

            </div>

            <div class="col-sm-12 col-md-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Blog') ?></p>
                        <p class="block-subtitle"><?php echo __('Fields required for the blog page.'); ?></p>
                    </div>

                    <!-- content -->
                    <div class="view-block-content">

                        <?php
                        // Create metabox [page_id_home]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_blog_field_1',
                            'title'         => 'Field 1',
                            'description'   => __('Field 1'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_blog]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_blog_field_2',
                            'title'         => 'Field 2',
                            'description'   => __('Field 2'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_contact]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_blog_field_3',
                            'title'         => 'Field 3',
                            'description'   => __('Field 3'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_about]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_blog_field_4',
                            'title'         => 'Field 4',
                            'description'   => __('Field 4'),
                            'required'      => false
                        ));
                        ?>

                    </div>

                </div>
                <!-- /view-block -->

            </div>

            <div class="col-sm-12 col-md-4 col-full">

                <!-- view-block -->
                <div class="view-block">

                    <!-- title -->
                    <div class="view-block-title">
                        <p class="block-title"><?php echo __('Contact') ?></p>
                        <p class="block-subtitle"><?php echo __('Fields required for the contact page.'); ?></p>
                    </div>

                    <!-- content -->
                    <div class="view-block-content">

                        <?php
                        // Create metabox [page_id_home]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_contact_field_1',
                            'title'         => 'Field 1',
                            'description'   => __('Field 1'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_blog]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_contact_field_2',
                            'title'         => 'Field 2',
                            'description'   => __('Field 2'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_contact]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_contact_field_3',
                            'title'         => 'Field 3',
                            'description'   => __('Field 3'),
                            'required'      => false
                        ));

                        // Create metabox [page_id_about]
                        $metabox->createField('input_text', array(
                            'name'          => 'page_contact_field_4',
                            'title'         => 'Field 4',
                            'description'   => __('Field 4'),
                            'required'      => false
                        ));
                        ?>

                    </div>

                </div>
                <!-- /view-block -->

            </div>
        </div>

    </form>

</div>