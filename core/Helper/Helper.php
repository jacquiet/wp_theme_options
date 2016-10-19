<?php
// Class: Helper
// Description: This class contains helper methods



class Helper {

    // @return boolean
    public function getPageIndex() {
        global $module;

        // Get and return current module page
        return isset($_GET[$module['params']['page']]) ? $_GET[$module['params']['page']] : 0;
    }


    // @param string $url
    // @return string
    public function clearModuleParams() {
        global $module;
        $url = $this->getModuleUrl();

        // Strip module params
        $url = preg_replace('/' . $module['params']['page'] . '=\d+/', '', $url, 1);

        // If update param exists
        if ( $this->isSaved() ) {

            // Strip update param
            $url = preg_replace('/' . $module['params']['updated'] . '=[a-z]+/', '', $url, 1);

            // Strip special chars
            $url = preg_replace('/&+/', '', $url, 1);
        }

        // Strip special chars and return
        return preg_replace('/&+/', '', $url, 1);
    }


    // @param string $url
    // @return string
    public function isModuleOpened() {
        global $module;
        $url = $this->getModuleUrl();

        return strpos($url, $module['params']['page']);
    }


    // @param string $url
    // @return boolean
    public function isSaved() {
        global $module;
        $url = $this->getModuleUrl();

        // If update param exists
        return strpos($url, $module['params']['updated']);
    }


    // @param string $event
    // @return
    public function notify($event, $args) {

        switch ($event) {
            case 'save':
                ?>
                <script type="text/javascript">
                    (function($) {
                        var app = $.themeOptions.App;

                        // notify for save
                        app.notify('save', {
                            title: '<?php echo $args['title']; ?>',
                            subtitle: '<?php echo $args['subtitle']; ?>'
                        });
                    })( jQuery );
                </script>
                <?php
                break;
            default:
                break;
        }
    }


    // return string
    public function getModuleUrl() {
        return get_site_url() . $_SERVER['REQUEST_URI'];
    }


    // return string
    public function getPageTitle($page) {
        if ( strpos($page, '_') !== false ) {
            return implode(' ', array_map(ucfirst, explode('_', $page)));
        }

        if ( strpos($page, '–') !== false ) {
            return implode(' ', array_map(ucfirst, explode('–', $page)));
        }

        if ( strpos($page, '-') !== false ) {
            return implode(' ', array_map(ucfirst, explode('-', $page)));
        }

        return ucfirst($page);
    }
}