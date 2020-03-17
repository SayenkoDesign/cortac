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
<article class="thumbnail item video" id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/CreativeWork">
    <?php
    if (has_post_thumbnail()) :
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'cortac-featured-image');

        $post_thumbnail_id = get_post_thumbnail_id($post->ID);

        $thumbnail_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'cortac-featured-image');

        // Calculate aspect ratio: h / w * 100%.
        $ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
        ?>
    <?php
        else:
            $thumbnail[0] = get_theme_file_uri('/assets/images/Home/Latest Insights/blog post.jpg');
    ?>
    <?php endif; ?>
    <!--<img src="<?php echo get_theme_file_uri('/assets/images/Home/Latest Insights/blog post.jpg') ?>" class="img-responsive" />-->
    <img src="<?php echo esc_url($thumbnail[0]); ?>" class="img-responsive" />
    <div class="caption">
        <button class="btn btn-link" data-toggle="modal" data-target="#myModal"><img src="<?php echo get_theme_file_uri('/assets/images/Home/Latest Insights/video play icon.png') ?>" /></button>
        <h4 itemprop="headline" class="text-center">
            <?php the_title(); ?>
            <br /><?php
                /* translators: %s: Name of current post */
                the_content(sprintf(
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cortac'), get_the_title()
                ));
                ?>
        </h4>
    </div>
</article>
