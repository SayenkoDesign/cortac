<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
?>
<section class="about-desc">
    <div class="container">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2><?php echo get_sub_field('about_page_header'); ?></h2>
            </div>
            <div class="col-md-12 text-center">
                <?php echo get_sub_field('about_page_content'); ?>
                <?php
                    if (have_rows('abuot_button_link')) {
                            while (have_rows('abuot_button_link')) : the_row();
                                // display a sub field value
                                $link = get_sub_field('abuot_button_sub_link');
                                $label = get_sub_field('abuot_button_sub_label');
                                echo '<a class="btn btn-primary btn-blue" href="'.$link.'">'.$label.'</a>';
                            endwhile;
                        }
                ?>
                
            </div>
        </div>
    </div>
</section>

