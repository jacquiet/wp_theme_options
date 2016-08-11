<?php
// Template component: navigation
// Displays the navigation
?>

<?php
// Component settings

// Get module
global $module;

// Instantiate helper
$helper = new Helper();

// Get url request
$module_url = get_site_url() . $_SERVER['REQUEST_URI'];

// If module data has been saved
if ( $helper->isUpdated($module_url) ) {
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {

                // notify for save
                $.themeOptions.App.notify('save', {
                    title: '<?php echo __('Data saved'); ?>',
                    subtitle: '<?php echo __('Theme options saved successfully.'); ?>'
                });
            });
        </script>
    <?php
}

// Evaluate request to find out if module page param exists
if ( $helper->isOpened($module_url) ) {

    // Clear module params
    $module_url = $helper->clearParams($module_url);

    // Get page index
    $page_index = $helper->getPageIndex();
}

?>

<!-- view-component [navigation] -->
<div class="view-component" data-view-component="navigation">

    <div class="row row-full">

        <!-- navigation -->
        <ul class="navigation">

            <!-- Go through navigation pages -->
            <?php foreach ($module['pages'] as $page => $id): ?>

                <li class="nav-element <?php echo $id == $page_index ? 'active' : ''; ?>">
                    <div class="view-nav-element" data-element-id="<?php echo $id; ?>" title="<?php echo __('Go to ') . ucfirst($page); ?>">
                        <a href="<?php echo $module_url . '&' . $module['params']['page'] . '=' . $id; ?>" class="view-button-nav"><?php echo $page; ?></a>
                    </div>
                </li>

            <?php endforeach ?>

        </ul>
        <!-- /navigation -->

    </div>

</div>
<!-- /view-component [navigation] -->