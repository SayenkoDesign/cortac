<?php
/*
  Template Name: Client
 */

get_header();

$client_cat_html = "";
$client_categories_list = "";
$per_row_image = 4;
$client_desc_html = "";
if (have_rows('basic_content')) {
    
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'client_page':
                $client_categories_list = "";
                $clientMulti = [];
                $clientSectionMainTitle =  get_sub_field('client_section_heading');
                $clientImgHeading = get_sub_field('client_image_section_heading');
                while(have_rows('clients')):the_row();
                    $clientTermMultiTerms = get_sub_field('client_category');
                    if($clientTermMultiTerms){
                        foreach($clientTermMultiTerms as $term){
                            $clientCat = get_sub_field('client_name',$term->taxonomy.'_'.$term->term_id);
                            $clientMulti[][$term->term_id] = $clientCat;
                            //echo $clientCat.'_'.$term->taxonomy.'_'.$term->term_id.'</br>';        
                        }    
                    }
                endwhile;
                while (have_rows('client_category_icon')): the_row(); 
                    
                    $clientTerm = get_sub_field('client_cat_list');
                    $clientIcon = get_sub_field('client_cat_icons', $clientTerm->taxonomy . '_' . $clientTerm->term_id);
                    // $client_cat_html .= '<div class="col-sm-4 col-xs-12 text-center">';
                    $client_cat_html .= '<div class="client_cat_single">';
                    $client_cat_html .= '<div class="indusrie">';
                    if($clientIcon){
                        $client_cat_html .= '<img src="'.$clientIcon['url'].'")/>';
                    }
                    $client_cat_html .= '<h4>'.$clientTerm->name.'</h4>';
                    $client_cat_html .= '<div class="hidden-section">';
                    $client_categories_list = "";
                    if(sizeof($clientMulti)>0){
                        foreach($clientMulti as $key=>$val){
                            $tmpKey = key($val);
                            if($tmpKey===$clientTerm->term_id){
                                $client_categories_list .= '<a href="javascript:void(0)">'.$val[$tmpKey].'</a>';
                            }
                        }
                        $client_cat_html .= $client_categories_list;
                    }
                    $client_cat_html .= '</div>';
                    $client_cat_html .= '</div>';
                    $client_cat_html .= '</div>';
                endwhile;
                $client_desc_html .= '<div class="row client-list">';
                $ccount =0;    
                while(have_rows('client_image')): the_row();
                    $ccount++;
                    $client_images = get_sub_field('client_icons');
                    if($client_images){
                        $client_img = $client_images['url'];
                        $client_title = get_sub_field('client_icon_title');
                        $client_desc_html .='<div class="col-md-3 client">';
                        $client_desc_html .= '<img src="'.$client_img.'" title="'.$client_title.'"/>';
                        $client_desc_html .='</div>';
                        if($ccount % $per_row_image === 0){
                            $client_desc_html .='</div><div class="row client-list">';    
                        }

                    }
                endwhile;
                $client_desc_html .= '</div>';    
            break;

        }
    endwhile;
}            
?>
    <section class="indusries-new">
        <div class="container">
            <div class="row">
                <div class="col-md-12 title-center extra-padding">
                    <?php
                        if($clientSectionMainTitle){
                            echo '<h2>'.$clientSectionMainTitle.'</h2>';
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                    <?php 
                        echo $client_cat_html;
                    ?>
            </div>
        </div>
    </section>
    <section class="our-clients client-list">
    <?php 
        if($clientImgHeading){
    ?>        
            <div class="row">
                <div class="col-md-12 title-center">
                    <h2><?php echo $clientImgHeading;?></h2>
                </div>
            </div>        
     <?php 
        }
        echo '<div class="container text-center">'.$client_desc_html.'</div>';
    ?>
    </section>
<?php
get_footer();
