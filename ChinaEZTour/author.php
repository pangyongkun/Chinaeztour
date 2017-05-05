<?php
/**
 * /* Template Name: Author
 *
 * The template for displaying the Author.
 *
 */
get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
get_sidebar('under-header');

global $bookyourtravel_theme_globals;

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

?>

    <main class="page-content">
        <!-- Team Member Profile-->
        <section class="section-90 section-md-122 text-sm-left">
            <div class="shell">
                <div class="range range-xs-center">
                    <div class="cell-xs-10 cell-sm-3 cell-lg-3">
                        <!-- Member block-->
                        <div class="member-block">
                            <?php echo get_avatar($curauth->ID,247,370); ?>
                        </div>
                    </div>
                    <div class="cell-xs-10 cell-sm-9 cell-lg-9 offset-top-63 offset-sm-top-0">
                        <div class="inset-md-left-30">
                            <div>
                                <h3 class="text-bold text-uppercase text-spacing-20 text-ebony-clay"><?php echo $curauth->display_name; ?></h3>
                            </div>
                            <div>
                                <!-- Contact Info-->
                                <div class="reveal-inline-block">
                                                    <span class="unit-left">
                                                        <span class="icon icon-xxs icon-warning icon-circle mdi mdi-email-outline text-white icon icon-xxs icon-warning icon-circle mdi mdi-mail"></span>
                                                    </span><span class="unit-body inset-left-5">
                                                        <span><?php echo $curauth->user_email; ?></span>
                                                    </span></a></div>

                               <div style="margin-top: 20px"><?php echo $curauth->description; ?></div>
                                <!--<div class="member-block-body context-light offset-top-30 text-sm-left">
                                    <div class="offset-top-20">
                                        <ul class="list-inline list-inline-4 reveal-inline-block inset-left-5">
                                            <li><a href="#" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa-facebook"></a></li>
                                            <li><a href="#" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa-twitter"></a></li>
                                            <li><a href="#" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa-google-plus"></a></li>
                                            <li><a href="#" class="icon icon-xxs icon-boulder-filled icon-boulder-filled-inverse icon-circle fa-instagram"></a></li>
                                        </ul>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- latest jack anderson’s blog posts-->
        <section class="section-90 section-md-122 bg-catskill">
            <div class="shell-wide">
                <div>
                    <h4 class="text-bold text-uppercase text-spacing-20 text-ebony-clay">latest <?php the_author(); ?>’s blog posts</h4>
                </div>
                <div class="offset-top-30">
                    <hr class="divider divider-lg bg-primary">
                </div>
                <div class="range range-xs-left text-sm-left offset-top-57">
                    <?php

                    $args = array(
                        'author'=>$curauth->ID,
                        'post_type' => 'blog',
                        'posts_per_page'=>9
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
                    <div class="cell-sm-7 cell-lg-4 offset-top-40 offset-lg-top-0">
                        <!-- Post Modern-->
                        <article class="post post-modern post-modern-classic">
                            <!-- Post media-->
                            <header class="post-media"><img width="570" height="400" src="<?php echo $thumbnail[0]; ?>" alt="" class="img-responsive img-cover">
                            </header>
                            <!-- Post content-->
                            <section class="post-content text-left">
                                <div class="post-modern-classic-meta"><a href="#"><span class="icon text-middle icon icon-xxs icon-extra-small mdi mdi-file-image text-orange-peel"></span><span class="text-middle text-darker text-bold">Articles</span></a></div>
                                <!-- Post Title-->
                                <div class="post-title offset-top-8">
                                    <h4 class="text-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                </div>
                                <ul class="group-lg list list-inline text-darker offset-top-20">
                                    <li><?php echo get_the_time('M d, Y').' at '.get_the_time(  'H:i:s'); ?></li>
                                    <li><a href="<?php echo get_the_author_meta('user_url'); ?>" class="text-orange-peel"><?php echo get_the_author(); ?></a></li>
                                    <li><a href="#"><?php echo count(get_comments('post_id='.get_the_ID()));?> Comments</a></li>
                                </ul>
                                <!-- Post Body-->
                                <div class="post-body">
                                    <div class="offset-top-20">
                                        <p>
                                            <?php echo get_the_excerpt(); ?>
                                        </p>
                                    </div>
                                </div>
                            </section>
                        </article>
                    </div>
                        <?php endwhile; ?>

                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" href="/css/style.css">
<?php
get_footer();