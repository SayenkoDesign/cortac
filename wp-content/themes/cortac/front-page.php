<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
get_header();
$client_desc_html = "";
$per_row_image = 4;
if (have_rows('basic_content')) {
    
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'featured_clients':
                $clientTitle = get_sub_field('fet_client_title');
                $client_desc_html .= '<div class="row">';
                $client_desc_html .= '<div class="col-md-12 title-center">';
                $client_desc_html .= '<h2>' . $clientTitle . '</h2>';
                $client_desc_html .= '</div>';
                $client_desc_html .= '</div>';
                $client_desc_html .= '<div class="container text-center">';
                $client_desc_html .= '<div class="row client-list">';
                $ccount =0;    
                while(have_rows('featured_client')): the_row();
                    $ccount++;
                    $client_images = get_sub_field('fet_client_icon');
                    if($client_images){
                        $client_img = $client_images['url'];
                        $client_desc_html .='<div class="col-md-3 client">';
                        $client_desc_html .= '<img src="'.$client_img.'"/>';
                        $client_desc_html .='</div>';
                        if($ccount % $per_row_image === 0){
                            $client_desc_html .='</div><div class="row client-list">';    
                        }
                    }
                endwhile;
                $client_desc_html .= '</div>';    
                $client_desc_html .= '</div>';
                while(have_rows('fet_cli_button')): the_row();
                    $ft_btn_label = get_sub_field('fet_button_label');
                    $ft_btn_link = get_sub_field('fet_button_link');
                    $is_blue_btn = get_sub_field('fet_is_blue_btn');
                    $btn_class = ($is_blue_btn)?'custom-blue-btn':'';
                    $client_desc_html .='<div class="row">';
                    $client_desc_html .='<div class="col-md-12 text-center">';
                    $client_desc_html .='<div class="more-article btn-more">';
                    $client_desc_html .='<a href="' . $ft_btn_link . '" class="btn btn-link '.$btn_class.'">'.$ft_btn_label.'</a>';
                    $client_desc_html .='</div>';
                    $client_desc_html .='</div>';
                    $client_desc_html .='</div>';
                endwhile;
                $client_desc_html .='</div>';                    
            break;
           }     
    endwhile;
   }         
?>
<?php
if (have_rows('basic_content')) {
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'home_service_section' :
                // get wysiwyg sub-field
                get_template_part('template-parts/page/home/content', 'service-section');
                break;
        }
    endwhile;
}
?>
<?php echo get_template_part('template-parts/page/content', 'recent-post-page'); ?>
<section class="our-clients">
    <div class="container-fluid">
        <?php echo $client_desc_html; ?>
    </div>
</section>
<?php
wp_reset_postdata();
if (have_rows('basic_content')) {

    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'home_join_team' :
                // get wysiwyg sub-field
                get_template_part('template-parts/page/home/content', 'join-team');
                break;
        }
    endwhile;
}
?>
<div class="modal fade modal-video" id="service_resource_myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="video" >
                    <iframe width="640" height="360" id="vedioURL"  src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showVedio(url) {
        var vedioURL = document.getElementById("vedioURL");
        vedioURL.src = url;
        console.log("vedioURL.src ", vedioURL.src);
        $("#service_resource_myModal").modal('show');
    }
</script>
<?php
get_footer();
