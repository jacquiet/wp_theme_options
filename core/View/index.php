<?php
// Template: index
// Displays the main page template
// @param array $view_data - passed by Router
?>


<?php
// Template settings

// get module
global $module;

// instantiate controller
$controller = new Controller();

// get main view
$mainView = $view_data['view'];
?>


<!-- module-view [index] -->
<div class="module-view" data-view="index">

    <!-- heading -->
    <div class="view-heading">

        <!-- load navigation -->
        <?php $controller->loadView('header'); ?>
    </div>


    <!-- main -->
    <div class="view-main">

        <!-- load page view -->
        <?php $controller->loadMainView($mainView); ?>
    </div>


    <!-- footer -->
    <div class="view-footer">

        <!-- Load footer -->
        <?php $controller->loadView('footer'); ?>
    </div>

</div>
<!-- /module-view [index] -->