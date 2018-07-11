<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inspirar
 */
$inspirar_blog_post_thumbnail_visibility = get_theme_mod('inspirar_blog_post_thumbnail_visibility', true);
$inspirar_blog_post_meta_visibility = get_theme_mod('inspirar_blog_post_meta_visibility', true);
$inspirar_blog_footer_meta_visibility = get_theme_mod('inspirar_blog_footer_meta_visibility', true);
$inspirar_blog_read_more_btn_visibility = get_theme_mod('inspirar_blog_read_more_btn_visibility', true);
$inspirar_blog_full_content = get_theme_mod('inspirar_blog_full_content', false);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( $inspirar_blog_post_thumbnail_visibility ) { inspirar_post_thumbnail(); } ?>
	<div class="post-content">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;

			if ( 'post' === get_post_type() && $inspirar_blog_post_meta_visibility ) :
				?>
				<div class="entry-meta">
					<?php
					inspirar_post_category_list();
					inspirar_posted_by();
				    inspirar_post_comments_count();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			if( is_singular() || $inspirar_blog_full_content ) {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'inspirar' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
		   } else {
		   	 the_excerpt();
		   }

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'inspirar' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			<?php if($inspirar_blog_footer_meta_visibility) { inspirar_post_tags_list(); } ?>
			<?php if( !is_singular() && $inspirar_blog_read_more_btn_visibility ){ ?>
			<a href="<?php echo esc_url( get_permalink()); ?>" class="read-more"><?php esc_html_e('Read More', 'inspirar'); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			<?php } ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
