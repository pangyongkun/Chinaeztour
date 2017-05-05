<?php


function add_location_of_post($post)
{

    // 创建临时隐藏表单，为了安全
    wp_nonce_field('post_location_meta_box', 'post_location_meta_box_nonce');
    /*获取原来的值*/
    $value = get_post_meta($post->ID, '_post_location', true);
    $locations_old = unserialize($value);
    if ($locations_old == null) {
        $locations_old = array();
    }

    echo "<select name='post_location' >";

    query_posts(array('post_type' => 'location', 'orderby' => 'post_name', 'order' => 'ASC', 'posts_per_page' => 1000));
    while (have_posts()):the_post();
        $title = get_the_title();
        $ID = get_the_ID();
        $selected=($value==$ID?' selected="selected"':'');
        echo '<option value="'.$ID.'" '.$selected.' >'.$title.'</option>';
    endwhile;

    echo "</select >";
}

function create_meta_box_location_of_post()
{
    global $theme_name;
    if (function_exists('add_location_of_post')) {
        add_meta_box('location', 'Location', 'add_location_of_post', 'post', 'advanced', 'high');
    }
}

add_action('admin_menu', 'create_meta_box_location_of_post');


function post_location_save_meta_box($post_id)
{


    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if (!isset($_POST['post_location_meta_box_nonce'])) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['post_location_meta_box_nonce'], 'post_location_meta_box')) {
        return;
    }
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 判断 Meta Box 是否为空
    if (!isset($_POST['post_location'])) {
        return;
    }

    $location = $_POST['post_location'];
    //$post_location = serialize($locations);
    update_post_meta($post_id, '_post_location', $location);

}

add_action('save_post', 'post_location_save_meta_box');

?>