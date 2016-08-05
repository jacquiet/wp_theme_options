<?php
// Template: index
// Displays the main page template
// @param array $view_data - passed by Controller
?>


<?php
// Template settings

// Get module
global $module;

// Instantiate controller
$controller = new Controller();
?>


<!-- module-view [index] -->
<div class="module-view" data-view="index">

    <!-- heading -->
    <div class="view-heading">
        <div class="view-title">
            <p><?php echo __($module['title']); ?></p>
        </div>

        <!-- load navigation -->
        <?php $controller->loadView('navigation'); ?>
    </div>


    <!-- main -->
    <div class="view-main">

        <!-- load page view -->
        <?php $controller->loadView($view_data['view']); ?>
    </div>


    <!-- footer -->
    <div class="view-footer">

        <!-- Load footer -->
        <?php $controller->loadView('footer'); ?>
    </div>

</div>
<!-- /module-view [index] -->