<?php
/**
 * Template part for displaying the footer nav menu.
 *
 * @package Uptown Style
 */

$header_img = primer_get_hero_image();
?>
<div class="hero" <?php if ( ! empty( $header_img ) ) : ?> style="background:url('<?php echo $header_img; ?>') no-repeat top center; background-size: cover;"<?php endif; ?>>

	<div class="hero-wrapper">

		<?php do_action( 'uptown_hero' ); ?>

		<?php if ( is_front_page() ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php endif; ?>

	</div>

</div>
