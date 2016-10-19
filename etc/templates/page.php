<?php
// Template: Page
// Use this template as base for page views
// Page views are defined in moduledir/core/View/
?>

<?php

// Instantiate metabox
$metabox = new Metabox();

// Instantiate page
$page = new TO_Page(array(

    // get file name and set it as page name
    'name' => __FILE__,

    // define page sections
    'sections' => array(
        'example_1' => array(
            'title'    => __('Example 1'),
            'subtitle' => __('Please fill out the fields below')
        )
    )
));

// get home section
$example1Section = $page->getSections()->example_1;
?>

<?php $page->beforeContent(); ?>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-full">
            <?php

            // set section before content
            $page->beforeSection($example1Section);

            // create date picker
            $metabox->createField('input_date', array(
                'name'          => 'testing_date',
                'title'         => 'Example title',
                'description'   => __('Example description'),
                'required'      => false
            ));

            // create wysiwyg editor
            $metabox->createField('wysiwyg', array(
                'name'          => 'testing_editor',
                'title'         => 'Example title',
                'description'   => __('Example description'),
                'required'      => false
            ));

            // set section after content
            $page->afterSection();

            ?>
        </div>
    </div>

<?php $page->afterContent(); ?>