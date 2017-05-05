<?php
/**
 * /* Template Name: Feedback list
 *
 * The template for displaying the Feedback list.
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');

?>
    <div style="margin-top: -20px">
        <?php
        echo do_shortcode('[rev_slider alias="Blogindex"]');

        ?>
    </div>
<style>.post-media img{ height: 270px}.post-body{ height: 200px; overflow: hidden}
    .post-body-scroll{ height: 200px; overflow-y: scroll; overflow-x: hidden}
    .figure img{ height: 200px !important;}
    .text-bold{ display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
</style>
    <!-- Page-->
    <link rel="stylesheet" href="/css/style.css">
    <div class="page text-center">
        <!-- Page Head-->

        <!-- Page Contents-->
        <main class="page-content">
            <!-- Modern Blog-->

            <section class="section-40 bg-catskill">
                <div class="shell-wide">
                    <div class="range range-xs-center">
                        <div class="cell-md-10 cell-lg-12 cell-xl-5" style="text-align: left">
                            <h3>China Tour Reviews</h3>
                            <p class="offset-top-10 offset-md-top-20">Our guests are from varied cultures with diverse tastes and interests, but they all made the same right choice - TravelChinaGuide. We are certain that you will love our service, but don't take our word for it - here are our clients' China tour reviews about their travel experiences with us. Please read their reviews and comments on our service and feel free to contact them with your questions.
                            </p>
                            <div style="text-align: center">
                            <h2 class="text-uppercase text-bold text-ebony-clay">Customers Videos</h2>
                            <hr class="divider divider-lg bg-primary"></div>
                            <div data-items="1" data-md-items="2" data-lg-items="4" data-margin="30" data-nav="true" data-dots="true" data-nav-class="[&quot;owl-prev icon-primary-filled fa fa-chevron-left&quot;, &quot;owl-next icon-primary-filled fa fa-chevron-right&quot;]" class="owl-carousel owl-carousel-default owl-carousel-arrows owl-carousel-arrows-fullwidth veil-xl-owl-dots veil-owl-nav reveal-xl-owl-nav">
                            <?php
                            $args=array(
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post_type' => 'feedback',
                                'post_status' => 'publish',
                                'posts_per_page'=>8
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

                                <div>
                                    <!-- Thumbnail Terry-->
                                    <div class="thumbnail-terry">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <span class="figure thumbnail-border-none">
                                    <img width="420" height="280" class="lazy" data-original="<?php echo $thumbnail[0]; ?>" alt="">
                                    </span><span class="figcaption"><span class="reveal-block">
                                    <span class="thumbnail-terry-title text-bold"><?php echo get_the_title(); ?></span></span>
                                    <span class="thumbnail-terry-desc offset-md-top-10"></span>
                                    </span>
                                    </a>
                                    </div>
                                </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>

                        </div>
                </div>


                <div class="tags group group-sm offset-top-23">
                <?php
                $categories = get_categories(array('type' => 'feedback', 'taxonomy' => 'feedback_category','hide_empty'=>0));
                foreach ($categories as $category) {
                    ?>
                <a href="<?php echo get_category_link( $category->cat_ID ); ?>" class="btn-tag btn btn-orange-peel btn-orange-peel-transparent"><?php echo $category->name ?></a>
                <?php } ?>
                </div>

                <div class="range range-md-left offset-top-63">

                    <?php
                    $args=array(
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post_type' => 'feedback',
                        'post_status' => 'publish',
                        'posts_per_page'=>8
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
                        <div class="cell-sm-6 cell-lg-4 cell-xl-3 offset-top-20">
                            <!-- Post Modern-->
                            <article class="post post-modern post-modern-classic">
                                <!-- Post media-->
                                <header class="post-media"><img data-original="<?php echo $thumbnail[0] ?>" alt="" class="img-responsive img-cover lazy"/>
                                </header>
                                <!-- Post content-->
                                <section class="post-content text-left">
                                    <!-- Post Title-->
                                    <div class="post-title offset-top-8">
                                        <h4 class="text-bold"><a href="<?php echo get_permalink(); ?>"><?php echo get_post_meta(get_the_ID(),'itinerary',true); ?></a></h4>
                                    </div>
                                    <ul class="group-lg list list-inline text-darker offset-top-20">
                                        <li><?php echo get_the_time('M d, Y').' at '.get_the_time(  'H:i:s'); ?></li>
                                        <li><?php echo get_post_meta(get_the_ID(),'country',true); ?></li>
                                        <li><b>Clients:</b><?php echo get_post_meta(get_the_ID(),'gender',true); ?> <?php echo get_post_meta(get_the_ID(),'clients',true); ?><br>
                                            <b>Email:</b><?php echo get_post_meta(get_the_ID(),'email',true); ?><br>
                                        </li>
                                    </ul>
                                    <!-- Post Body-->
                                    <div class="post-body">
                                        <div class="offset-top-20">
                                            <p><?php echo substr(get_the_excerpt(),0,400); ?></p>
                                        </div>
                                    </div>
                                </section>
                            </article>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                </div>
            </section>

            </div>
        </main>
        <!-- Page Footer-->
        <!-- Footer Default-->

    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.post-body').mouseover(function () {
                $(this).removeClass('post-body')
                    .addClass('post-body-scroll');
            }).mouseout(function () {
                $(this).removeClass('post-body-scroll')
                    .addClass('post-body');
            });
        });
    </script>
    
<?php
get_footer();