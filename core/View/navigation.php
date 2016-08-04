<?php
// Template component: navigation
// Displays the navigation
?>

<?php
// Component settings

// Get module
global $module;

// Get url request
$module_url = get_site_url() . $_SERVER['REQUEST_URI'];

// Evaluate request to find out if module page param exists
if ( strpos($module_url, $module['params']['page']) ) {

    // Instantiate helper
    $helper = new Helper();

    // Clear module params
    $module_url = $helper->clearParams($module_url);

    // Get page index
    $page_index = $helper->getPageIndex();
}
?>

<!-- view-component[navigation] -->
<div class="view-component" data-view-component="navigation">

    <div class="row row-full">
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
    </div>

</div>
<!-- /view-component[navigation] -->