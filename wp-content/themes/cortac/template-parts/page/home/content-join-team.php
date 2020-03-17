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
$style = "";
if(get_sub_field('home_join_image')){
   $bkurl = get_sub_field('home_join_image'); 
   $style = "background-image: url(".$bkurl['url'].")";
}
?>
<section class="join" style="<?php echo $style; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php echo get_sub_field('home_join_content'); ?>
                <?php
                if (have_rows('home_join_page_link')) {
                    while (have_rows('home_join_page_link')) : the_row();
                        // display a sub field value
                        $choice_buttons = get_sub_field('home_join_blue_button');
                        if ($choice_buttons) {
                            $choice_buttons = join(" ", $choice_buttons);
                        }
                        echo '<a href="' . get_sub_field('home_join_link') . '" target="_blank" class=" btn btn-primary btn-join  ">' . get_sub_field('home_join_link_name') . '</a>';
                    endwhile;
                }
                ?>
            </div>
        </div>
    </div>
</section>
