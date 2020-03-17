<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
		<meta name="google-site-verification" content="ldIxZKAK-lfczWEP2TYafpg0ZcebUj1bG41_lD5AZss" />
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <!-- Fixed navbar -->
        <section class="main-menu">
            <nav class="navbar navbar-fixed-top">
                <div id="header-container" class="container navbar-container">
                    <div class="navbar-header">
                        <a id="brand" class="navbar-brand" href=<?php echo site_url(); ?>><img class="logo" src="<?php echo get_theme_file_uri('/assets/images/Logo/Logo-white.png') ?>" /></a>

                    </div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'home-contact-us',
                        'menu_id' => 'top-cnt-menu',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'walker' => new Custom_Walker_Header_Nav_ContactUs_Menu,
                    ));
                    ?>
                </div><!-- /.container -->
            </nav>
            <div class="middle-content">
                <div class="table-cell">
                    <div class="left-section">
                        <h6>Sitemap</h6>
                        <?php if (has_nav_menu('top')) : ?>
                            <div class="navigation-top">
                                <div class="wrap">
                                    <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
                                </div><!-- .wrap -->
                            </div><!-- .navigation-top -->
                        <?php endif; ?>
                    </div>
                    <div class="right-section">
                        <h6>Recent Insights</h6>
                        <ul>
                            <?php
                            $recent_posts = wp_get_recent_posts(array('numberposts' => 3,));
                            //print_r($recent_posts);
                            foreach ($recent_posts as $recent) {
                                printf('<li><h2><a href="%1$s">%2$s</a></h2><p>%3$s...  </p></li>', esc_url(get_permalink($recent['ID'])), apply_filters('the_title', $recent['post_title'], $recent['ID']),
                                        //$recent['post_content']
                                        substr(str_replace('[/dropcap]', '', str_replace('[dropcap]', '', strip_tags(strip_shortcodes( $recent['post_content'])))), 0, 250)
                                );
                            }
                            wp_reset_query();
                            ?>
                        </ul>
                        <?php echo '<a href="' . get_permalink(get_option('page_for_posts')) . '" class="btn btn-primary btn-more">MORE ARTICLES</a>'; ?>
                    </div>
                </div>
            </div>
        </section>
        <nav id="header" class="navbar navbar-fixed-top">
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <div id="brand-new" class="navbar-brand" href="#">
                        <?php
                        if (is_front_page()) {
                            the_custom_logo();
                        } else {

                            echo '<a href="' . site_url() . '"><img class="logo" src="' . get_theme_file_uri('/assets/images/Logo/Logo-white.png') . '" /></a>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'home-contact-us',
                    'menu_id' => 'top-cnt-menu',
                    'menu_class' => 'nav navbar-nav navbar-right',
                    'walker' => new Custom_Walker_Header_Nav_ContactUs_Menu,
                ));
                ?>

            </div><!-- /.container -->
        </nav><!-- /.navbar -->

        <?php
        // If a regular post or page, and not the front page, show the featured image.
        // If a regular post or page, and not the front page, show the featured image.
        $front_page = false;
        $blog_page_found = (is_blog() && !is_home() && !is_archive()) ? true : false;
         // echo '<br>';
/*          var_dump(is_home());
          var_dump($blog_page_found);
          var_dump(is_blog());
*/        $profile_img_class = ($blog_page_found) ? 'profile-img-section' : '';

        if (has_post_thumbnail() && ( is_single() || ( is_page() && !cortac_is_frontpage() ) || is_blog() )) {
            $page_for_posts = get_option('page_for_posts');
            $metaId = (is_blog()) ? $page_for_posts : get_the_ID();
            $header_title = get_post_meta($metaId, 'header_title', true);
            $header_post_title = get_the_title();
            $header_desc = get_post_meta($metaId, 'header_desc', true);

            if ( is_blog() && !is_single()) {
                $large_image_url = get_the_post_thumbnail_url( $metaId, 'large');
                $top_section = '<section class="top-section top-section-about custom-header ' . $profile_img_class . '" style="background: url(' . $large_image_url . ') no-repeat;background-size:cover;background-position:center;">';
            } else {
                if ( is_singular('resources')) {
                    $large_image_url = get_the_post_thumbnail_url( $metaId, 'large');
                    $top_section = '<section class="top-section top-section-about custom-header ' . $profile_img_class . '" style="background: url(' . $large_image_url . ') no-repeat;background-size:cover;background-position:center;">';
                } else {
                    $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                    $top_section = '<section class="top-section top-section-about custom-header ' . $profile_img_class . '" style="background: url(' . $large_image_url[0] . ') no-repeat;background-size:cover;background-position:center;">';
                }
            }

            // Check if the custom field has a value.
            if (!empty($header_title)) {
                $header_name = $header_title;
            }
            if (!empty($header_post_title) && $blog_page_found && !is_category()) {
                $header_name = $header_post_title;
            }
            if (!empty($header_desc) && !$blog_page_found) {
                $header_description = $header_desc;
            }
            if (!empty($header_desc) && is_category()) {
                $header_description = $header_desc;
            }

            $header_button = '';
            $front_page = false;
            //echo $header_name;
        } else if (!is_blog() || is_404()) {
            $top_section = '<section class="top-section custom-header not-found ' . $profile_img_class . '">';
            $header_name = '404';
            $header_description = 'Page not found';
            $front_page = false;
        } else {

            $top_section = '<section class="top-section custom-header ' . $profile_img_class . '">';
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) {
                $header_description = $description;
            }
            $front_page = true;
        }
        ?>

        <?php
        if (!is_blog() && !is_404() && !is_search() && !is_singular('resources')) {
            if (have_rows('basic_content')) {
                while (have_rows('basic_content')) : the_row();
                    // All your subfields code for this goes here.
                    switch (get_row_layout()) {
                        case 'header' :
                            // get wysiwyg sub-field
                            get_template_part('template-parts/partials/content', 'header');
                            break;
                    }
                endwhile;
            }
        } else {
            echo $top_section;
            ?>
            <div class="disp-table">
                <div class="middle-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <?php
                                if ($blog_page_found && is_single()) :
                                    $post_categories = wp_get_post_categories(get_the_ID());
                                    $cats = array();
                                    $cat_html = '<div class="btn-section">';
                                    foreach ($post_categories as $c) {
                                        $cat = get_category($c);
                                        $cat_link = get_category_link($c);
                                        $cats[] = array('name' => $cat->name, 'slug' => $cat->slug);
                                        $cat_html .= '<a href="' . $cat_link . '" class="btn btn-link">' . $cat->name . '</a>';
                                    }
                                    $cat_html .= '</div>';
                                    echo $cat_html;
                                endif;
                                if(is_singular('resources')){
                                ?>
                                    <h1 class="site-title"><?php the_title()?></h1>

                                <?php } else { ?>
                                    <h1 class="site-title"><?php echo ($front_page) ? bloginfo('name') : $header_name; ?></h1>
                                <?php } ?>
                                <h4 class="site-description">
                                    <?php echo $header_description; ?>
                                </h4>
                                <?php
                                if ($blog_page_found && !is_category()) :
                                    echo '<div class="row column entry-meta-date">';
                                    echo cortac_time_link();
                                    echo '</div><!-- .entry-meta -->';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        if ($blog_page_found) :
            echo '<div class="entry-meta-auther">';
            echo '<div class="profile-img">';
            $default = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y';
            $args = array('height' => 96, 'width' => 96);
            //echo the_ID();
            echo get_avatar(get_the_author_meta('ID'), 96, $default, '', $args);
            echo '</div>';
            echo '<div class="profile-auther">';
            echo 'By ' . $author = get_the_author();
            echo '</div>';
            echo '</div>';

        endif;
        ?>
    </section>
            <?php }
        ?>
