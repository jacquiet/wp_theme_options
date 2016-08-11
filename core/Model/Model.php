<?php
// Class: Model
// Description: This class communicates with the database


class Model {


    // @param array $args
    // @return WP Object
    public function getPosts($post_type) {
        $query = new WP_Query(array(
            'post_type'      => $post_type,
            'posts_per_page' => -1
        ));

        return $query->get_posts();
    }

}