<?php
// Template: Widget
// Use this template as base for widgets
?>

<?php
// Widget settings should be added here

// If your widget requires js functionality, make sure to define the widget in moduledir/assets/javascripts/core/core.js - widgets object
// Make sure the name of the widget matches the name given in the data attribute [data-view-widget]
// This way, the system will pick up your js code
?>

<!-- view-widget[insert widget name here] -->
<div class="view-widget" data-view-widget="{insert widget name here}">

    <!-- view-block -->
    <div class="view-block">

        <!-- title -->
        <div class="view-block-title widget">
            <p class="block-title"><?php echo __('Insert widget title here') ?></p>
            <p class="block-subtitle"><?php echo __('Insert widget subtitle here'); ?></p>
        </div>

        <!-- content -->
        <div class="view-block-content">

            <!-- section -->
            <div class="view-block-section">

                <!-- Insert widget content here -->

            </div>
            <!-- /section -->

        </div>
        <!-- /content -->

    </div>
    <!-- /view-block -->

</div>
<!-- /view-widget[insert widget name here] -->


