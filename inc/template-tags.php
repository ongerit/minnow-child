<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Minnow
 */

if ( ! function_exists( 'minnow_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function minnow_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'minnow' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'minnow' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'minnow' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'minnow_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function minnow_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'minnow' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'minnow' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'minnow' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'minnow_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function minnow_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$author_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$byline = '<span class="author vcard"><a class="url fn n" href="' . $author_url . '">' . esc_html( get_the_author() ) . '</a></span>';
	$avatar_photo = '<img class="avatar-photo" src="'.esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ).'"/>';
	echo '<a href="'. $author_url .'">'.$avatar_photo.'</a><span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';

	if ( 'post' == get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'minnow' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links">' . $tags_list . '</span>';
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'minnow' ), __( '1 Comment', 'minnow' ), __( '% Comments', 'minnow' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'minnow' ), '<span class="edit-link">', '</span>' );

}
endif;

if ( ! function_exists( 'minnow_entry_format' ) ) :
/**
 * Prints HTML with meta information for the post format, if it exists.
 */
function minnow_entry_format() {

	$format = get_post_format();
	$formats = get_theme_support( 'post-formats' );

	//If the post has no format, or if it's not a format supported by the theme, return
	if ( ! $format || ! has_post_format( $formats[0] ) ) :
		printf( '<a href="%1$s"><span class="screen-reader-text">%2$s</span></a>',
					esc_url( get_permalink() ),
					get_the_title()
				);
	else :
		printf( '<a href="%1$s" title="%2$s"><span class="screen-reader-text">%3$s</span></a>',
					esc_url( get_post_format_link( $format ) ),
					esc_attr( sprintf( __( 'All %s posts', 'minnow' ), get_post_format_string( $format ) ) ),
					get_post_format_string( $format )
				);
	endif;

}
endif;
