<?php

add_action( 'widgets_init', 'my_search_widgets' );

function my_search_widgets() {
    register_widget( 'my_search_widget' );
}


class my_search_widget extends WP_Widget {

    public function __construct() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'my_search_widget', 'description' => esc_html__('My Search Widget', 'my') );

        /* Widget control settings. */
        $control_ops = array( 'width' => 300, 'height' => 550, 'id_base' => 'my_search_widget' );

        /* Create the widget. */
        parent::__construct( 'my_search_widget', esc_html__('My Search Widget', 'my'), $widget_ops, $control_ops );

    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        echo __( 'Hello, World!', 'text_domain' );
        echo $after_widget;

    }

    public function form( $instance ) {
        // outputs the options form on admin
        ?>
        <input name="hello" value="hello">hello
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved

        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

}