jQuery(document).ready(function($) {

    // JS class wrapper for module [theme_options]
    var App = function() {

        // Components
        var components = {

            // component [any]
            any: function() {

                // on click on save button
                $('.button-save').on('click', function(e) {
                    e.preventDefault();

                    // submit view form
                    $('.view-form').submit();
                });
            },

            // component [navigation]
            navigation: function() {

                // on click on navigation button
                $('.nav-element').on('click', function(e) {

                    // go to destination
                    window.location.href = $(this).find('a').attr('href');
                });
            },

            // component [home]
            home: function() {

            }
        };


        // Widgets
        var widgets = {

            // widget [any]
            any: function() {

            },

            // widget [activity]
            activity: function() {
                var chartDataPosts = $('.widget-activity-posts-pie-chart').data('chart-data');
                var chartDataPages = $('.widget-activity-pages-pie-chart').data('chart-data');

                var publishPosts = parseInt(chartDataPosts.publish);
                var draftPosts = parseInt(chartDataPosts.draft);
                var trashPosts = parseInt(chartDataPosts.trash);
                var totalPosts = publishPosts + draftPosts + trashPosts;

                var publishPages = parseInt(chartDataPages.publish);
                var draftPages = parseInt(chartDataPages.draft);
                var trashPages = parseInt(chartDataPages.trash);
                var totalPages = publishPages + draftPages + trashPages;

                var publishPostsPercentage = (100 * publishPosts) / totalPosts;
                var draftPostsPercentage = (100 * draftPosts) / totalPosts;
                var trashPostsPercentage = (100 * trashPosts) / totalPosts;

                var publishPagesPercentage = (100 * publishPages) / totalPages;
                var draftPagesPercentage = (100 * draftPages) / totalPages;
                var trashPagesPercentage = (100 * trashPages) / totalPages;

                var dataPosts = {
                    labels: [publishPostsPercentage.toFixed(2)+'%', draftPostsPercentage.toFixed(2)+'%', trashPostsPercentage.toFixed(2)+'%'],
                        series: [
                        {
                            value: publishPosts,
                            className: 'chart-publish-posts'
                        },
                        {
                            value: draftPosts,
                            className: 'chart-draft-posts'
                        },
                        {
                            value: trashPosts,
                            className: 'chart-trash-posts'
                        }
                    ]
                };

                var dataPages = {
                    labels: [publishPagesPercentage.toFixed(2)+'%', draftPagesPercentage.toFixed(2)+'%', trashPagesPercentage.toFixed(2)+'%'],
                    series: [
                        {
                            value: publishPages,
                            className: 'chart-publish-posts'
                        },
                        {
                            value: draftPages,
                            className: 'chart-draft-posts'
                        },
                        {
                            value: trashPages,
                            className: 'chart-trash-posts'
                        }
                    ]
                };

                new Chartist.Pie('.widget-activity-posts-pie-chart', dataPosts, {});
                new Chartist.Pie('.widget-activity-pages-pie-chart', dataPages, {});
            }
        };


        // Call active components
        var call = function(type) {

            // set selector
            var selector    = 'view-' + type;

            // get active components
            var $components = $('.' + selector);

            // get collection
            var collection  = type === 'component' ? components : widgets;

            // execute any
            collection.any();

            // iterate collection and call active components
            for (var i = 0, j = $components.length; i < j; i++) {

                // get component name
                var component = $components.eq(i).data(selector);

                // check if component exists
                if ( collection.hasOwnProperty(component) ) {

                    // initialize component
                    collection[component]();
                } else {

                    // throw not found warning
                    console.warn("Warning! " + type + " [" + component + "] not found. Make sure to define the component first.");
                }
            }

        };


        // Initialize
        var init = function() {

            call('component');
            call('widget');
        };


        // Return public API
        return {
            init: init
        };
    };



    // Initialize application
    var app = new App();
    app.init();

});