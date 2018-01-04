<?php
/**
 * @package Minnow
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'link' == get_post_format() ) : ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( minnow_get_link_url() ) ), '</a></h1>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php minnow_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		$content = get_the_content(); 
		// [TO] strips the html and trucs
		echo wp_trim_words( $content , 100, '...' );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'minnow' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-format">
		<?php minnow_entry_format(); ?>
	</div>
</article><!-- #post-## -->
