<?php
/**
 * inspirar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package inspirar
 */

if ( ! function_exists( 'inspirar_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function inspirar_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on inspirar, use a find and replace
		 * to change 'inspirar' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'inspirar', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );


		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-default' => esc_html__( 'Primary', 'inspirar' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'inspirar_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'inspirar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function inspirar_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'inspirar_content_width', 640 );
}
add_action( 'after_setup_theme', 'inspirar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function inspirar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'inspirar' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'inspirar' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	// Footer widget
 	$inspirar_footer_widgets_section_columns = get_theme_mod('inspirar_footer_widgets_section_columns', 4);
    for( $i = 1; $i <= $inspirar_footer_widgets_section_columns; $i++ ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets', 'inspirar' ) .$i,
			'id'            => 'inspirar' . '-footer-' . $i,
			'description'   => esc_html__( 'Add footer widgets here.', 'inspirar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
    }
}
add_action( 'widgets_init', 'inspirar_widgets_init' );


/**
 * Register custom fonts.
 */
function inspirar_fonts_url(){
	$fonts_url = '';
	 
	/* Translators: If there are characters in your language that are not
	* supported by Libre Poppins, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$poppins = _x( 'on', 'Poppins font: on or off', 'inspirar' );
	 
	if ( 'off' !== $poppins ) {
	$font_families = array();
	 
	if ( 'off' !== $poppins ) {
	$font_families[] = 'Poppins:400,500,600,700';
	}
	 
	$query_args = array(
	'family' => urlencode( implode( '|', $font_families ) ),
	'subset' => urlencode( 'latin,latin-ext' ),	
	);
	 
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles.
 */
function inspirar_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'inspirar-fonts', inspirar_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.0');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'inspirar-default', get_template_directory_uri() . '/assets/css/default.css', array(), '1.0.0' );
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.min.css', array(), '2.0.7');
	wp_enqueue_style( 'inspirar-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );
	wp_enqueue_style( 'inspirar-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'inspirar-navigation-jquery', get_template_directory_uri() . '/assets/js/inspirar-navigation-jquery.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'inspirar-skip-link-focus-fix-jquery', get_template_directory_uri() . '/assets/js/inspirar-skip-link-focus-fix-jquery.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'inspirar-main-jquery', get_template_directory_uri() . '/assets/js/inspirar-main-jquery.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'inspirar_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load Breadcrumbs function
 */
require_once get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Load theme custom functions
 */
require get_template_directory() . '/inc/global-functions.php';

/**
 * Load theme custom widgets
 */
require get_template_directory() . '/inc/widgets/inspirar-contact-widget.php';

/**
 * Modify excerpt length
 */
function inspirar_excerpt_length( $length ) {
	return get_theme_mod('inspirar_blog_excerpt_length', 30);
}
add_filter( 'excerpt_length', 'inspirar_excerpt_length', 999 );

/**
 * Modify search widget
 */
function inspirar_blog_search_widget(){
	$form = '
	    <div class="search-form">
			<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
				
			    <input type="search" value="' . get_search_query() . '" name="s" class="search-field form-control"  placeholder="' . esc_attr__('Search' , 'inspirar') .'">
			    <label class="d-none">'.esc_html('Search for', 'inspirar').':</label>

			    <button type="submit" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
		</div>';
	return $form;
}
add_filter( 'get_search_form', 'inspirar_blog_search_widget' );


/**
 * Modify archive widget
 */
function inspirar_archive_count_span( $links ) {
	$links = str_replace('</a>&nbsp;(', ' <span>(', $links);
	$links = str_replace(')', ')</span></a>', $links);
	return $links;
}
add_filter('get_archives_link', 'inspirar_archive_count_span');

/**
 * Modify category widget
 */
function inspirar_category_count_span( $links ) {
	$links = str_replace('</a> (', ' <span>(', $links);
	$links = str_replace(')', ')</span></a>', $links);
	return $links;
}
add_filter('wp_list_categories', 'inspirar_category_count_span');

// Comment list modify
function inspirar_comments( $comment, $args, $depth ){
    ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<article class="media single-comment">
			<div class="align-self-top"> 
			     <a href="<?php comment_author_url(); ?>">
				<?php echo get_avatar( $comment, 50 ); ?>
				</a>
			</div>
			
			<div class="media-body">
				<h4 class="author"><?php comment_author(); ?></h4>
                <small><?php echo esc_html(get_comment_date()); ?></small>
                <?php if ($comment->comment_approved == '0') { ?>
						<em><?php esc_html_e('Your comment is awaiting moderation.','inspirar'); ?></em>
				<?php } ?>	
				<div class="comment-text">
	                <?php comment_text() ?>
	            </div>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>	
			</div>
		</article>	
<?php 
}

// Comment form modify
function inspirar_comment_reform ($arg) {
	$col_class = ( is_user_logged_in() ) ? 'col-sm-12' : 'col-sm-6';
	$row_end = ( is_user_logged_in() ) ? '</div>' : '';

	$arg['comment_field'] = '<div class="row"><div class="'.esc_attr($col_class).'"><div class="form-group"><label for="author">'. esc_html__("Comment", "inspirar").' <span class="required">*</span></label><textarea id="comment" class="form-control" name="comment" rows="6" placeholder="'. esc_html__("Type your comment...", "inspirar").'" aria-required="true"></textarea></div></div>'.$row_end.'';
	return $arg;
}
add_filter('comment_form_defaults','inspirar_comment_reform');


// Comment form modify
function inspirar_modify_comment_form_fields($fields){
	$commenter = wp_get_current_commenter();
	$req	   = get_option( 'require_name_email' );
	$row_end = ( !is_user_logged_in() ) ? '</div>' : '';

	$fields['author'] = '<div class="col-sm-6"><div class="form-group"><label for="author">'. esc_html__("Name", "inspirar").' <span class="required">*</span></label><input type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" placeholder="'. esc_attr__("Your Name", "inspirar").'" size="22" tabindex="1" '. ( $req ? 'aria-required="true"' : '' ).' class="form-control" /></div>';

	$fields['email'] = '<div class="form-group"><label for="email">'. esc_html__("Email", "inspirar").' <span class="required">*</span></label><input type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'.esc_attr__("Your Email", "inspirar").'" size="22" tabindex="2" '. ( $req ? 'aria-required="true"' : '' ).' class="form-control"  /></div></div>'.$row_end.'';
	
	$fields['url'] = '';

	return $fields;
}
add_filter('comment_form_default_fields','inspirar_modify_comment_form_fields'); 
