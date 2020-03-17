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
<div class="col-md-4 col-md-offset-1">
    <h2 class="section-title"><?php echo get_sub_field('left_side_heading'); ?></h2>
    <?php
    if (have_rows('left_side_content')) {
        while (have_rows('left_side_content')) : the_row();
            $contact_row_heading = get_sub_field('contact_row_heading');
            $contact_row_content = get_sub_field('contact_row_content');
            ?>
            <h3><?php echo $contact_row_heading; ?></h3>
            <div><?php echo $contact_row_content; ?></div>
            <?php
        endwhile;
    }
    ?>
    
</div>
<div class="col-md-6 contact-us">
    <h2 class="section-title"><?php echo get_sub_field('right_side_heading'); ?></h2>
    <?php echo do_shortcode(get_sub_field('right_side_content')); ?>
</div>