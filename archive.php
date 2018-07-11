<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inspirar
 */

get_header();
inspirar_blog_banner();

$el_data = get_post_meta( get_the_ID() , '_elementor_edit_mode', true );
$inspirar_site_padding = ( $el_data ) ? '' : 'inspirar-site-padding';

$inspirar_blog_layout = get_theme_mod('inspirar_blog_layout', '2');
$col_class = ( $inspirar_blog_layout === '3' ) ? ' offset-md-2' : '';
?>
	<div id="primary" class="blog inspirar-content-area <?php echo esc_attr($inspirar_site_padding); ?>">
		<div class="container">
			<div class="row">
		       <?php if( $inspirar_blog_layout === '1' ) { get_sidebar(); } ?>
				<div class="col-md-8 <?php echo esc_attr($col_class); ?>">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content' );

						endwhile;

						inspirar_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>	
		       </div>
		       <?php if( $inspirar_blog_layout === '2' ) { get_sidebar(); } ?>
			</div>
		</div>
	</div><!-- #primary -->

<?php
get_footer();