<?php
$organization_id = get_field('organization_id', get_the_ID());
$final_current_url = get_permalink() ;
?>
<section class="latest-insight">
    <div class="container">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2>Latest News</h2>
            </div>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 6
            ), OBJECT);
            if ($recent_posts):
            ?>
            <div class="latest-blog-posts bg-white pt60 pb60">
                <div class="pos-rel">
                    <div id="owl-demo-2" class="owl-carousel owl-theme">
                        <?php
                        foreach ($recent_posts as $post):
                            setup_postdata($post->ID);
                            ?>
                            <div class="resource-item" id="resource-post-<?php echo $post->ID; ?>">
                                <div class="img-resource">
                                    <?php
                                    $video_url = convertVideoURL(get_field('video_url', $post->ID));
                                    $other_file = get_field('other_file', $post->ID);
                                    if (!empty($video_url)) {
                                        //echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#videoModal" class="play-icon" onclick="setVideoURL("'.$video_url.'")"></a>';
                                        echo '<span href="javascript:void(0)" class="play-icon"></span>';
                                    }
                                    ?>
                                    <?php echo get_the_post_thumbnail($post->ID, [400, 0]); ?>
                                </div>
                                <div class="resource-detail">
                                    <h2 class="title"><?php the_title(); ?></h2>
                                    <!-- the_content();<p> -->
                                    <?php
                                    $post_format = get_post_format($post->ID);
                                    $post_type = get_post_type($post->ID);
                                    if ($post_type == 'resources' && $post_format == 'video') {
                                        if (empty($video_url)) {
                                            ?>
                                            <a class="btn btn-primary btn-download openDownloadBox"
                                               onClick="setDownloadID('<?php echo $other_file['id']; ?>','<?php the_title(); ?>')"><i
                                                        class="fa fa-arrow-down" aria-hidden="true"></i>Download</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="btn btn-primary btn-download openVideoBox"
                                               onClick="setVideoURL('<?php echo $video_url ?>','<?php the_title(); ?>')"><i
                                                        class="fa fa-arrow-down" aria-hidden="true"></i>Watch Now</a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-download">Read More</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <!-- #owl-demo-2 -->
                    <div class="customNavigation">
                        <span class="pager-left"><a class="btn btn-link prev"><span class="glyphicon glyphicon-chevron-left fa fa-angle-left"></span></a></span>
                        <span class="pager-right"><a class="btn btn-link next"><span class="glyphicon glyphicon-chevron-right fa fa-angle-right"></span></a></span>
                    </div>
                </div>
                <!-- .container -->
            
            </div>

            <div class="col-md-12 text-center">
                <div class="more-article btn-more">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-link">MORE ARTICLES</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
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
            $(".openVideoBox").on('click', function (ev) {
                is_select_download= false;
                console.log("!$.cookie('lightbox_form') ",$.cookie('lightbox_form'));
                if (typeof $.cookie('lightbox_form') === 'undefined') {
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
        fileID.href = fileID.href + "&post_id=" + id
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