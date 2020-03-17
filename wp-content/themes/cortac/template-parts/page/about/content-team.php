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
<section class="team" id="team"> 
    <div class="container">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2><?php echo get_sub_field('team_heading'); ?></h2>
            </div>
        </div>
        <div class="sub-heading">
            <div class="col-md-12 text-center">
                <h4><?php echo get_sub_field('team_sub_heading'); ?></h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (have_rows('team_list')) {
                while (have_rows('team_list')) : the_row();
                    // display a sub field value
                    $profile_image = get_sub_field('team_sub_profile_image');
                    $name = get_sub_field('team_sub_name');
                    $designation = get_sub_field('team_sub_designation');
                    $facebook_link = get_sub_field('team_sub_facebook_link');
                    $linkedin_link = get_sub_field('team_sub_linkedin_link');
                    $twitter_link = get_sub_field('team_sub_twitter_link');
                    
                    $about_desc_html = '';
                    $about_desc_html .='<div class="col-md-3 col-sm-3 resource">';
                    $about_desc_html .= '<img class="resource-image" src="' . $profile_image['url'] . '" />';
                    $about_desc_html .= '<div class="resource-desc">';
                    $about_desc_html .= '<div class="abs">';
                    $about_desc_html .= '<div class="name">' . $name . '</div>';
                    $about_desc_html .= '<div class="designation">' . $designation . '</div>';
                    
                    if (!empty($facebook_link)) {
                        $about_desc_html .= '<a href="' . $facebook_link . '" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>';
                    }
                    if (!empty($linkedin_link)) {
                        $about_desc_html .= '<a href="' . $linkedin_link . '" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>';
                    }
                    if (!empty($twitter_link)) {
                        $about_desc_html .= '<a href="' . $twitter_link . '" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>';
                    }
                    $about_desc_html .= '</div>';
                    $about_desc_html .= '</div>';
                    $about_desc_html .= '</div>';
                    echo $about_desc_html;
                endwhile;
            }
            ?>
        </div>
    </div>    	
</section>