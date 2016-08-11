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
    public function clearParams($url) {
        global $module;

        // Strip module params
        $url = preg_replace('/' . $module['params']['page'] . '=\d+/', '', $url, 1);

        // If update param exists
        if ( $this->isUpdated($url) ) {

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
    public function isOpened($url) {
        global $module;

        return strpos($url, $module['params']['page']);
    }


    // @param string $url
    // @return boolean
    public function isUpdated($url) {
        global $module;

        // If update param exists
        return strpos($url, $module['params']['updated']);
    }
}