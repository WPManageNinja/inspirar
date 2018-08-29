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
 $inspirar_copyright_section_text_alignment = get_theme_mod('inspirar_copyright_section_text_alignment');
 $inspirar_copyright_section_columns = get_theme_mod('inspirar_copyright_section_columns', 12);
 $inspirar_copyright_section_content_c_one = get_theme_mod('inspirar_copyright_section_content_c_one', 'text');
 $inspirar_copyright_section_content_c_two = get_theme_mod('inspirar_copyright_section_content_c_two', 'widget');
 $inspirar_copyright_section_content_c_three = get_theme_mod('inspirar_copyright_section_content_c_three', 'menu');

 $inspirar_cloumn_one_custom_text = get_theme_mod('inspirar_cloumn_one_custom_text');
 $inspirar_cloumn_two_custom_text = get_theme_mod('inspirar_cloumn_two_custom_text');
 $inspirar_cloumn_three_custom_text = get_theme_mod('inspirar_cloumn_three_custom_text');

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
		<div class="site-copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-<?php echo esc_attr($inspirar_copyright_section_columns); ?> <?php echo esc_attr($inspirar_copyright_section_text_alignment); ?>">

							<?php 
								if( $inspirar_copyright_section_content_c_one === 'widget' ) { 
									inspirar_footer_copyright_widget();
								}

								if( $inspirar_copyright_section_content_c_one === 'text' ) { 
									inspirar_footer_copyright_custom_text($inspirar_cloumn_one_custom_text);
								}

								if( $inspirar_copyright_section_content_c_one === 'menu' ) { 
									footer_copyright_menu();
								}
							?>

					</div>

					<?php if($inspirar_copyright_section_columns !== '12' ) { ?>
					<div class="col-md-<?php echo esc_attr($inspirar_copyright_section_columns); ?>">
						<?php 
							if( $inspirar_copyright_section_content_c_two === 'widget' ) { 
								inspirar_footer_copyright_widget();
							}

							if( $inspirar_copyright_section_content_c_two === 'text' ) { 
								inspirar_footer_copyright_custom_text($inspirar_cloumn_two_custom_text);
							}

							if( $inspirar_copyright_section_content_c_two === 'menu' ) { 
								footer_copyright_menu();
							}
						?>

					</div>
					<?php } ?>

					<?php if($inspirar_copyright_section_columns == '4' ) { ?>
					<div class="col-md-<?php echo esc_attr($inspirar_copyright_section_columns); ?> text-right">
						<?php 
							if( $inspirar_copyright_section_content_c_three === 'widget' ) { 
								inspirar_footer_copyright_widget();
							}

							if( $inspirar_copyright_section_content_c_three === 'text' ) { 
								inspirar_footer_copyright_custom_text($inspirar_cloumn_three_custom_text);
							}

							if( $inspirar_copyright_section_content_c_three === 'menu' ) { 
								footer_copyright_menu();
							}
						?>
					</div>
					<?php } ?>
		
				</div>
			</div>
		</div><!-- .site-copyright -->
		<?php } ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
