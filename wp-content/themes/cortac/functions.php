<?php
/**
 * Cortac functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 */
/**
 * Cortac only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cortac_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/cortac
     * If you're building a theme based on Cortac, use a find and replace
     * to change 'cortac' to the name of your theme in all the template files.
     */
    load_theme_textdomain('cortac');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('cortac-featured-image', 2000, 1200, true);

    add_image_size('cortac-thumbnail-avatar', 100, 100, true);

    add_filter('jpeg_quality', function($arg){return 82;});

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'top' => __('Top Menu', 'cortac'),
        'social' => __('Social Links Menu', 'cortac'),
        'home-header' => __('Banner Menu', 'cortac'),
        'home-contact-us' => __('Contact Us Menu', 'cortac'),
        'career' => __('career', 'cortac'),
        'resource' => __('Resources Menu', 'cortac')
        
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
//        'aside',
//        'image',
        'video',
//        'quote',
//        'link',
//        'gallery',
//        'audio',
    ));
    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
     */
//	add_editor_style( array( 'assets/css/editor-style.css', cortac_fonts_url() ) );
    add_editor_style(array('assets/css/font-awesome.min.css', cortac_fonts_url()));
    add_editor_style(array('assets/css/font-awesome.min.css', cortac_fonts_url()));
    add_editor_style(array('assets/css/owl.carousel.min.css', cortac_fonts_url()));
    add_editor_style(array('assets/css/owl.theme.default.css', cortac_fonts_url()));
    add_editor_style(array('assets/css/style.css', cortac_fonts_url()));

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets' => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),
            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),
            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts' => array(
            'home',
            'about' => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog' => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),
        // Create the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
            'image-espresso' => array(
                'post_title' => _x('Espresso', 'Theme starter content', 'cortac'),
                'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
            ),
            'image-sandwich' => array(
                'post_title' => _x('Sandwich', 'Theme starter content', 'cortac'),
                'file' => 'assets/images/sandwich.jpg',
            ),
            'image-coffee' => array(
                'post_title' => _x('Coffee', 'Theme starter content', 'cortac'),
                'file' => 'assets/images/coffee.jpg',
            ),
        ),
        // Default to a static front page and assign the front and posts pages.
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),
        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods' => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),
        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus' => array(
            // Assign a menu to the "top" location.
            'top' => array(
                'name' => __('Top Menu', 'cortac'),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),
            // Assign a menu to the "social" location.
            'social' => array(
                'name' => __('Social Links Menu', 'cortac'),
                'items' => array(
                    'link_linkedin',
                    //'link_facebook',
                    'link_twitter',
                    //'link_instagram',
                    'link_youtube',
                ),
            ),
            // Assign a menu to the "On Home page banner" location.
            'home-header' => array(
                'name' => __('Banner Menu', 'cortac'),
                'items' => array(
                    'page_about',
                    'page_services',
                ),
            ),
            'home-contact-us' => __('Contact Us Menu', 'cortac'),
            // Assign a menu to the "Top Contact us" location.
            'home-contact-us' => array(
                'name' => __('Contact Us Menu', 'cortac'),
                'items' => array(
                    'page_contact',
                ),
            ),
            'career' => __('Career', 'cortac'),
        ),
    );

    /**
     * Filters Cortac array of starter content.
     *
     * @since Cortac 1.1
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters('cortac_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}

add_action('after_setup_theme', 'cortac_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cortac_content_width() {

    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (cortac_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    /**
     * Filter Cortac content width of the theme.
     *
     * @since Cortac 1.0
     *
     * @param $content_width integer
     */
    $GLOBALS['content_width'] = apply_filters('cortac_content_width', $content_width);
}

add_action('template_redirect', 'cortac_content_width', 0);

/**
 * Register custom fonts.
 */
function cortac_fonts_url() {
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $libre_franklin = _x('on', 'Libre Franklin font: on or off', 'cortac');

    if ('off' !== $libre_franklin) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Cortac 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function cortac_resource_hints($urls, $relation_type) {
    if (wp_style_is('cortac-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'cortac_resource_hints', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cortac_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'cortac'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'cortac'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 1', 'cortac'),
        'id' => 'sidebar-2',
        'description' => __('Add widgets here to appear in your footer.', 'cortac'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'cortac'),
        'id' => 'sidebar-3',
        'description' => __('Add widgets here to appear in your footer.', 'cortac'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'cortac_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Cortac 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function cortac_excerpt_more($link) {
    if (is_admin()) {
        return $link;
    }

    $link = sprintf('<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>', esc_url(get_permalink(get_the_ID())), sprintf(__('...Continued<span class="screen-reader-text"> "%s"</span>', 'cortac'), get_the_title(get_the_ID()))
    );
    return $link;
}

add_filter('excerpt_more', 'cortac_excerpt_more');

function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">...Continued</a>';
}

add_filter('the_content_more_link', 'modify_read_more_link');

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function cortac_excerpt_length($length) {
    return 45;
}

add_filter('excerpt_length', 'cortac_excerpt_length', 999);

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Cortac 1.0
 */
function cortac_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'cortac_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function cortac_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
    }
}

add_action('wp_head', 'cortac_pingback_header');

/**
 * Display custom color CSS.
 */
function cortac_colors_css_wrap() {
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once( get_parent_theme_file_path('/inc/color-patterns.php') );
    $hue = absint(get_theme_mod('colorscheme_hue', 250));
    ?>
    <style type="text/css" id="custom-theme-colors" <?php
    if (is_customize_preview()) {
        echo 'data-hue="' . $hue . '"';
    }
    ?>>
    <?php echo cortac_custom_colors_css(); ?>
    </style>
    <?php
}

add_action('wp_head', 'cortac_colors_css_wrap');

/**
 * Enqueue scripts and styles.
 */
function cortac_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('cortac-fonts', cortac_fonts_url(), array(), null);

    // Theme stylesheet.
    wp_enqueue_style('cortac-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('cortac-google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700');
    wp_enqueue_style('cortac-font-awesome', get_theme_file_uri('/assets/css/font-awesome.min.css'));
    wp_enqueue_style('cortac-carousel', get_theme_file_uri('/assets/css/owl.carousel.min.css'));
    wp_enqueue_style('cortac-theme', get_theme_file_uri('/assets/css/owl.theme.default.css'));
    wp_enqueue_style('cortac-style', get_theme_file_uri('/assets/css/style.css'));

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('cortac-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('cortac-style'), '1.0');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
//		wp_enqueue_style( 'cortac-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'cortac-style' ), '1.0' );
//		wp_style_add_data( 'cortac-ie9', 'conditional', 'IE 9' );
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('cortac-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('cortac-style'), '1.0');
    wp_style_add_data('cortac-ie8', 'conditional', 'lt IE 9');

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '3.7.3');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('cortac-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '1.0', true);

    $cortac_l10n = array(
        'quote' => cortac_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('cortac-navigation', get_theme_file_uri('/assets/js/navigation.js'), array(), '1.0', true);
        $cortac_l10n['expand'] = __('Expand child menu', 'cortac');
        $cortac_l10n['collapse'] = __('Collapse child menu', 'cortac');
        $cortac_l10n['icon'] = cortac_get_svg(array('icon' => 'angle-down', 'fallback' => true));
    }

    wp_enqueue_script('jquery-google', "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
    wp_enqueue_script('jquery-cookie', "https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js");
    wp_enqueue_script('jquery-bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");
    wp_enqueue_script('cortac-global', get_theme_file_uri('/assets/js/owl.carousel.min.js'));
    wp_enqueue_script('cortac-custom', get_theme_file_uri('/assets/js/custom.js'));

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

    wp_localize_script('cortac-skip-link-focus-fix', 'cortacScreenReaderText', $cortac_l10n);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'cortac_scripts');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Cortac 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function cortac_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];

    if (740 <= $width) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }

    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
        if (!( is_page() && 'one-column' === get_theme_mod('page_options') ) && 767 <= $width) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'cortac_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Cortac 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function cortac_header_image_tag($html, $header, $attr) {
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}

add_filter('get_header_image_tag', 'cortac_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Cortac 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function cortac_post_thumbnail_sizes_attr($attr, $attachment, $size) {
    if (is_archive() || is_search() || is_home()) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'cortac_post_thumbnail_sizes_attr', 10, 3);

class Custom_Walker_Header_Nav_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $classLabel = " btn btn-link ";
        foreach ($item->classes as $key => $cval) {
            $classLabel .= $cval . ' ';
        }
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);
        //echo $title;
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="' . $classLabel . '">';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        echo $item_output;
    }

}

class Custom_Walker_Header_Nav_ContactUs_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<ul class="nav navbar-nav navbar-right"><li><a' . $attributes . ' class="btn btn-primary btn-contact">';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a></li>';
        $item_output .= '<li><a href="javascript:;" class="menu-icon"></a></li>';
        $item_output .= '</ul>';
        $item_output .= $args->after;

        echo $item_output;
    }

}

/**
  Create carrer menu design
 */
class Custom_Walker_Header_Nav_career extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="btn btn-primary btn-join">';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        echo $item_output;
    }

}

/**
  Social navigation
 */
class Custom_Walker_Social_Nav_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_icon = array('linkedin' => 'fa-linkedin',
            'youtube' => 'fa-youtube-play',
            'twitter' => 'fa-twitter',
        );
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);
        if (array_key_exists(strtolower($title), $item_icon)) {
            $title_icon = $item_icon[strtolower($title)];
        } else {
            $title_icon = 'fa-linkedin';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="btn btn-link">';
        //$item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '<i class="fa ' . $title_icon . ' aria-hidden="true">';
        $item_output .= '</i></a>';
        $item_output .= $args->after;

        echo $item_output;
    }

}

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Cortac 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function cortac_front_page_template($template) {
    return is_home() ? '' : $template;
}

add_filter('frontpage_template', 'cortac_front_page_template');

function my_login_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($image) {
        $custom_logo = $image[0];
    } else {
        $custom_logo = get_stylesheet_directory_uri() . '/assets/images/Logo/Logo-full-color.png';
    }
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $custom_logo; ?>);
            height:48px;
            width:170px;
            background-size: 170px 48px;
            background-repeat: no-repeat;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo');


/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

function get_child_pages($parent_id) {
    return get_pages(['parent' => $parent_id]);
}

function my_lead_action() {
    global $wp_version;
    $params = array();
    parse_str($_POST['data'], $params);
    $output = [];

    $params['lead_source'] = "Lead source on cortac.pantrishi";
    $params['orgid'] = $params['oid']; // web to case
    $body = preg_replace('/%5B[0-9]+%5D/simU', '', http_build_query($params));
    $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $args = array(
        'body' => $body,
        'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            'user-agent' => 'Brilliant Web-to-Lead for Salesforce plugin - WordPress/' . $wp_version . '; ' . get_bloginfo('url'),
        ),
        'sslverify' => false,
    );
    $result = wp_remote_post($url, $args);
    if (is_wp_error($result)) {
//        print_r($result);
        $output['status'] = FALSE;
    } else {
        if ($result['response']['code'] == 200) {
            $output['status'] = true;
        } else {
            $output['status'] = FALSE;
        }
    }
//    echo json_decode($output);
    if ($output['status']) {
        echo "ok";
    } else {
        echo "Error";
    }
    setcookie("lightbox_form", true, 0, COOKIEPATH, COOKIE_DOMAIN);
    exit();
}

add_action('wp_ajax_my_lead_action', 'my_lead_action');
add_action('wp_ajax_nopriv_my_lead_action', 'my_lead_action');

function getPageLinkByName($name) {
    $pagename = get_page_by_path($name);
    if (!empty($pagename)) {
        return get_permalink($pagename->ID);
    }
    return "";
}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function example_add_dashboard_widgets() {

    wp_add_dashboard_widget(
            'example_dashboard_widget', // Widget slug.
            'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!', // Title.
            'example_dashboard_widget_function' // Display function.
    );
}

add_action('wp_dashboard_setup', 'example_add_dashboard_widgets');

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function example_dashboard_widget_function() {

// Display whatever it is you want to show.
    echo "<span style='width:100%'>
        <a href='http://www.sayenkodesign.com' target='_blank'>
            <img alt='Seattle Web Design' src='" . get_stylesheet_directory_uri() . "/assets/images/generic/Sayenko-Design-WP-Referral-Bonus-460.jpg' style='width:100%'></a></span>
</br>
</br>

Simply introduce us via email along with the prospects phone number. Email introductions can be sent to <a href='mailto:mike@sayenkodesign.com'>mike@sayenkodesign.com</a>";
}

function convertVideoURL($video_url) {
    $video_url = preg_replace_callback('#https://vimeo.com/\d*#', function($message) {
        if (preg_match(
                        '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/', $message[0], $matches
                )) {
            $id = $matches[2];
            return "//player.vimeo.com/video/" . $id . "?portrait=0";
        }
        return $message[0];
    }, $video_url);
    return $video_url;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path) {

    // update path
    $path = get_stylesheet_directory() . '/my-acf-folder';


    // return
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths) {

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/my-acf-folder';


    // return
    return $paths;
}

//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_cortac_hierarchical_taxonomy', 0);

//create a custom taxonomy name it cortac categoriy for your posts

function create_cortac_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

    $labels = array(
        'name' => _x('Cortac Categories', 'taxonomy general name'),
        'singular_name' => _x('Cortac Category', 'taxonomy singular name'),
        'search_items' => __('Search Cortac Categories'),
        'all_items' => __('All Cortac Category'),
        'parent_item' => __('Parent Cortac Category'),
        'parent_item_colon' => __('Parent Cortac Category:'),
        'edit_item' => __('Edit Cortac Category'),
        'update_item' => __('Update Cortac Category'),
        'add_new_item' => __('Add New Cortac Category'),
        'new_item_name' => __('New Cortac Category Name'),
        'menu_name' => __('Cortac Categories'),
    );

// Now register the taxonomy

    register_taxonomy('cortac_categories', array('post'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'cortac_categories'),
    ));
}

//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_cortac_client_hierarchical_taxonomy', 0);

//create a custom taxonomy name it cortac categoriy for your posts

function create_cortac_client_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

    $labels = array(
        'name' => _x('Client Categories', 'taxonomy general name'),
        'singular_name' => _x('Client Category', 'taxonomy singular name'),
        'search_items' => __('Search Client Categories'),
        'all_items' => __('All Client Category'),
        'parent_item' => __('Parent Client Category'),
        'parent_item_colon' => __('Parent Client Category:'),
        'edit_item' => __('Edit Client Category'),
        'update_item' => __('Update Client Category'),
        'add_new_item' => __('Add New Client Category'),
        'new_item_name' => __('New Client Category Name'),
        'menu_name' => __('Client Categories'),
    );

// Now register the taxonomy

    register_taxonomy('client_categories', array('post'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'client_categories'),
    ));
}

function reset_editor() {
    global $_wp_post_type_features;
        $post_type = "page";
        $feature = "editor";
        if (!isset($_wp_post_type_features[$post_type])) {

        } elseif (isset($_wp_post_type_features[$post_type][$feature]))
            unset($_wp_post_type_features[$post_type][$feature]);
}

add_action("init", "reset_editor");



add_filter('acf/settings/remove_wp_meta_box', '__return_false');