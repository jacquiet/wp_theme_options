

// Global object KenobiSoft
// This is the only global used in the entire framework
var KenobiSoft = KenobiSoft || {};


// Define metafields object
KenobiSoft.metafields = KenobiSoft.metafields || {};


// Define gallery metafield
KenobiSoft.metafields.gallery = KenobiSoft.metafields.gallery || function($component) {

    // define local vars
    var $ = jQuery,
        galleries = [];

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
};