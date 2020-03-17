<?php
/*
    Template Name: Blog Page
*/

get_header();

if ($_GET['category']) {
    $get_category = $_GET['category'];
}

$resource_categories = get_object_taxonomies('resources', 'objects');

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

if ( $get_category ) {
    $my_query = new WP_Query(array(
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => $get_category,
                'field' => 'slug',
                'terms' => 'blog-posts'
            )
        )
    ));
} else {
    $my_query = new WP_Query(array(
        'post_type' => 'resources',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $paged,
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'business_capture',
                'field' => 'slug',
                'terms' => 'blog-posts'
            ),
            array(
                'taxonomy' => 'management_consulting',
                'field' => 'slug',
                'terms' => 'blog-posts'
            ),
            array(
                'taxonomy' => 'program_planning_and_controls',
                'field' => 'slug',
                'terms' => 'blog-posts'
            ),
            array(
                'taxonomy' => 'technology_solutions',
                'field' => 'slug',
                'terms' => 'blog-posts'
            )
        )
    ));
}
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
                    if($get_category) {
                        echo "<li><a href='".get_permalink()."'>All Categories</a></li>";
                    } else {
                        echo "<li class='active'><a href='".get_permalink()."'>All Categories</a></li>";
                    }
                    usort($resource_categories, function($a, $b){ return strcasecmp($a->label,$b->label); });
                    foreach ($resource_categories as $key => $value) {
                        if ($value->name == 'post_format') {

                        } elseif ($get_category == $value->name) {
                            echo "<li class='active'><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                        } else {
                            echo "<li><a href='" . $current_page_url . "?category=" . $value->name . "'>" . $value->label . "</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</section>

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
                                ?>
                                <a class="btn btn-primary btn-download" href="<?php echo get_permalink(); ?>" ><i class="fa fa-arrow-down" aria-hidden="true"></i>Read More</a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-primary btn-download openVideoBox" onclick="setVideoURL('<?php echo $video_url ?>','<?php the_title(); ?>')"><i class="fa fa-arrow-down" aria-hidden="true"></i>Watch Now</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="resource-clear"></div>
            <?php endwhile; ?>
        </div>
        <div class="pagination">
            <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $my_query->max_num_pages
            ) );
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
<?php
get_footer();
