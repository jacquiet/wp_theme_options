
// Initialize framework
jQuery(document).ready(function($) {

    // define core object
    var core = (function() {
        var coreLoaded =
            KenobiSoft &&
            KenobiSoft.manager &&
            KenobiSoft.helper &&
            KenobiSoft.metafields &&
            KenobiSoft.widgets;

        var init = function() {
            if ( coreLoaded ) {
                KenobiSoft.manager.initMetafields({
                    components: KenobiSoft.metafields,
                    selector: '.custom-metafield',
                    dataSelector: 'metafield'
                });
            }
        };

        return {
            init: init
        };
    })();

    // init core
    core.init();
});