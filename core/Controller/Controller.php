<?php
// Class: Controller
// Description: This class communicates with the views


class Controller {


    // $param int $view_id
    public function getViewById($view_id) {
        global $module;

        // Set view to default view
        $view = $module['default_view'];

        // Find view
        foreach ($module['pages'] as $page=>$id) {
            if ( $view_id == $id ) {
                $view = $page;
                break;
            }
        }

        return $view;
    }


    public function getCurrentView() {

        // Instantiate controller
        $controller = new Controller();

        // Instantiate helper
        $helper = new Helper();

        // Get page index
        $page_index = $helper->getPageIndex();

        // Get view
        $view = $controller->getViewById($page_index);

        return $view;
    }


    // @param string $view
    // @param array $view_data
    public function loadView($view, $view_data = array()) {

        // Get view
        $this->_getView($view, $view_data, '/core/View/');
    }


    // @param string $widget
    // @param array $widget_data
    public function loadWidget($widget, $widget_data = array()) {

        // Get widget
        $this->_getView($widget, $widget_data, '/widgets/');
    }


    // @param string $view
    // @param array $view_data
    // @param string $module_path
    protected function _getView($view, $view_data = array(), $module_path) {

        // Get module
        global $module;

        // Get template
        include(locate_template('/modules/' . $module['name'] . $module_path . $view . '.php'));
    }
}