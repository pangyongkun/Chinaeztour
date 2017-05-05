<?php
function add_location_of_blog($post)
{

// 创建临时隐藏表单，为了安全
    wp_nonce_field('blog_location_meta_box', 'blog_location_meta_box_nonce');
    /*获取原来的值*/
    $value_blog_location = get_post_meta($post->ID, 'blog_location', true);
    $value_blog_is_featured=get_post_meta($post->ID,'blog_is_featured',true);

    $locations_old = $value_blog_location;
    if ($locations_old == null) {
        $locations_old = array();
    }

    ?>

    <table class="form-table meta_box">
        <tr>
            <th style="width:20%"><label >Blog Is Featured</label></th>
            <td>
                <ul>
                    <li><input type="checkbox" name="blog_is_featured" value="1" <?php echo $value_blog_is_featured==1?'checked="checked"':''; ?>></li>
                </ul>
            </td>
        </tr>
        <tr>
            <th style="width:20%"><label >Blog Location</label></th>
            <td>
                <ul>
                    <?php
                    query_posts(array('post_type' => 'location', 'orderby' => 'post_name', 'order' => 'ASC', 'posts_per_page' => 1000));
                    while (have_posts()):the_post();
                        $title = get_the_title();
                        $ID = get_the_ID();
                        $selected = (in_array(intval($ID), $locations_old) ? ' checked="checked"' : '');
                        ?>
                        <li style="float: left; width:150px; overflow: hidden; margin-right: 10px ">
                            <input id="blog_location_<?php echo $ID ?>" type="checkbox" value="<?php echo $ID ?>" name="blog_location[]" <?php echo $selected; ?>>
                            <label for="blog_location_<?php echo $ID ?>"><?php echo $title; ?></label>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </td>

        </tr>
    </table>
<?php


}

function create_meta_box_location_of_blog()
{
    global $theme_name;
    if (function_exists('add_location_of_blog')) {
        add_meta_box('blog_location', 'Extra Information', 'add_location_of_blog', 'blog', 'advanced', 'high');
    }
}

add_action('admin_menu', 'create_meta_box_location_of_blog');


function blog_location_save_meta_box($post_id)
{


// 安全检查
// 检查是否发送了一次性隐藏表单内容（判断是否为第三者模拟提交）
    if (!isset($_POST['blog_location_meta_box_nonce'])) {
        return;
    }
// 判断隐藏表单的值与之前是否相同
    if (!wp_verify_nonce($_POST['blog_location_meta_box_nonce'], 'blog_location_meta_box')) {
        return;
    }
// 判断该用户是否有权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

// 判断 Meta Box 是否为空
    if (!isset($_POST['blog_location'])) {
        return;
    }

    if(!isset($_POST['blog_is_featured'])){
        return;
    }

    $blog_location = $_POST['blog_location'];
    $blog_is_featured=$_POST['blog_is_featured'];

    update_post_meta($post_id, 'blog_location', $blog_location);
    update_post_meta($post_id, 'blog_is_featured', $blog_is_featured);

}

add_action('save_post', 'blog_location_save_meta_box');

?>