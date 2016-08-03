<?php
/**
 * Displays the site title.
 *
 * @package Primer
 */
$site_title = get_bloginfo( 'name', 'display' );
$site_description = get_bloginfo( 'description', 'display' );
?>


<div class="site-title-wrapper">

	<?php if ( has_custom_logo() ) : ?>

		<?php the_custom_logo() ?>

	<?php endif; ?>

</div><!-- .site-title-wrapper -->

<?php if ( get_header_image() ) : ?>

	<div class="header-image">

		<img src="<?php header_image() ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>">

	</div><!-- .header-image -->

<?php endif; ?>
