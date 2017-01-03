<?php

namespace ThemeOptions;

/**
 * Class Initialzr
 * Main module class
 * @package ThemeOptions
 */
class Initialzr {


    /**
     * @property array $instance
     */
    protected static $instance 	 = null;


    /**
     * @property array $config
     */
    protected $config 			 = array();


    /**
     * @property Helper $helper
     */
    protected $helper 			 = null;


    /**
     * @property View $view
     */
    protected $view 			 = null;


    /**
     * @property Collection $collection
     */
    protected static $collection = null;


    /**
     * Get instance of the class
     * @param $config
     * @return mixed
     */
    public static function getInstance($config) {
        $c = get_called_class();

        if ( ! isset($instance[$c]) ) {
            self::$instance[$c] = new Initialzr($config);
        }

        return self::$instance[$c];
    }


    /**
     * Construct
     * @param $config
     */
    private function __construct($config) {
        $this->setup();

        $this->helper 	  = new Helper();
        $this->config 	  = $this->helper->xmlToArr($config);
        $this->view   	  = new View($this->config);
        self::$collection = new Collection($this->config['module']['collection']);

        $this->monitor();
    }


    /**
     * Setup
     */
    protected function setup() {

        // get dependencies
        $this->getDependencies();

        // register collection space
        add_action('admin_init', function() {
            self::$collection->register();
        });

        // add plugin backend page
        add_action('admin_menu', function() {
            $module = $this->config['module'];
            add_menu_page($module['name'], $module['name'], 'manage_options', $module['dir'], array($this, 'getBackend'), $module['menuIcon']);
        });

        // enqueue plugin resources
        add_action('admin_enqueue_scripts', function() {
            $module    = $this->config['module'];
            $scriptExt = $module['mode'] === 'production' ? '.min.js' : '.js';

            wp_enqueue_media();
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_style($module['dir'], get_stylesheet_directory_uri() . '/modules/' . $module['dir'] . '/assets/stylesheets/style.css');
            wp_enqueue_script($module['dir'], get_stylesheet_directory_uri() . '/modules/' . $module['dir'] . '/assets/javascripts/main' . $scriptExt, array('jquery'));
            wp_enqueue_script($module['dir'] . '_googleMaps', 'http://maps.google.com/maps/api/js?sensor=false');
        });
    }


    /**
     * Get dependencies
     */
    protected function getDependencies() {
        require_once('View.php');
        require_once('Widget.php');
        require_once('Helper.php');
        require_once('Metabox.php');
        require_once('Collection.php');
    }


    /**
     * Monitor module for updates
     */
    protected function monitor() {
        if ( $this->view->isUpdated() ) {
            $this->save();
        }
    }


    /**
     * Save module data
     */
    protected function save() {
        self::$collection->updateAll();
    }


    /**
     * Get backend
     */
    public function getBackend() {
        $data = self::$collection->getAll();
        $this->view->renderBackend($data);
    }
}