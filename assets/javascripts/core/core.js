
// Module: Floor Calculator
// Global wrapper for js functionality
// The module scans the current page for js components and runs any found components.
// The module is available through the global namespace [kenobiSoft].
// This means that it can be used from other scripts as well.


// Set global namespace
var kenobiSoft = {};

// Set namespace
kenobiSoft.modules = kenobiSoft.modules || {};

// Create module
kenobiSoft.modules.themeOptions = kenobiSoft.modules.themeOptions || (function($) {

    // @private object components
    var components = {

        // component [any]
        any: function() {

            // save event: submit plugin form
            $('.button-save').on('click', function(e) {
                e.preventDefault();

                // submit plugin form
                $('.button-submit-hidden').click();
            });


            // redirect event: redirect to page on navigation click
            $('.nav-element').on('click', function(e) {
                window.location.href = $(this).find('a').attr('href');
            });


            // check checkbox on label click
            $('label').on('click', function(e) {
                $(this).find('input[type="checkbox"]').trigger('click');
            });


            // highlight wysiwyg on click
            $('.ksfc-metafield[data-metafield="wysiwyg"]').on('click', function() {
                var $box = $(this).find('.trumbowyg-box');

                if ( ! $box.hasClass('active') ) {
                    $box.addClass('active');

                    $('.trumbowyg-box').not($box).removeClass('active');
                }
            });


            // remove wysiwyg highlight
            $('.ksfc-metafield').on('click', function(e) {
                var $metafield = $(this);

                if ( $metafield.attr('data-metafield') !== 'wysiwyg' ) {
                    $('.trumbowyg-box').length > 0 && $('.trumbowyg-box').removeClass('active');
                }

            });
        }
    };


    // @private initialize all components found on current page
    var initComponents = function() {
        // set component selector
        var componentSelector = 'ks-component';

        // get components
        var $components = $('.' + componentSelector);

        // execute any component
        components.any();

        for (var i = 0, j = $components.length; i < j; i++) {
            // get component
            var $component = $components.eq(i);

            // get component name
            var component = $component.data('component');

            // check if component exists
            if ( components.hasOwnProperty(component) && typeof components[component] === 'function' ) {

                // initialize component
                components[component]($component);
            }
        }
    };


    // @public init
    var init = function() {

        // init components
        initComponents();

        // enable cascade
        return this;
    };


    // Return public API
    return {
        init: init
    }

})( jQuery );


// Set namespace
kenobiSoft.metafields = kenobiSoft.metafields || {};

// Create module
kenobiSoft.metafields.gallery = kenobiSoft.metafields.gallery || (function($) {

    // Wrapper for the page galleries
    var galleries = [];

    var init = function() {
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

            $('.ksfc-metafield[data-metafield=gallery] .gallery-image-wrapper').magnificPopup({
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
            var offset = 200;

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
                enableSliders();
            } catch(e) {
                reloadSliders();
            }
        }, 100);

        // toggle image controls
        toggleImageControls();

        // enable magnification
        enableMagnification();
    };


    // Return public API
    return {
        init: init
    }

})( jQuery );



// Set namespace
kenobiSoft.widgets = kenobiSoft.widgets || {};

// Create module
kenobiSoft.widgets.activity = kenobiSoft.widgets.activity || (function($) {

    var init = function() {
        var chartDataPosts = $('.widget-activity-posts-pie-chart').data('chart-data');
        var chartDataVideos = $('.widget-activity-videos-pie-chart').data('chart-data');
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
        new Chartist.Pie('.widget-activity-pages-pie-chart', dataPages, {});
    };


    // Return public API
    return {
        init: init
    }

})( jQuery );



// Initialize the module
jQuery(document).ready(function($) {
    kenobiSoft.modules.themeOptions.init();
});