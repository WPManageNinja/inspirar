<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package inspirar
 */

get_header();
?>

<div id="primary" class="inspirar-content-area pt-200">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			    <div class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'inspirar' ); ?></h1>
					</header><!-- .page-header -->
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'inspirar' ); ?></p>

						<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'inspirar' ); ?></h2>
							<ul>
								<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
								?>
							</ul>
						</div><!-- .widget -->

						<?php
						/* translators: %1$s: smiley */
						the_widget( 'WP_Widget_Archives');
                        
						the_widget( 'WP_Widget_Tag_Cloud' );
						?>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
		</div>
	</div>
</div>
</div>
<?php
get_footer();
