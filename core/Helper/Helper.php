<?php
// Class: Helper



class Helper {


    public function getPageIndex() {
        global $module;

        // Get and return current module page
        return isset($_GET[$module['params']['page']]) ? $_GET[$module['params']['page']] : 0;
    }


    // @param string $url
    public function clearParams($url) {
        global $module;

        // Strip module params
        $url = preg_replace('/' . $module['params']['page'] . '=\d+/', '', $url, 1);

        // If update param exists
        if ( strpos($url, $module['params']['updated']) ) {

            // Strip update param
            $url = preg_replace('/' . $module['params']['updated'] . '=[a-z]+/', '', $url, 1);

            // Strip special chars
            $url = preg_replace('/&+/', '', $url, 1);
        }

        // Strip special chars and return
        return preg_replace('/&+/', '', $url, 1);
    }
}