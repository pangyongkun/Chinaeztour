<?php
/**
 * /* Template Name: About list
 *
 * The template for displaying the FAQ list.
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');
global $bookyourtravel_theme_globals;

?>
   </div></div>
   <style>.main{ min-height: 0px !important; display: none}
      #newstyle h1{ padding: 0px !important;}
      #newstyle h5{ padding: 0px !important; margin-bottom: 0px !important;}
      #newstyle h2{ padding: 0 !important;}
      #newstyle h6{ padding: 0 !important; margin-bottom: 0px !important;}
       #newstyle hr{ display: block}
   </style>
   <link rel="stylesheet" href="/css/style.css">
    <section id="newstyle" class="section-height-700 breadcrumb-modern rd-parallax context-dark bg-gray-darkest" style="width: 100%; margin-top: -18px">
        <div data-speed="0.2" data-type="media" data-url="/temp/background-06-1920x950.jpg" class="rd-parallax-layer"></div>
        <div data-speed="0" data-type="html" class="rd-parallax-layer">
            <div class="bg-overlay-lg-darker">
                <div class="shell section-top-50 section-bottom-34 section-md-top-90 section-lg-bottom-34 section-lg-top-128" style="margin: 50px auto">
                    <div class="veil reveal-md-block">
                        <h5 class="reveal-inline-block font-default both-lines text-italic">Let`s Create Future Together</h5>
                    </div>
                    <div class="veil reveal-md-block offset-top-8">
                        <h1 class="text-bold">About Us</h1>
                    </div>
                    <ul class="list-inline list-inline-icon p offset-top-35 offset-md-top-63 offset-lg-top-108">
                        <li class="text-warning"><a href="index.html">Home</a></li>
                        <li>About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="newstyle"  class="page text-center">
        <!-- Page Head-->
        <!-- Page Contents-->
        <main class="page-content">
            <!-- Paris Cruise-->
            <section class="section-90 section-lg-0 section-hidden">
                <div class="shell-wide">
                    <div class="range range-xs-center range-lg-left">
                        <div class="cell-xs-10 cell-lg-6 section-image-aside section-image-aside-right text-left">

                            <h3 class="text-bold text-uppercase text-spacing-20 text-ebony-clay text-center text-sm-left offset-top-30">About ChinaEZtour</h3>
                            <hr class="divider-lg hr-sm-left-0 bg-primary"><p><?php echo esc_html($bookyourtravel_theme_globals->get_about_us()); ?></p>
                        </div>
                        <div class="cell-xs-10 cell-lg-6 section-md-top-165">
                            <img class="lazy" data-original="/temp/temp8.jpg" alt="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- Skills-->
            <section style="background: #282e3c url(/temp/background-04-642x538.png) repeat;" class="section-30 section-md-30">
                <div class="shell-wide">
                    <h2 class="text-bold text-uppercase text-ebony-clay" style="color:#fff">Company Events</h2>
                    <hr class="divider divider-lg bg-primary">
                    <div class="range range-xs-center range-md-left text-sm-left">
                        <?php
                        $args = array(
                            'post_type' => 'about',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'about_category',
                                    'field' => 'slug',
                                    'terms' => 'company-events'
                                )
                            )

                        );
                        $query = new WP_Query($args);
                        while ($query->have_posts()): $query->the_post();

                        //search thumbnail
                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $thumbnail = wp_get_attachment_image_src($thumbnail_id, full);
                        if ($thumbnail[0] == null || $thumbnail[0] == '') {
                            $thumbnail[0] = home_url() . '/skin/img.jpg';
                        }
                        ?>
                            <div class="cell-sm-6 cell-md-4 cell-lg-3">
                                <!-- Guide Post-->
                                <div class="guide-post"><a href="<?php echo get_the_permalink(); ?>">
                                        <div class="guide-post-img-wrap"><img  data-original="<?php echo $thumbnail[0];?>" width="420" height="280" alt="" class="img-responsive center-block lazy"></div>
                                        <div class="guide-post-body">
                                            <div class="offset-top-4">
                                                <div class="text-atlantis"><?php echo get_the_title(); ?></div>
                                            </div>
                                        </div></a></div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>







                    </div>
                </div>
            </section>
            <!-- our team-->
            <section class="section-30 section-md-30">
                <div class="shell-wide">
                    <h2 class="text-bold text-uppercase text-ebony-clay">our team</h2>
                    <hr class="divider divider-lg bg-primary">
                    <div class="range range-xs-center range-md-left offset-top-57 text-md-left">
                        <?php
                        $users = get_users( array( 'role' => 'staff' ) );
                        foreach($users as $user){


                        ?>
                        <div class="cell-xs-8 cell-sm-5 cell-md-2 cell-xl-2">
                            <!-- Box Member-->
                            <div class="box-member"><?php echo get_avatar($user->ID,270); ?>
                                <div class="offset-top-18">
                                    <div class="box-member-title">
                                        <h6 class="text-bold text-primary"><a href="<?php echo get_author_posts_url($user->ID ); ?>"><?php echo $user->display_name ?></a></h6>
                                    </div>
                                    <div class="box-member-description offset-top-5">
                                        <p><?php echo get_user_meta($user->ID,'user_post',true); ?></p>
                                    </div>
                                </div>
                                <div class="box-member-wrap">
                                    <div class="box-member-caption">
                                        <div class="box-member-caption-inner">
                                            <ul class="list-inline list-inline-2 reveal-inline-block" style="margin-bottom: 182px">
                                                <li><a href="<?php echo get_author_posts_url($user->ID ); ?>" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-user"></a> </li>
                                                <li><a href="mailto:<?php echo $user->user_email; ?>" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa fa-envelope-o"></a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                    </div>
                </div>
            </section>
            <!-- testimonials-->
            <section class="section-30 section-md-30 bg-catskill">
                <div class="shell-wide">
                    <h2 class="text-bold text-uppercase text-spacing-20 text-ebony-clay">testimonials</h2>
                    <hr class="divider divider-lg bg-primary">
                    <div class="range range-xs-center owl-testimonials offset-md-top-30 offset-lg-top-63 owl-pagination-offset-60">
                        <div class="cell-sm-8 cell-md-12">
                            <!-- Owl Carousel-->
                            <div data-items="1" data-sm-items="1" data-md-items="3" data-nav="false" data-dots="true" data-sm-stage-padding="5" data-xl-stage-padding="0" data-margin="20" data-md-margin="30" data-lg-margin="40" class="owl-carousel owl-carousel-classic">
<!--Loop Start-->
                                <div>
                                    <!-- Blockquote-->
                                    <blockquote class="quote quote-classic section-md-top-30 section-lg-top-0">
                                        <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                            <div class="unit-left"><img data-original="/temp/user-amy-garza-70x70.jpg" width="70" height="70" alt="" class="img-responsive img-circle center-block lazy"/></div>
                                            <div class="unit-body">
                                                <h6 class="quote-author"><a href="team-member.html">Amy Garza</a></h6>
                                                <p class="quote-desc">Manager, New York</p>
                                            </div>
                                        </div>
                                        <p class="h5 font-default text-bold text-italic offset-top-18">
                                            <q>I would just like to say thank you for your prompt and effective service, for your friendly and professional support staff! I will recommend your expert company to all my friends.</q>
                                        </p>
                                    </blockquote>
                                </div>
<!--Loop End-->
                                <div>
                                    <!-- Blockquote-->
                                    <blockquote class="quote quote-classic section-md-top-30 section-lg-top-0">
                                        <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                            <div class="unit-left"><img data-original="/temp/user-amy-garza-70x70.jpg" width="70" height="70" alt="" class="img-responsive img-circle center-block lazy"/></div>
                                            <div class="unit-body">
                                                <h6 class="quote-author"><a href="team-member.html">Amy Garza</a></h6>
                                                <p class="quote-desc">Manager, New York</p>
                                            </div>
                                        </div>
                                        <p class="h5 font-default text-bold text-italic offset-top-18">
                                            <q>I would just like to say thank you for your prompt and effective service, for your friendly and professional support staff! I will recommend your expert company to all my friends.</q>
                                        </p>
                                    </blockquote>
                                </div>
                                <div>
                                    <!-- Blockquote-->
                                    <blockquote class="quote quote-classic section-md-top-30 section-lg-top-0">
                                        <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                            <div class="unit-left"><img data-original="/temp/user-amy-garza-70x70.jpg" width="70" height="70" alt="" class="img-responsive img-circle center-block lazy"/></div>
                                            <div class="unit-body">
                                                <h6 class="quote-author"><a href="team-member.html">Amy Garza</a></h6>
                                                <p class="quote-desc">Manager, New York</p>
                                            </div>
                                        </div>
                                        <p class="h5 font-default text-bold text-italic offset-top-18">
                                            <q>I would just like to say thank you for your prompt and effective service, for your friendly and professional support staff! I will recommend your expert company to all my friends.</q>
                                        </p>
                                    </blockquote>
                                </div>
                                <div>
                                    <!-- Blockquote-->
                                    <blockquote class="quote quote-classic section-md-top-30 section-lg-top-0">
                                        <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                            <div class="unit-left"><img data-original="/temp/user-amy-garza-70x70.jpg" width="70" height="70" alt="" class="img-responsive img-circle center-block lazy"/></div>
                                            <div class="unit-body">
                                                <h6 class="quote-author"><a href="team-member.html">Amy Garza</a></h6>
                                                <p class="quote-desc">Manager, New York</p>
                                            </div>
                                        </div>
                                        <p class="h5 font-default text-bold text-italic offset-top-18">
                                            <q>I would just like to say thank you for your prompt and effective service, for your friendly and professional support staff! I will recommend your expert company to all my friends.</q>
                                        </p>
                                    </blockquote>
                                </div>
                                <div>
                                    <!-- Blockquote-->
                                    <blockquote class="quote quote-classic section-md-top-30 section-lg-top-0">
                                        <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                            <div class="unit-left"><img data-original="/temp/user-amy-garza-70x70.jpg" width="70" height="70" alt="" class="img-responsive img-circle center-block lazy"/></div>
                                            <div class="unit-body">
                                                <h6 class="quote-author"><a href="team-member.html">Amy Garza</a></h6>
                                                <p class="quote-desc">Manager, New York</p>
                                            </div>
                                        </div>
                                        <p class="h5 font-default text-bold text-italic offset-top-18">
                                            <q>I would just like to say thank you for your prompt and effective service, for your friendly and professional support staff! I will recommend your expert company to all my friends.</q>
                                        </p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
   <script src="js/core.min.js"></script>
   <script src="js/script.js"></script>
<?php
get_footer();