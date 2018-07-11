<?php
/*
 *  Breadcrumbs Function
 *  Source: http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */

function inspirar_breadcrumbs($align = 'right') {
    $inspirar_blog_title = get_theme_mod( 'inspirar_blog_title' );
    $showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = '/'; // delimiter between crumbs
    $home        = esc_html__('Home', 'inspirar'); // text for the 'Home' link
    $blog        = ( $inspirar_blog_title ) ? $inspirar_blog_title : esc_html__('Blog', 'inspirar'); 
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before      = '<li><span href="#">'; // tag before the current crumb
    $after       = '</span></li>'; // tag after the current crumb
    $output      = array();
    $class       = array();
    $class[]     = 'inspirar-breadcrumbs';
    $class[]     = ($align == 'right') ? 'text-right' : null;
    $class       = implode(' ', $class);
 
    global $post;
    $homeLink = home_url('/');

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
            $output[] = $before . esc_html__('Category', 'inspirar') . ': ' . esc_html(single_cat_title('', false)) . '' . $after;

        } elseif ( is_search() ) {
            $output[] = $before . esc_html__('Search', 'inspirar') . $after;
        } elseif ( is_day() ) {
            $output[] = '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
            $output[] = '<li><a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
            $output[] = $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            $output[] = '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a><span class="separator">' . esc_html($delimiter) . '</span></li>';
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
                $page = get_page($parent_id);
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
            $output[] = $before . esc_html__('Tag', 'inspirar') . ': ' . esc_html(single_tag_title('', false)) . $after;
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

?>