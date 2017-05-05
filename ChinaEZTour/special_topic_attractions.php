<?php
/**
 * Category Template:Attractions
 */

get_header();
BookYourTravel_Theme_Utils::breadcrumbs();

global $wp_query,$bookyourtravel_tour_helper;
$cat_ID = get_query_var('cat');
$category=get_category($cat_ID);

if (function_exists('get_tax_image_urls'))
    $img_urls = get_tax_image_urls($cat_ID ,'full');
?>

<link rel='stylesheet'  href='/wp-content/themes/ChinaEZTour/includes/plugins/lightSlider/css/lightSlider.css?ver=4.6.1' type='text/css' media='all' />
<script type='text/javascript' src='/wp-content/themes/ChinaEZTour/includes/plugins/lightSlider/js/jquery.lightSlider.js?ver=1.0'></script>
<script type="text/javascript">
(function($) {

	$(document).ready(function () {
		locations.init();

        $('#tab-content1').hide();
        $('#tab-content2').show();

        $('#tab-title-tag2').bind('click',function(){
            $(this).removeClass('tab-title')
                .addClass('tab-title-act');
            $('#tab-title-tag1').removeClass('tab-title-act')
                .addClass('tab-title');

            $('#tab-content2').show();
            $('#tab-content1').hide();
        });

        $('#tab-title-tag1').bind('click',function(){
            $(this).removeClass('tab-title')
                .addClass('tab-title-act');
            $('#tab-title-tag2').removeClass('tab-title-act')
                .addClass('tab-title');
            $('#tab-content2').hide();
            $('#tab-content1').show();
        });
	});



	
	var locations = {

		init: function () {

			$("#gallery").lightSlider({
				item:1,
				rtl: (window.enableRtl ? true : false),
				slideMargin:0,
				auto:true,
				loop:true,
				speed:1500,
				pause:3000,
				keyPress:true,
				gallery:false,
				galleryMargin:0,
				onSliderLoad: function() {
					$('#gallery').removeClass('cS-hidden');
				}  
			});
		}
	};
	
})(jQuery);
</script>
<?php if (count($img_urls) > 0) { ?>
    <!--gallery-->
    <ul id="gallery" class="cS-hidden">
        <?php foreach($img_urls as $img_url) {?>
        <li><img class="lazy" data-original="<?php echo $img_url ?>" alt=""/></li>
        <?php }?>
    </ul>
    <!--//gallery-->
<?php } ?>
<?php echo $category->description; ?>

    <div class="row">
        <h2 class="text-center main-title">Best Attractions of China for 2016</h2>

        <p class="text-center">Follow is the collection of best attractions of China covering the most outstanding
            places for both nature and culture lovers. Each tab-content2 is the best of its kind, such as the masterpiece of
            Chinese architecture – Forbidden City, holy Tibetan Buddhist tab-content2 - Potala Palace, best sightseeing mountain
            – Huangshan, etc.
        </p>
        <?php
        $args = array(
            'post_type' => 'post',
            'category_name' => 'Attractions',
            'posts_per_page' => 8,

        );
        $query = new WP_Query($args);

        while ($query->have_posts()):
        $query->the_post();

        //search thumbnail
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
        if ($thumbnail[0] == null || $thumbnail[0] == '') {
            $thumbnail[0] = home_url() . '/skin/img.jpg';
        }

        ?>
        <article class="tour_item one-fourth">
            <div>
                <figure>
                    <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                         alt="<?php the_title(); ?>" title="<?php the_title(); ?>"
                         style="width:100%; height:150px">
                </figure>
                <div class="details" style="height: 235px;">
                    <h4 class="over-hidden"><a href="<?php the_permalink() ?>"
                           title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

                    <div class="description clearfix">
                        <?php echo substr(get_the_excerpt(),0,160).'...'; ?>
                        <a href="<?php the_permalink() ?>">More
                            info</a></div>

                </div>
            </div>
        </article>
        <?php endwhile; wp_reset_postdata();?>

        <h2 class="text-center main-title">More Things to Do in China</h2>

        <p class="text-center">No matter for the first time trip in China, or the tenth, you can always get an exciting
            adventure because China boasts too many things to do. But you may find it difficult to browse among such a
            large number of attractions. Don’t worry, we have already made it easy for you. Here we list out more than
            70 tab-content1s which offer unique places to visit. You only need to locate the things to do in the center
            tab-content1, or just find the attraction you are interested in in the attraction index tab.</p>

        <div class="one-half tab-title-act" id="tab-title-tag2">By Site</div>
        <div class="one-half tab-title" id="tab-title-tag1">By Destination</div>
        <?php
        $args = array(
            'post_type' => 'post',
            'category_name' => 'Attractions',
            'posts_per_page' => 1000,
            'orderby' => 'title',
            'order'=>'ASC'

        );
        $query = new WP_Query($args);
        ?>
        <div id="tab-content2">


            <div class="one-fifth tab-title-sub" >
                <h4 class="">A-E</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        if(($first_value>=65&&$first_value<=69)||($first_value>=97&&$first_value<=101)){
                            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">F-J</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        if(($first_value>=70&&$first_value<=74)||($first_value>=102&&$first_value<=106)){
                            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">K-O</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        if(($first_value>=75&&$first_value<=79)||($first_value>=107&&$first_value<=111)){
                            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">P-T</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        if(($first_value>=80&&$first_value<=84)||($first_value>=112&&$first_value<=116)){
                            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">U-Z</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        if(($first_value>=85&&$first_value<=90)||($first_value>=117&&$first_value<=122)){
                            echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                        }

                    endwhile; ?>
                </ul>
            </div>

        </div>
        <?php wp_reset_postdata(); ?>

        <?php
        $args = array(
            'post_type' => 'location',
            'posts_per_page' => 1000,
            'orderby' => 'title',
            'order'=>'ASC'
        );
        $query = new WP_Query($args);
        ?>
        <div id="tab-content1">
            <div class="one-fifth tab-title-sub" >
                <h4 class="">A-E</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        $province_city=get_post_meta(get_the_ID(),'location_province_city',true);
                        if(($first_value>=65&&$first_value<=69)||($first_value>=97&&$first_value<=101)){
                            if($province_city=='province'){
                                echo '<li><a style="color: #000" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }else{
                                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }

                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">F-J</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        $province_city=get_post_meta(get_the_ID(),'location_province_city',true);
                        if(($first_value>=70&&$first_value<=74)||($first_value>=102&&$first_value<=106)){
                            if($province_city=='province'){
                                echo '<li><a style="color: #000" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }else{
                                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">K-O</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        $province_city=get_post_meta(get_the_ID(),'location_province_city',true);
                        if(($first_value>=75&&$first_value<=79)||($first_value>=107&&$first_value<=111)){
                            if($province_city=='province'){
                                echo '<li><a style="color: #000" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }else{
                                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">P-T</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        $province_city=get_post_meta(get_the_ID(),'location_province_city',true);
                        if(($first_value>=80&&$first_value<=84)||($first_value>=112&&$first_value<=116)){
                            if($province_city=='province'){
                                echo '<li><a style="color: #000" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }else{
                                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }
                        }

                    endwhile; ?>
                </ul>
            </div>
            <div class="one-fifth tab-title-sub" >
                <h4 class="">U-Z</h4>
                <ul>
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();
                        $first=substr(get_the_title(),0,1);
                        $first_value=ord($first);
                        $province_city=get_post_meta(get_the_ID(),'location_province_city',true);
                        if(($first_value>=85&&$first_value<=90)||($first_value>=117&&$first_value<=122)){
                            if($province_city=='province'){
                                echo '<li><a style="color: #000" href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }else{
                                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                            }
                        }

                    endwhile; ?>
                </ul>
            </div>

        </div>
        <?php wp_reset_postdata(); ?>
        <h2 class="text-center main-title">Top Recommended China Tours</h2>

        <p>These are our best sellers. Over 10,000 customers in the last year have helped select these as the most
            popular China Highlights tours. Of course each of them can be tailor-made to your requirements at the
            booking stage. Take a look and contact us. Our consultancy is free.</p>

        <?php
        $args = array(
            'post_type' => 'tour',
            'posts_per_page' => 6,
            'meta_query'=>array(
                array(
                    'key'        => 'tour_is_featured',
                    'value'      => '1',
                    'compare'=>'='
                )
            )

        );
        $query = new WP_Query($args);

        while ($query->have_posts()):
        $query->the_post();

        //search thumbnail
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
        if ($thumbnail[0] == null || $thumbnail[0] == '') {
            $thumbnail[0] = home_url() . '/skin/img.jpg';
        }
            $locations_id=get_post_meta(get_the_id(),'locations',true);
            $tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,1,'Id','ASC',0,0,0,get_the_ID() );

            ?>
        <article class="tour_item one-third">
            <div>
                <figure>
                    <img class="lazy" data-original="<?php echo $thumbnail[0] ?>"
                         alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>"
                         style="width:100%; height:250px">
                </figure>
                <div class="details" style="height: 235px;">
                    <h4 class="over-hidden"><a href="<?php echo get_the_permalink(); ?>"
                           title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
                    <span class="address over-hidden">
                    <?php
                    foreach ($locations_id as $location_id) {
                        echo get_the_title($location_id).' ';
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

                    <div class="description clearfix"><?php echo substr(get_the_excerpt(),0,160).'...'; ?> <a
                            href="<?php echo get_the_permalink(); ?>">More
                            info</a></div>

                </div>
            </div>
        </article>
        <?php endwhile; wp_reset_postdata();  ?>


    </div>
<?php
get_footer();
?>