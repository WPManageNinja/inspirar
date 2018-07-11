<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package inspirar
 */

get_header();
inspirar_blog_banner();

$el_data = get_post_meta( get_the_ID() , '_elementor_edit_mode', true );
$inspirar_site_padding = ( $el_data ) ? '' : 'inspirar-site-padding';

$inspirar_blog_related_posts_visibility = get_theme_mod( 'inspirar_blog_related_posts_visibility', true );
?>
	<div id="primary" class="blog inspirar-content-area <?php echo esc_attr($inspirar_site_padding); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content' );

						the_post_navigation(
							array(
								'next_text' => esc_html__( 'Next post', 'inspirar' ),
								'prev_text' => esc_html__( 'Previous post', 'inspirar' ),
							)
						);

						if( function_exists( 'inspirar_related_posts' ) && $inspirar_blog_related_posts_visibility ){
					    	inspirar_related_posts();
					    }

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
 				</div>
		       <?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- #primary -->
<?php
get_footer();