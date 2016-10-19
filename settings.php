<?php
// Settings for module: Theme Options
// Version: 1.0
// Author: KenobiSoft


// Globalize module
global $module;


// Set module settings
$module = array(

    // Set mode - can be 'development' or 'production
    'mode'          => 'production',

    // Set module name - must match the name of the module under themedir/modules
    'name'          => 'theme_options',

    // Set module title - the title appears on each of the module pages
    'title'         => __('Theme Options'),

    // Define pages
    'pages'    => array(
        // page name  // id
        'dashboard'   => 0,
        'home'        => 1,
        'settings'    => 2
    ),

    // Define GET params
    'params'        => array(

        // Define page param
        'page'        => 'theme-options-page',

        // Do NOT change this property - it comes from WP
        'updated'     => 'settings-updated'
    ),

    // Define default view
    'default_view'  => 'dashboard',

    // Define base View
    'base_view'     => 'index'
);