<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="blog generic clear">
<div class="container"> <!--add this 1-->
<div class="row"> <!--add this 2-->
<div class="col-md-9 left-section">

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'excerpt' );

			endwhile;

            ?>
            <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
        <?php     


		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- .wrap -->
</div>
<div class="col-md-3 right-section">	
	<?php get_sidebar(); ?>
</div>	
</div>
</div>
</section>
<div class="clear">&nbsp;</div>
<?php get_footer();
