<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?php wp_nav_menu( array(
                    'theme_location' => 'social',
                    'menu_id'        => 'social',
                    'walker' => new Custom_Walker_Social_Nav_Menu,
                ) ); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                <img src="<?php echo get_theme_file_uri('/assets/images/Logo/Logofooter.png') ?>" />
            </div>
            <?php get_template_part('template-parts/footer/site', 'info'); ?>
	

        </div>
    </div>
</footer>
<div class="modal fade modal-video" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="video">
                    <iframe width="640" height="360" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </div>
</div>

<?php wp_footer(); ?>
<a class="scroll-top" href="javascript:;"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</body>
</html>
