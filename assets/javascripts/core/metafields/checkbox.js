

// Global object KenobiSoft
// This is the only global used in the entire framework
var KenobiSoft = KenobiSoft || {};


// Define metafields object
KenobiSoft.metafields = KenobiSoft.metafields || {};


// Define checkbox metafield
KenobiSoft.metafields.checkbox = KenobiSoft.metafields.checkbox || function($component) {
    // define local vars
    var $ = jQuery,
        checkedVal = 1,
        uncheckedVal = 0;

    $component.find('input[type="checkbox"]').on('change', function() {
        var $checkbox = $(this);
        var $field    = $checkbox.parent().find('input[type="hidden"]');

        if ( $checkbox.is(':checked') ) {
            $field.val(checkedVal);
            $field.attr('value', checkedVal);
        } else {
            $field.val(uncheckedVal);
            $field.attr('value', uncheckedVal);
        }
    });
};