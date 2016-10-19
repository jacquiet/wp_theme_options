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
$module_url = $helper->getModuleUrl();

// If module data has been saved
if ( $helper->isSaved() ) {

    // notify user
    $helper->notify('save', array(
        'title'    => __('Data saved'),
        'subtitle' => __('Theme Options saved successfully.')
    ));
}

// Evaluate request to find out if module page param exists
if ( $helper->isModuleOpened() ) {

    // Clear module params
    $module_url = $helper->clearModuleParams();

    // Get page index
    $page_index = $helper->getPageIndex();
}

?>

<div class="view-title" title="<?php echo __('Developed by KenobiSoft'); ?>">
    <p><?php echo __($module['title']); ?></p>
</div>

<!-- view-component [navigation] -->
<div class="view-component" data-view-component="header">

    <div class="row row-full">

        <!-- navigation -->
        <ul class="navigation">

            <!-- Go through navigation pages -->
            <?php foreach ($module['pages'] as $page => $id): ?>
                <?php $page_title = $helper->getPageTitle($page); ?>

                <li class="nav-element <?php echo $id == $page_index ? 'active' : ''; ?>">
                    <div class="view-nav-element" data-element-id="<?php echo $id; ?>" title="<?php echo __('Go to ') . ucfirst($page_title); ?>">
                        <a href="<?php echo $module_url . '&' . $module['params']['page'] . '=' . $id; ?>" class="view-button-nav"><?php echo $page_title; ?></a>
                    </div>
                </li>

            <?php endforeach ?>

        </ul>
        <!-- /navigation -->

    </div>

</div>
<!-- /view-component [navigation] -->