<?php
// Class: Router
// Description: This class processes url requests


class Router {


    // @param array $module
    public function processRequest() {
        global $module;

        // Instantiate controller
        $controller = new Controller();

        // Get current view
        $view = $controller->getCurrentView($module);

        // Set view data
        $data = array(
            'view'  => $view
        );

        // Load base view with data, containing current view
        $controller->loadView($module['base_view'], $data);
    }
}