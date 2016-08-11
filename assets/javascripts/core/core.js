
// This module will be loaded in the context of jQuery
// Exact namespace: $/jQuery.themeOptions

// MODULE CODE BLOCK
; (function( module, jQuery, document, undefined ) {
    "use strict";

    // App class - wrapper for module functionality
    var App = module.App = module.App || (function() {

        // Enable jQuery through the variable $
        var $ = jQuery;

        // Wrapper for the page galleries
        var galleries = [];

        // Private: Components
        var components = {

            // component [any] - executed on any page
            any: function() {

                // on click on save button
                $('.button-save').on('click', function(e) {
                    e.preventDefault();

                    // submit view form
                    $('.button-submit-hidden').click();
                });
            },

            // component [navigation]
            navigation: function() {

                // on click on navigation button
                $('.nav-element').on('click', function(e) {

                    // go to destination
                    window.location.href = $(this).find('a').attr('href');
                });
            }
        };

        var notifications = {
            save: function(args) {
                // Display notification for SAVE
                $('.module-view').append('<div class="notification save"><p><span class="mdi-action-done"></span>' + args['title'] + '</p><p>' + args['subtitle'] + '</p></div>');

                // Hide notification for SAVE
                setTimeout(function() {
                    $('.notification.save').fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 2500);
            }
        };


        // Private: Metafields
        var metafields = {
            any: function() {},
            gallery: function() {

                // Set variable for the slider
                var sly = null;

                // Toggle image controls
                var toggleImageControls = function() {

                    // on hover
                    $('.gallery-image-wrapper, .view-image-upload-box').hover(function() {
                        // show controls
                        $(this).find('.gallery-image-controls').fadeIn(300);
                    }, function() {
                        // hide controls
                        $(this).find('.gallery-image-controls').fadeOut(300);
                    });
                };

                // initialize image magnification
                var enableMagnification = function() {
                    $('.view-metafield[data-view-metafield=gallery] .gallery-image-wrapper').magnificPopup({
                        delegate: '.gallery-image-link',
                        tLoading: 'Loading image #%curr%...',
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                };

                // enable sliders
                var enableSliders = function() {
                    var $sliders = $('.gallery-frame');

                    for (var i = 0, j = $sliders.length; i < j; i++) {
                        var id = $sliders.eq(i).attr('id');

                        // initialize slider
                        initSlider(id);
                    }
                };

                var initSlider = function(id) {

                    // Call Sly on frame
                    sly = new Sly('#' + id, {
                        horizontal: 1,
                        itemNav: 'basic',
                        smart: 1,
                        activateOn: 'click',
                        mouseDragging: 1,
                        touchDragging: 1,
                        releaseSwing: 1,
                        startAt: 0,
                        scrollBy: 0,
                        speed: 300,
                        elasticBounds: 1,
                        dragHandle: 1,
                        dynamicHandle: 1,
                        clickBar: 1
                    }, function() {}).init();

                    galleries.push({
                        slider: sly,
                        id: id
                    });

                    increaseSliderWidth();
                };

                var reloadSliders = function() {
                    var $sliders = $('.gallery-frame');

                    for (var i = 0, l = $sliders.length; i < l; i++) {
                        galleries[i].slider.destroy();

                        $sliders.eq(i).attr('id', galleries[i].id);

                        initSlider(galleries[i].id);
                    }
                };

                // increase slider width to fit all images
                var increaseSliderWidth = function() {

                    // Get sliders
                    var $sliders = $('.gallery-frame');

                    // Set offset for the slider width
                    var offset = 10;

                    for (var i = 0, j = $sliders.length; i < j; i++) {

                        // Get slider
                        var $slider = $sliders.eq(i).find('ul');

                        // Get slider width
                        var sliderWidth = $slider.width();

                        // Update slider width
                        sliderWidth += offset;

                        // Update slider
                        $slider.css({width: sliderWidth + 'px'});
                    }
                };

                // enable slider after 100 milliseconds
                setTimeout(function() {
                    try {
                        console.log('init');
                        enableSliders();
                    } catch(e) {
                        console.log('reload');
                        reloadSliders();
                    }
                }, 100);

                // toggle image controls
                toggleImageControls();

                // enable magnification
                enableMagnification();
            },
            image_upload: function() {

                var enableMagnification = function() {

                    // initialize image magnification
                    $('.view-metafield[data-view-metafield=image_upload] .gallery-image-link').magnificPopup({
                        type: 'image'
                    });
                };

                // enable magnification
                enableMagnification();
            },
            map: function() {

                $('.button-open-map-settings').on('click', function(e) {
                    e.preventDefault();

                    var isOpened = $(this).attr('data-control-opened') !== 'false';
                    $('.map-controls').addClass('active');

                    if ( isOpened ) {
                        $(this).parent().removeClass('active');
                        $(this).attr('data-control-opened', false);

                    } else {
                        $(this).parent().addClass('active');
                        $(this).attr('data-control-opened', true);
                    }
                });
            }
        };


        // Private: Widgets
        var widgets = {

            // widget [any] - executed on any page
            any: function() {

            },

            // widget [activity]
            activity: function() {
                var chartDataPosts = $('.widget-activity-posts-pie-chart').data('chart-data');
                var chartDataVideos = $('.widget-activity-videos-pie-chart').data('chart-data');
                var chartDataPages = $('.widget-activity-pages-pie-chart').data('chart-data');

                var publishPosts = parseInt(chartDataPosts.publish);
                var draftPosts = parseInt(chartDataPosts.draft);
                var trashPosts = parseInt(chartDataPosts.trash);
                var totalPosts = publishPosts + draftPosts + trashPosts;

                var publishVideos = parseInt(chartDataVideos.publish);
                var draftVideos = parseInt(chartDataVideos.draft);
                var trashVideos = parseInt(chartDataVideos.trash);
                var totalVideos = publishVideos + draftVideos + trashVideos;

                var publishPages = parseInt(chartDataPages.publish);
                var draftPages = parseInt(chartDataPages.draft);
                var trashPages = parseInt(chartDataPages.trash);
                var totalPages = publishPages + draftPages + trashPages;

                var publishPostsPercentage = (100 * publishPosts) / totalPosts;
                var draftPostsPercentage = (100 * draftPosts) / totalPosts;
                var trashPostsPercentage = (100 * trashPosts) / totalPosts;

                var publishVideosPercentage = (100 * publishVideos) / totalVideos;
                var draftVideosPercentage = (100 * draftVideos) / totalVideos;
                var trashVideosPercentage = (100 * trashVideos) / totalVideos;

                var publishPagesPercentage = (100 * publishPages) / totalPages;
                var draftPagesPercentage = (100 * draftPages) / totalPages;
                var trashPagesPercentage = (100 * trashPages) / totalPages;

                // Posts data
                var dataPosts = {
                    labels: [],
                    series: []
                };

                if ( publishPosts > 0 ) {
                    dataPosts.labels.push(publishPostsPercentage.toFixed(2)+'%');

                    dataPosts.series.push({
                        value: publishPosts,
                        className: 'chart-publish-posts'
                    });
                }

                if ( draftPosts > 0 ) {
                    dataPosts.labels.push(draftPostsPercentage.toFixed(2)+'%');

                    dataPosts.series.push({
                        value: draftPosts,
                        className: 'chart-draft-posts'
                    });
                }

                if ( trashPosts > 0 ) {
                    dataPosts.labels.push(trashPostsPercentage.toFixed(2)+'%');

                    dataPosts.series.push({
                        value: trashPosts,
                        className: 'chart-trash-posts'
                    });
                }

                // Videos data
                var dataVideos = {
                    labels: [],
                    series: []
                };

                if ( publishVideos > 0 ) {
                    dataVideos.labels.push(publishVideosPercentage.toFixed(2)+'%');
                    dataVideos.series.push({
                        value: publishVideos,
                        className: 'chart-publish-posts'
                    });
                }

                if ( draftVideos > 0 ) {
                    dataVideos.labels.push(draftVideosPercentage.toFixed(2)+'%');

                    dataVideos.series.push({
                        value: draftVideos,
                        className: 'chart-draft-posts'
                    });
                }

                if ( trashVideos > 0 ) {
                    dataVideos.labels.push(trashVideosPercentage.toFixed(2)+'%');

                    dataVideos.series.push({
                        value: trashVideos,
                        className: 'chart-trash-posts'
                    });
                }


                // Pages data
                var dataPages = {
                    labels: [],
                    series: []
                };

                if ( publishPages > 0 ) {
                    dataPages.labels.push(publishPagesPercentage.toFixed(2)+'%');

                    dataPages.series.push({
                        value: publishPages,
                        className: 'chart-publish-posts'
                    });
                }

                if ( draftPages > 0 ) {
                    dataPages.labels.push(draftPagesPercentage.toFixed(2)+'%');

                    dataPages.series.push({
                        value: draftPages,
                        className: 'chart-draft-posts'
                    });
                }

                if ( trashPages > 0 ) {
                    dataPages.labels.push(trashPagesPercentage.toFixed(2)+'%');

                    dataPages.series.push({
                        value: trashPages,
                        className: 'chart-trash-posts'
                    });
                }


                // initialize pie-charts
                new Chartist.Pie('.widget-activity-posts-pie-chart', dataPosts, {});
                new Chartist.Pie('.widget-activity-videos-pie-chart', dataVideos, {});
                new Chartist.Pie('.widget-activity-pages-pie-chart', dataPages, {});
            },
            statistics: function() {

            },
            plugins: function() {
                console.log('Widget [plugins] initialized!');
            }
        };


        // Private: Call active components
        var call = function(type) {

            // set selector
            var selector    = 'view-' + type;

            // get active components
            var $components = $('.' + selector);

            // get collection
            var collection  = components;

            switch (type) {
                case 'component':
                    collection = components;
                    break;
                case 'widget':
                    collection = widgets;
                    break;
                case 'metafield':
                    collection = metafields;
                    break;
            }

            // execute any
            collection.any();

            // iterate collection and call active components
            for (var i = 0, j = $components.length; i < j; i++) {

                // get component name
                var component = $components.eq(i).data(selector);

                // check if component exists
                if ( collection.hasOwnProperty(component) ) {

                    // execute component
                    collection[component]();
                }
                /* DEV: Uncomment to test which components are getting loaded successfully.
                 else {

                 // throw not found warning
                 console.warn("Warning! " + type + " [" + component + "] not found. Make sure to define the component first.");
                 }
                 */
            }
        };


        // Public: Initialize
        var init = function() {

            // Call all components
            call('component');
            call('widget');
            call('metafield');
        };


        // Public: Start
        var start = function(collection, component) {

            // start specific component
            switch (collection) {
                case 'component':
                    if ( components.hasOwnProperty(component) ) {
                        components[component]();
                    }
                    break;
                case 'widget':
                    if ( widgets.hasOwnProperty(component) ) {
                        widgets[component]();
                    }
                    break;
                case 'metafield':
                    if ( metafields.hasOwnProperty(component) ) {
                        metafields[component]();
                    }
                    break;
            }
        };


        // Public Notify
        var notify = function(event, args) {
            switch (event) {
                case 'save':
                    notifications.save(args);
                    break;
            }
        };


        // Return public API
        return {
            // initialize the whole module
            init: init,
            // start programatically specific component
            start: start,
            // notify for given event
            notify: notify
        };

    })();

}(jQuery.themeOptions = jQuery.themeOptions || {}, jQuery, document));



// INITIALIZE CODE BLOCK
jQuery(document).ready(function($) {

    // Initialize module [themeOptions]
    $.themeOptions.App.init();
});