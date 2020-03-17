<?php
/**
 * Template Name: About Page
 *
 * @package WordPress
 * @subpackage Cortac
 * @since Cortac 1.0
 */
get_header();
if (have_rows('basic_content')) {
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'about' :
                get_template_part('template-parts/page/about/content', 'about');
                break;
            case 'team' :
                get_template_part('template-parts/page/about/content', 'team');
                break;
        }
    endwhile;
}
get_footer();
