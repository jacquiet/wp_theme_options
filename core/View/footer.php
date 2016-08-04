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

    <div class="view-component" data-view-component="footer">
        <div class="footer-controls">
            <div class="buttons-group">
                <a href="#" class="button-save" title="<?php echo __('Click to save your data'); ?>"><?php echo __('Save'); ?></a>
            </div>
        </div>
    </div>

<?php endif; ?>