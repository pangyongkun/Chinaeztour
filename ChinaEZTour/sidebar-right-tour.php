<?php
/**
 * The sidebar containing the tour widget area.
 *
 * @package WordPress
 * @subpackage BookYourTravel
 * @since Book Your Travel 1.0
 */

global $post, $tour_price, $current_user, $show_currency_symbol_after, $default_currency_symbol, $price_decimal_places, $tour_obj, $entity_obj, $score_out_of_10, $bookyourtravel_review_helper, $bookyourtravel_theme_globals,$bookyourtravel_tour_helper;

$enable_reviews = $bookyourtravel_theme_globals->enable_reviews();
$tour_locations = $tour_obj->get_locations();
$tour_location_title = '';
if ($tour_locations && count($tour_locations) > 0) {
	foreach ($tour_locations as $location_id) {
		$location_obj = new BookYourTravel_Location((int)$location_id);
		$location_title = $location_obj->get_title();
		$tour_location_title .= $location_title . ', ';
	}
}
$tour_location_title = rtrim($tour_location_title, ', ');

$tour_schedule=$bookyourtravel_tour_helper->list_tour_schedules(null,100,'Id','ASC',0,0,0,$tour_obj->get_id() );
?>

<link href="/js/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="/js/select2/dist/js/select2.min.js"></script>
<aside id="secondary" class="right-sidebar widget-area one-fourth" role="complementary">
	<ul class="bootstrap-iso">
		<li>
			<article class="tour-details">
				<h4><?php echo $tour_obj->get_title(); ?></h4>
				<span class="address"><?php echo $tour_location_title; ?></span>
				<?php if ($score_out_of_10 > 0) { ?>
				<span class="rating"><?php echo $score_out_of_10; ?> / 10</span>
				<?php } ?>

				<?php if ($tour_price > 0) { ?>
				<div class="price">
					<?php esc_html_e('Price from ', 'bookyourtravel'); ?>
					<em>
					<?php if (!$show_currency_symbol_after) { ?>
					<span class="curr"><?php echo esc_html($default_currency_symbol); ?></span>
					<span class="amount"><?php echo number_format_i18n( $tour_price, $price_decimal_places ); ?></span>
					<?php } else { ?>
					<span class="amount"><?php echo number_format_i18n( $tour_price, $price_decimal_places ); ?></span>
					<span class="curr"><?php echo esc_html($default_currency_symbol); ?></span>
					<?php } ?>
					</em>
				</div>

				<?php } ?>

                <?php
                $post_id=get_the_ID();
                $tour_code=get_post_meta($post_id,'tour_tour_code',true);
                $travel_length=get_post_meta($post_id,'tour_travel_lengthdays',true);
                foreach($tour_schedule['results'] as $tour_schedule_result){
                    if($tour_schedule_result->price==$tour_price){
                        echo '<br><b>Tour code:</b>'.$tour_code.'<br><b>Travel length:</b>'.$tour_schedule_result->duration_days.'Days';
                        break;
                    }

                }

                ?>

				<?php BookYourTravel_Theme_Utils::render_field("description", "", "", BookYourTravel_Theme_Utils::strip_tags_and_shorten($tour_obj->get_description(), 100), "", true); ?>

				<?php
				$tags = $tour_obj->get_tags();
				if (count($tags) > 0) {?>
				<div class="tags">
					<ul>
						<?php
							foreach ($tags as $tag) {
								echo '<li>' . $tag->name . '</li>';
							}
						?>
					</ul>
				</div>
				<?php } ?>

				<?php
				if ($enable_reviews) {
					$reviews_by_current_user_query = $bookyourtravel_review_helper->list_reviews($tour_obj->get_base_id(), $current_user->ID);
					if (!$reviews_by_current_user_query->have_posts() && is_user_logged_in()) {
						BookYourTravel_Theme_Utils::render_link_button("#", "gradient-button right leave-review review-tour", "", esc_html__('Leave a review', 'bookyourtravel'));
					}
					?>
					<p class="review-form-thank-you" style="display:none;">
					<?php esc_html_e('Thank you for submitting a review.', 'bookyourtravel'); ?>
					</p>
					<?php
				}
				if (!$tour_obj->get_custom_field('hide_inquiry_form')) {
					BookYourTravel_Theme_Utils::render_link_button("#", "gradient-button right contact-tour", "", esc_html__('Send inquiry', 'bookyourtravel'));
					?>
					<p class="inquiry-form-thank-you" style="display:none;">
					<?php esc_html_e('Thank you for submitting an inquiry. We will get back to you as soon as we can.', 'bookyourtravel'); ?>
					</p>
					<?php
				} ?>
			</article>

		</li>
		<?php if ($enable_reviews) { ?>
		<li>
			<?php
			$all_reviews_query = $bookyourtravel_review_helper->list_reviews($tour_obj->get_base_id());
			if ($all_reviews_query->have_posts()) {
				while ($all_reviews_query->have_posts()) {
				$all_reviews_query->the_post();
				global $post;
				$likes = get_post_meta($post->ID, 'review_likes', true);
					break;
				}
			} ?>
		</li>
		<?php
		}
		wp_reset_postdata();
		dynamic_sidebar( 'right-tour' ); ?>
	</ul>
</aside><!-- #secondary -->