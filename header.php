<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package inspirar
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<?php 
		$inspirar_main_menu_sticky = get_theme_mod( 'inspirar_main_menu_sticky' );
		$inspirar_main_menu_fullwidth = get_theme_mod( 'inspirar_main_menu_fullwidth' );
		$inspirar_main_menu_sticky = ( $inspirar_main_menu_sticky ) ? 'fixed-top' : 'position-absolute';
		$inspirar_main_menu_fullwidth = ( $inspirar_main_menu_fullwidth ) ? 'container-fluid' : 'container';
	?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'inspirar' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="heading_nav_default agency-menu hide-on-tab <?php echo esc_attr($inspirar_main_menu_sticky); ?>">
			<div class="align-middle d-table-cell">
	        	<div class="<?php echo esc_attr($inspirar_main_menu_fullwidth); ?>">
	            	<div class="row">
	                	<div class="col-md-12 d-flex align-items-center justify-content-between">
							<div class="site-logo">
								<?php if( function_exists('inspirar_logo') ){ inspirar_logo(); } ?>
							</div><!-- .site-branding -->

							<nav class="float-right main-navigation" id="site-navigation">
	                        	<?php if( function_exists('inspirar_main_menu')){ inspirar_main_menu(); } ?>
							</nav><!-- #site-navigation -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="mobile-menu-area">
		    <div class="mobile-menu d-md-none d-xl-none" id="mob-menu">
		       <div class="mobile-menu-logo">
		            <?php if( function_exists('inspirar_logo') ){ inspirar_logo(); } ?>
		        </div> 
		        <?php if( function_exists('inspirar_mobile_menu')){ inspirar_mobile_menu(); } ?>
		    </div>
	    </div>

	</header><!-- #masthead -->
