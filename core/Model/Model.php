<?php
// Class: Model


class Model {


    // @param array $args
    public function getPosts($args) {
        $query = new WP_Query($args);

        return $query->get_posts();
    }
}