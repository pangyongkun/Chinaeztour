<?php

//add post for user whose role is staff
function add_user_post($user)
{

    $u=get_user_by('ID',$user->ID);
    $old_post = get_user_meta($user->ID, 'user_post', true);

    ?>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">Staff Post</th>
            <td>
                <select name="user_post" style="width: 494px;">
                    <option value="">Staff Post</option>
                    <option value="Marketing & Website Team" <?php echo $old_post=='Marketing & Website Team'?'selected="selected"':'';  ?> >Marketing & Website Team</option>
                    <option value="Travel Consultant Team" <?php echo $old_post=='Travel Consultant Team'?'selected="selected"':'';  ?> >Travel Consultant Team</option>
                    <option value="Tour Operators" <?php echo $old_post=='Tour Operators'?'selected="selected"':'';  ?> >Tour Operators</option>
                    <option value="Local Tour Guide Team" <?php echo $old_post=='Local Tour Guide Team'?'selected="selected"':'';  ?> >Local Tour Guide Team</option>
                    <option value="Local Vehicle & Drivers Team" <?php echo $old_post=='Local Vehicle & Drivers Team'?'selected="selected"':'';  ?> >Local Vehicle & Drivers Team</option>
                    <option value="Online Volunteers" <?php echo $old_post=='Online Volunteers'?'selected="selected"':'';  ?> >Online Volunteers</option>
                </select>
        </tr>
        </tbody>
    </table>
    <?php
}


add_action( 'show_user_profile', 'add_user_post' );
add_action( 'edit_user_profile', 'add_user_post' );


function user_post_save($user_id)
{
    update_user_meta( $user_id,'user_post', sanitize_text_field( $_POST['user_post'] ) );
}

add_action( 'personal_options_update', 'user_post_save' );
add_action( 'edit_user_profile_update', 'user_post_save' );

////////////////////////////////////////////////////////////////////////////////
/*feedback meta box*/
add_filter('rwmb_meta_boxes', 'feedback_meta_boxes');
function feedback_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title' => __('Feedback Info', 'textdomain'),
        'post_types' => 'feedback',
        'fields' => array(
            array(
                'id' => 'clients',
                'name' => __('Clients', 'textdomain'),
                'type' => 'text',
            ),
            array(
                'id' => 'gender',
                'name' => __('Gender', 'textdomain'),
                'type' => 'text',

            ),
            array(
                'id' => 'country',
                'name' => __('Country', 'textdomain'),
                'type' => 'text',

            ),
            array(
                'id' => 'email',
                'name' => __('Email', 'textdomain'),
                'type' => 'email',
            ),
            array(
                'id' => 'itinerary',
                'name' => __('Itinerary', 'textdomain'),
                'type' => 'text',
            ),
            array(
                'id'=>'feedback_is_video',
                'name'=>__('Is Video', 'textdomain'),
                'type'=>'checkbox'
            )
        ),
    );
    return $meta_boxes;
}


/*location meta box*/
add_filter('rwmb_meta_boxes', 'location_meta_boxes');
function location_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title' => __('Location Details', 'textdomain'),
        'post_types' => 'location',
        'fields' => array(
            array(
                'id' => 'location_province_city',
                'name' => __('Province Or City', 'textdomain'),
                'type' => 'radio',
                'options' => array(
                    'province' => __( 'province','textdomain'),
                    'city' => __( 'city','textdomain'),
                )
            ),

        ),
    );
    return $meta_boxes;
}

/*tour meta box*/
add_filter('rwmb_meta_boxes', 'tour_meta_boxes');
function tour_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title' => __('Tour Details', 'textdomain'),
        'post_types' => 'tour',
        'fields' => array(
            array(
                'id' => 'tour_optional_activities',
                'name' => __('Tour option activity', 'textdomain'),
                'type' => 'wysiwyg'
            ),
            array(
                'id' => 'tour_travel_tip',
                'name' => __('Travel tip', 'textdomain'),
                'type' => 'wysiwyg'
            ),
            array(
                'id' => 'tour_services',
                'name' => __('Tour services', 'textdomain'),
                'type' => 'wysiwyg'
            ),

        ),
    );
    return $meta_boxes;
}




