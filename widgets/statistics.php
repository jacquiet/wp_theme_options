<?php
// Widget: Statistics
// Displays statistical information about the website
?>

<?php

// Get users data
$users_data = count_users();

// Get comments data
$comments_data = wp_count_comments();
?>

<!-- view-widget[activity] -->
<div class="view-widget" data-view-widget="activity">

    <!-- view-block -->
    <div class="view-block">

        <!-- title -->
        <div class="view-block-title widget">
            <p class="block-title"><?php echo __('Statistics') ?></p>
            <p class="block-subtitle"><?php echo __('Statistical information about the website.'); ?></p>
        </div>

        <!-- content -->
        <div class="view-block-content">

            <div class="view-block-section">
                <p class="view-block-section-heading"><?php echo __('Users'); ?></p>
                <div class="row">
                    <div class="col-sm-12 col-md-4">

                        <?php if ( isset($users_data['avail_roles']['administrator']) ) : ?>
                            <p><span class="view-block-label"><?php echo __('Administrators:'); ?></span> <span class="view-block-count"><?php echo $users_data['avail_roles']['administrator']; ?></span> </p>
                        <?php endif; ?>

                        <?php if ( isset($users_data['avail_roles']['subscriber']) ) : ?>
                            <p><span class="view-block-label"><?php echo __('Subscribers:'); ?></span> <span class="view-block-count"><?php echo $users_data['avail_roles']['subscriber']; ?></span> </p>
                        <?php endif; ?>

                        <?php if ( isset($users_data['avail_roles']['contributor']) ) : ?>
                            <p><span class="view-block-label"><?php echo __('Contributors:'); ?></span> <span class="view-block-count"><?php echo $users_data['avail_roles']['contributor']; ?></span> </p>
                        <?php endif; ?>

                        <?php if ( isset($users_data['avail_roles']['author']) ) : ?>
                            <p><span class="view-block-label"><?php echo __('Authors:'); ?></span> <span class="view-block-count"><?php echo $users_data['avail_roles']['author']; ?></span> </p>
                        <?php endif; ?>

                        <?php if ( isset($users_data['avail_roles']['editor']) ) : ?>
                            <p><span class="view-block-label"><?php echo __('Editors:'); ?></span> <span class="view-block-count"><?php echo $users_data['avail_roles']['editor']; ?></span> </p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="view-block-section">
                <p class="view-block-section-heading"><?php echo __('Comments'); ?></p>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <p><span class="view-block-label"><?php echo __('Total number:'); ?></span> <span class="view-block-count"><?php echo $comments_data->total_comments; ?></span> </p>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <!-- /view-block -->

</div>
<!-- /view-widget[activity] -->


