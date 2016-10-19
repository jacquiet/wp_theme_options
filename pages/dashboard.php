<?php
// Page: pages
// Displays the pages page
?>

<?php
// Page settings

// instantiate controller
$controller = new Controller();

// instantiate page
$page = new TO_Page(array(
    'name' => __FILE__
));
?>

<?php $page->beforeContent(); ?>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-full">

        <!-- widget [activity] -->
        <?php $controller->loadWidget('activity'); ?>

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 col-full">

        <div class="row row-full">
            <div class="col-sm-12 col-full">

                <!-- widget [statistics] -->
                <?php $controller->loadWidget('statistics'); ?>

            </div>
            <div class="col-sm-12 col-full">

                <!-- widget [plugins] -->
                <?php $controller->loadWidget('plugins'); ?>

            </div>
        </div>

    </div>
</div>

<?php $page->afterContent(); ?>