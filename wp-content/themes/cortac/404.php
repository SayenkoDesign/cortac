<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="service-detail generic text-center">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'This page cannot be found', 'cortac' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content ">
					<?php get_search_form(); ?>
				</div>
			</section><!-- .error-404 -->
</section>
<?php get_footer();
