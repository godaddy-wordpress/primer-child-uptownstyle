<div class="hero" <?php if ( ! empty( uptown_get_header_image() ) && is_front_page() ) : ?> style="background:url('<?php echo uptown_get_header_image( ); ?>') no-repeat top center; background-size: cover;"<?php endif; ?>>

	<div class="hero-wrapper row">

		<?php if ( is_front_page() ) : ?>

			<?php dynamic_sidebar( 'hero' ); ?>

		<?php elseif ( is_single() ) : ?>

			<div class="widget single-widget">
				<h1 class="site-title"><?php esc_html_e( 'Blog', 'uptown' ); ?></h1>
			</div>

		<?php elseif ( is_page() ) : ?>

			<div class="widget single-widget">
				<h1 class="site-title"><?php the_title(); ?></h1>
			</div>

		<?php elseif ( is_archive() ) : ?>

			<div class="widget single-widget">
				<h1 class="site-title"><?php post_type_archive_title(); ?></h1>
			</div>

		<?php elseif ( is_home() ) : ?>

			<div class="widget single-widget">
				<h1 class="site-title"><?php esc_html_e( 'Blog', 'uptown' ); ?></h1>
			</div>

		<?php endif; ?>

	</div>

</div>
