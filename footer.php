<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package inspirar
 */
 $inspirar_widgets_section_visiblity = get_theme_mod('inspirar_widgets_section_visiblity', true);
 $inspirar_footer_widgets_columns = get_theme_mod('inspirar_footer_widgets_section_columns', 4);
 $inspirar_copyright_section_visiblity = get_theme_mod('inspirar_copyright_section_visiblity', true);
 $inspirar_copyright_section_text_alignment = get_theme_mod('inspirar_copyright_section_text_alignment', 'text-center');
 $copyright_text = get_theme_mod('inspirar_copyright_text');

 switch ($inspirar_footer_widgets_columns) {
 	case '1':
 		$col_length = '12';
 		break;
	case '2':
		$col_length = '6';
		break;
	case '3':
		$col_length = '4';
		break;
	case '4':
		$col_length = '3';
		break;
 	default:
 		$col_length = '3';
 		break;
 }
?>
	
	<footer id="colophon" class="site-footer">
		<?php if($inspirar_widgets_section_visiblity) { ?>
		<div class="footer-widgets">
			<div class="container">
				<div class="row">
					<?php for( $col_class = 1; $col_class <= $inspirar_footer_widgets_columns ; $col_class++ ) { ?>
	                <div class="col-sm-<?php echo esc_attr($col_length); ?>">
	                    <div class="footer-widget">
	                        <?php dynamic_sidebar( 'inspirar-footer-' . esc_html($col_class) ); ?>
	                    </div>
	                </div>
	                <?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if($inspirar_copyright_section_visiblity) { ?>
		<div class="site-copyright <?php echo esc_attr($inspirar_copyright_section_text_alignment); ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				   <p>
				   	<?php 
				   	if( $copyright_text ) { 
						$allowed_tags = array(
					        'a' => array(
					          'href' => array(),
					          'title' => array()
					        ),
					        'br' => array(),
					        'span' => array(),
					        'em' => array(),
					        'strong' => array()
					    );
						echo wp_kses( $copyright_text, $allowed_tags);
				   	 } else { ?>
					<?php
						/* translators: 1: Theme year, 2: Theme name. */
						printf( esc_html__( 'Copyright &copy; %1$s by %2$s.', 'inspirar' ), get_bloginfo('sitename'), date('Y') );
					?>
                       Inspirar Theme By <a href="https://wpmanageninja.com">WPManageNinja.com</a>
					</p>

					<a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>">
						<?php
						printf( esc_html__( 'Proudly powered by %s', 'inspirar' ), '<span>WordPress</span>' );
						?>
					</a>
					<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- .site-copyright -->
		<?php } ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
