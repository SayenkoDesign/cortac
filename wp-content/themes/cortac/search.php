<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="about-desc">
<div class="container">

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cortac' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'cortac' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'excerpt' );

			endwhile; // End of the loop.

			the_posts_pagination( array(
				'prev_text' => cortac_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'cortac' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'cortac' ) . '</span>' . cortac_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cortac' ) . ' </span>',
			) );

		else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cortac' ); ?></p>
			<?php
				get_search_form();
		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
</section>
<?php get_footer();
