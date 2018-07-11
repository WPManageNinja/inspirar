<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package inspirar
 */

if ( ! function_exists( 'inspirar_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function inspirar_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'inspirar' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'inspirar_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function inspirar_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%1$sWritten by %2$s', 'post author', 'inspirar' ),
			'<i class="fa fa-user" aria-hidden="true"></i>',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'inspirar_post_category_list' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function inspirar_post_category_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'inspirar' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<i class="fa fa-calendar" aria-hidden="true"></i><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'inspirar' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;



if ( ! function_exists( 'inspirar_post_tags_list' ) ) :
	/**
	 * Prints HTML with meta information for the tags.
	 */
	function inspirar_post_tags_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'inspirar' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<i class="fa fa-tags" aria-hidden="true"></i><span class="tags-links">' . esc_html__( 'Tags: %1$s', 'inspirar' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'inspirar_post_comments_count' ) ) :

	function inspirar_post_comments_count(){
		echo '<i class="fa fa-comments" aria-hidden="true"></i>';
		 comments_popup_link( 
		 	esc_html__('No Comment','inspirar'), 
		 	esc_html__('1 Comment','inspirar'), 
		 	esc_html__('% Comments','inspirar'), 
		 	' ', 
		 	esc_html__('Comments off','inspirar')
		 );
	}

endif;

if ( ! function_exists( 'inspirar_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function inspirar_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;
