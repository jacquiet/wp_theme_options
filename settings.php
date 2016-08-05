<?php
// Settings for module: Theme Options
// Version: 1.0
// Author: KenobiSoft


// Set module settings
global $module;
$module = array(
    // Set mode - can be 'development' or 'production
    'mode'          => 'development',
    // Set module name - must match the name of the module under themedir/modules
    'name'          => 'theme_options',
    'title'         => 'Theme Options',
    // Define pages
    'pages'    => array(
        // page name  // id
        'home'        => 0,
        'settings'    => 1,
        'pages'       => 2
    ),
    // Define GET params
    'params'        => array(
        'page'        => 'theme-options-page',
        'updated'     => 'settings-updated'
    ),
    // Define default view
    'default_view'  => 'home',
    // Define base View
    'base_view'     => 'index'
);