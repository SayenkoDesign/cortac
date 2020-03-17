<?php
/*
  Template Name: Service
 */

get_header();

get_template_part('template-parts/page/service', 'child-page');

$secondSection = false;
$tabSection = false;
$tab_title_html = "";
$tab_content_html = "";
$global_heading = "";
$global_link = "";
if (have_rows('basic_content')) {
    
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'service_page_second_section' :
                $secondSection = true;
                if(get_sub_field("sec_section_main_heading")) {
                    $number_main_heading = get_sub_field("sec_section_main_heading"); 
                }
?>
<section class="by-the-numbers">
    <div class="container">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2><?php echo $number_main_heading;?></h2>
            </div>
        </div>
        <div class="row">
<?php
                while(have_rows('ser_second_section')) : the_row();
                    echo '<div class="col-md-3 col-sm-3 text-center">';
                    if(get_sub_field("ser_second_sec_image")){

                        $tmp_icon_img = get_sub_field("ser_second_sec_image");
                        $icon_img = $tmp_icon_img['url'];
                        echo '<img class="" src="'.$icon_img.'" />';
                    }
                    $amount = get_sub_field("ser_second_sec_amount");
                    echo '<div class="value">'.$amount.'</div>';   
                    $number_title = get_sub_field("ser_second_sec_title");
                    echo '<div class="desc">'.$number_title.'</div>';
                    echo '</div>';
                endwhile;        

?>
        </div>
    </div>
</section>

<?php
            break;
            case 'service_page_tab':
                $tab_id =1;
                $tabSection = true;
                while(have_rows('ser_service_page_tab')): the_row();
                    $tab_title = get_sub_field('ser_service_tab_title');
                    
                    $tab_content = get_sub_field('ser_service_tab_content');
                    
                    $tab_heading = get_sub_field('ser_service_tab_heading');
                    $tab_text = get_sub_field('ser_service_tab_text');
                    $tab_image = get_sub_field('ser_service_tab_image');
                    
                    if( ! empty( $tab_heading ) ) {
                        $tab_content = sprintf( '<h2>%s</h2>', $tab_heading );
                    }
                    
                    $columns = 'col';
                    
                    if( ! empty( $tab_text ) ) {
                        if( ! empty( $tab_image ) ) {
                            $columns = 'col-md-6';
                            $tab_image = sprintf( '<div class="%s">%s</div>', $columns, wp_get_attachment_image( $tab_image, 'large' ) );
                        }
                        $tab_content .= sprintf( '<div class="row"><div class="%s">%s</div>%s</div>', $columns, $tab_text, $tab_image );
                    }
                    
                    $tab_active_class = ($tab_id==1)?'active':'';
                    $tab_id_label = 'tab'.$tab_id;
                    $tab_title_html .= '<li class="'.$tab_active_class.'"><a data-toggle="tab" href="#'.$tab_id_label.'">'.$tab_title.'</a></li>';  
                    $tab_content_html .= '<div id="'.$tab_id_label.'" class="tab-pane fade in '.$tab_active_class.'">'.html_entity_decode($tab_content).' </div>';
                    $tab_id++;
                endwhile;
if($tabSection){
?>
<section class="tab-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-5">
                <ul class="nav nav-pills nav-stacked">
                <?php
                    $tab_title = get_sub_field('ser_service_tab_title');
                    echo $tab_title_html;
                ?>
                </ul>
            </div>
            <div class="col-md-8 col-sm-7">
                <div class="tab-content">
                    <?php
                        echo $tab_content_html;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
            }
        break;
        case 'global_heading':
            $global_heading = '<h2>'.get_sub_field('sub_global_heading').'</h2>';
            ?>
            <div class="row">
                <div class="col-md-12 title-center">
                    <?php echo $global_heading; ?>
                </div>
            </div>
            <?php
            break;
        case 'resources_carousel':
            get_template_part('template-parts/page/resource', 'recent-post-page');
            break;
        case 'global_button':
            while(have_rows('sub_global_btn')): the_row();
                $button_title = get_sub_field('global_btn_title');
                $button_link = get_sub_field('global_btn_link');
                $global_link = '<a href="'.$button_link.'" class="btn btn-link">'.$button_title.'</a>';
            endwhile;
            break;           
    }
endwhile;
}
?>
<?php
set_query_var('global_heading', $global_heading);
?>

<?php //get_template_part('template-parts/page/resource', 'recent-post-page'); ?>
<div class="modal fade modal-video" id="service_resource_myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="video">
                    <iframe width="640" height="360" id="vedioURL" src="https://www.youtube.com/embed/QoptnVCQHsU" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showVedio(url) {
        var vedioURL = document.getElementById("vedioURL");
        vedioURL.src = url;
        //console.log("vedioURL.src ",vedioURL.src);
        $("#service_resource_myModal").modal('show');
    }
</script>
<?php
get_footer();
