<?php
// Module: Theme Options
// Version: 1.0
// Author: KenobiSoft


// Get module settings
require_once('settings.php');

global $module;


// Get modules directory
$modules_dir = get_stylesheet_directory() . '/modules';


// Get Controller class
require_once($modules_dir . '/' . $module['name'] . '/core/Controller/Controller.php');

// Get Module class
require_once($modules_dir . '/' . $module['name'] . '/core/Model/Model.php');

// Get Router class
require_once($modules_dir . '/' . $module['name'] . '/core/Router/Router.php');

// Get Helper class
require_once($modules_dir . '/' . $module['name'] . '/core/Helper/Helper.php');

// Get Metabox class
require_once($modules_dir . '/' . $module['name'] . '/core/Metabox/Metabox.php');


// Enqueue module styles
add_action('admin_print_styles', 'module_theme_options_styles');

function module_theme_options_styles() {
    global $module;

    // Enqueue style
    wp_enqueue_style('module-theme-options-style-admin', get_bloginfo('template_url').'/modules/' . $module['name'] . '/assets/styles/style.css', array());
}


// Enqueue module scripts
add_action('admin_enqueue_scripts', 'module_theme_options_scripts');

function module_theme_options_scripts() {
    global $module;

    $script_suffix = ($module['mode'] === 'development') ? '.js' : '.min.js';

    // Enqueue main script
    wp_enqueue_script('custom_admin_script', get_bloginfo('template_url').'/modules/' . $module['name'] . '/assets/javascripts/main' . $script_suffix, array('jquery'));

    // Enable support for jquery datepicker
    wp_enqueue_script('jquery-ui-datepicker');

    // Enable support for file uploader
    wp_enqueue_media();
}


// Hook to admin iti and assign register module settings callback
add_action('admin_init', 'register_module_settings');

// Register module settings
function register_module_settings() {

    // Register module settings
    register_setting('sa_theme_options', 'sa_options');
}


// Hook to admin menu and assign create callback
add_action('admin_menu', 'createPage');

// Create module page
function createPage() {

    // Create module page for admins only
    if ( is_admin() ) {

        // Get global module
        global $module;

        // Add theme options page to the admin menu
        add_theme_page($module['title'], $module['title'], 'edit_' . $module['name'], $module['name'], 'displayModule');
    }
}


// Display module
function displayModule() {

    // Display module for admins only
    if ( is_admin() ) {

        // Get global module
        global $module;

        // Instantiate router
        $router = new Router();

        // Process request
        $router->processRequest($module['params']['page']);
    }
}