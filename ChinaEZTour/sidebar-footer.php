<?php

/**

 * The sidebar containing the footer widget area.

 *

 * If no active widgets in sidebar, let's hide it completely.

 *

 * @package WordPress

 * @subpackage BookYourTravel

 * @since Book Your Travel 1.0

 */

global $bookyourtravel_theme_globals;

if ( is_active_sidebar( 'footer' ) ) : ?>

	<div id="footer-sidebar" class="footer-sidebar widget-area wrap" role="complementary">

		<ul>

            <li class="widget widget-sidebar one-half"><h6>About ChinaEZTour</h6>



                <div class="textwidget">

                    <div class="textwidget">Shanghai Ez International Travel Service Co.,LTD (L-SH-01704) is

                        approved by the Shanghai Tourism Bureau and registered with the Industrial and Commercial Bureau

                        of Pudong New District<br>

                        <b>For Special Booking Request,please call</b><br>



                        <h2 class="footer-tel">+86 21 5239 2064</h2>



                        <div class="contact-email-w small">eztour@outlook.com</div>

                    </div>

                    <article class="byt_social_widget BookYourTravel_Social_Widget">

                        <ul class="social">

                            <li><a href="<?php echo $bookyourtravel_theme_globals->get_facebook(); ?>" title="facebook" style="background: #3b5998;">

                                    <i class="fa fa-facebook fa-fw"></i>

                                </a>

                            </li>

                            <li><a href="<?php echo $bookyourtravel_theme_globals->get_twitter(); ?>" title="twitter" style="background: #55acee;">

                                    <i class="fa fa-twitter fa-fw"></i>

                                </a>

                            </li>

                            <li><a href="<?php echo $bookyourtravel_theme_globals->get_google(); ?>" title="linkedin" style="background: #0076b4;">

                                    <i class="fa fa-linkedin fa-fw"></i>

                                </a>

                            </li>

                            <li><a href="<?php echo $bookyourtravel_theme_globals->get_linkedin(); ?>" title="googleplus" style="background: #db4d40;">

                                    <i class="fa fa-google-plus fa-fw"></i>

                                </a>

                            </li>



                        </ul>

                    </article>

                </div>

            </li>

		<?php dynamic_sidebar( 'footer' ); ?>

		</ul>

	</div><!-- #secondary -->

<?php endif;