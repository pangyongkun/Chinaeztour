<?php
/**
 * Add the input field to the form
 *
 * @param int $form_id
 * @param null|int $post_id
 * @param array $form_settings
 */
function add_blog_location($form_id, $post_id, $form_settings)
{

    $value = get_post_meta($post_id, 'blog_location', true);
    $locations_old = $value;
    if ($locations_old == null) {
        $locations_old = array();
    }

    ?>
    <li class="wpuf-el blog_location" xmlns="http://www.w3.org/1999/html">
        <div class="wpuf-label">
            <label for="wpuf-blog_location">Blog Location <span class="required">*</span></label>
        </div>
        <div class="wpuf-fields">
            <span data-required="yes" data-type="tax-checkbox" />
            <ul class="wpuf-category-checklist">
    <?php
    $query = new WP_Query(array('post_type' => 'location', 'orderby' => 'post_name', 'order' => 'ASC', 'posts_per_page' => 1000));
    while ($query->have_posts()):$query->the_post();
        $title = get_the_title();
        $ID = get_the_ID();
        $selected = (in_array(intval($ID), $locations_old) ? ' checked="checked"' : '');
        ?>
        <li id='blog_location-<?php echo $ID; ?>'>
            <label class="selectit">
                <input <?php echo $selected; ?> value="<?php echo $ID; ?>" type="checkbox" name="blog_location[]" id="in-blog_location-<?php echo $ID; ?>" /> <?php echo $title; ?>
            </label>
        </li>
    <?php endwhile;
    wp_reset_postdata(); ?>
            </ul>
            <span class="wpuf-help"></span>
        </div>
    </li>
<?php
}

add_action('blog_location_hook', 'add_blog_location', 10, 3);

/**
 * Update the Blog Location when the form submits
 *
 * @param type $post_id
 */
function update_blog_location($post_id)
{
    if (isset($_POST['blog_location'])) {
        update_post_meta($post_id, 'blog_location', $_POST['blog_location']);
    }
}

add_action('wpuf_add_post_after_insert', 'update_blog_location');
add_action('wpuf_edit_post_after_update', 'update_blog_location');