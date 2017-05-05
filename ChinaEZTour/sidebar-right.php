<link href="/js/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="/js/select2/dist/js/select2.min.js"></script>
<?php
/**
 * The sidebar containing the right widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage BookYourTravel
 * @since Book Your Travel 1.0
 */
if (is_active_sidebar('right')) : ?>
    <aside id="secondary" class="right-sidebar widget-area one-fourth" role="complementary">
        <ul>
            <?php dynamic_sidebar('right'); ?>
        </ul>
    </aside><!-- #secondary -->
<?php endif;