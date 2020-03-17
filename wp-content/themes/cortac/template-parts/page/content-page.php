<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        if (have_rows('basic_content')) {
            while (have_rows('basic_content')) : the_row();
                // All your subfields code for this goes here.
                switch (get_row_layout()) {
                    case 'contact_content' :
                        get_template_part('template-parts/page/contact/content', 'contact-us');
                        break;
                }
            endwhile;
        } else {
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'cortac'),
                'after' => '</div>',
            ));
        }
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->