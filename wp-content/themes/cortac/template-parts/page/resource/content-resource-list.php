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
//    echo $get_sub_category ." ---- " ;
//    echo $get_category;
//    print_r($sub_categories_slug_list);
    $sub_cat_list =[];
    if(!empty($get_sub_category)){
        $cat_id = get_term_by('slug', $get_sub_category, 'cortac_categories');
        $sub_cat_list[] = $cat_id->term_id;
    }else{
        $sub_cat_list= array_keys($sub_categories_slug_list);
    }
    
//    print_r($sub_cat_list);
    $has_resources = false;
?>
<section class="resource-gallery resource-grid">
    <div class="container">
        <?php
        if (have_rows('resource_list')) {
            ?>
            <div class="row resources-list">
                <?php
                while (have_rows('resource_list')) : the_row();
                    // display a sub field value
                    $image = get_sub_field('res_image');
                    $res_title = get_sub_field('res_title');
                    $res_description = get_sub_field('resource_description');
                    $res_category = get_sub_field('resource_category');
                    $res_type = get_sub_field('resource_type');
                    $res_video = get_sub_field('resource_video');
                    $res_file = get_sub_field('resource_file');
                        
//                    print_r($res_category);
//                    print_r($res_video);
//                    print_r($res_file);
//                    
                    $match_array =  array_intersect($res_category,$sub_cat_list);
//                    print_r($match_array);
//                    exit;   
                    if(count($match_array)){
                        $has_resources = true;
                    
                    ?>
                    <div class="resource-item">
                        <div class="img-resource">
                            <img src="<?php echo $image['url']; ?>" alt="" />
                        </div>
                        <div class="resource-detail">
                            <h2 class="title"><?php echo $res_title; ?></h2>
                            <p><?php echo $res_description ?></p>
                            <?php
                            if ($res_type == 'standard') {
                                ?>
                                <a class="btn btn-primary btn-download openDownloadBox" onclick="setDownloadID('<?php echo $res_file['ID']; ?>', '<?php echo $res_title; ?>')" ><i class="fa fa-arrow-down" aria-hidden="true"></i>Download</a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-primary btn-download openVideoBox" onclick="setVideoURL('<?php echo $res_video ?>', '<?php echo $res_title; ?>')"><i class="fa fa-arrow-down" aria-hidden="true"></i>Watch Now</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    }
                endwhile;
                ?>
            </div>
            <?php
        } 
        if($has_resources == false) {
            ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>There are no resources matching this selection</h3>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>