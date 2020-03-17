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
    <div class="row">
        <div class="col-md-12 title-center">
            <h2><?php echo $sub_header_title = get_post_meta( get_the_ID(), 'page_title', true );?></h2>
        </div>
        <div class="col-md-12 text-center">
			<?php
				printf('<h4>%1$s</h4>',the_content());
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'cortac' ),
					'after'  => '</div>',
				) );
			?>
        </div>
    </div>
