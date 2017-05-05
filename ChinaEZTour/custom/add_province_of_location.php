<?php


function add_province_of_location($post)
{

    // 创建临时隐藏表单，为了安全
    wp_nonce_field('province_location_meta_box', 'province_location_meta_box_nonce');
    /*获取原来的值*/
    $value = get_post_meta($post->ID, 'location_province_city', true);
    $locations_old = unserialize($value);
    if ($locations_old == null) {
        $locations_old = array();
    }
    ?>
    province<input type="radio" name="location_province_city" value="province" <?php echo $value=='province'?'checked="checked"':''; ?>">
    city<input type="radio"  name="location_province_city" value="city" <?php echo $value=='city'?'checked="checked"':''; ?>">
    <?php

}

function create_meta_box_province_of_location()
{
    global $theme_name;
    if (function_exists('add_province_of_location')) {
        add_meta_box('province_city', 'province_city', 'add_province_of_location', 'location', 'advanced', 'high');
    }
}

add_action('admin_menu', 'create_meta_box_province_of_location');


function province_location_save_meta_box($post_id)
{


    // 安全检查
    // 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if (!isset($_POST['province_location_meta_box_nonce'])) {
        return;
    }
    // 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['province_location_meta_box_nonce'], 'province_location_meta_box')) {
        return;
    }
    // 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 判断 Meta Box 是否为空
    if (!isset($_POST['location_province_city'])) {
        return;
    }

    $location_province_city = $_POST['location_province_city'];
    //$post_location = serialize($locations);
    update_post_meta($post_id, 'location_province_city', $location_province_city);

}

add_action('save_post', 'province_location_save_meta_box');

?>