<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inspirar
 */

get_header();
inspirar_page_banner();
$el_data = get_post_meta( get_the_ID() , '_elementor_edit_mode', true );
$inspirar_site_padding = ( $el_data ) ? '' : 'inspirar-site-padding';
?>

	<div id="primary" class="inspirar-content-area <?php echo esc_attr($inspirar_site_padding); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
		       </div>
			</div>
		</div>
	</div><!-- #primary -->
<?php
get_footer();
