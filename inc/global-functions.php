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
		if( has_post_thumbnail() ) {
			$inspirar_page_banner_bg_image = get_the_post_thumbnail_url(null, 'full');
		} 
		$inspirar_page_banner_bg_image = ( !empty($inspirar_page_banner_bg_image) ) ? 'style="background-image: url('.esc_url($inspirar_page_banner_bg_image).')"' : '';
		if( !is_front_page() ){
		?>	
		<div class="inspirar-page-banner d-table overlay" <?php echo wp_kses_post($inspirar_page_banner_bg_image); ?>>
			<div class="inspirar-page-banner-content d-table-cell align-bottom">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="inspirar-header-title">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<?php if( $inspirar_page_breadcrumbs_section_visiblity ) { echo inspirar_breadcrumbs(); } ?>
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
		?>	
		<div class="inspirar-page-banner d-table overlay" <?php if( get_header_image() !== '') { ?> style="background-image: url('<?php esc_attr( header_image() ); ?>');" <?php } ?>>
			<?php if( !is_singular('post') ) { ?>
			<div class="inspirar-page-banner-content d-table-cell align-bottom">
				<div class="container">
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

// Pagination
function inspirar_pagination( $numpages = ''){
    if ($numpages == '') {
	    global $wp_query;
	    $numpages = $wp_query->max_num_pages;
	    if(!$numpages) {
	        $numpages = 1;
	    }
	}
        
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'       => '',
      'add_args'     => '',
      'current'      => max( 1, get_query_var( 'paged' ) ),
      'total'        => $numpages,
      'prev_text'    => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      'next_text'    => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
      'type'         => 'list',
      'end_size'     => 2,
      'mid_size'     => 2
    ) );
}
