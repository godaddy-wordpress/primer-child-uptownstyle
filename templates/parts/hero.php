<div class="hero" <?php if ( ! empty( uptown_get_header_image() ) && is_front_page() ) : ?> style="background:url('<?php echo uptown_get_header_image( ); ?>') no-repeat top center; background-size: cover;"<?php endif; ?>>

	<div class="hero-wrapper row">

		<?php dynamic_sidebar( 'hero' ); ?>

	</div>

</div>
