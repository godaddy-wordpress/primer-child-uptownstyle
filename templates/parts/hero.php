<div class="hero" <?php if ( ! empty( uptown_get_header_image() ) && is_front_page() ) : ?> style="background:url('<?php echo uptown_get_header_image( ); ?>') no-repeat top center; background-size: cover;"<?php endif; ?>>

	<div class="hero-wrapper row">

		<?php if ( is_front_page() ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php elseif ( is_singular() ) : ?>

			<div class="widget single-widget">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/lady.png" alt="<?php bloginfo( 'name' ) ?>" />
				<h1 class="site-title"><?php bloginfo( 'name' ) ?></h1>
			</div>

		<?php endif; ?>

	</div>

</div>
