<?php 
/**
* Template Name: Inspirar Full Width
*
**/
get_header();
inspirar_page_banner();
$el_data = get_post_meta( get_the_ID() , '_elementor_edit_mode', true );
$inspirar_site_padding = ( $el_data ) ? '' : 'inspirar-site-padding';
?>
	<div id="primary" class="inspirar-content-area <?php echo esc_attr($inspirar_site_padding); ?>">
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
	</div><!-- #primary -->
<?php
get_footer();
