<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<section class="blog generic clear">
<div class="container"> <!--add this 1-->
<div class="row"> <!--add this 2-->
<div class="col-md-9 left-section">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) :


            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */

                if ( is_blog() && !is_single()) {
                  get_template_part( 'template-parts/post/content-excerpt');
                } else {
                  get_template_part( 'template-parts/post/content', get_post_format() );
                }

            endwhile;
            ?>
            <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
        <?php
            else:

                get_template_part( 'template-parts/post/content', 'none' );

            endif;
        ?>
        </main>
    </div>
</div>
<div class="col-md-3 right-section">
    <?php get_sidebar(); ?>
</div>
</div>
</div>
</section><!-- #post-## -->
<div class="clear">&nbsp;</div>
<?php get_footer();?>
