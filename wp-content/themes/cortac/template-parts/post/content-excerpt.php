<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo cortac_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<div class="row"> 
	<header class="entry-header">
		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="background-title" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') no-repeat;background-size:cover">
			<div class="row column title-container"> 
				<div class="row column">
			<?php
				if ( is_single() ) {
					the_title( '<h2 class="entry-title">', '</h2>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>	
				</div>
			</div>
			<div class="row column entry-meta">
				<?php
					if ( 'post' === get_post_type() ) :
						echo '<div class="row column entry-meta-date">';
							if ( is_single() ) :
								cortac_posted_on();
							else :
								echo cortac_time_link();
								cortac_edit_link();
							endif;
						echo '</div><!-- .entry-meta -->';
						echo '<div class="row column entry-meta-author">';
						$default = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y';
						$args = array('height' => 96,'width'=>96);
						echo get_avatar( get_the_author_meta('ID'), 96, $default, '', $args ); 
						echo '</div>';
					endif;
				?>
			</div>
		</div><!-- .post-thumbnail -->
		<div class="row column"> 
			<div class="row column entry-meta">
				<div class="row column entry-meta-byline"> 
					<?php echo 'By '.$author = get_the_author(); ?> 
				</div>
			</div>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	</div>

	<div class="row entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_excerpt( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cortac' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'cortac' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class="entry-footer">
		<?php if ( is_single() ) : ?>
			<?php cortac_edit_link();//cortac_entry_footer(); ?>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
	