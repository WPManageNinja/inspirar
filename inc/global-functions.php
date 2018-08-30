<?php 
// main menu
if( !function_exists( 'inspirar_main_menu' ) ){

	function inspirar_main_menu(){
		wp_nav_menu(array( 
			'theme_location' => 'menu-default', 
			'depth' => 5,
			'container' => false,
			'menu_class' => 'nav nav-menu',
			'fallback_cb' => 'inspirar_menu_setting',
	    )); 
	}
}

// mobile menu
if( !function_exists( 'inspirar_mobile_menu' ) ){
	function inspirar_mobile_menu(){
		wp_nav_menu(array( 
			'theme_location' => 'menu-default', 
			'depth' => 5,
			'container' => false,
			'menu_class' => 'm-menu',
			'fallback_cb' => 'inspirar_menu_setting',
	    )); 
	}
}

// menu setting
if ( !function_exists( 'inspirar_menu_setting' ) ){
	function inspirar_menu_setting(){
      ?>
      <div>
	      <ul class="nav pull-right">
	         <?php if( is_user_logged_in() ): ?>
		      <li>
		      		<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__('Create A Menu', 'inspirar'); ?></a>
		      </li>
		      <?php else: ?>
		      <li>
		      		<a href="<?php echo esc_url( home_url('/') ); ?>"><?php echo esc_html__('Home', 'inspirar'); ?></a>
		      </li>
		  	<?php endif; ?>
	      </ul>
      </div>
    <?php
	}
}

// inspirar logo
if( !function_exists('inspirar_logo') ){
	function inspirar_logo(){
		$inspirar_sub_page_logo = get_theme_mod( 'inspirar_sub_page_logo' );
		if( ( is_home() && is_front_page() ) && has_custom_logo() ){ 
		 	the_custom_logo(); 
		} 
		elseif( is_front_page() && has_custom_logo() ) {
			the_custom_logo(); 
		}
		elseif( has_custom_logo() && $inspirar_sub_page_logo ) {
			echo '<a href="'.esc_url( home_url( '/' ) ).'" rel="home"><img src="'.esc_url($inspirar_sub_page_logo).'"></a>';
		} else { 
			echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_html(get_bloginfo( 'name' )).'</a></h1>';
			$inspirar_description = get_bloginfo( 'description', 'display' ); 
			if ( $inspirar_description || is_customize_preview() ) {
           		echo '<p class="site-description">'.esc_html($inspirar_description).'</p>';
         	} 
     	} 
	}
}


// page banner
if( !function_exists('inspirar_page_banner') ){
	function inspirar_page_banner(){
		$inspirar_page_breadcrumbs_section_visiblity = get_theme_mod('inspirar_page_breadcrumbs_section_visiblity', true);
		$inspirar_page_breadcrumbs_section_style = get_theme_mod('inspirar_page_breadcrumbs_section_style', 'style_1');
		$inspirar_page_banner_section_text_align = get_theme_mod('inspirar_page_banner_section_text_align', 'text-left');

		if( $inspirar_page_breadcrumbs_section_style == 'style_2' ){
		$inspirar_page_banner_section_text_align = get_theme_mod('inspirar_page_banner_section_text_align', 'text-center');

		} else{
		    $inspirar_page_banner_section_text_align = get_theme_mod('inspirar_page_banner_section_text_align', 'text-right');
		}
		// $inspirar_page_banner_section_text_align = ( $inspirar_page_breadcrumbs_section_style == 'style_2' ) ? 'text-center' : $inspirar_page_banner_section_text_align;

		$inspirar_page_banner_bg_blend_mode = get_theme_mod('inspirar_page_banner_bg_blend_mode', false);
		$blande_mode = ( $inspirar_page_banner_bg_blend_mode ) ? 'background-blend-mode-overlay' : '';
		$col_class = ( $inspirar_page_breadcrumbs_section_style !== 'style_2' ) ? 'col-sm-6 col-xs-12' : 'col-sm-12';
		$extra_class = ( $inspirar_page_breadcrumbs_section_style !== 'style_2' ) ? '' : 'inspirar-page-banner-two';
		$vertical_align = ( $inspirar_page_breadcrumbs_section_style !== 'style_2' ) ? 'align-bottom' : 'align-middle';

		if( has_post_thumbnail() ) {
			$inspirar_page_banner_bg_image = get_the_post_thumbnail_url(null, 'full');
		} 
		$inspirar_page_banner_bg_image = ( !empty($inspirar_page_banner_bg_image) ) ? 'style="background-image: url('.esc_url($inspirar_page_banner_bg_image).')"' : '';
		if( !is_front_page() ){
		?>	
		<div class="inspirar-page-banner d-table overlay <?php echo esc_attr($extra_class); ?> <?php echo esc_attr($blande_mode); ?>" <?php echo wp_kses_post($inspirar_page_banner_bg_image); ?>>
			<div class="inspirar-page-banner-content d-table-cell <?php echo esc_attr($vertical_align); ?>">
				<div class="container">
					<div class="breadcrumbs-bg">
					<div class="row">
						<div class="<?php echo esc_attr($col_class); ?>">
							<div class="inspirar-header-title <?php echo esc_attr($inspirar_page_banner_section_text_align); ?>">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
						<div class="<?php echo esc_attr($col_class); ?>">
							<?php if( $inspirar_page_breadcrumbs_section_visiblity ) { echo inspirar_breadcrumbs(); } ?>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
	    }
	}
}

// Blog header title
if ( !function_exists( 'inspirar_blog_header_title' ) ) {
	function inspirar_blog_header_title(){
	    if ( is_home() && !is_front_page() ) {
	      $inspirar_blog_title = get_theme_mod( 'inspirar_blog_title' );
	      if( $inspirar_blog_title ){ 
	        echo esc_html( $inspirar_blog_title );
	      } else{
	      	 echo esc_html__( 'Blog', 'inspirar' );
	      }
	    } 
	    elseif( is_single()) {
	      echo get_the_title();
	    }
	    elseif( is_archive()) {
	        if ( is_day() ) :
			  /* translators: %s get theme date. */
	          printf( esc_html__( 'Daily Archives: %s', 'inspirar' ), '<span>' . esc_html(get_the_date()) . '</span>' );
	        elseif ( is_month() ) :
			  /* translators: %s get theme monthly arcives date. */
	          printf( esc_html__( 'Monthly Archives: %s', 'inspirar' ), '<span>' . esc_html(get_the_date( _x( 'F Y', 'monthly archives date format', 'inspirar' ) )) . '</span>' );
	        elseif ( is_year() ) :
			  /* translators: %s get theme yearly arcives date. */
	          printf( esc_html__( 'Yearly Archives: %s', 'inspirar' ), '<span>' . esc_html(get_the_date( _x( 'Y', 'yearly archives date format', 'inspirar' ) )) . '</span>' );
	        else :
	          esc_html_e( 'Archives', 'inspirar' );
	        endif;
	    } elseif( is_search() ){
			/* translators: %s get theme search result title. */
	       printf( esc_html__( 'Search Results for: &ldquo;%s&rdquo;', 'inspirar' ), '<span>' . esc_html(get_search_query()) . '</span>' );
	    } else {
	      echo esc_html_e( 'Blog', 'inspirar' );
	    }
	}
}

// blog banner
if( !function_exists('inspirar_blog_banner') ){
	function inspirar_blog_banner(){
		$inspirar_page_breadcrumbs_section_visiblity = get_theme_mod('inspirar_page_breadcrumbs_section_visiblity', true);
		$inspirar_page_banner_bg_blend_mode = get_theme_mod('inspirar_page_banner_bg_blend_mode', false);
		$blande_mode = ( $inspirar_page_banner_bg_blend_mode ) ? 'background-blend-mode-overlay' : '';
		?>	
		<div class="inspirar-page-banner d-table overlay <?php echo esc_attr($blande_mode); ?>" <?php if( get_header_image() !== '') { ?> style="background-image: url('<?php esc_attr( header_image() ); ?>');" <?php } ?>>
			<?php if( !is_singular('post') ) { ?>
			<div class="inspirar-page-banner-content d-table-cell align-bottom">
				<div class="container">
					<div class="breadcrumbs-bg">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="inspirar-header-title">
							     <h1><?php if( function_exists('inspirar_blog_header_title') ){ inspirar_blog_header_title(); } ?></h1>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<?php if( $inspirar_page_breadcrumbs_section_visiblity ) { echo inspirar_breadcrumbs(); } ?>
						</div>
					</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php 
	}
}

// inspirar related posts
if( !function_exists('inspirar_related_posts') ){
	function inspirar_related_posts(){

		global $post;

	    $tags = wp_get_post_tags( $post->ID );

	    if( $tags ){

	        $tag_ids = array();

	        foreach ($tags as $single_tag ) {
	          $tag_ids[] = $single_tag->term_id;
	        }

	        $args = array(
	            'tag__in' => $tag_ids,
	            'post__not_in' => array($post->ID),
	            'posts_per_page' => 4,
	            'ignore_sticky_posts' => 1,
	            'orderby' => 'rand',
	        );
	        $q = new WP_Query($args);

	        if( $q->have_posts() ){

	    ?>
	    <!--related post section start here-->
	    <div class="single-blog-related-post">
	        <h3><?php esc_html_e('Related Posts', 'inspirar' ); ?></h3>
	        <div class="row">
	            <?php 
	            $i = 0;
	            while( $q->have_posts()){ $q->the_post(); 
	            $i++;
	            ?>
	            <div class="col-sm-6">
	                <div class="single-related-post">
	                	<a href="<?php esc_url( the_permalink() );?>">
                            <?php 
                            if( has_post_thumbnail() ){ 
                             the_post_thumbnail( 'full' , array( 'class' => 'img-fluid') );
                            } 
                            ?>
                        </a>
	                    <div class="single-related-post-content">
	                    	<h4>
                                <a href="<?php esc_url( the_permalink() );?>"><?php the_title(); ?></a>
                            </h4>
                            <p><?php echo get_the_date(); ?></p>
	                    </div>
	                </div> <!--/.related-post-->
	            </div>
	           <?php if( $i%2 === 0 ) { echo '<div class="clearfix"></div>'; } ?>
	           <?php } ?>
	        </div>
	    </div>
	    <?php } } 
	    wp_reset_postdata(); 
	}
}



if( !function_exists( 'inspirar_footer_copyright_widget' ) ){
	function inspirar_footer_copyright_widget(){
		dynamic_sidebar( 'inspirar-copyright-widgets');
	}
}

if( !function_exists( 'inspirar_footer_copyright_custom_text' ) ){
	function inspirar_footer_copyright_custom_text( $custom_text ){
	?>
	   	<?php 
	   	if( $custom_text ) { 
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
			echo wp_kses( $custom_text, $allowed_tags);
	   	 } else { ?>
            <div class="copyright-default text-center">
            <p>
                <?php
                /* translators: 1: Theme year, 2: Theme name. */
                printf( esc_html__( 'Copyright &copy; %1$s.', 'inspirar' ), '<span>'.get_bloginfo('site_title').'</span>' );
                ?>

                <?php
                /* translators: 1: Theme year, 2: Theme name. */
                printf( esc_html__( 'Inspirar Theme By %1$s.', 'inspirar' ), '<a href="https://wpmanageninja.com">WPManageNinja.com</a>' );
                ?>
            </p>
            <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>">
		            <?php
		            /* translators: %s: CMS name, i.e. WordPress. */
		            printf( esc_html__( 'Proudly powered by %s', 'inspirar' ), '<span>WordPress</span>' );
		            ?>
            </a>
            </div>
		<?php } 
	}
}

if( !function_exists('footer_copyright_menu') ){
	function footer_copyright_menu(){
		wp_nav_menu(array( 
			'theme_location' => 'menu-footer', 
			'depth' => 5,
			'container' => false,
			'menu_class' => 'inspirar-footer-menu',
	    )); 
	}
}
// Pagination
if( !function_exists('inspirar_pagination') ) {
	function inspirar_pagination( $numpages = '' ) {
		if ( $numpages == '' ) {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if ( ! $numpages ) {
				$numpages = 1;
			}
		}

		$big = 999999999; // need an unlikely integer
		echo get_the_posts_pagination( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '',
			'add_args'  => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $numpages,
			'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
			'type'      => 'list',
			'end_size'  => 2,
			'mid_size'  => 2
		) );
	}
}


if( !function_exists('inspirar_breadcrumbs') ){
	function inspirar_breadcrumbs() {
		$inspirar_blog_title = get_theme_mod( 'inspirar_blog_title' );

		$inspirar_page_breadcrumbs_section_style = get_theme_mod('inspirar_page_breadcrumbs_section_style', 'style_1');
		$inspirar_page_breadcrumbs_text_align = get_theme_mod('inspirar_page_breadcrumbs_text_align', 'text-right');
		$inspirar_page_breadcrumbs_text_align = ( $inspirar_page_breadcrumbs_section_style == 'style_2' ) ? 'text-center' : $inspirar_page_breadcrumbs_text_align;

		$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter   = '/'; // delimiter between crumbs
		$home        = esc_html__('Home', 'inspirar'); // text for the 'Home' link
		//$blog        = get_theme_mod('inspirar_blog_title', 'Blog');
		$blog        = ( $inspirar_blog_title ) ? $inspirar_blog_title : esc_html__('Blog', 'inspirar');
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before      = '<li><span href="#">'; // tag before the current crumb
		$after       = '</span></li>'; // tag after the current crumb
		$output      = array();
		$class       = array();
		$class[]     = 'inspirar-breadcrumbs';
		$class[]     = $inspirar_page_breadcrumbs_text_align;
		$class       = implode(' ', $class);

		global $post;
		$homeLink = esc_url(home_url('/'));

		if (is_home() || is_front_page()) {
			if ($showOnHome == 1) {
				$output[] = '<ul class="'. $class .'">
            <li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li><li><span> '. esc_html($blog) . '</span></li></ul>';
			}
		} else {
			$output[] = '<ul class="'. $class .'"><li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';

			if (is_category()) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$output[] = get_category_parents($thisCat->parent, TRUE, ' ') . '';
				}
				$output[] = $before . esc_html__('Category', 'inspirar') . ': ' . esc_html(get_the_archive_title()) . '' . $after;

			} elseif ( is_search() ) {
				$output[] = $before . esc_html__('Search', 'inspirar') . $after;
			} elseif ( is_day() ) {
				$output[] = '<li><a href="' . esc_url(get_year_link(esc_html(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
				$output[] = '<li><a href="' . esc_url(get_month_link(esc_html(get_the_time('Y')),esc_html(get_the_time('m')))) . '">' . esc_html(get_the_time('F')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
				$output[] = $before . esc_html(get_the_time('d')) . $after;

			} elseif ( is_month() ) {
				$output[] = '<li><a href="' . esc_url(get_year_link(esc_html(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
				$output[] = $before . esc_html(get_the_time('F')) . $after;

			} elseif ( is_year() ) {
				$output[] = $before . esc_html(get_the_time('Y')) . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if ($showCurrent == 1) {
						$output[] = ' ' . $before . esc_html(get_the_title()) . $after;
					}
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, '<span class="separator">' . esc_html($delimiter) . '</span> ');
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					$output[] = '<li>'.$cats.'</li>'; // No need to escape here
					if ($showCurrent == 1) $output[] = $before . esc_html(get_the_title()) . $after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				$output[] = $before . esc_html($post_type->labels->singular_name) . $after;

			} elseif ( is_attachment() ) {
				if ($showCurrent == 1) $output[] = $before . esc_html(get_the_title()) . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) $output[] = $before . esc_html(get_the_title()) . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$output[] = $breadcrumbs[$i]; // No need to escape here
					if ($i != count($breadcrumbs)-1) $output[] = ' ' . '<span class="separator">' . esc_html($delimiter) . '</span> ' . ' ';
				}
				if ($showCurrent == 1) $output[] = '<span class="separator">' . esc_html($delimiter) . '</span> '.$before . esc_html(get_the_title()) . $after;

			} elseif ( is_tag() ) {
				$output[] = $before . esc_html__('Tag', 'inspirar') . ': ' . esc_html(get_the_archive_title()) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$output[] = $before . esc_html__('Articles by', 'inspirar') . ' ' . esc_html($userdata->display_name) . $after;
			} elseif ( is_404() ) {
				$output[] = $before . esc_html__('Error 404', 'inspirar') . $after;
			}
			if ( get_query_var('paged') ) {
				$output[] = '</li><li><span class="separator">' . esc_html($delimiter) . '</span><span> '. esc_html__('Page', 'inspirar') . ' ' . esc_html(get_query_var('paged'));
			}

			$output[] = '</ul>';
		}

		return implode("\n", $output);

	}
}