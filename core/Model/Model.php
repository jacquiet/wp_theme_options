<?php
// Class: Model
// Description: This class communicates with the database


class Model {


    // @param array $args
    // @return WP Object
    public function getPosts($args) {
        $query = new WP_Query($args);

        return $query->get_posts();
    }
}