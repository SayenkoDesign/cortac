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
<?php
$profile_img_class = ($blog_page_found) ? 'profile-img-section' : '';
if (get_sub_field('header_bk_image')) {
    $image_array = get_sub_field('header_bk_image');
    //echo $image_array['url'];
    $top_section = '<section class="top-section top-section-about custom-header ' . $profile_img_class . '" style="background: url(' . $image_array['url'] . ') no-repeat;background-size:cover;background-position:center;">';
} else if (is_404()) {
    $top_section = '<section class="top-section custom-header not-found ' . $profile_img_class . '">';
} else {
    $top_section = '<section class="top-section top-section-about custom-header ' . $profile_img_class . '" >';
}
echo $top_section;
?>
<div class="disp-table">
    <div class="middle-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="btn-section">
                        <?php
                        if (get_sub_field('header_content')) {
                            print get_sub_field('header_content');
                        }
                        if (have_rows('header_page_link')) {
                            while (have_rows('header_page_link')) : the_row();

                                // display a sub field value
                                $choice_buttons = get_sub_field('header_sub_blue_button');
                                if($choice_buttons){
                                    $choice_buttons = join(" ", $choice_buttons);
                                }

                                if(get_sub_field('header_sub_custom_link') === true) {
                                    echo '<a href="'.get_sub_field('header_sub_custom_link_url').'" class=" btn btn-link '.$choice_buttons.' menu-item menu-item-type-post_type menu-item-object-page ">'.get_sub_field('header_sub_link_name').'</a>';
                                } else {
                                    echo '<a href="'.get_sub_field('header_sub_link').'" class=" btn btn-link '.$choice_buttons.' menu-item menu-item-type-post_type menu-item-object-page ">'.get_sub_field('header_sub_link_name').'</a>';
                                }
                            endwhile;
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo "</section>"; ?>
