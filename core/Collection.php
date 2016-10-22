<?php

namespace ThemeOptions;

/**
 * Class Collection
 * Controls the interactions with the database
 * @package ThemeOptions
 */
class Collection {


    /**
     * @param array $config
     */
    protected static $config = array();


    /**
     * Construct
     * @param array $config
     */
	public function __construct(array $config) {
        self::$config = $config;
	}


    /**
     * Register collection space
     */
    public static function register() {
        register_setting(self::$config['optionGroup'], self::$config['optionName']);
    }


    /**
     * Get data
     * @param string $prop
     * @return array
     */
    public static function get($prop) {
        $data = self::getAll();

        if ( isset($data[$prop]) ) {
            return $data[$prop];
        }

        return null;
    }


    /**
     * Get all collection data
     * @return array
     */
    public static function getAll() {
        return get_option(self::$config['optionName']);
    }


    /**
     * Remove all, clear collection
     */
    public static function removeAll() {
        update_option(self::$config['optionName'], array());
    }


    /**
     * Update all collection data
     */
    public static function updateAll() {
        $collection = self::$config['optionName'];
        $data = $_POST[$collection];

        update_option(self::$config['optionName'], $data);
    }


    /**
     * Get post data
     * @param $postType
     * @return mixed
     */
    public function getPostData($postType) {
        $posts = get_posts(array(
            'post_type'      => $postType,
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC'
        ));

        return $posts;
    }


    /**
     * Get taxonomy data
     * @param $taxonomy
     * @return mixed
     */
    public function getTaxonomyData($taxonomy) {
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => 'false',
            'orderby'    => 'name',
            'order'      => 'ASC'
        ));

        return $terms;
    }
}