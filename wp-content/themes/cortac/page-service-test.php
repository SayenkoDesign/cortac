<?php
/*
  Template Name: TestService
 */

get_header();
?>
<?php
if ($post->post_parent) {
    $successful_proposals_value = number_format(get_field('successful_proposals_value', $post->post_parent), 0);
    $companies_assisted = get_field('companies_assisted', $post->post_parent);
    $proposals_success_rate = get_field('proposals_success_rate', $post->post_parent);
    $international_proposals = get_field('international_proposals', $post->post_parent);

    $benifit_1_title = get_field('benifit_1_title', $post->post_parent);
    $benifit_1_content = get_field('benifit_1', $post->post_parent);

    $benifit_2_title = get_field('benifit_2_title', $post->post_parent);
    $benifit_2_content = get_field('benifit_2', $post->post_parent);

    $benifit_3_title = get_field('benifit_3_title', $post->post_parent);
    $benifit_3_content = get_field('benifit_3', $post->post_parent);

    $benifit_4_title = get_field('benifit_3_title', $post->post_parent);
    $benifit_4_content = get_field('benifit_3', $post->post_parent);
} else {
    $successful_proposals_value = number_format(get_field('successful_proposals_value'), 0);
    $companies_assisted = get_field('companies_assisted');
    $proposals_success_rate = get_field('proposals_success_rate');
    $international_proposals = get_field('international_proposals');

    $benifit_1_title = get_field('benifit_1_title');
    $benifit_1_content = get_field('benifit_1');

    $benifit_2_title = get_field('benifit_2_title');
    $benifit_2_content = get_field('benifit_2');

    $benifit_3_title = get_field('benifit_3_title');
    $benifit_3_content = get_field('benifit_3');

    $benifit_4_title = get_field('benifit_3_title');
    $benifit_4_content = get_field('benifit_3');
}
get_template_part('template-parts/page/service', 'child-page');
?>
<section class="by-the-numbers">
    <div class="container">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2>By the Numbers</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 text-center">
                <img class="" src="<?php echo get_theme_file_uri('/assets/images/Service/By the numbers/Successful proposals value.png') ?>" />
                <div class="value">$<?php echo $successful_proposals_value; ?></div>
                <div class="desc">Successful Proposals Value</div>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <img class="" src="<?php echo get_theme_file_uri('/assets/images/Service/By the numbers/companies assisted.png') ?>" />
                <div class="value"><?php echo $companies_assisted ?></div>
                <div class="desc">Companies Assisted</div>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <img class="" src="<?php echo get_theme_file_uri('/assets/images/Service/By the numbers/proposal success rate.png') ?>" />
                <div class="value"><?php echo $proposals_success_rate; ?></div>
                <div class="desc">Proposals Success Rate</div>
            </div>
            <div class="col-md-3 col-sm-3 text-center">
                <img class="" src="<?php echo get_theme_file_uri('/assets/images/Service/By the numbers/international proposals.png') ?>" />
                <div class="value"><?php echo $international_proposals; ?></div>
                <div class="desc">International Proposals</div>
            </div>
        </div>
    </div>
</section>
<section class="tab-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-5">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" href="#tab1"><?php echo $benifit_1_title; ?></a></li>
                    <li><a data-toggle="tab" href="#tab2"><?php echo $benifit_2_title; ?></a></li>
                    <li><a data-toggle="tab" href="#tab3"><?php echo $benifit_3_title; ?></a></li>
                    <li><a data-toggle="tab" href="#tab4"><?php echo $benifit_4_title; ?></a></li>
                </ul>
            </div>
            <div class="col-md-8 col-sm-7">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <?php echo html_entity_decode($benifit_1_content); ?>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <?php echo html_entity_decode($benifit_2_content); ?>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <?php echo html_entity_decode($benifit_3_content); ?>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <?php echo html_entity_decode($benifit_4_content); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="latest-insight proposal">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 title-center">
                <h2>Proposal Development Resources</h2>
            </div>
            <div class="latest-blog-posts bg-white pt60 pb60">
                <div class="pos-rel">
                    <div id="owl-demo-2" class="owl-carousel owl-theme">

                        <?php
                        get_template_part('template-parts/page/resource', 'recent-post-page');
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
        </div>
        <div class="col-md-12 text-center">
            <div class="more-article btn-more">
                <a href="<?php echo getPageLinkByName('resources'); ?>" class="btn btn-link">See All Resources</a>
            </div>
        </div>
    </div>
</section>    
<div class="modal fade modal-video" id="service_resource_myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="video">
                    <iframe width="640" height="360" id="vedioURL" src="" frameborder="0" allowfullscreen></iframe>
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
//    $(document).ready(function () {
//        $(".btn_vedio").click(function () {
//            $("#service_resource_myModal").modal('show');
//        });
//    });
</script>
<?php
get_footer();
