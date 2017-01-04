

// Global object KenobiSoft
// This is the only global used in the entire framework
var KenobiSoft = KenobiSoft || {};


// Define metafields object
KenobiSoft.metafields = KenobiSoft.metafields || {};


// Define gallery metafield
KenobiSoft.metafields.gallery = KenobiSoft.metafields.gallery || function($component) {

    // define local vars
    var $ = jQuery,
        meta_image_frame,
        galleries = [],
        $galleryWrapper = $component.find('.gallery-wrapper'),
        $valStorage = $component.find('textarea'),
        $btnAddImg = $component.find('.button-add-images');

    // define function for gallery initialization
    var initGallery = function() {
        if ( $galleryWrapper.hasClass('slick-initialized') ) {
            $galleryWrapper.slick('unslick');
        }

        $galleryWrapper.not('.slick-initialized').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 1000,
            slidesToScroll: 3,
            centerMode: false,
            variableWidth: true
        });
        $galleryWrapper.fadeIn(300);

        enableMagnification();
    };

    // define function for gallery update
    var updateGallery = function(urls) {

        // hide and empty current gallery
        $galleryWrapper.hide();
        $galleryWrapper.empty();

        // concatenate gallery images
        var $html = '<div class="gallery-wrapper"><ul>';

        for (var u in urls) {
            $html += '<div class="slide"><a class="gallery-image-link" href="' + urls[u].url + '"><img src="' + urls[u].url + '"/></a></div>';
        }

        $html += '</div>';

        // append new gallery
        $galleryWrapper.append($html);
    };

    // initialize image magnification
    var enableMagnification = function() {

        $galleryWrapper.magnificPopup({
            delegate: '.gallery-image-link',
            tLoading: 'Loading image #%curr%...',
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    };

    var init = function() {
        initGallery();

        // set up media frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Choose or Upload an Image',
            button: {
                text: 'Use this image'
            },
            multiple: true
        });

        // upon image selection, update gallery
        meta_image_frame.on('select', function(){

            // get image data
            var data = meta_image_frame.state().get('selection').toJSON();

            // define urls array
            var urls = [];

            // fill urls array
            for (var i in data) {
                urls.push({
                    id: data[i].id,
                    url: data[i].url
                });
            }

            // stringify urls array
            var dataStr = JSON.stringify(urls);

            // update val storage
            $valStorage.html(dataStr);

            // update the gallery
            updateGallery(urls);

            // initialize the new gallery
            initGallery();
        });

        // on button click, open media gallery
        $btnAddImg.click(function(e){
            e.preventDefault();

            // open media
            meta_image_frame.open();
        });
    };

    init();
};