<?php
global $bookyourtravel_tour_helper;
class BookYourTravel_Style_Helper{

    protected function __construct() {

    }


    function list_featured_tours ($args){
        $query = new WP_Query($args);
        while ($query->have_posts()):
            $query->the_post();
            //search thumbnail
            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
            if ($thumbnail[0] == null || $thumbnail[0] == '') {
                $thumbnail[0] = home_url() . '/skin/img.jpg';
            }
            $locations_id = get_post_meta(get_the_id(), 'locations', true);
            $tour_schedule = $bookyourtravel_tour_helper->list_tour_schedules(null, 1, 'Id', 'ASC', 0, 0, 0, get_the_ID());
            ?>
            <article class="tour_item one-third">
                <div>
                    <figure>
                        <img src="<?php echo $thumbnail[0] ?>"
                             alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>"
                             style="width:100%; height:250px">
                    </figure>
                    <div class="details" style="height: 235px;">
                        <h4 class="over-hidden"><a href="<?php echo get_the_permalink(); ?>"
                                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
                        </h4>
                    <span class="address over-hidden">
                    <?php
                    foreach ($locations_id as $location_id) {
                        echo get_the_title($location_id) . ' ';
                    }
                    ?>
                    </span>
                        <span class="days"><?php echo $tour_schedule['results'][0]->duration_days; ?>days</span>

                        <div class="price clearfix">
                            Price per person from <em>
                                <span class="curr">$</span>
                                <span class="amount"><?php echo $tour_schedule['results'][0]->price; ?></span>
                            </em>
                        </div>

                        <div class="description clearfix"><?php echo substr(get_the_excerpt(), 0, 160) . '...'; ?> <a
                                href="<?php echo get_the_permalink(); ?>">More
                                info</a></div>

                    </div>
                </div>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    }

}

global $bookyourtravel_style_helper;

// store the instance in a variable to be retrieved later and call init
//$bookyourtravel_style_helper = BookYourTravel_Style_Helper::getInstance();
