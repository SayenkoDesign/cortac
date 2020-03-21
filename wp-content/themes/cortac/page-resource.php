<?php
/*
  Template Name: Resource
 */

$organization_id = get_field('organization_id', get_the_ID());
$category_title = "";
$output = 'objects'; // or names
$resource_categories = get_object_taxonomies('resources', $output);
$current_page_url = get_permalink();
$get_category = NULL;
$get_sub_category = NULL;
if (empty($_GET['category'])) {
    // if (count($resource_categories) > 0) {
    //     $array_values = array_values($resource_categories);
    //     $get_category = $array_values [0]->name;
    // }
    $get_category = 'business_capture';
} else {
    $get_category = $_GET['category'];
}
$termargs = array('hide_empty' => false,'orderby'=>"description");
$resource_sub_categories = get_terms($get_category, $termargs);
$sub_categories_slug_list = [];
foreach ($resource_sub_categories as $key => $value) {
    $sub_categories_slug_list[] = $value->slug;
}
if (!empty($_GET['sub_category'])) {
//    if (count($resource_sub_categories) > 0) {
//        $get_sub_category = $resource_sub_categories [0]->slug;
//    }
//} else {
    $get_sub_category = $_GET['sub_category'];
}
if ($get_sub_category) {
    $get_current_child_category = get_term_by('slug', $get_sub_category, $get_category);
    $my_query = new WP_Query(array(
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $get_category,
                'field' => 'slug',
                'terms' => $get_sub_category
            )
        )
    ));
} else {
    $my_query = new WP_Query(array(
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $get_category,
                'field' => 'slug',
                'terms' => $sub_categories_slug_list
            )
        )
    ));
}
$final_current_url = $current_page_url . "?category=" . $get_category . "&sub_category=" . $get_sub_category;

if (!empty($_GET['post_id'])) {
    //echo $_GET['post_id'];
    $attachement_file_path = get_attached_file($_GET['post_id']);
    $attachement_file_name = basename($attachement_file_path);
    $file_type = wp_check_filetype($attachement_file_name);
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $file_type['type']);
    header("Content-Disposition: attachment; filename=\"" . basename($attachement_file_path) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($attachement_file_path));
    ob_clean();
    flush();
    readfile($attachement_file_path); //showing the path to the server where the file is to be download
    exit;
    /* echo "<pre>";
      print_r($attachement_file_path);
      print_r($attachement_file_name);
      print_r($file_type);
      echo "</pre>";
      exit; */
}
get_header();
?>

<section class="nav-services nav-resources">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header visible-xs-block">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="pull-right" style="padding: 15px;">Select solution</div>
            </div>
            <div class="collapse navbar-collapse text-center" id="myNavbar">
                <ul class="nav navbar-nav">
                    <?php
                    /*
                    usort($resource_categories, function($a, $b){ return strcasecmp($a->label,$b->label); });
                    foreach ($resource_categories as $key => $value) {
                        if ($value->name == 'post_format') {

                        } elseif ($get_category == $value->name) {
                            echo "<li class='active'><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                        } else {
                            echo "<li><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                        }
                    }
                    */
                    
                    if( has_nav_menu( 'resource' ) ) {
                        $args = array( 
                            'theme_location'  => 'resource', 
                            'container'       => false,
                            'echo'            => false,
                            'depth'           => 0,
                            'items_wrap'      => '%3$s'
                        ); 
                        
                        echo wp_nav_menu( $args );
                        
                    } else {
                        usort($resource_categories, function($a, $b){ return strcasecmp($a->label,$b->label); });
                        foreach ($resource_categories as $key => $value) {
                            if ($value->name == 'post_format') {
    
                            } elseif ($get_category == $value->name) {
                                echo "<li class='active'><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                            } else {
                                echo "<li><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
<?php if (!empty($resource_sub_categories)): ?>

<?php endif; ?>
<section class="resource-gallery resource-grid">
    <div class="container">
        <?php
        if (!empty($my_query) && $my_query->have_posts()):
            ?>
        <div class="row resources-list">
        <?php
            while ($my_query->have_posts()) : $my_query->the_post();
                ?>
                    <div class="resource-item" id="resource-post-<?php echo $post->ID; ?>">
                        <div class="img-resource">
                            <?php
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'cortac-featured-image');
                            $video_url = convertVideoURL(get_field('video_url', $post->ID));
                            $other_file = get_field('other_file', $post->ID);
                            $skip_lead_capture = get_field('lead_capture', $post->ID);
                            
                            $target_blank = get_field( 'target_blank', $post->ID );
                            if( $target_blank ) {
                                $target_blank = ' target="_blank"';
                            }
                            
                            
                            if (empty($image)) {
                                $image[0] = get_theme_file_uri('/assets/images/Resources/resource-sample-featured-image.jpg');
                            }
                            if (!empty($video_url)) {
                                //echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#videoModal" class="play-icon" onclick="setVideoURL("'.$video_url.'")"></a>';
                                echo '<span href="javascript:void(0)" class="play-icon"></span>';
                            }
                            ?>
                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
                        </div>
                        <div class="resource-detail">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <?php
                            if (empty($video_url)) {
                                if ($skip_lead_capture) {
                                ?>
                                    <a class="btn btn-primary btn-download noCap" href="<?php echo get_permalink(); ?>" <?php echo $target_blank;?>><i class="fa fa-arrow-down" aria-hidden="true"></i>Read More</a>
                                <?php } else { ?>
                                    <a class="btn btn-primary btn-download" href="<?php echo get_permalink(); ?>" <?php echo $target_blank;?>><i class="fa fa-arrow-down" aria-hidden="true"></i>Read More</a>
                                <?php
                                }
                            } else {
                                if ($skip_lead_capture) {
                                ?>
                                    <a class="btn btn-primary btn-download openVideoBox noCap" onClick="setVideoURL('<?php echo $video_url ?>','<?php the_title(); ?>')"><i class="fa fa-arrow-down" aria-hidden="true"></i>Watch Now</a>
                                <?php } else { ?>
                                    <a class="btn btn-primary btn-download openVideoBox" onClick="setVideoURL('<?php echo $video_url ?>','<?php the_title(); ?>')"><i class="fa fa-arrow-down" aria-hidden="true"></i>Watch Now</a>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="resource-clear"></div>
                    <?php
                endwhile;
        ?>
        </div>
        <?php
            else:
                ?>
            <div class="row">
                <div class="col-md-12 center">
                    <h3>There are no resources matching this selection</h3>
                </div>
            </div>
        <?php
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>
<div id="lightBox" class="modal fade light-box" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="title-label">Download </span></h4>
            </div>
            <div class="modal-body">
                <!--<form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">-->
                <form  name="download_form" id="download_form" >
                    <input type=hidden name="oid" value="<?php echo $organization_id; ?>">
                    <input type=hidden id="retURL" name="retURL" value="<?php echo $final_current_url; ?>">
                    <p>Are you human? Tell us more to get instant access to ALL of our resources.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="First" id="first_name" name="first_name" required minlength="2"/>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Last" name="last_name" id="last_name" required minlength="2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Company" id="company" name="company" required minlength="2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="download_submit" class="btn btn-primary btn-blue"><i class="fa fa-arrow-down" aria-hidden="true"></i><span class="button-label">Download</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="downloadBoxModel" class="modal fade light-box" role="dialog" >
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="title-label">Download </span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?php echo $final_current_url; ?>"  id="file_download_id" class="btn btn-primary btn-blue" > <i class="fa fa-arrow-down" aria-hidden="true"></i> <span class="button-label">Download File</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-video" id="videoModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="video">
                    <iframe width="640" height="360" src="" id="videoIframe" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var is_select_download= true;
    <?php if (!empty($_GET['post'])): ?>
    var resource_post_id = <?php echo $_GET['post']; ?>
    <?php endif; ?>

    $(document).ready(function () {
        $(".openVideoBox").click(function (ev) {
            is_select_download= false;
            console.log($(this).attr('class'));
            if ($(this).hasClass('noCap')) {
                $('#lightBox').modal('hide');
                $('#videoModal').modal('show');
            } else if (typeof $.cookie('lightbox_form') === 'undefined') {
                $('#lightBox').modal('show');
                $('#videoModal').modal('hide');
            } else {
                $('#lightBox').modal('hide');
                $('#videoModal').modal('show');
            }
        });
        $(".openDownloadBox").on('click', function (ev) {
            is_select_download= true;
            console.log("!$.cookie('lightbox_form') ",$.cookie('lightbox_form'));
            if (typeof $.cookie('lightbox_form') === 'undefined') {
                $('#lightBox').modal('show');
                $('#downloadBoxModel').modal('hide');
            } else {
                $('#lightBox').modal('hide');
                $('#downloadBoxModel').modal('show');
            }
        });

        if (typeof resource_post_id !== 'undefined') {
            $('html, body').animate({
                scrollTop: $('#resource-post-' + resource_post_id).offset().top
            }, 500, function() {
                $('#resource-post-' + resource_post_id + ' .btn-download').click();
            });
        }
    });

    function setVideoURL(url,title) {
        jQuery(".title-label").html("Watch Now "+title);
        jQuery(".button-label").html("Watch Now");
        var videoIframe = document.getElementById("videoIframe");
        videoIframe.src = url
    }
    function setDownloadID(id,title) {
        jQuery(".title-label").html("Download "+title);
        jQuery(".button-label").html("Download ");
        var fileID = document.getElementById("file_download_id");
        fileID.href = fileID.href + "&post_id=" + fileID
    }
    jQuery(document).on('submit', '#download_form', function (event) {
        event.preventDefault();
        var newDownloadForm = jQuery('#download_form').serialize();
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'my_lead_action',
                data: newDownloadForm
            },
            success: function (response) {
                if (response === 'ok') {
//                    $.cookie("lightbox_form", 1, { expires : 0,domain: '.wpengine.com' });
                    document.cookie = "lightbox_form=1;expires=0;domain=.wpengine.com; path=/"
                    console.log("document.cookie ",document.cookie);
                    $('#download_form')[0].reset();
                    $('#lightBox').modal('hide');
                    if(is_select_download){
                        $('#downloadBoxModel').modal('show');
                    }
                    else{
                        $('#videoModal').modal('show');
                    }
                }
            }
        });
    });
    jQuery(document).on('click', '#file_download_id', function () {
        $('#download_form')[0].reset();
        $('#downloadBoxModel').modal('hide');
    });
</script>
<?php
get_footer();
