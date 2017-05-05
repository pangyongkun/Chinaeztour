<?php
function my_taxonomies_tour() {
    $labels = array(
        'name'              => _x( 'Tour category', 'taxonomy 名称' ),
        'singular_name'     => _x( 'tour category', 'taxonomy 单数名称' ),
        'search_items'      => __( 'search tour' ),
        'all_items'         => __( 'Tour category' ),
        'parent_item'       => __( 'parent tour category' ),
        'parent_item_colon' => __( 'parent tour category' ),
        'edit_item'         => __( 'edit tour category' ),
        'update_item'       => __( 'update tour category' ),
        'add_new_item'      => __( 'add tour category' ),
        'new_item_name'     => __( 'add tour category' ),
        'menu_name'         => __( 'Tour category' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'tour_category', 'tour', $args );
}
add_action( 'init', 'my_taxonomies_tour', 0 );