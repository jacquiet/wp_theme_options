<?php
// Template component: pages
// Displays the pages page
?>

<?php
// Component settings

// Get Controller
$controller = new Controller();
?>

<div class="view-component" data-view-component="home">
    <p class="view-component-heading"><?php echo __('Home'); ?></p>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-full">

            <!-- load widget [activity] -->
            <?php $controller->loadWidget('activity'); ?>

        </div>

        <div class="col-xs-12 col-sm-6 col-md-4 col-full">

            <!-- load widget [statistics] -->
            <?php $controller->loadWidget('statistics'); ?>

        </div>
    </div>

</div>