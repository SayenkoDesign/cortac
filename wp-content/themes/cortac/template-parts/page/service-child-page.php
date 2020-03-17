<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
?>
<?php
$parent_pages = get_child_pages($post->ID);
//print_r($parent_pages);
?>
<?php
if ($post->post_parent)
    $children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0");
else
    $children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0");
?>

<section class="nav-services">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse text-center" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!--                    <li class="active"><a href="#">Business Capture</a></li>
                                        <li><a href="#">Management Consulting</a></li>
                                        <li><a href="#">Program Project and Controls</a></li>
                                        <li><a href="#">Technology Solutions</a></li>-->
                    <?php if ($children) { ?>
                        <?php echo $children; ?>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</section>
<section class="service-detail">
    <div class="container">
        <div class="row">
            <?php
            $page_content = "";
            $feature_image = "";
            if (have_rows('basic_content')) {
                
                while (have_rows('basic_content')) : the_row();
                    // All your subfields code for this goes here.
                    switch (get_row_layout()) {
                        case 'service_page' :
                            while(have_rows('ser_first_section')) : the_row();
                                $heading = get_sub_field("first_section_heading");
                                $page_content = html_entity_decode(get_sub_field("first_section_content"));
                            endwhile;        
                            if(get_sub_field("ser_image")){
                                $tmp_image = get_sub_field("ser_image"); 
                                //echo "<pre>";
                                //print_r($tmp_image);
                                $feature_image = $tmp_image['url'];

                            }
                    }
            endwhile;
            }
            ?>
            <div class="col-md-5">
                <?php
                    echo '<h2>'.$heading.'</h2>';
                    echo $page_content; 
                ?>    
            </div>
            <div class="col-md-7">
                <img class="img-responsive" src="<?php echo $feature_image;?>" />
            </div>
        </div>
    </div>
</section>
