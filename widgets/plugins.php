<?php
// Widget: Plugins
// Displays activity information about plugins
?>

<?php
// Widget settings

// Get plugins data
$plugins_data = get_plugins();

// Get active plugins
$active_plugins = get_option('active_plugins');
?>

<!-- view-widget [plugins] -->
<div class="view-widget" data-view-widget="plugins">

    <!-- view-block -->
    <div class="view-block">

        <!-- title -->
        <div class="view-block-title widget">
            <p class="block-title"><?php echo __('Plugins') ?></p>
            <p class="block-subtitle"><?php echo __('Information regarding plugin usage.'); ?></p>
        </div>
        <!-- /title -->

        <!-- content -->
        <div class="view-block-content">

            <!-- block-section -->
            <div class="view-block-section">
                <div class="widget-box-medium">
                    <?php if ( count($plugins_data) > 0 ) : ?>
                        <p class="view-block-section-heading"><span class="view-block-label"><?php echo __('General:'); ?></span></p>

                        <p><span class="view-block-label"><?php echo __('Installed plugins:'); ?></span> <span class="view-block-count"><?php echo count($plugins_data); ?></span> </p>

                        <p><span class="view-block-label"><?php echo __('Active plugins:'); ?></span> <span class="view-block-count"><?php echo count($active_plugins); ?></span> </p>

                        <p><span class="view-block-label"><?php echo __('Disabled plugins:'); ?></span> <span class="view-block-count"><?php echo count($plugins_data) - count($active_plugins); ?></span> </p>

                    <?php endif; ?>
                </div>
            </div>
            <!-- /block-section -->

            <!-- block-section -->
            <div class="view-block-section">
                <div class="widget-box-medium">
                    <p class="view-block-section-heading"><span class="view-block-label"><?php echo __('Installed plugins:'); ?></span></p>
                    <?php foreach($plugins_data as $name=>$p) : ?>

                        <?php if ( in_array($name, $active_plugins) ) : ?>
                            <span class="view-block-label-large" title="<?php echo __('Active plugin'); ?>"><?php echo $p['Name']; ?></span> <span class="active-plugin" title="<?php echo __('Active plugin'); ?>"></span><br/>
                        <?php else: ?>
                            <span class="view-block-label-large" title="<?php echo __('Disabled plugin'); ?>"><?php echo $p['Name']; ?></span> <span class="disabled-plugin" title="<?php echo __('Disabled plugin'); ?>"></span><br/>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            </div>
            <!-- /block-section -->

        </div>
        <!-- /content -->

    </div>
    <!-- /view-block -->

</div>
<!-- /view-widget [plugins] -->


