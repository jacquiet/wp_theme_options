<?php
// Widget: Activity
// Displays activity information about posts
?>

<?php

// Get posts data
$posts_data = wp_count_posts('post');

// Get pages data
$pages_data = wp_count_posts('page');
?>

<!-- view-widget[activity] -->
<div class="view-widget" data-view-widget="activity">

    <!-- view-block -->
    <div class="view-block">

        <!-- title -->
        <div class="view-block-title widget">
            <p class="block-title"><?php echo __('Activity') ?></p>
            <p class="block-subtitle"><?php echo __('Activity information about posts.'); ?></p>
        </div>
        <!-- /title -->

        <!-- content -->
        <div class="view-block-content">

            <!-- block-section -->
            <div class="view-block-section">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <p class="view-block-section-heading"><?php echo __('Pages'); ?></p>
                        <p><span class="view-block-label"><?php echo __('Published pages:'); ?></span> <span class="view-block-count"><?php echo $pages_data->publish; ?></span> <span class="publish-posts"></span></p>
                        <p><span class="view-block-label"><?php echo __('Draft pages:'); ?></span> <span class="view-block-count"><?php echo $pages_data->draft; ?></span> <span class="draft-posts"></span></p>
                        <p><span class="view-block-label"><?php echo __('Trashed pages:'); ?></span> <span class="view-block-count"><?php echo $pages_data->trash; ?></span> <span class="trash-posts"></span></p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="widget-activity-pages-pie-chart" data-chart-data="<?php echo stripcslashes(htmlentities(json_encode($pages_data))); ?>"></div>
                    </div>
                </div>
            </div>
            <!-- /block-section -->

            <!-- block-section -->
            <div class="view-block-section">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <p class="view-block-section-heading"><?php echo __('Posts'); ?></p>
                        <p><span class="view-block-label"><?php echo __('Published posts:'); ?></span> <span class="view-block-count"><?php echo $posts_data->publish; ?></span> <span class="publish-posts"></span></p>
                        <p><span class="view-block-label"><?php echo __('Draft posts:'); ?></span> <span class="view-block-count"><?php echo $posts_data->draft; ?></span> <span class="draft-posts"></span></p>
                        <p><span class="view-block-label"><?php echo __('Trashed posts:'); ?></span> <span class="view-block-count"><?php echo $posts_data->trash; ?></span> <span class="trash-posts"></span></p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="widget-activity-posts-pie-chart" data-chart-data="<?php echo stripcslashes(htmlentities(json_encode($posts_data))); ?>"></div>
                    </div>
                </div>
            </div>
            <!-- /block-section -->

        </div>
        <!-- /content -->

    </div>
    <!-- /view-block -->

</div>
<!-- /view-widget[activity] -->


