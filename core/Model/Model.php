<?php
// Class: Model
// Description: This class communicates with the database


class Model {


    // @param array $args
    public function getPosts($args) {
        $query = new WP_Query($args);

        return $query->get_posts();
    }
}