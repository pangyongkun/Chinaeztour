
<aside id="secondary_" class="right-sidebar widget-area one-fourth" role="complementary">
    <ul>
    <?php
        $post_location=get_post($location_id);
        $location_obj_siderbar = new BookYourTravel_Location($post_location);
        $map_img_id=$location_obj_siderbar->get_custom_field('map_image');
        $map_img=wp_get_attachment_image_src($map_img_id,full);
        if ($map_img[0] == null || $map_img[0] == '') {
            $map_img[0] = home_url() . '/skin/img.jpg';
        }
        if($show_map==true){
        ?>
        <li class="widget widget-sidebar">
            <ul class="small-list destinations">
                <h4><img class="attachment-featured size-featured wp-post-image" src="<?php echo $map_img[0] ?>"></h4>
                <ul>
                    <li><b>Chinese Name:</b></b><?php echo $location_obj_siderbar->get_custom_field('chinese_name'); ?></li>
                    <li><b>English IPA:</b></b><?php echo $location_obj_siderbar->get_custom_field('english_ipa'); ?></li>
                    <li><b>Location:</b></b><?php echo $location_obj_siderbar->get_custom_field('location'); ?></li>
                    <li><b>Population:</b></b><?php echo $location_obj_siderbar->get_custom_field('population'); ?></li>
                    <li><b>Language:</b></b><?php echo $location_obj_siderbar->get_custom_field('language'); ?></li>
                </ul>
            </ul>
        </li>
        <?php } ?>

        <?php $province_city= $location_obj_siderbar->get_custom_field('province_city');

        if($province_city=='city'){?>
        <li class="widget widget-sidebar">
            <ul class="side-menu">
            <h4>Travel in <?php echo $location_obj_siderbar->get_title(); ?></h4>
                <li><a href="<?php echo $location_obj_siderbar->get_permalink(); ?>"><h3><?php echo $location_obj_siderbar->get_title(); ?> Overview</h3></a></li>
                <li><a href="<?php echo $location_obj_siderbar->get_permalink() . '/attractions_' . $location_obj_siderbar->get_id(); ?>"><h3><?php echo $location_obj_siderbar->get_title(); ?> Attractions</h3></a></li>
                <li><a href="<?php echo $location_obj_siderbar->get_permalink() . '/tour_' . $location_obj_siderbar->get_id(); ?>"><h3><?php echo $location_obj_siderbar->get_title(); ?> Tours</h3></a></li>
                <li><a href="<?php echo $location_obj_siderbar->get_permalink() . '/activities_' . $location_obj_siderbar->get_id(); ?>"><h3><?php echo $location_obj_siderbar->get_title(); ?> Activities</h3></a></li>
                <li><a href="<?php echo $location_obj_siderbar->get_permalink() . '/curiosities_' . $location_obj_siderbar->get_id(); ?>"><h3><?php echo $location_obj_siderbar->get_title(); ?> Curiosities</h3></a></li>

            </ul>
            <ul class="small-list destinations">
            <h4>Top <?php echo $location_obj_siderbar->get_title(); ?> Tours</h4>
            <?php
            $args = array(
                'post_type' => 'tour',
                'posts_per_page'=>5,
                'meta_query' => array(
                    array(
                        'key' => 'locations',
                        'value' => serialize(strval($location_id)),
                        'compare' => 'LIKE'
                    ),
                ),
            );
            $query = new WP_Query($args);

            while ($query->have_posts()):$query->the_post();
                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                $thumbnail = wp_get_attachment_image_src($thumbnail_id);
                if ($thumbnail[0] == null || $thumbnail[0] == '') {
                    $thumbnail[0] = home_url() . '/skin/img.jpg';
                }
                ?>
                <li>
                    <a href="<?php the_permalink() ?>">
                        <figure>
                            <img src="<?php echo $thumbnail[0] ?>" class="attachment-featured size-featured wp-post-image" alt="<?php the_title(); ?>" title="" height="459" width="850">
                        </figure>
                        <h3><?php the_title(); ?></h3>
                    </a>
                </li>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
            </ul>
        </li>
            <?php } ?>

        <?php if($show_tour_category==true){
            $parent_category=get_term_by('id',$cat->parent,'blog_category');
            $cat_args=array(
                'type'=> 'post',
                'child_of'=> $parent_category->term_id,
                'taxonomy'=> 'tour_category',
                'hide_empty'=> 1,
                'orderby'=>'name',
            );
            $categories=get_categories($cat_args);
        ?>
        <li class="widget widget-sidebar">
            <ul class="side-menu">
                <h4> <?php echo $parent_category->name; ?></h4>
                <?php foreach($categories as $category) {
                echo '<li><a href="'.get_category_link( $category->term_id ).'"> <h3>'.$category->name.'</h3></a></li>';
                } ?>
            </ul>
        </li>
        <?php } ?>

        
    </ul>
</aside>