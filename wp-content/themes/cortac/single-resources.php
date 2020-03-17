<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

get_header();
?>
<section class="service-detail generic">
<div class="container">
<div class="row"> <!--add this 2-->
<div class="single-post col-sm-12">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();


					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile; // End of the loop.
			?>
	</div>
	</div>
</div>
</section>
<?php
get_footer();
