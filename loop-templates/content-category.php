<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php
		the_title(
			sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
			'</a></h2>'
		);
		?>

		<?php if ('post' == get_post_type()) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(false); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->


	<div class="entry-content category-entry-content">
		<div class="category-entry-content__excerpt">
			<?php the_excerpt();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
					'after'  => '</div>',
				)
			);
			?>
		</div>

		<?php
		$imageTag = get_the_post_thumbnail($post->ID, 'large');
		if (!empty($imageTag)) : ?>
			<div class="category-entry-content__image">
				<?php echo $imageTag; ?>
			</div>
		<?php endif; ?>



	</div><!-- .entry-content -->


	<hr>


	<footer class="entry-footer">

		<?php edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__('Edit %s', 'understrap'),
				the_title('<span class="sr-only">"', '"</span>', false)
			),
			'<span class="edit-link">',
			'</span>'
		); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->