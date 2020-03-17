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
<section class="services-section" id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-4 left-section">
                <div class="row">
                    <div class="col-md-11">
                        <h2 class="services-title"><?php echo get_sub_field('home_service_heading'); ?></h2>
                        <?php echo get_sub_field('home_service_content'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12 right-section">
                <div class="row">
                    
                    <?php
                        if (have_rows('home_service_menu_list')) {
                            while (have_rows('home_service_menu_list')) : the_row();

                                // display a sub field value
                                $link = get_sub_field('menu_list_link');
                                $label = get_sub_field('menu_list_label');
                                $icon = get_sub_field('menu_list_icon');
                                echo '<div class="col-md-3 col-sm-3 col-xs-12 text-center"><div class="text-center"><a href="'.$link.'" class="text-center"><img src="'.$icon["url"].'"></a></div><a href="'.$link.'" class="text-center">'.$label.'</a></div>';
                            endwhile;
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>