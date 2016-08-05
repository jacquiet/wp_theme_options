<?php
// Template component: footer
// Displays the footer
?>

<?php
// Component settings

// Instantiate controller
$controller = new Controller();

// Get current view
$view = $controller->getCurrentView();
?>

<?php if ( $view !== 'home' ) : ?>

    <!-- view-page-part [footer] -->
    <div class="view-page-part" data-view-page-part="footer">
        <div class="footer-controls">
            <div class="buttons-group">
                <a href="#" class="button-save" title="<?php echo __('Click to save your data'); ?>"><?php echo __('Save'); ?></a>
            </div>
        </div>
    </div>
    <!-- view-page-part [footer] -->

<?php endif; ?>