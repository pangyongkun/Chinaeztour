<?php
/**
 * Template Name:Create Your Trip
 */

get_header();
//BookYourTravel_Theme_Utils::breadcrumbs();
?>
    </div></div>
    <style>.main{display: none;}h1{ padding: 0px !important;}
        h5{ padding: 0px !important; margin-bottom: 0px !important;}
        h2{ padding: 0 !important;}
        .want-to-visit .wpcf7-list-item{ width: 160px}
        .wpcf7-list-item{ width: 200px}
        #wpcf7-f1148-o1 p{ margin: 0px; padding: 0px }
        #wpcf7-f1148-o1 label{ margin: 0px; padding: 0px }
        .wpcf7-form-control-wrap{ padding: 0px; margin-top: 20px !important;}
        .desmain{background:url(/temp/tailor-made-1600-2.jpg) no-repeat center center; background-attachment:fixed; background-size:cover;padding-bottom:1.5em;  padding-top: 1em;}
        .header{ margin-bottom: 0px}
        .Hotel-Style .wpcf7-list-item{ width: 250px}
        .Train-Plane .wpcf7-list-item{ width: 250px}
        .Age-Range .wpcf7-list-item{ width: 100px}
        .travel-with-you .wpcf7-list-item{ width: 150px}
        .select2-results__option{ text-align: left}
        .triplength-left{ width: 30%; float: left; margin-right:20px; margin-bottom: 20px }
        .triplength-right{ width: 50%; float: left; margin-top: 20px;margin-bottom: 20px}
        .triplength-right .wpcf7-list-item{ width: 60px}
        .triplength-right .wpcf7-form-control-wrap { margin-top: 0px !important;}
        h5{
            clear: both;}
        .Date-of-Arrival{ width: 30%}
        @media (max-width: 1000px) {
         .triplength-left{ width: 100%;}
         .triplength-right{ width: 100%;}

        }
    </style>
    <link rel="stylesheet" href="/css/style.css">

    <!-- Page Contents-->
    <main class="page-content desmain">
        <section class="section-90 section-md-50 text-sm-left">
            <div class="shell-wide">
                <h3 class="text-bold text-center" style="color: #fff">Tailor My Tour</h3>
                <p class="text-center" style="color: #fff">The joy of travel starts at home! Your travel adventure starts the moment you start to map it out. <br>We’re here to help you discover China in your way!</p>
                <div class="range range-xs-center range-lg-left">
                    <div class="cell-lg-2"></div>
                    <div class="cell-lg-8" style="background: rgba(245,245,245,0.9);padding: 40px;border-radius:8px">
                        <div class="offset-top-20">
                            <?php echo do_shortcode('[contact-form-7 id="1148" title="Tailor My Tour"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <script src="/js/core.min.js"></script>
    <script src="/js/script.js"></script>
<?php
get_footer();