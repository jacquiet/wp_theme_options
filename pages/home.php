<?php
// Template: Home
?>

<?php

// Instantiate metabox
$metabox = new Metabox();

// Instantiate page
$page = new TO_Page(array(
    'name' => __FILE__,
    'sections' => array(
        'home' => array(
            'title'    => __('Fields'),
            'subtitle' => __('Please fill out the fields below')
        ),
        'extra' => array(
            'title'    => __('Extra'),
            'subtitle' => __('Please extra this extra to gen an extra')
        )
    )
));

// get home section
$homeSection = $page->getSections()->home;

// get extra section
$extraSection = $page->getSections()->extra;
?>


<?php $page->beforeContent(); ?>

<div class="row">
    <div class="col-sm-12 col-md-6 col-full">
        <?php

        // set section before content
        $page->beforeSection($homeSection);

        // create date picker
        $metabox->createField('input_date', array(
            'name'          => 'testing_date_field',
            'title'         => 'Test 123',
            'description'   => __('Please test this'),
            'required'      => false
        ));

        // create wysiwyg editor
        $metabox->createField('wysiwyg', array(
            'name'          => 'testing_field',
            'title'         => 'Test 123',
            'description'   => __('Please test this'),
            'required'      => false
        ));

        // set section after content
        $page->afterSection();

        ?>
    </div>

    <div class="col-sm-12 col-md-6 col-full">
        <?php

        // set section before content
        $page->beforeSection($extraSection);

        // create text field
        $metabox->createField('input_text', array(
            'name'          => 'testing_text',
            'title'         => 'Text field',
            'description'   => __('Please test this'),
            'required'      => false
        ));

        // create map
        $metabox->createField('map', array(
            'name'          => 'testing_map',
            'title'         => 'Map',
            'description'   => __('Please test this'),
            'required'      => false
        ));

        // set section after content
        $page->afterSection();
        ?>
    </div>
</div>

<?php $page->afterContent(); ?>