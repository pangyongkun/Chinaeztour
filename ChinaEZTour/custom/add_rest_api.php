<?php

/**
 * Add REST API support to tour
 */
add_action( 'init', 'tour_rest_support', 25 );
function tour_rest_support() {
    global $wp_post_types;

    //be sure to set this to the name of your post type!
    $post_type_name = 'tour';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {
        $wp_post_types[$post_type_name]->show_in_rest = true;
        $wp_post_types[$post_type_name]->rest_base = $post_type_name;
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }

}

add_action( 'init', 'tour_taxonomy_rest_support', 25 );
function tour_taxonomy_rest_support() {
    global $wp_taxonomies;

    //be sure to set this to the name of your taxonomy!
    $taxonomy_name = 'tour_category';

    if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
        $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
        $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
        $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
    }


}

/**
 * Add REST API support to location
 */
add_action( 'init', 'location_rest_support', 25 );
function location_rest_support() {
    global $wp_post_types;

    //be sure to set this to the name of your post type!
    $post_type_name = 'location';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {
        $wp_post_types[$post_type_name]->show_in_rest = true;
        $wp_post_types[$post_type_name]->rest_base = $post_type_name;
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }

}

add_action( 'init', 'location_taxonomy_rest_support', 25 );
function location_taxonomy_rest_support() {
    global $wp_taxonomies;

    //be sure to set this to the name of your taxonomy!
    $taxonomy_name = 'location_category';

    if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
        $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
        $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
        $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
    }


}


/**
 * Add REST API support to blog
 */
add_action( 'init', 'blog_rest_support', 25 );
function blog_rest_support() {
    global $wp_post_types;

    //be sure to set this to the name of your post type!
    $post_type_name = 'blog';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {
        $wp_post_types[$post_type_name]->show_in_rest = true;
        $wp_post_types[$post_type_name]->rest_base = $post_type_name;
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }

}

//post_meta blog_location
add_action( 'rest_api_init', 'slug_register_blog_location' );
function slug_register_blog_location() {
    register_rest_field( 'blog',
        'blog_location',
        array(
            'get_callback'    => 'slug_get_blog_location',
            'update_callback' => 'slug_update_blog_location',
            'schema'          => null,
        )
    );
}

function slug_get_blog_location( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name ,true);
}


function slug_update_blog_location( $value, $object, $field_name ) {
    if ( ! $value || ! is_string( $value ) ) {
        return;
    }

    return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );

}


//custom
add_action( 'rest_api_init', function () {
    register_rest_route( 'myplugin/v1', '/location', array(
        'methods' => 'post',
        'callback' => 'get_location',
    ) );
} );

function get_location( $request ){
    global $wpdb;
    $parameters=$request->get_params();
    $query=null;
    if(isset($parameters['keyword'])){
        $aql='select ID from ez_posts where post_title like '.$parameters['keyword'].' and post_type=location';
        $prepared_statement = $wpdb->prepare('select ID from ez_posts where (post_title like %s and post_type=%s)','%'.$parameters['keyword'].'%','location');
        $blog_ids=$wpdb->get_col($prepared_statement);
        $args=array(
            'post_type' => 'location',
            'post__in'=>$blog_ids,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        );
        $query = new WP_Query($args);
    }
    return $query->posts;
}


