<?php
/**
 * Template part for displaying the post meta inside The Loop.
 *
 * @package Primer
 */
?>

<div class="entry-meta">

	<span class="posted-meta">

		<?php printf( esc_html_x( '%1$s &mdash; %2$s', '1. post date, 2. author name', 'activation' ), get_the_author_link(), get_the_date() ); ?>

	</span>

</div><!-- .entry-meta -->
