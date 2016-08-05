<?php
// Page: pages
// Displays the pages page
?>

<?php
// Page settings

// Get Controller
$controller = new Controller();
?>

<!-- view-page [home -->
<div class="view-page" data-view-page="home">

    <!-- view-page-heading -->
    <p class="view-page-heading"><?php echo __('Home'); ?></p>

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
<!-- /view-page [home -->